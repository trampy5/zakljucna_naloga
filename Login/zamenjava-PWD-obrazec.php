<?php
include "db.php";

$error = "";
$success = "";

// Funkcija za preverjanje obstoja e-pošte
function email_exists($email, $conn) {
    $sql = "SELECT id FROM uporabniki WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}

// Obdelava zahteve za ponastavitev gesla
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (!email_exists($email, $conn)) {
        $error = "Ta e-poštni naslov ne obstaja v naši bazi.";
    } else {
        $novo_geslo = bin2hex(random_bytes(4)); // Generiranje 8-mestnega gesla
        $hashGeslo = password_hash($novo_geslo, PASSWORD_DEFAULT);

        // Posodobi geslo v bazi
        $sql = "UPDATE uporabniki SET geslo = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashGeslo, $email);

        if ($stmt->execute()) {
            // Pošlji email z novim geslom
            $subject = "Ponastavitev gesla";
            $message = "Vaše novo geslo: " . $novo_geslo . "\nPrijavite se in ga spremenite!";
            $headers = "From: support@tvoja-spletna-stran.com";

            if (mail($email, $subject, $message, $headers)) {
                $success = "Novo geslo je bilo poslano na vaš e-poštni naslov.";
            } else {
                $error = "Napaka pri pošiljanju e-pošte.";
            }
        } else {
            $error = "Napaka pri posodobitvi gesla.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamenjava gesla</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="position-fixed top-0 end-0 m-3">
    <a href="../index.php" class="btn btn-danger">Domov</a>
</div>


<div class="container mt-5">
    <div class="card p-4">
        <h2 class="text-center">Zamenjava gesla</h2>
        <p class="text-center">Vpišite vaš poštni naslov in poslali vam bomo novo geslo.</p>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Vpišite svoj e-mail..." required>
            </div>
            <button type="submit" class="btn btn-danger w-100">📩 Pošlji e-mail za novo geslo</button>
        </form>
    </div>
</div>

</body>
</html>
