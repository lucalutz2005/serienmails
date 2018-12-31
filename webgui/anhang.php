<html>
<head>
<title> Anhang upladen </title>
<link rel="stylesheet" type="text/css" href="style/anhang/style-form.css">
<link rel="stylesheet" type="text/css" href="style/anhang/style-text.css">
</head>
<body>

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
		$success_message = "Es hat funktioniert der Anhang wurde hochgeladen und verlinkt!";
		echo $success_message;
        }

	}
?>
  <form role="form"  action="anhang.php"  method="post" name="signupform" enctype="multipart/form-data">
  <h2>Anhang Hinzuf&uuml;gen</h2>

    <div class="group">  
      <input type="text" name="name" required value="<?php //if($error) echo $name; ?>" class="form-control" /> 
      <span class="highlight"></span>
      <span class="bar"></span>
      <label>Name des Events</label>
    </div>

	<span class="input">
<br />
<span></span>	
</span>
  <span class="border"></span>
    <!--    <label for="images">Images <span></span></label>
    <input type="file" name="datei" id="datei"  required="required" multiple="multiple"/>
    <div class="file-dummy">
      <div class="success">Supper, deine Datei wurde ausgew&auml;hlt</div>
      <div class="default">Zum ausw&auml;hlen klicken oder Dateien fallen lassen</div>
    </div>
  </div>-->
  <div class="form-group file-area">
        <label for="images"> <!--Anhang --> <span></span></label>
    <input type="file" name="datei" id="datei" required="required" multiple="multiple"/>
    <div class="file-dummy">
      <div class="success">Supper, deine Datei wurde ausgew&auml;hlt</div>
      <div class="default">Zum ausw&auml;hlen klicken oder Datei fallen lassen</div>
    </div>
  </div>


<link href='https://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700' rel='stylesheet' type='text/css'>

    <!--<input type="file" name="datei" id="datei"/>
    <label for="datei" class="btn-2">Hochladen</label>--> <br />

    <input type="submit" name="bestaetigen" value="Hinzufuegen" class="btn btn-primary" />
  </form>
</body>
</html>
