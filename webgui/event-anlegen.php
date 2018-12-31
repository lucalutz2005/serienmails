<html>
<head>
<title> Event anlegen </title>
</head>
<body>
<!-- Jetz wird PHP gestartet -->
<?php
include_once("connect.php");
session_start();

$error = false;
if (isset($_GET['signup'])) {
        $name   = mysqli_real_escape_string ($conn, $_GET['name']);
	$inhalt = mysqli_real_escape_string ($conn, $_GET['inhalt']);
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
                $error = true;
                $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        }
        if (!$error) {
        
	$inhalt_neu = "inhalte/" . $name ;
	$inhalt_mysql = '"' . $inhalt_neu . '"';
	//echo $inhalt_neu;
	file_put_contents($inhalt_neu, $inhalt);
	$name_neu   = '"' . $name   . '"';
	//echo $name_neu;
	//$sql = "DELETE FROM users WHERE name=" . $name_neu . ";";
	$sql = "INSERT INTO events(name, inhalt_pfad) VALUES(" . $name_neu . ", " . $inhalt_mysql . ")";
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
    <h2> Event anlegen </h2>

      <div class="form-group">
        <input type="text" name="name" id="name" placeholder="Voller Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
        <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
      </div>

      <div class="form-group">
        <input type="text" name="inhalt" id="inhalt" placeholder="Bitte Inhalt eintragen" required value="<?php if($error) echo $inhalt; ?>" class="form-control" />
      </div>
      
      <input type="submit" name="signup" value="Anlegen" class="btn btn-primary" />
  </fieldset>
</form>

</body>
</html>

