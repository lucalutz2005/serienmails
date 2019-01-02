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
  echo "Verzeichnis nicht gfunden! ({$dirname})";
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
if (isset($_GET['signup'])) {
        $name = mysqli_real_escape_string ($conn, $_GET['name']);

	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
                $error = true;
                $uname_error = "Der Name darf nur Bustaben und Leertasten enthalten";
        }
        if (!$error) {

	$name_neu = '"' . $name . '"';
	//echo $name_neu;
	$pfad_rm = "upload/" . $name;
	delete_directory($pfad_rm);	
	$sql = "DELETE FROM events WHERE name=" . $name_neu . ";";
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
<!--  <fieldset>
    <h2>Event l&ouml;schen</h2>
      <div class="form-group">
        <input type="text" autocomplete="off" name="name" id="name" placeholder="Voller Name" required value="<?php if($error) echo $name; ?>" class="form-control" />
        <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
      </div>
      
      <input type="submit" name="signup" value="l&ouml;schen" class="btn btn-primary" />
  </fieldset>
</form> -->











<div>
  <label>
    <p class="label-txt">Name des Events</p>
    <input type="text" autocomplete="off" name="name" id="name" required value="<?php if($error) echo $name; ?>" class="input">
    <div class="line-box">
      <div class="line"></div>
    </div>
  </label>
<br />
<br />
  <button type="submit" name="signup">L&ouml;schen</button>
    <span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
</div>
</form>

</body>
</html>
