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
                header("Location: registracija-OK.php");
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
    <title>Registracija</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { 
            background-color: #f8f9fa; 
        }
        .container { 
            max-width: 500px; 
            margin-top: 50px; 
        }
        .form-container { 
            background: white; 
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        }

    </style>
</head>
<body>

<!-- Gumb Domov v zgornjem desnem kotu -->
<div class="position-fixed top-0 end-0 m-3">
    <a href="../index.php" class="btn btn-danger">Domov</a>
</div>

<div class="container">
    <div class="form-container">
        <h2 class="text-center">Registracija</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Ime:</label>
                    <input type="text" name="ime" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Priimek:</label>
                    <input type="text" name="priimek" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Uporabniško ime:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Elektronska pošta:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Geslo:</label>
                <input type="password" name="geslo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ponovi geslo:</label>
                <input type="password" name="geslo2" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-danger w-100">🔑 Registracija</button>
        </form>
    </div>
</div>

</body>
</html>
