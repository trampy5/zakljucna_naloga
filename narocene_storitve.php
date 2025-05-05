<?php
session_start();
include("login/db.php");

// Preverjanje, če je uporabnik prijavljen
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = mysqli_real_escape_string($conn, $_SESSION['username']);

// Pridobitev naročil za prijavljenega uporabnika (brez stolpca id)
$sql = "SELECT name, email, phone, service, date, message, created_at FROM narocila_storitve WHERE username = '$username' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Napaka pri pridobivanju naročil: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja naročila</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
        }
        .order {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.6);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        .order p {
            margin: 8px 0;
            font-size: 16px;
            color: #555;
        }
        .order p strong {
            color: #333;
        }
        .message {
            text-align: center;
            font-size: 16px;
            color: #777;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: rgb(194, 72, 72);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: rgb(170, 60, 60);
        }
        @media (max-width: 768px) {
            .order, h2, .btn {
                font-size: 14px;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Moja naročila</h2>
        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="order">
                    <p><strong>Ime in priimek:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                    <p><strong>Telefon:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                    <p><strong>Storitev:</strong> <?php echo htmlspecialchars($row['service']); ?></p>
                    <p><strong>Datum storitve:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
                    <p><strong>Opombe:</strong> <?php echo htmlspecialchars($row['message']); ?></p>
                    <p><strong>Oddano:</strong> <?php echo htmlspecialchars($row['created_at']); ?></p>
                </div>
            <?php endwhile; ?>
            <div class="button-container">
                <!-- Change the href value as needed -->
                <a href="../ZAKLUCNA/index.php" class="btn">Nazaj domov</a>
            </div>
        <?php else: ?>
            <p class="message">Nimate nobenih naročil.</p>
        <?php endif; ?>
    </div>
</body>
</html>
