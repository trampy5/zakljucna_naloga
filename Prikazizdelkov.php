<?php
// Povezava z bazo – preveri, da je pot pravilna
require_once $_SERVER['DOCUMENT_ROOT'] . '/zaklucna/Login/db.php';

// Definicija dovoljenih tabel in pripadajočih polj
$allowed_tables = [
    "motorji" => [
        "name"  => "Ime_Motorja",
        "img"   => "Slika_Motorja",
        "desc"  => "Opis_Motorja",
        "price" => "Cena_Motorja",
        "id"    => "Id_Motorja"
    ],
    "olja" => [
        "name"  => "Ime_Olja",
        "img"   => "Slika_Olja",
        "desc"  => "Opis_Olja",
        "price" => "Cena_Olja",
        "id"    => "Id_Olj"
    ],
    "pnevmatike" => [
        "name"  => "Ime_Pnevmatike",
        "img"   => "Slika_Pnevmatike",
        "desc"  => "Opis_Pnevmatike",
        "price" => "Cena_Pnevmatike",
        "id"    => "Id_Pnevmatike"
    ],
    "ostalo" => [
        "name"  => "Ime_Ostalo",
        "img"   => "Slika_Ostalo",
        "desc"  => "Opis_Ostalo",
        "price" => "Cena_Ostalo",
        "id"    => "Id_Ostalo"
    ]
];

// Preberi parametre iz URL-ja
$search    = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
$table     = filter_input(INPUT_GET, 'table', FILTER_SANITIZE_STRING);
$min_price = filter_input(INPUT_GET, 'min_price', FILTER_VALIDATE_FLOAT);
$max_price = filter_input(INPUT_GET, 'max_price', FILTER_VALIDATE_FLOAT);
$sort      = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING);

$results = [];

// Če je podan iskalni niz, iščemo po vseh tabelah
if (!empty($search)) {
    foreach ($allowed_tables as $table_name => $fields) {
        $where = " {$fields['name']} LIKE '%" . $conn->real_escape_string($search) . "%'";
        if ($min_price !== false && $min_price !== null) {
            $where .= " AND {$fields['price']} >= " . $conn->real_escape_string($min_price);
        }
        if ($max_price !== false && $max_price !== null) {
            $where .= " AND {$fields['price']} <= " . $conn->real_escape_string($max_price);
        }
        $order_clause = "";
        switch ($sort) {
            case "price_asc":
                $order_clause = " ORDER BY {$fields['price']} ASC";
                break;
            case "price_desc":
                $order_clause = " ORDER BY {$fields['price']} DESC";
                break;
            case "name_asc":
                $order_clause = " ORDER BY {$fields['name']} ASC";
                break;
            case "name_desc":
                $order_clause = " ORDER BY {$fields['name']} DESC";
                break;
        }
        $sql = "SELECT *, '$table_name' as origin_table FROM $table_name WHERE $where" . $order_clause;
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['_meta'] = $fields;
                $row['_table'] = $table_name;
                $results[] = $row;
            }
        }
    }
} elseif ($table && array_key_exists($table, $allowed_tables)) {
    // Če ni iskalnega niza, vendar je podana tabela, iščemo samo v tej tabeli
    $fields = $allowed_tables[$table];
    $where = "1=1";
    if ($min_price !== false && $min_price !== null) {
        $where .= " AND {$fields['price']} >= " . $conn->real_escape_string($min_price);
    }
    if ($max_price !== false && $max_price !== null) {
        $where .= " AND {$fields['price']} <= " . $conn->real_escape_string($max_price);
    }
    $order_clause = "";
    switch ($sort) {
        case "price_asc":
            $order_clause = " ORDER BY {$fields['price']} ASC";
            break;
        case "price_desc":
            $order_clause = " ORDER BY {$fields['price']} DESC";
            break;
        case "name_asc":
            $order_clause = " ORDER BY {$fields['name']} ASC";
            break;
        case "name_desc":
            $order_clause = " ORDER BY {$fields['name']} DESC";
            break;
    }
    $sql = "SELECT *, '$table' as origin_table FROM $table WHERE $where" . $order_clause;
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['_meta'] = $fields;
            $row['_table'] = $table;
            $results[] = $row;
        }
    }
} else {
    echo "<p style='color: darkred;'>Tabela ni izbrana ali je iskalni niz prazen.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Prikaz izdelkov</title>
    <link rel="stylesheet" href="Trga.css">

</head>
<body>
    <!-- Vključi navigacijsko vrstico -->
    <?php include 'navigacija/navbarTrgovina.php'; ?>

    <!-- Obrazec za filtriranje izdelkov -->
    <div class="filter-form">
        <form method="get" action="Prikazizdelkov.php">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($table ?? ''); ?>">
            <label for="min_price">Cena od:</label>
            <input type="number" step="0.01" name="min_price" value="<?php echo htmlspecialchars($min_price ?? '') ?>">
            <label for="max_price">do:</label>
            <input type="number" step="0.01" name="max_price" value="<?php echo htmlspecialchars($max_price ?? '') ?>">
            <br>
            <label for="sort">Sortiraj po:</label>
            <select name="sort" onchange="this.form.submit()">
                <option value="">Privzeto</option>
                <option value="price_asc" <?php if ($sort === 'price_asc') echo 'selected'; ?>>Ceni: naraščajoče</option>
                <option value="price_desc" <?php if ($sort === 'price_desc') echo 'selected'; ?>>Ceni: padajoče</option>
                <option value="name_asc" <?php if ($sort === 'name_asc') echo 'selected'; ?>>Imenu: A–Ž</option>
                <option value="name_desc" <?php if ($sort === 'name_desc') echo 'selected'; ?>>Imenu: Ž–A</option>
            </select>
            <button type="submit">Filtriraj</button>
        </form>
    </div>

    <!-- Izpis izdelkov -->
    <div class="container">
        <?php
        if (count($results) > 0) {
            foreach ($results as $row) {
                $meta = $row['_meta'];
                $tbl  = $row['_table'];
                echo '<div class="product-card" ';
                echo 'data-product-id="' . htmlspecialchars($row[$meta['id']]) . '" ';
                echo 'data-table="' . htmlspecialchars($tbl) . '" ';
                echo 'data-name="' . htmlspecialchars($row[$meta['name']]) . '" ';
                echo 'data-price="' . htmlspecialchars($row[$meta['price']]) . '" ';
                echo 'data-img="' . htmlspecialchars($row[$meta['img']]) . '"';
                echo '>';
                echo '<div class="product-title">' . htmlspecialchars($row[$meta['name']]) . '</div>';
                if (!empty($row[$meta['img']])) {
                    echo '<img src="' . htmlspecialchars($row[$meta['img']]) . '" alt="Slika izdelka">';
                } else {
                    echo '<img src="placeholder.jpg" alt="Ni slike">';
                }
                echo '<div class="product-description">' . htmlspecialchars($row[$meta['desc']]) . '</div>';
                echo '<div class="price">' . htmlspecialchars($row[$meta['price']]) . ' €</div>';
                echo '<button class="add-to-cart-button" onclick="addToCart(this)">Dodaj v košarico</button>';
                echo '</div>';
            }
        } else {
            echo "<p style='text-align:center;'>Ni zadetkov za iskalni niz <strong>" . htmlspecialchars($search ?? '') . "</strong>.</p>";
        }
        ?>
    </div>
    <div class="noga">
    <?php include_once 'footer.html'; ?>
  </div>

    <!-- Košarica, ki se prikaže le ob hover nad ikono -->
    <div class="cart-container">
        <div class="cart-icon"></div>
        <div class="cart-dropdown navbar-cart-dropdown">
            <!-- Vsebina košarice bo vstavljena s pomočjo JavaScripta -->
        </div>
    </div>

    <!-- JavaScript koda za košarico -->
    <script>
        // Inicializacija košarice, če ni definirana
        if (typeof window.cart === 'undefined') {
            window.cart = JSON.parse(localStorage.getItem('cart')) || {};
        }

        // Funkcija za dodajanje izdelka v košarico
        window.addToCart = function(button) {
            const productCard = button.parentElement;
            const productId = productCard.getAttribute('data-product-id');
            const table = productCard.getAttribute('data-table');
            const name = productCard.getAttribute('data-name');
            const price = parseFloat(productCard.getAttribute('data-price'));
            const img = productCard.getAttribute('data-img');
            const key = table + '_' + productId;
            if (!window.cart[key]) {
                window.cart[key] = { id: productId, table, name, price, img, quantity: 0 };
            }
            window.cart[key].quantity++;
            updateAllCartDisplays();
        };

        window.increaseQuantity = function(key) {
            if (window.cart[key]) {
                window.cart[key].quantity++;
                updateAllCartDisplays();
            }
        };

        window.decreaseQuantity = function(key) {
            if (window.cart[key]) {
                if (window.cart[key].quantity > 1) {
                    window.cart[key].quantity--;
                } else {
                    delete window.cart[key];
                }
                updateAllCartDisplays();
            }
        };

        window.removeFromCart = function(key) {
            if (window.cart[key]) {
                delete window.cart[key];
                updateAllCartDisplays();
            }
        };

        window.checkoutCart = function() {
            localStorage.setItem('cart', JSON.stringify(window.cart));
            window.location.href = "../ZAKLUCNA/blagajna.php";
        };

        window.updateAllCartDisplays = function() {
            localStorage.setItem('cart', JSON.stringify(window.cart));
            updateCartDisplay();
        };

        window.updateCartDisplay = function() {
            const cartDropdown = document.querySelector('.cart-dropdown.navbar-cart-dropdown');
            let cartItemsHTML = '';
            let total = 0;
            for (let key in window.cart) {
                if (window.cart.hasOwnProperty(key)) {
                    const item = window.cart[key];
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    cartItemsHTML += `
                        <div class="cart-item-entry">
                            <img src="${item.img}" alt="${item.name}" class="cart-item-img">
                            <div class="cart-item-info">
                                <strong>${item.name}</strong>
                                <div class="quantity-controls">
                                    <button onclick="decreaseQuantity('${key}')">–</button>
                                    <span>${item.quantity}</span>
                                    <button onclick="increaseQuantity('${key}')">+</button>
                                </div>
                                <div class="item-total">${itemTotal.toFixed(2)}€</div>
                            </div>
                            <button class="remove-btn" onclick="removeFromCart('${key}')">Odstrani</button>
                        </div>
                    `;
                }
            }
            cartItemsHTML += `<div id="cart-total"><strong>Skupaj: ${total.toFixed(2)} €</strong></div>`;
            cartItemsHTML += `<button class="checkout-btn" onclick="checkoutCart()">Na blagajno</button>`;
            if(cartDropdown) {
                cartDropdown.innerHTML = cartItemsHTML;
            }
        };

        document.addEventListener('DOMContentLoaded', updateAllCartDisplays);
    </script>
</body>
</html>
