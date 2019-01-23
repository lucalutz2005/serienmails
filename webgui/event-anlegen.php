<?php
include 'login_test.php';  // Funktioniert
?>

<html>
<head>
<title> Event anlegen </title>
<link rel="stylesheet" href="style/input.css">
<link rel="stylesheet" type="text/css" href="style/inputs.css">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
</script>

<script>
$(function(){
 // $("#header").load("header.html");
});
</script>

</head>
<body>
<div id="header"></div>
<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
<!-- Jetz wird PHP gestartet -->
<?php
include_once("connect.php");
session_start();

$error = false;
if (isset($_GET['signup'])) {
        $name   = mysqli_real_escape_string ($conn, $_GET['name']);
	$inhalt = mysqli_real_escape_string ($conn, $_GET['inhalt']);

        if (!preg_match("/^[a-zA-Z0-9]+$/",$name)) {
                $error = true;
		echo "<br />";
                $uname_error = "Der Name darf nur Bustaben enthalten";
        }

	#if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        #        $error = true;
        #        $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        #}
	$inhalt_neu = "inhalte/" . $name ;
	$inhalt_mysql = '"' . $inhalt_neu . '"';
	$name_neu   = '"' . $name   . '"';
        
	$sql = "SELECT * FROM `einladungen` WHERE event_name = '" . $name . "'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          if ($row["event_name"] == $name)
	    $error = 1;
          }
          } else {
          }

	if (!$error) {
	//echo $inhalt_neu;
	file_put_contents($inhalt_neu, $inhalt);
	//echo $name_neu;
	//$sql = "DELETE FROM users WHERE name=" . $name_neu . ";";
	
	$sql = "INSERT INTO events(name, inhalt_pfad) VALUES(" . $name_neu . ", " . $inhalt_mysql . ")";
	shell_exec("mails_for_php.sh '".$name."'");
	$ordner = shell_exec('/home/luca/serienmails/webgui/erstelle_ordner.sh "'.$name.'"');
	$meldung = shell_exec('/home/luca/serienmails/webgui/mails_for.sh "'.$name.'"');
  	echo $ordner;	
	echo $maeldung;
	if(mysqli_query($conn, $sql)) { 
	  $success_message = "Es hat funktioniert!";
	  echo $success_message;
	}
	else {
          $error_message = "Bei der MySQL Abfrage liegt ein Fehler vor!";
	  echo '<span class="text-danger">' . $error_message . '</span>';
	}
	
}
else {
echo '<span class="text-danger">' . "Es ist ein Fehler aufgetreten"  . '</span>';
}
}
?>

<br /><span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
<h1>Event anlegen</h1>
<div>
  <label>
    <p class="label-txt">Name des Events</p>
    <input type="text" autocomplete="off" name="name" id="name" required value="<?php if($error) echo $name; ?>" class="input">
    <div class="line-box">
      <div class="line"></div>
    </div>
  </label>
<br />

<!--
		<div class="container-fluid">
		<div class="row">
		<h2 class="demo-text">LineControl Demo</h2>
		<div class="container">	
		<div class="row">
		<div class="col-lg-12 nopadding">
    	<textarea placeholder="Hier den Inhalt der auch der Body der Mail ist" rows="2" cols="20" name="inhalt" id="inhalt" class="input"><?php echo $inhalt;?></textarea>


		</div>
		</div>
		</div>
		</div>
		</div>-->

  <label>
    <p class="label-txt">Inhalt</p>
    	<textarea placeholder="Hier den Inhalt der auch der Body der Mail ist" rows="2" cols="20" name="inhalt" id="inhalt" class="input"><?php echo $inhalt;?></textarea>
	<div class="line-box">
      <div class="line"></div>
    </div>
  </label>
<br />
<br />
  <button type="submit" name="signup">Anlegen</button>
</div>
</form>


</body>
</html>

