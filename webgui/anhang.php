<?php
include 'login_test.php';  // Funktioniert
?>

<html>
<head>
<title> Anhang upladen </title>
<link rel="stylesheet" type="text/css" href="style/anhang/style-form.css">
<!--<link rel="stylesheet" type="text/css" href="style/anhang/style-text.css"> -->
<link rel="stylesheet" type="text/css" href="style/inputs.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form role="form"  action="anhang.php"  method="post" name="signupform" enctype="multipart/form-data">
<!--<div> -->
<h2>Anhang Hinzuf&uuml;gen</h2>
<?php
include_once("connect.php");
session_start();
$error = false;

if (isset($_POST['bestaetigen'])) {
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$mkdir_pfad = "upload/" . $name;
	mkdir($mkdir_pfad, 0777);
	move_uploaded_file($_FILES['datei']['tmp_name'], 'upload/'.$name.'/'.$_FILES['datei']['name']);
	$pfad1 = $_FILES['datei']['name'];
	$pfad_upload = 'upload/'. $name . '/' . $pfad1;
	//echo $pfad_upload;
	$name1 = '"' . $name . '"';
	$pfad_mysql = '"' . $pfad_upload . '"';
	//echo $pfad_mysql;
	$sql = "UPDATE events SET anhang_pfad = " . $pfad_mysql  . " WHERE name = " . $name1 ;
	//echo $sql;
	if(mysqli_query($conn, $sql))
        {
		$success_message = '<a style="color: red">' . 'Es hat funktioniert der Anhang wurde hochgeladen und verlinkt!' . '</a> <br />';
		echo $success_message;
        }

	}

        $sql = "SELECT * FROM `events`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
	  echo '<select name="name">';
	  echo '<option value="">Bitte ausw&auml;hlen</option>';
          while($row = $result->fetch_assoc()) {
	    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>';
	    }
	    # echo '/select>';
	    # echo "<br />";
	 } else {
         echo "Es sind leider Keine Events Verfuegbar";
	 }

 
?>
</select>
<br />
<br />
  <!--<span class="border"></span> -->
    <!--    <label for="images"> </span></label> -->
    <div class="file-area">
	<input class="file-area" type="file" name="datei" id="datei"  required="required" multiple="multiple"/>
    <div class="file-dummy">
      <div class="success">Supper, deine Datei wurde ausgew&auml;hlt</div>
      <div class="default">Zum ausw&auml;hlen klicken oder Dateien fallen lassen</div>
    </div>
</div>
<br />
<br />
  <button type="submit" name="bestaetigen" value="Hinzufuegen">Anlegen</button>
</form>
</body>
</html>

