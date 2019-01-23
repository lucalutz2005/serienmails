<?php
include 'login_test.php';  // Funktioniert
?>

<html>
<head>
<title> User anlegen </title>
<link rel="stylesheet" href="style/inputs.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
<!-- Jetz wird PHP gestartet -->
<?php
include_once("connect.php");
session_start();

$error = false;
if (isset($_GET['signup'])) {
        $name = mysqli_real_escape_string ($conn, $_GET['name']);
        $email = mysqli_real_escape_string($conn, $_GET['email']);
        $adress1 = mysqli_real_escape_string($conn, $_GET['adress1']);
        $adress2 = mysqli_real_escape_string($conn, $_GET['adress2']);
	if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	  $IP = $_SERVER['REMOTE_ADDR'];
	}
	else {
          $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}

	if (!preg_match("/^[a-zA-Z ].+$/",$name)) {
                $error = true;
                $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $error = true;
                $email_error = "Bitte gebe eine g&uuml;ltige email ein";
        }
	
	$sql = "SELECT * FROM `users`";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          if ($row["name"] == $name)
            $error = 1;
          }
          } else {
          }

	$sql = "SELECT * FROM `users`";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          if ($row["email"] == $email)
            $error = 1;
          }
          } else {
          }
	
        if (!$error) {
        
	//$sql = "INSERT INTO users(name, IP, mail) VALUES('" . $name . "', '" . $IP . "', '" . $email . "')";
	//echo $sql;
	if(mysqli_query($conn, "INSERT INTO users(name, IP, email, Adresse1, Adresse2) VALUES('" . $name . "', '" . $IP . "', '" . $email . "', '" . $adress1 . "', '" . $adress2 . "')") ) { 
	  $success_message = "<br />"."Es hat funktioniert!"."<br />";
	  echo $success_message;
	}  
	else {
          $error_message = "<br />" . "Es ist ein MySQL-Fehler aufgtreten!" . "<br />";
	  echo $error_message;
	}
	
}
	else {
          $error_message = "<br />" . "Es ist ein Fehler bei Ihren Eingaben aufgtreten!" . "<br />";
	  echo $error_message;
	}
}
?>


	Bitte ä=ae; ü=ue; ö=oe <br />
   
     <!-- <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>  -->
    <!-- <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span> -->
<h1>User hinzuf&uuml;gen</h1>
   <label>
     <label style="top: -4.3em;" class="label-txt" for="title">Name</label>
     <input type="text" name="name" class="input"id="name" value="<?php if($error) echo $name; ?>" required class="form-controll"/>
     <div class="line-box">
       <div class="line"></div>
     </div> 
   </label>
   
   <br />
   
   <label>
     <label style="top: -4.3em;" class="label-txt" for="caption">E-Mail</label>
     <input type="text" name="email" id="email" class="input" required value="<?php if($error) echo $email; ?>" required class="form-controll"/>
     <div class="line-box">
       <div class="line"></div>
     </div>
   </label>

  <br />

   <label>
     <label style="top: -4.3em;" class="label-txt" for="caption">Land; PLZ. Ort</label>
     <input type="text" name="adress1" id="adress1" class="input" required value="<?php if($error) echo $adress1; ?>" required class="form-controll"/>
     <div class="line-box">
       <div class="line"></div>
     </div>
   </label>
  
  <br />
   
   <label>
     <label style="top: -4.3em;" class="label-txt" for="caption">Straße Hausnummer</label>
     <input type="text" name="adress2" id="adress2" class="input" required value="<?php if($error) echo $adress2; ?>" required class="form-controll"/>
     <div class="line-box">
       <div class="line"></div>
     </div>
   </label>

  <br />
  <br />
  <br />

<button type="submit" name="signup">Registrieren</button>
</form>



</body>
</html>

