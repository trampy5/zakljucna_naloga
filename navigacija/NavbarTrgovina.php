<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Login';

function renderLoginDropdown($username) {
    echo '<div class="login-container login-dropdown">';
    if ($username === 'Login') {
        // Not logged in: Direct link to login page.
        echo '<a href="Login/prijava.php"><span class="login-text">' . htmlspecialchars($username) . '</span></a>';
    } else {
        // Logged in: Display the username and a dropdown menu.
        echo '<a href="#" class="login-toggle"><span class="login-text">' . htmlspecialchars($username) . '</span></a>';
        echo '<div class="dropdown-menu">';
        echo '  <a href="Login/Obrazec_sprememba_podatkov.php">Upravljanje računa</a>';
        echo '  <a href="narocene_storitve.php">Naročene storitve</a>';
        echo '  <a href="naroceni_izdelki.php">Naročeni izdelki</a>';
        echo '  <a href="Login/logout.php?redirect=' . urlencode($_SERVER['REQUEST_URI']) . '">Odjava</a>';
        echo '</div>';
    }
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Navbar - Trgovina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic styling for the navbar */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #fff;
        }
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #333;
            padding: 10px 20px;
        }
        .logo {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
        }
        .navbar-menu {
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
            padding: 8px;
        }
        .nav-links a:hover {
            background: #575757;
            border-radius: 4px;
        }
        .navbar-right {
            display: flex;
            align-items: center;
        }
        .search-form input[type="text"] {
            padding: 6px;
        }
        .search-form button {
            padding: 6px;
            background: #cc1e1e;
            border: none;
            color: #fff;
        }
        .cart {
            margin-left: 15px;
            position: relative;
        }
        .cart a {
            color: #fff;
            text-decoration: none;
        }
        .cart-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: #fff;
            border: 1px solid #ccc;
            width: 350px;
            padding: 10px;
            z-index: 999;
        }
        .cart:hover .cart-dropdown {
            display: block;
        }
        .login-container {
            margin-left: 15px;
            position: relative;
            z-index: 1000;
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
        .login-container a:hover,
        .login-container span:hover,
        .login-container .dropdown-menu a:hover {
            color: #cc1e1e;
        }
        .dropdown-menu {
            position: absolute;
            top: 110%;
            right: 0;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            min-width: 180px;
            z-index: 1001;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
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
            background: #f1f1f1;
        }
        .logo img {
            max-height: 40px; /* Adjust the value as needed */
            width: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-header">
            <a href="index.php" class="logo">
                <img src="slike/ZacetnaStran/logotip_web.gif" alt="Logo">
            </a>
        </div>
        <div class="navbar-menu">
            <ul class="nav-links">
                <li><a href="index.php">Domov</a></li>
                <li><a href="Prikazizdelkov.php?table=olja">Olja</a></li>
                <li><a href="Prikazizdelkov.php?table=motorji">Motorji</a></li>
                <li><a href="Prikazizdelkov.php?table=pnevmatike">Pnevmatike</a></li>
                <li><a href="Prikazizdelkov.php?table=ostalo">Ostalo</a></li>
            </ul>
        </div>
        <div class="navbar-right">
            <form class="search-form" action="Prikazizdelkov.php" method="GET">
                <input type="text" name="search" placeholder="Išči izdelke..." />
                <button type="submit">Išči</button>
            </form>
            <div class="cart" id="cart-link">
                <a href="#">
                    <span class="cart-icon">&#128722;</span>
                    <span class="cart-text">Košarica</span>
                </a>
                <div class="cart-dropdown navbar-cart-dropdown">
                    <!-- Dropdown košarice, updated via JavaScript -->
                </div>
            </div>
            <?php renderLoginDropdown($username); ?>
        </div>
    </nav>

    <!-- JavaScript for delayed hiding of the dropdown and preventing empty search submissions -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Login dropdown functionality
          var loginContainer = document.querySelector('.login-container');
          var dropdown = document.querySelector('.dropdown-menu');
          var closeTimeout;

          // Show the dropdown immediately on mouseenter
          loginContainer.addEventListener('mouseenter', function() {
              clearTimeout(closeTimeout);
              dropdown.style.opacity = '1';
              dropdown.style.visibility = 'visible';
          });

          // Delay hiding the dropdown on mouseleave (500ms)
          loginContainer.addEventListener('mouseleave', function() {
              closeTimeout = setTimeout(function() {
                  dropdown.style.opacity = '0';
                  dropdown.style.visibility = 'hidden';
              }, 500);
          });

          // Prevent form submission if the search field is empty
          var searchForm = document.querySelector('.search-form');
          var searchInput = searchForm.querySelector('input[name="search"]');
          searchForm.addEventListener('submit', function(e) {
              if (searchInput.value.trim() === '') {
                  e.preventDefault();
              }
          });
      });
    </script>
</body>
</html>
