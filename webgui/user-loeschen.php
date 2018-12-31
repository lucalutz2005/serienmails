<html>
<head>
<title> User l&ouml;schen </title>
</head>
<body>
<!-- Jetz wird PHP gestartet -->
<?php
include_once("connect.php");
session_start();

$error = false;
if (isset($_GET['signup'])) {
        $name = mysqli_real_escape_string ($conn, $_GET['name']);

	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
                $error = true;
                $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        }
        if (!$error) {

	$name_neu = '"' . $name . '"';
	//echo $name_neu;
	$sql = "DELETE FROM users WHERE name=" . $name_neu . ";";
	//echo $sql;
	if(mysqli_query($conn, $sql)) { 
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
  <fieldset>
    <h2>User l&ouml;schen</h2>
      <div class="form-group">
        <input type="text" name="name" id="name" placeholder="Voller Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
        <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
      </div>
      
      <input type="submit" name="signup" value="Endg&uuml;ltig l&ouml;schen" class="btn btn-primary" />
  </fieldset>
</form>

</body>
</html>

