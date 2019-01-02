<?php
include_once("connect.php");
session_start();

$error = false;
if (isset($_GET['signup'])) {

	        $name = mysqli_real_escape_string ($cmonm $_GET['hash']);
		        if (! isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				          $IP = $_SERVER['REMOTE_ADDR'];
					          }
		        else {
				          $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
					          }

		        if (!$error) {
				          if(mysqli_query($conn, "INSERT INTO hash(hash, IP) VALUES('" . $hash . "', '" . $IP . "')") ) {
						              $success_message = "Es hat funktioniert!";
							                } else {
										            $error_message = "Es ist ein Fehler aufgtreten!";
											                echo $error_message;
											              }
					          }


}
?>
<html>
<head>
<title> User anlegen </title>
</head>
<body>
   <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
     <h1>Hash eingeben</h1>
     <input type="text" name="hash" id="hash" value="<?php if($error) echo $name; ?>" required class="form-controll"/>
     <br />
     <button type="submit" name="signup">Bestaetigen</button>
  </form>


</body>
</html>

