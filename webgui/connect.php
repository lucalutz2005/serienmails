<?php
/* Starte die Verbindung zu der Datenbank */
$servername = "localhost";    // Da die Datenbank nor lokal ist
$username   = "serienmails";  // Der User "Serienmails" wird in der Datenbank.sh erstellt und hat nur auf die Datenbank Serienmails Rechte
$password   = "garnix";       // Passwort darf auch unsicher sein, da es ja nur lokal ist
$dbname     = "serienmails";  // Die Datenbank "Serienmails wird extra in der Datenbank.sh fuer dieses Projekt erstellt
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Verbindung gescheitert: %s\n", mysqli_connect_error());
    exit();
}
?>
