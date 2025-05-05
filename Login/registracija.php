<?php
include "db.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = trim($_POST['ime']);
    $priimek = trim($_POST['priimek']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $geslo = $_POST['geslo'];
    $geslo2 = $_POST['geslo2'];

    // Preveri, ali gesli sovpadata
    if ($geslo !== $geslo2) {
        $error = "Gesli se ne ujemata!";
    } else {
        // Preveri, ali uporabniško ime ali email že obstaja
        $check_sql = "SELECT id FROM uporabniki WHERE email = ? OR username = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("ss", $email, $username);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error = "Uporabniško ime ali email že obstaja!";
        } else {
            // Shrani uporabnika v bazo
            $hashGeslo = password_hash($geslo, PASSWORD_DEFAULT);
            $sql = "INSERT INTO uporabniki (ime, priimek, username, email, geslo) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $ime, $priimek, $username, $email, $hashGeslo);

            if ($stmt->execute()) {
                header("Location: registracija-OK.php"); // Preusmeri na potrditev registracije
                exit();
            } else {
                $error = "Napaka pri registraciji.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija - Rezultat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="form-container">
        <h2 class="text-center">Rezultat registracije</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <div class="text-center mt-3">
                <a href="registracija-obrazec.php" class="btn btn-primary">🔄 Poskusi znova</a>
            </div>
        <?php else: ?>
            <div class="alert alert-success text-center">Registracija je bila uspešna!</div>
            <div class="text-center mt-3">
                <a href="prijava.php" class="btn btn-success">➡️ Nadaljuj na prijavo</a>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
