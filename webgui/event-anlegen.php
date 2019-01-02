<html>
<head>
<title> Event anlegen </title>
<link rel="stylesheet" href="style/input.css">
 <link rel="stylesheet" type="text/css" href="style/inputs.css">
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
        $name   = mysqli_real_escape_string ($conn, $_GET['name']);
	$inhalt = mysqli_real_escape_string ($conn, $_GET['inhalt']);
	#if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        #        $error = true;
        #        $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        #}
        if (!$error) {
        
	$inhalt_neu = "inhalte/" . $name ;
	$inhalt_mysql = '"' . $inhalt_neu . '"';
	//echo $inhalt_neu;
	file_put_contents($inhalt_neu, $inhalt);
	$name_neu   = '"' . $name   . '"';
	//echo $name_neu;
	//$sql = "DELETE FROM users WHERE name=" . $name_neu . ";";
	$sql = "INSERT INTO events(name, inhalt_pfad) VALUES(" . $name_neu . ", " . $inhalt_mysql . ")";
	shell_exec("mails_for_php.sh '".$name."'");
	$meldung = shell_exec('/home/luca/serienmails/webgui/mails_for.sh "'.$name.'"');
	echo $maeldung;
	if(mysqli_query($conn, $sql)) { 
	  $success_message = "Es hat funktioniert!";
	  echo $success_message;
	}
	else {
          $error_message = "Bitte Daten eingeben!";
	  echo $error_message;
	}
	
}
}
?>

<div>
  <label>
    <p class="label-txt">Name des Events</p>
    <input type="text" autocomplete="off" name="name" id="name" required value="<?php if($error) echo $name; ?>" class="input">
    <div class="line-box">
      <div class="line"></div>
    </div>
  </label>
<br />
  <label>
    <p class="label-txt">Inhalt</p>
    	<textarea placeholder="Hier den Inhalt der auch der Body der Mail ist" rows="2" cols="20" name="inhalt" id="inhalt" class="input"></textarea>
	<div class="line-box">
      <div class="line"></div>
    </div>
  </label>
<br />
<br />
  <button type="submit" name="signup">Anlegen</button>
    <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
</div>
</form>


</body>
</html>

