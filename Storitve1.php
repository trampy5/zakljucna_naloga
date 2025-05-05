<?php
// Vključi kodo za povezavo z bazo (uporablja MySQLi)
include 'login/db.php';

// Ustvari tabelo "services", če ta še ne obstaja
$createTableSQL = "CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

if (!$conn->query($createTableSQL)) {
    die("Napaka pri ustvarjanju tabele: " . $conn->error);
}

// Preveri, če je tabela prazna
$result = $conn->query("SELECT COUNT(*) as count FROM services");
$row = $result->fetch_assoc();
if ($row['count'] == 0) {
    $insertSQL = "INSERT INTO services (name, description, image) VALUES 
        ('Menjava olja', 'Profesionalna menjava motornega olja z visokokakovostnimi materiali.', 'slike/motorji/delavnica.jpg'),
        ('Servis motorja', 'Celovit servis motorja, ki zagotavlja optimalno delovanje vašega motorja.', 'slike/motorji/delavnica.jpg'),
        ('Popravilo motorja', 'Strokovno popravilo in diagnostika napak za vaš motor.', 'slike/motorji/delavnica.jpg'),
        ('Optimizacija motorja', 'Povečajte zmogljivost vašega motorja z našimi rešitvami optimizacije.', 'slike/motorji/delavnica.jpg'),
        ('Diagnostika motorja', 'Napredna diagnostika za odkrivanje vseh skritih težav motorja.', 'slike/motorji/delavnica.jpg')";
    
    if (!$conn->query($insertSQL)) {
        die("Napaka pri vstavljanju podatkov: " . $conn->error);
    }
}

// Pridobi vse storitve iz baze
$selectSQL = "SELECT * FROM services";
$result = $conn->query($selectSQL);
$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
         $services[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
  <meta charset="UTF-8">
  <title>Storitve</title>
  <link rel="stylesheet" href="../zaklucna/Storitve.css">
  <style>

  </style>
</head>
<body>
  <div class="service-container">
    <?php foreach ($services as $service): ?>
      <div class="service" style="--bg-url: url('<?php echo htmlspecialchars($service['image']); ?>');">
        <div class="service-content">
          <h2><?php echo htmlspecialchars($service['name']); ?></h2>
          <p><?php echo htmlspecialchars($service['description']); ?></p>
          <a class="order-btn" href="Obrazec_za_naročanje.php">Naroči storitev</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>
</html>
