<?php
session_start();

// Preverimo, če je uporabnik prijavljen
if (!isset($_SESSION['user_id'])) {
    header("Location: Login/prijava.php");
    exit();
}

include "db.php"; // Povezava na bazo

// Spremenljivke
$ime = $priimek = $username = $email = "";
$current_password_hash = "";
$error = "";
$success = "";

// Pridobimo podatke o trenutno prijavljenem uporabniku (vključno z geslom)
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT ime, priimek, username, email, geslo FROM uporabniki WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $user_data = $result->fetch_assoc();
    $ime = $user_data['ime'];
    $priimek = $user_data['priimek'];
    $username = $user_data['username'];
    $email = $user_data['email'];
    $current_password_hash = $user_data['geslo'];
} else {
    // Če uporabnik ni najden, ga odjavimo
    session_destroy();
    header("Location: Login/prijava.php");
    exit();
}

// Obdelava obrazca, ko je ta oddan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pridobimo posodobljene podatke iz obrazca
    $new_ime       = trim($_POST['ime']);
    $new_priimek   = trim($_POST['priimek']);
    $new_username  = trim($_POST['username']);
    $new_email     = trim($_POST['email']);
    $current_input = $_POST['trenutno_geslo']; // Vrednost, ki jo je uporabnik vnesel prek pojnega okna
    $new_password  = $_POST['geslo'];
    $new_password2 = $_POST['geslo2'];
    
    // Validacija
    if (empty($new_ime) || empty($new_priimek) || empty($new_username) || empty($new_email)) {
        $error = "Prosimo, izpolnite vsa obvezna polja.";
    } elseif (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Elektronska pošta ni veljavna.";
    } elseif (empty($current_input)) {
        $error = "Prosimo, vnesite trenutno geslo za potrditev sprememb.";
    } elseif (!password_verify($current_input, $current_password_hash)) {
        $error = "Trenutno geslo ni pravilno.";
    } elseif ((!empty($new_password) || !empty($new_password2)) && ($new_password !== $new_password2)) {
        $error = "Nova gesla se ne ujemata.";
    }
    
    if (empty($error)) {
        // Če je uporabnik vnesel novo geslo, ga posodobimo, sicer obdržimo staro geslo
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE uporabniki SET ime = ?, priimek = ?, username = ?, email = ?, geslo = ? WHERE id = ?");
            $stmt->bind_param("sssssi", $new_ime, $new_priimek, $new_username, $new_email, $hashed_password, $user_id);
        } else {
            $stmt = $conn->prepare("UPDATE uporabniki SET ime = ?, priimek = ?, username = ?, email = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $new_ime, $new_priimek, $new_username, $new_email, $user_id);
        }
        
        if ($stmt->execute()) {
            $success = "Podatki so bili uspešno posodobljeni.";
            // Če se spremeni uporabniško ime, posodobimo tudi sejo
            $_SESSION['username'] = $new_username;
            // Posodobimo lokalne spremenljivke, da se obrazec ponovno prikaže s posodobljenimi podatki
            $ime = $new_ime;
            $priimek = $new_priimek;
            $username = $new_username;
            $email = $new_email;
        } else {
            $error = "Prišlo je do napake pri posodabljanju podatkov.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upravljanje računa</title>
  <!-- Vključitev Bootstrap CSS (še vedno za osnovno stilizacijo) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body { background-color: #f8f9fa; }
    .container { max-width: 600px; margin-top: 50px; }
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
    <h2 class="text-center mb-4">Upravljanje računa</h2>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
      <div class="alert alert-success" role="alert">
        <?php echo htmlspecialchars($success); ?>
      </div>
    <?php endif; ?>
    
    <!-- Obrazec; skrito polje za trenutno geslo bo nastavljeno preko JavaScript prompt okna -->
    <form id="accountForm" method="post" action="">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Ime:</label>
          <input type="text" name="ime" class="form-control" value="<?php echo htmlspecialchars($ime); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Priimek:</label>
          <input type="text" name="priimek" class="form-control" value="<?php echo htmlspecialchars($priimek); ?>" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Uporabniško ime:</label>
          <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Elektronska pošta:</label>
          <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
      </div>
      <!-- Skrito polje za vnos trenutnega gesla, ki ga bomo nastavili prek prompt okna -->
      <input type="hidden" name="trenutno_geslo" id="hiddenCurrentPassword">
      <div class="mb-3">
        <label class="form-label">Novo geslo (če želite spremeniti):</label>
        <input type="password" name="geslo" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Ponovi novo geslo:</label>
        <input type="password" name="geslo2" class="form-control">
      </div>
      <button type="button" id="updateAccountButton" class="btn btn-danger w-100">
        Posodobi podatke
      </button>
    </form>
  </div>
</div>

<script>
  document.getElementById('updateAccountButton').addEventListener('click', function() {
    let currentPassword = prompt("Vnesite trenutno geslo:");
    if (currentPassword === null || currentPassword.trim() === "") {
      alert("Prosimo, vnesite trenutno geslo.");
      return;
    }
    // Nastavimo skrito polje z vnesenim trenutnim geslom
    document.getElementById('hiddenCurrentPassword').value = currentPassword;
    // Oddamo obrazec
    document.getElementById('accountForm').submit();
  });
</script>
</body>
</html>
