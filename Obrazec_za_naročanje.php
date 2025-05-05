<!DOCTYPE html>
<html lang="sl">
<head>
  <meta charset="UTF-8" />
  <title>Domov</title>
  <style>
    .home-button {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color:rgb(219, 71, 52);
      color: #fff;
      border: none;
      padding: 10px 20px;
      text-decoration: none; 
      border-radius: 4px; 
      font-size: 16px;
      cursor: pointer;
      z-index: 1000; 
    }

    .home-button:hover {
      background-color:rgb(255, 0, 0);
    }
  </style>
</head>
<body>
  <a href="index.php" class="home-button">Domov</a>

  <div class="zacstr">
    <?php include_once 'Obrazec_za_narocanje1.php'; ?>
  </div>
</body>
</html>
