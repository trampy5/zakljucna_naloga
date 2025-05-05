<?php
session_start();
require 'login/db.php'; // Vključitev datoteke za povezavo z bazo

// Preverjanje, če je uporabnik prijavljen
if (!isset($_SESSION['username'])) {
    die("Niste prijavljeni!");
}

$trenutniUporabnik = $_SESSION['username'];

// Poizvedba, ki pridobi naročila za prijavljenega uporabnika
$stmt = $conn->prepare("SELECT order_data, payment_method, order_date, shipping_address FROM narocila WHERE username = ?");
$stmt->bind_param("s", $trenutniUporabnik);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Vaša naročila</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .top-menu {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .btn-home {
            display: inline-block;
            padding: 10px 15px;
            background-color: rgb(243, 57, 57);
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }
        h1 {
            color: #333;
            text-align: center;
            margin-top: 60px;
            margin-bottom: 30px;
            font-size: 32px;
        }
        .order {
            background-color: #fff;
            margin: 30px auto;
            padding: 20px;
            border-radius: 8px;
            /* Less transparent border */
            border: 1px solid rgba(0, 0, 0, 0.6);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            max-width: 900px;
        }
        .order-details p {
            margin: 8px 0;
            font-size: 16px;
            color: #555;
        }
        .order-details p strong {
            color: #333;
        }
        h2 {
            color: #333;
            margin: 20px 0 10px;
            font-size: 24px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
            color: #555;
        }
        th {
            background-color: rgb(247, 51, 51);
            color: #fff;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f9e2e2;
        }
        img {
            max-width: 80px;
            border-radius: 4px;
        }
        @media (max-width: 768px) {
            h1 {
                font-size: 28px;
            }
            .order, table, th, td {
                font-size: 14px;
                padding: 8px 10px;
            }
        }
    </style>
</head>
<body>
    <div class="top-menu">
        <a href="../ZAKLUCNA/Index.php" class="btn-home">Domov</a>
    </div>
    <h1>Vaša naročila</h1>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <?php
            // Dekodiramo JSON zapis izdelkov
            $products = json_decode($row['order_data'], true);
            if ($products === null) {
                $products = [];
            }
        ?>
        <div class="order">
            <div class="order-details">
                <p><strong>Datum naročila:</strong> <?php echo htmlspecialchars($row['order_date']); ?></p>
                <p><strong>Način plačila:</strong> <?php echo htmlspecialchars($row['payment_method']); ?></p>
                <p><strong>Naslov za dostavo:</strong> <?php echo htmlspecialchars($row['shipping_address']); ?></p>
            </div>
            <h2>Izdelki</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tabela</th>
                        <th>Ime izdelka</th>
                        <th>Cena</th>
                        <th>Količina</th>
                        <th>Slika</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['id']); ?></td>
                            <td><?php echo htmlspecialchars($product['table']); ?></td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['price']); ?></td>
                            <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                            <td>
                                <?php if (!empty($product['img'])): ?>
                                    <img src="<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endwhile; ?>

<?php
$stmt->close();
$conn->close();
?>
</body>
</html>
