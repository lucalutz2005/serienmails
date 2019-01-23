<html>															<!-- beginn des HTMLs -->
<head>															<!-- beginn des HTML heads -->
<title> Offene Events </title>    										
<link rel="stylesheet" href="style/inputs.css">										<!-- Mein eigenes Stylesheet -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">	<!-- Automatisiert den Style -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>                             	
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>                               	
</head>  														<!-- ende des HTML heads -->
<body>															<!-- beginn des HTML bodys-->
   <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="signupform">			<!-- Ein Formular beginnt-->
     	<h1>Eventname Eingeben</h1>											<!-- Die ueberschrifft -->
<?php					// Beginn von PHP
include_once("connect.php");		// Den Connector einbeziehen in dem alle Verbindungsdaten enthalten sind
session_start();			// Starten der PHP Session

$error = false;				
$name  = mysqli_real_escape_string($conn, $_GET['name']); // Den Dropdown auslesen
$sql = "SELECT * FROM `events`";	// Die Sql Variable auf den aktuellen Befehl setzen
$result = $conn->query($sql);		// Die Variable result wird mit dem Ergebnis des MySQL Befehls gefuellt

if ($result->num_rows > 0) {		// Es wird geprueft, ob die Variable result leer ist. Wenn dies nicht der Fall ist soll Folgendes passieren
  echo '<select name="name">';		// Das Dropdown Auswahlmenue starten
  echo '<option value="">Bitte ausw&auml;hlen</option>'; // Das erste Beispiel zum Dropdown Auswahlmenue hinzufuegen
  while($row = $result->fetch_assoc()) {		 // solange noch nicht alle Daten von der Variable abgearbeitet sind soll Folgendes passieren
    echo '<option value="' . $row["name"] . '">' . $row["name"] . '</option>'; // Die Events nacheinander zum Dropdown Auswahlmenue hinzufuegen
  }
  echo '</select>';                     // Das Dropdown Auswahlmenue beenden
  echo "<br />";                        // einen HTML Zeilenumbruch erzeugen
  echo "<br />";                        // einen HTML Zeilenumbruch erzeugen
  } 
  else { 				// Wenn die Variable result leer ist soll Folgendes passieren
    echo "Es sind leider keine Events verfuegbar"; 
  }

echo '<button type="submit" name="signup">Best&auml;tigen</button>'; // Einen Button mit der Aufschrift Bestaetigen hinzufuegen

$sql = "SELECT * FROM `einladungen` WHERE antwort IS NULL AND event_name = '" . $name . "'"; // Die Sql Variable mit dem aktuellen Befehl updaten
$result = $conn->query($sql);								     // Die Variable result wird auf das Ergebnis des MySQL Befehls upgedatet

echo "<br />";	// einen HTML Zeilenumbruch erzeugen
echo "<br />";  
echo "<br />";  
echo "<br />";  
echo '<table  style="margin-left: auto; margin-right: auto; text-align: left;">';    // Eine Tabelle beginnen
echo '<colgroup> <col width="150"> <col width="250"> <col width="165"> </colgroup>'; // Die Spalten richtig formatieren
echo '<tr> <a style="color: red"> Die folgenden Nutzer haben die Mail &uumlber ' . $name . ' noch nicht gelesen!</a> </tr>'; // Ausgeben eines Textes der eine Variable enthaelt, somit ist er dynamisch
echo "<tr> <td> Name </td> <td> Email </td> <td> manuell Bestaetigen </td> </tr>";    // Hinzufuegen des Tabellen-Headers
if ($result->num_rows > 0) {			// Es wird geprueft, ob die Variable result leer ist, wenn dies nicht der Fall ist soll Folgendes passieren
  while($row = $result->fetch_assoc()) {	// solange noch nicht alle Daten von der Variable abgearbeitet sind soll Folgendes passieren
    echo "<tr>";				// Es wird eine neue Zeile hinzugefuegt
    echo "<td>";				// Es wird eine Zelle hinzugefuegt
    echo $row["user_name"];			// In diese wird der Names des Benutzers eingetragen
    echo "</td>";				// Die Zelle wird beendet
    echo "<td>";				// Es wird eine Zelle hinzugefuegt
    echo $row["user_email"];			// In diese wird die E-Mail des Benutzers eingetragen
    echo "</td>";				// Die Zelle wird beendet
    echo "<td>";				// Es wird eine Zelle hinzugefuegt
    echo "<a href='https://papier.lucalutz.org/webgui/bestaetigung.php?hash=" . $row["hash"] . "&signup=''> Als Best&aumltigt eintragen</a>" . "<br>";  // In diese wird ein Link hinzugefuegt mit dem man den Benutzer bestaetigen kann
    echo "</td>";				// Die Zelle wird beendet
    echo "</tr>";				// Die Zeile wird beendet
  }
} 
else {						// Wenn die Variable result leer ist soll Folgendes passieren
  echo "<br />";				// einen HTML Zeilenumbruch erzeugen
  echo "<br />";				// einen HTML Zeilenumbruch erzeugen
  echo "Super, keine offenen Einladungen mehr";	// Gebe auf der Website aus: Super, keine offenen Einladungen mehr
}
echo '</table>';				// Die Tabelle wird beendet
$sql = "SELECT SUM(antwort) FROM `einladungen` WHERE event_name = '".$name."';"; // Die Sql Variable mit dem aktuellen Befehl updaten
$result = $conn->query($sql);							 // Die Variable result wird auf das Ergebnis des MySQL Befehls upgedatet

if ($result->num_rows > 0) {					// Es wird geprueft, ob die Variable result leer ist. Wenn dies nicht der Fall ist soll Folgendes passieren
  while($row = $result->fetch_assoc()) {			// solange noch nicht alle Daten von der Variable abgearbeitet sind soll Folgendes passieren
    echo "Es kommen " . $row["SUM(antwort)"] . " Personen";     // Gebe auf der Website aus: Es kommen [Zahl der kommenden Personen] 
  }
}
?>
</form>						<!-- Das Formular wird beendet -->
</body>						<!-- ende des HTML body's -->
</html>						<!-- ende des HTML's -->
