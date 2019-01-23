<?php
include 'login_test.php';  // Funktioniert
?>

<html>
<head>
<link rel="stylesheet" href="style/inputs.css"> 
<title> User l&ouml;schen </title>
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

	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
                $error = true;
                $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        }
        if (!$error) {

	$name_neu = '"' . $name . '"';
	//echo $name_neu;
	$sql = "DELETE FROM `admins` WHERE username=" . $name_neu . ";";
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
        <div class="form-group">
	  <h1>Admin l&ouml;schen</h1>
	</div>

	<label>
<!--	<label class="label-txt" style="top: -4.3em; right: 12.8em" for="name1234">Name</label> -->
<?php
include_once("connect.php");
session_start();

$sql = "SELECT * FROM `admins`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<select name="name">';
  echo '<option value="">Bitte ausw&auml;hlen</option>';
  while($row = $result->fetch_assoc()) {
    echo '<option value="' . $row["username"] . '">' . $row["username"] . '</option>';
  }
  echo '</select>';
  echo "<br />";
  } else {
  echo "Es sind leider Keine Events Verfuegbar";
  }
?>
<br />
<br />
        <!--<div class="form-group">
        <input type="text" name="name" id="name" required value="<?php if($error) echo $name; ?>" class="input"/>
        <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
	<div class="line-box">
       	<div class="line"></div>
    	</div>      
	</div>
	</label>-->

        <button type="submit" name="signup">Endg&uuml;ltig l&ouml;schen</button>
</form>

</body>
</html>

