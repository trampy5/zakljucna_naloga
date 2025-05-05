<?php
session_start();

if (!isset($_POST['product_id']) || !isset($_POST['table'])) {
    // Neveljaven dostop ali manjkajoči podatki
    header("Location: Prikazizdelkov.php");
    exit;
}

$product_id = $_POST['product_id'];
$table      = $_POST['table'];

// Inicializiraj košarico, če še ne obstaja
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// Inicializiraj tabelo v košarici, če še ne obstaja
if (!isset($_SESSION['cart'][$table])) {
    $_SESSION['cart'][$table] = [];
}
// Če izdelek še ni v košarici, ga nastavi
if (!isset($_SESSION['cart'][$table][$product_id])) {
    $_SESSION['cart'][$table][$product_id] = ['quantity' => 0];
}

// Povečaj količino za 1
$_SESSION['cart'][$table][$product_id]['quantity'] += 1;

// Preusmeri nazaj na stran s prikazom izdelkov
header("Location: Prikazizdelkov.php?table=" . urlencode($table));
exit;
