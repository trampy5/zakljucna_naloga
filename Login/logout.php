<?php
session_start();

// Počistimo vse sejne spremenljivke
session_unset();

// Uničimo sejo
session_destroy();

// Preberemo parameter redirect, če obstaja, sicer uporabimo 'index.php'
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';

// Preusmerimo nazaj na prejšnjo stran
header('Location: ' . $redirect);
exit;
?>
