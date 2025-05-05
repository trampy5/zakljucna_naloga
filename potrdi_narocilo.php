<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/zaklucna/Login/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$cart = $_POST['cart'] ?? '';
$address = trim($_POST['shipping_address'] ?? '');
$payment = trim($_POST['payment_method'] ?? '');

if (!$cart || !$address || !$payment) {
    echo "Manjkajo podatki za naročilo.";
    exit();
}

$stmt = $conn->prepare("INSERT INTO narocila (username, order_data, shipping_address, payment_method) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $cart, $address, $payment);

if ($stmt->execute()) {
    echo "<script>
        localStorage.removeItem('cart');
        alert('Naročilo uspešno oddano!');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "Napaka pri shranjevanju naročila: " . $stmt->error;
}

$stmt->close();
?>
