<?php
session_start(); // Začetek seje, da lahko pridobimo podatke o prijavljenem uporabniku
include("login/db.php"); // Povezava do baze

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pridobivanje in čiščenje podatkov iz obrazca
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Pridobivanje uporabniškega imena iz seje
    if (isset($_SESSION['username'])) {
        $username = mysqli_real_escape_string($conn, $_SESSION['username']);
    } else {
        // Če uporabnik ni prijavljen, lahko nastavite privzeto vrednost ali izvedete napako
        $username = 'guest';
    }

    // SQL poizvedba za vstavljanje podatkov v tabelo narocila_storitve
    $sql = "INSERT INTO narocila_storitve (name, email, phone, service, date, message, username)
            VALUES ('$name', '$email', '$phone', '$service', '$date', '$message', '$username')";

    if (mysqli_query($conn, $sql)) {
        echo "Naročilo je bilo uspešno oddano!";
    } else {
        echo "Napaka pri oddaji naročila: " . mysqli_error($conn);
    }
}
?>
