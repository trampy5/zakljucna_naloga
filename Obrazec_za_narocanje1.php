<?php
include("login/db.php");

// Pridobitev možnosti storitev iz tabele services
$query = "SELECT name FROM services";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Napaka pri pridobivanju storitev: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obrazec za naročanje storitev</title>
    <link rel="stylesheet" href="obrazec_za_narocanje.css">
    <style>

    </style>
</head>
<body>
    <div class="Ogrodje">
        <h2>Naročite storitev</h2>
        <form action="Obdelava_narocila.php" method="post">
            <label for="name">Ime in priimek:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">E-pošta:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Telefon:</label>
            <input type="text" id="phone" name="phone">

            <label for="service">Storitev:</label>
            <select id="service" name="service" required>
                <?php
                // Izpis možnosti, pridobljenih iz baze
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=\"" . htmlspecialchars($row['name']) . "\">" . htmlspecialchars($row['name']) . "</option>";
                }
                ?>
            </select>

            <label for="date">Datum storitve:</label>
            <input type="date" id="date" name="date" required>

            <label for="message">Opombe:</label>
            <textarea id="message" name="message"></textarea>

            <button type="submit">Oddaj naročilo</button>
        </form>
    </div>
</body>
</html>
