<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $novo_geslo = bin2hex(random_bytes(4)); 
    $hashGeslo = password_hash($novo_geslo, PASSWORD_DEFAULT);

    $sql = "UPDATE uporabniki SET geslo = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashGeslo, $email);

    if ($stmt->execute()) {
        mail($email, "Zamenjava gesla", "Vaše novo geslo: " . $novo_geslo);
        header("Location: zamenjava-PWD-OK.php");
        exit();
    } else {
        echo "Napaka pri zamenjavi gesla.";
    }
}
?>
