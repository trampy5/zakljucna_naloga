<?php
// Zaženemo sejo, da lahko dostopamo do spremenljivk seje
session_start();

// Preverimo, če je uporabnik prijavljen in nastavimo ustrezno spremenljivko
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Login';
?>
<!DOCTYPE html>
<html lang="sl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navigacija Trgovine</title>
  <link rel="stylesheet" href="../zaklucna/navigacija/navbar.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #333;
      padding: 10px 20px;
      flex-wrap: wrap;
    }
    
    .navbar-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    
    .logo {
      color: #fff;
      font-size: 24px;
      font-weight: bold;
      text-decoration: none;
      margin-right: 20px;
    }
    
    /* New CSS rule to make the logo image smaller */
    .logo img {
      max-height: 40px; /* Adjust the value as needed */
      width: auto;
    }
    
    .navbar-hamburger {
      display: none;
      font-size: 24px;
      color: #fff;
      cursor: pointer;
    }
    
    .navbar-menu {
      display: flex;
      align-items: center;
      flex: 1;
    }
    
    .nav-links {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
    }
    
    .nav-links li {
      margin-left: 20px;
    }
    
    .nav-links a {
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      padding: 8px 12px;
      transition: background-color 0.3s;
    }
    
    .nav-links a:hover,
    .nav-links a.active {
      background-color: #575757;
      border-radius: 4px;
    }
    
    .navbar-right {
      display: flex;
      align-items: center;
      /* S tem pravilo ostaja na desni strani */
    }

    .login-container a,
    .login-container span {
      color: #fff;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: color 0.3s;
      font-size: 16px;
    }
    
    .login-icon {
      font-size: 20px;
      margin-right: 5px;
    }
    
    /* Dropdown meni za upravljanje računa */
    .login-dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #fff;
      min-width: 150px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      border-radius: 4px;
      overflow: hidden;
      z-index: 1000;
    }
    
    .dropdown-menu a {
      color: #333;
      padding: 10px 15px;
      text-decoration: none;
      display: block;
      font-size: 14px;
      transition: background-color 0.3s;
    }
    
    .dropdown-menu a:hover {
      background-color: #f1f1f1;
    }
    
    .login-dropdown:hover .dropdown-menu {
      display: block;
    }
    
    .mobile-only {
      display: none;
    }
    
    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .navbar-header {
        width: 100%;
      }
      
      .navbar-hamburger {
        display: block;
      }
      
      .navbar-menu {
        width: 100%;
        display: none;
        flex-direction: column;
        margin-top: 10px;
      }
      
      .navbar-menu.active {
        display: flex;
      }
      
      .nav-links {
        flex-direction: column;
        width: 100%;
      }
      
      .nav-links li {
        margin: 10px 0;
      }
      
      /* Prikažemo login element tudi na mobilnih napravah */
      .navbar-right {
        display: flex;
        width: 100%;
        justify-content: flex-end;
        margin-top: 10px;
      }
      
      .mobile-only {
        display: block;
      }
      
      .mobile-only form,
      .mobile-only .cart,
      .mobile-only .login-container {
        margin: 10px 0;
      }
    }

    .login-container a:hover,
    .login-container span:hover,
    .login-dropdown a:hover {
      color: #cc1e1e;
    }
  </style>
</head>
<body>
  <nav class="navbar">

    <div class="navbar-header">
      <a href="index.php" class="logo">
        <img src="slike/ZacetnaStran/logotip_web.gif" alt="Logo">
      </a>
      <div class="navbar-hamburger">
        &#9776;
      </div>
    </div>
    
    <div class="navbar-menu">
      <ul class="nav-links">
        <li><a href="index.php">Domov</a></li>
        <li><a href="Trgovina.php">Trgovina</a></li>
        <li><a href="Storitve.php">Storitve</a></li>
        <!-- Samo za majhna okna -->
        <li class="mobile-only">
          <!-- Tu lahko dodate dodatne elemente za mobilno verzijo, če je potrebno -->
        </li>
        <li class="mobile-only login-dropdown">
          <?php if($username === 'Login'): ?>
            <a href="Login/prijava.php">
              <span class="login-text"><?php echo htmlspecialchars($username); ?></span>
            </a>
          <?php else: ?>
            <span style="cursor: default;">
              <span class="login-text"><?php echo htmlspecialchars($username); ?></span>
            </span>
            <div class="dropdown-menu">
              <a href="Login/Obrazec_sprememba_podatkov.php">Upravljanje računa</a>
              <a href="narocene_storitve.php">Naročene storitve</a>
              <a href="naroceni_izdelki.php">Naročeni izdelki</a>
              <a href="Login/logout.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Odjava</a>
            </div>
          <?php endif; ?>
        </li>
      </ul>
    </div>
    
    <div class="navbar-right">
      <div class="login-container login-dropdown">
        <?php if($username === 'Login'): ?>
          <a href="Login/prijava.php">
            <span class="login-text"><?php echo htmlspecialchars($username); ?></span>
          </a>
        <?php else: ?>
          <span style="cursor: default;">
            <span class="login-text"><?php echo htmlspecialchars($username); ?></span>
          </span>
          <div class="dropdown-menu">
            <a href="Login/Obrazec_sprememba_podatkov.php">Upravljanje računa</a>
            <a href="narocene_storitve.php">Naročene storitve</a>
            <a href="naroceni_izdelki.php">Naročeni izdelki</a>
            <a href="Login/logout.php?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">Odjava</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  
  <!-- JavaScript za preklop prikaza hamburger menija na mobilnih napravah -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var hamburger = document.querySelector('.navbar-hamburger');
      var menu = document.querySelector('.navbar-menu');
      hamburger.addEventListener('click', function() {
        menu.classList.toggle('active');
      });
    });
  </script>
</body>
</html>
