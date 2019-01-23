<?php
include 'login_test.php';  // Funktioniert
?>

<html>
<head>
<title> Event Exportieren </title>
<link rel="stylesheet" type="text/css" href="style/inputs.css">
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

	if (!preg_match("/^[a-zA-Z]+$/",$name)) {
                $error = true;
                $uname_error = "<br />"."Bitte ein Event ausw&auml;hlen!!!";
	}
        if (!$error) {

	$name_neu = '"' . $name . '"';
	$meldung =  shell_exec('/home/luca/serienmails/webgui/adresse.sh "'.$name.'"');
        echo $meldung;
	$meldung1 = shell_exec('/home/luca/serienmails/webgui/zip.sh "'.$name.'"');
        echo $meldung1;
	header("Location: https://".$_SERVER["HTTP_HOST"]."/smt/".$name.".zip".""); /* Browser umleiten */ 
}
}
?>



<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
   
<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>










<h1>Event Exportieren</h1>
<div>

<?php
include_once("connect.php");
session_start();

$sql = "SELECT * FROM `events`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<select name="name">';
  echo '<option value="">Bitte ausw&auml;hlen</option>';
  while($row = $result->fetch_assoc()) {
    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
  }
  echo '</select>';
  echo "<br />";
  } else {
  echo "Es sind leider Keine Events Verfuegbar";
  }
?>
<br />
<br />
  <button type="submit" name="signup">Exportieren</button>
</div>
</form>

</body>
</html>
