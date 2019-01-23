<?php
include 'login_test.php';  // Funktioniert
?>

<html>
<head>
<title> Event l&ouml;schen </title>
<link rel="stylesheet" type="text/css" href="style/inputs.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<!-- Jetz wird PHP gestartet -->
<?php




include_once("connect.php");
function delete_directory($dirname)
{   
if(is_dir($dirname)) $dir_handle = opendir($dirname);
//Falls Verzeichnis nicht geoeffnet werden kann, mit Fehlermeldung terminieren
if(!$dir_handle)
{ 
  #echo "Verzeichnis nicht gfunden! ({$dirname})";
  return  false;
}
while($file=readdir($dir_handle))
{  
  if($file!="." && $file!="..")
{  
  if(!is_dir($dirname."/".$file))
{ 
//Datei loeschen 
@unlink($dirname."/".$file);
}
else
{ 
//Falls es sich um ein Verzeichnis handelt, "delete_directory" aufrufen
delete_directory($dirname.'/'.$file);
}
}
}
closedir($dir_handle);
//Verzeichnis loeschen
rmdir($dirname);
return  true;
}

session_start();

$error = false;
if (isset($_GET['name'])) {
        $name = mysqli_real_escape_string ($conn, $_GET['name']);

        if (!$error) {

	$name_neu = '"' . $name . '"';
	//echo $name_neu;
	//$meldung =  shell_exec('/home/luca/serienmails/webgui/adresse.sh "'.$name.'"');
        //echo $meldung;
	#makeDownload($name.".zip", "/home/luca/serienmails/webgui/smt/", "application/zip");
        #readfile("/home/luca/serienmails/webgui/smt/".$name.".zip");
	$pfad_rm = "upload/" . $name;
	delete_directory($pfad_rm);	
	$pfad_rm = "adressen/" . $name;
	delete_directory($pfad_rm);	
	$sql = "DELETE FROM events WHERE name=" . $name_neu . ";";
	$pfad_rm = "inhalte/" . $name;
	unlink($pfad_rm);	
	//echo $sql;
	if(mysqli_query($conn, $sql)) { 
	  $success_message = "Es hat funktioniert!";
	  #echo $success_message;
	}
	else {
          $error_message = "Es ist ein Fehler aufgtreten!";
	  #echo $error_message;
	}
	$sql = "DELETE FROM einladungen WHERE event_name=" . $name_neu . ";";
	if(mysqli_query($conn, $sql)) { 
	  #$success_message = "Es hat funktioniert!";
	  //echo $success_message;
	}
	else {
          #$error_message = "Es ist ein Fehler aufgtreten!";
	  echo $error_message;
	}
	
}
}
?>



<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
 <span ><?php if (isset($success_message)) echo $success_message; ?></span> 
 <span class="text-danger"><?php if (isset($error_message)) echo $error_message; ?></span> 
<h1>Event L&ouml;schen</h1>
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
  <button type="submit" name="signup">L&ouml;schen</button>
    <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
</div>
</form>

</body>
</html>
