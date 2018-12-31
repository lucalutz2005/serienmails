<?php
/* Starte Die verbindung zu der Datenbank */
$servername = "localhost";
$username   = "serienmails";
$password   = "garnix";
$dbname     = "serienmails";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    printf("Verbindung gescheitert: %s\n", mysqli_connect_error());
    exit();
}
?>
