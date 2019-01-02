<html>
<head>
<title> User anlegen </title>
<link rel="stylesheet" href="style/inputs.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<?php
include_once("connect.php");
session_start();
$error = false;

if (isset($_GET['signup'])) {

	$hash     = mysqli_real_escape_string($conn, $_GET['hash']);
	$antwort  = mysqli_real_escape_string($conn, $_GET['antwort']);
	
	if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      	  $IP = $_SERVER['REMOTE_ADDR'];
	}
	else {
	  $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	$ip_1   = '"' . $IP   . '"';
	$ip_neu = '"' . $IP   . '"';
	$hash_1 = '"' . $hash . '"';
	if (!$error) {
		if(mysqli_query($conn, "SELECT * FROM `einladungen` WHERE hash = " . $hash_1 .";")) {
			if(mysqli_query($conn, "UPDATE `einladungen` SET antwort=" . $antwort .", IP='" . $IP . "' WHERE hash = " . $hash_1 .";")) {}
		  	if(mysqli_query($conn, "UPDATE `einladungen` SET IP=" . $IP_1 . " WHERE hash = " . $hash_1 .";")) { }  
		  $success_message = "Es hat funktioniert!";
	  	} 
	  else {
	    $error_message = "Es ist ein Fehler aufgtreten!";
	    echo $error_message;
	  }
	}


}
?>
   <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
     <h1>Hash eingeben</h1>
        <input type="text" name="hash" id="hash" value="<?php echo $hash; ?>" required class="input" readonly/>
	<div class="line-box">
          <div class="line"></div>
	</div>
	<br />
     <?php echo $success_message; ?>
     <?php echo $error_message; ?>
      <select name="antwort" id="antwort" class="form-control">
 	 <option value="0">Ich komme</option>
 	 <option value="1">Ich kann leider nicht kommen</option>
 	 <option value="2">Ich komme mit 1. Person</option>
  	 <option value="3">Ich komme mit 2. Person</option>
  	 <option value="4">Ich komme mit 3. Person</option>
	</select> 
     <br />    
     <button type="submit" name="signup">Bestaetigen</button>
  </form>


</body>
</html>
