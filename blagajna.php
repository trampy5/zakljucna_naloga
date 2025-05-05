<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/zaklucna/Login/db.php';

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Login';

if ($username === 'Login') {
    header("Location: Login/prijava.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Blagajna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f5;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }
        #cartDisplay {
            width: 60%;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
        }
        #cartDisplay h3 {
            margin-top: 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            color: #007bff;
        }
        .cart-item {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 15px;
        }
        .cart-item-details {
            flex: 1;
        }
        .cart-item-details h4 {
            margin: 0 0 5px 0;
            font-size: 18px;
            color: #333;
        }
        .cart-item-details p {
            margin: 3px 0;
            font-size: 14px;
            color: #666;
        }
        .cart-total {
            text-align: right;
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        form {
            width: 60%;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        form label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        form textarea, form select, form input[type="text"], form input[type="month"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        form button {
            background: #28a745;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }
        form button:hover {
            background: #218838;
        }
        #cardDetails {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 10px;
            display: none;
        }
        #cardDetails label {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    <h2>Zaključi naročilo</h2>
    
    <div id="cartDisplay">
        <h3>Izdelki v košarici</h3>
        <div id="cartItems"></div>
        <div class="cart-total" id="cartTotal"></div>
    </div>

    <form method="post" action="potrdi_narocilo.php" id="orderForm">
        <label>Naslov za dostavo:</label>
        <textarea name="shipping_address" required placeholder="Vnesite naslov za dostavo..."></textarea>

        <label>Način plačila:</label>
        <select name="payment_method" id="paymentMethod" required>
            <option value="">Izberi način plačila</option>
            <option value="kartica">Kartica</option>
            <option value="po povzetju">Po povzetju</option>
        </select>

        <div id="cardDetails">
            <label>Ime in priimek na kartici:</label>
            <input type="text" name="card_holder" placeholder="Vnesite ime in priimek">
            <label>Številka kartice:</label>
            <input type="text" name="card_number" placeholder="XXXX XXXX XXXX XXXX">
            <label>Datum veljavnosti:</label>
            <input type="month" name="expiry_date">
            <label>CVV:</label>
            <input type="text" name="cvv" placeholder="XXX">
        </div>

        <input type="hidden" name="cart" id="cartInput">
        <button type="submit">Potrdi naročilo in plačaj</button>
    </form>

    <script>
        function displayCart() {
            let cartStr = localStorage.getItem('cart') || '{}';
            let cart = JSON.parse(cartStr);
            let cartItemsDiv = document.getElementById('cartItems');
            let total = 0;
            let html = '';

            if (Object.keys(cart).length === 0) {
                html = "<p>Košarica je prazna.</p>";
            } else {
                for (let key in cart) {
                    if (cart.hasOwnProperty(key)) {
                        let item = cart[key];
                        let itemTotal = item.price * item.quantity;
                        total += itemTotal;
                        html += `
                            <div class="cart-item">
                                <img src="${item.img ? item.img : 'placeholder.jpg'}" alt="${item.name}">
                                <div class="cart-item-details">
                                    <h4>${item.name}</h4>
                                    <p>Količina: ${item.quantity}</p>
                                    <p>Cena: ${item.price.toFixed(2)} €</p>
                                    <p>Skupaj: ${itemTotal.toFixed(2)} €</p>
                                </div>
                            </div>
                        `;
                    }
                }
            }
            cartItemsDiv.innerHTML = html;
            document.getElementById('cartTotal').innerText = total > 0 ? "Skupaj: " + total.toFixed(2) + " €" : "";
        }

        document.getElementById('paymentMethod').addEventListener('change', function() {
            const cardDetails = document.getElementById('cardDetails');
            if (this.value === 'kartica') {
                cardDetails.style.display = 'block';
                cardDetails.querySelectorAll('input').forEach(input => {
                    input.required = true;
                });
            } else {
                cardDetails.style.display = 'none';
                cardDetails.querySelectorAll('input').forEach(input => {
                    input.required = false;
                });
            }
        });

        document.getElementById('orderForm').addEventListener('submit', function(e) {
            const paymentMethod = document.getElementById('paymentMethod').value;
            const cart = localStorage.getItem('cart') || '[]';
            if (cart === '[]' || cart === '') {
                alert('Košarica je prazna. Prosimo, dodajte izdelke v košarico.');
                e.preventDefault();
                return;
            }
            document.getElementById('cartInput').value = cart;
        });

        document.addEventListener('DOMContentLoaded', function() {
            displayCart();
        });
    </script>
</body>
</html>
