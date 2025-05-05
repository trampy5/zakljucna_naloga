<?php
$host = "localhost";
$user = "root"; // Spremeni glede na nastavitve
$pass = "";
$dbname = "test1"; // Spremeni glede na tvojo bazo

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Povezava ni uspela: " . $conn->connect_error);
}
?>
