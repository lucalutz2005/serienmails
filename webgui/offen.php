<html>
<head>
<title> Offene Events </title>
<link rel="stylesheet" href="style/inputs.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

   <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">
     	<h1>Eventname Eingeben</h1>

	<!--<label>
	  <label class="label-txt" style="top: -4.3em">Name</label>
	  <input type="text" name="name" id="name" placeholder="<?php //if($name) echo $name; ?>" required class="input"/>
	  <div class="line-box">
      	    <div class="line"></div>
    	  </div>
	</label>-->
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
     <?php echo $tables; ?>
     <br />
     <button type="submit" name="signup">Bestaetigen</button>

<?php
$error = false;

$name  = mysqli_real_escape_string($conn, $_GET['name']);



						 $sql = "SELECT * FROM `einladungen` WHERE antwort IS NULL AND event_name = '" . $name . "'";
			                         $result = $conn->query($sql);
					
						 echo "<br />";
						 echo "<br />";
						 echo "<br />";
						 echo "<br />";
						 #echo "Die folgenden Nutzer haben die Mail &uumlber " . $name . "noch nicht gelesen!";
						 echo '<table  style="margin-left: auto; margin-right: auto; text-align: left;">'; # border = 4;
						 echo '<colgroup> <col width="150"> <col width="250"> <col width="165"> </colgroup>';
						 echo '<tr> <a style="color: red"> Die folgenden Nutzer haben die Mail &uumlber ' . $name . ' noch nicht gelesen!</a> </tr>';
						 echo "<tr> <td> Name </td> <td> Email </td> <td> Manuel Bestaetigen </td> </tr>";
						 if ($result->num_rows > 0) {
						 while($row = $result->fetch_assoc()) {
							 echo "<tr>";
							 echo "<td>";
							 echo $row["user_name"];
							 echo "</td>";
							 echo "<td>";
							 echo $row["user_email"];
							 echo "</td>";
							 echo "<td>";
							 echo "<a href='https://papier.lucalutz.org/bestaetigung.php?hash=" . $row["hash"] . "&signup=''> Als Best&aumltigt eintragen</a>" . "<br>";
							 echo "</td>";
							 echo "</tr>";
		                                 }
						 } else {
							 echo "<br /> <br /> Supper keine offenen Einladungen mehr";
						 }
						 echo '</table>';
						 $sql = "SELECT SUM(antwort) FROM `einladungen` WHERE event_name = '".$name."';";
						 //echo $sql;
						 $count = mysqli_fetch_array(mysqli_query($conn, $sql));
						 $result = $conn->query($sql);
						 if ($result->num_rows > 0) {
							 while($row = $result->fetch_assoc()) {
								 #echo $row["*"];
								 echo "Es kommen " . $row["SUM(antwort)"] . " Personen";
								 //echo $row;
								 //echo $row[""];
								 #echo $row["*"];

							 }
						 }

?>

  </form>

</body>
</html>
