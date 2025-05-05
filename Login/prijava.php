<?php
session_start();
include "db.php";

// Preverimo, ali je uporabnik prijavljen
$loggedIn = isset($_SESSION['user_id']);
$username = $loggedIn && isset($_SESSION['username']) ? $_SESSION['username'] : 'Login';

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = trim($_POST['user_input']); // Vnos je lahko email ali uporabniško ime
    $geslo = $_POST['geslo'];

    // Preverimo, ali je vnos email ali uporabniško ime
    $sql = filter_var($input, FILTER_VALIDATE_EMAIL) 
        ? "SELECT * FROM uporabniki WHERE email = ?" 
        : "SELECT * FROM uporabniki WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($geslo, $user['geslo'])) {
        // Shranimo podatke o uporabniku v sejo
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Izpišemo sporočilo o uspešni prijavi in s pomočjo meta oznake preusmerimo na glavni index.php po 3 sekundah
        echo '<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=../index.php">
    <title>Prijava uspešna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 600px; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="alert alert-success mt-5" role="alert">
            Prijava je bila uspešna. Preusmerjanje na domačo stran...
        </div>
    </div>
</body>
</html>';
        exit();
    } else {
        $error = "Nepravilno geslo ali uporabniško ime/email.";
    }
}

// Obdelava odjave
if (isset($_GET['logout'])) {
    session_destroy();
    // Ker se prijava nahaja v mapi Login, če preusmerjate v isto mapo, je to pravilno
    header("Location: prijava.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { 
            background-color: #f8f9fa; 
            position: relative; 
            min-height: 100vh;
        }
        .container { 
            max-width: 400px; 
            margin-top: 80px; 
        }
 
        .form-container { 
            background: #ffffff; /* Namesto 'white' */
            padding: 30px; 
            border-radius: 8px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        }


    </style>
</head>
<body>

<!-- Gumb "Domov" v zgornjem desnem kotu -->
<div class="position-fixed top-0 end-0 m-3">
    <a href="../index.php" class="btn btn-danger">Domov</a>
</div>

<div class="container">
    <div class="form-container">
        <h2 class="text-center">Prijava</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Uporabniško ime ali Email:</label>
                <input type="text" name="user_input" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Geslo:</label>
                <input type="password" name="geslo" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-danger w-100">🔑 Prijava</button>
        </form>

        <div class="text-center mt-3">
            <a href="zamenjava-PWD-obrazec.php">Ste pozabili geslo?</a> | 
            <a href="registracija-obrazec.php">Registracija</a>
        </div>

        <!-- Gumbi za urejanje in brisanje računa, če je uporabnik prijavljen -->
        <?php if ($loggedIn): ?>
            <div class="account-actions d-flex justify-content-between">
                <a href="obrazec_sprememba_podatkov.php" class="btn btn-warning">⚙️ Uredi podatke računa</a>
                <a href="izbrisi_račun.php" class="btn btn-danger">Izbriši račun</a>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
