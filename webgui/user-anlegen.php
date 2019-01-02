<html>
<head>
<title> User anlegen </title>
<link rel="stylesheet" href="style/inputs.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<!-- Jetz wird PHP gestartet -->
<?php
include_once("connect.php");
session_start();

$error = false;
if (isset($_GET['signup'])) {
        $name = mysqli_real_escape_string ($conn, $_GET['name']);
        $email = mysqli_real_escape_string($conn, $_GET['email']);
	if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	  $IP = $_SERVER['REMOTE_ADDR'];
	}
	else {
          $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}

	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
                $error = true;
                $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $email_error = "Bitte gebe eine g&uuml;ltige email ein";
        }
        if (!$error) {
        
	//$sql = "INSERT INTO users(name, IP, mail) VALUES('" . $name . "', '" . $IP . "', '" . $email . "')";
	//echo $sql;
	if(mysqli_query($conn, "INSERT INTO users(name, IP, email) VALUES('" . $name . "', '" . $IP . "', '" . $email . "')") ) { 
	  $success_message = "Es hat funktioniert!";
	  echo $success_message;
	}
	else {
          $error_message = "Es ist ein Fehler aufgtreten!";
	  echo $error_message;
	}
	
}
}
?>



<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
    <h1>User hinzuf&uuml;gen</h1>
   
   <label>
     <label style="top: -4.3em;" class="label-txt" for="title">Name</label>
     <input type="text" name="name" class="input"id="name" value="<?php if($error) echo $name; ?>" required class="form-controll"/>
     <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
     <div class="line-box">
       <div class="line"></div>
     </div> 
   </label>
   
   <br />
   
   <label>
     <label style="top: -4.3em;" class="label-txt" for="caption">E-Mail</label>
     <input type="text" name="email" id="email" class="input" required value="<?php if($error) echo $email; ?>" required class="form-controll"/>
     <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
     <div class="line-box">
       <div class="line"></div>
     </div>
   </label>

  <br />

   <button type="submit" name="signup">Registrieren</button>

</form>

</body>
</html>

