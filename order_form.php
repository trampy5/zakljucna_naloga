<!DOCTYPE html>
<html lang="sl">
<head>
    <meta charset="UTF-8">
    <title>Naročilo</title>
    <style>
        form {
            width: 50%;
            margin: 40px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label, textarea, select, button {
            width: 100%;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <form method="post" action="blagajna.php" id="orderForm">
        <!-- Skrito polje za podatke o košarici -->
        <input type="hidden" name="cart" id="cartInput">

        <label for="shipping_address">Naslov za dostavo:</label>
        <textarea name="shipping_address" id="shipping_address" required></textarea>

        <label for="payment_method">Način plačila:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="">Izberite način plačila</option>
            <option value="kartica">Kartica</option>
            <option value="gotovina">Gotovina</option>
            <option value="paypal">PayPal</option>
        </select>

        <button type="submit">Naroči</button>
    </form>

    <script>
        // Predpostavljamo, da je v spremenljivki window.cart shranjena košarica
        // Če košarice še ni, inicializiramo prazen objekt
        if (typeof window.cart === 'undefined') {
            window.cart = {};
        }

        // Ob oddaji obrazca shranimo podatke o košarici v skrito polje
        document.getElementById("orderForm").addEventListener("submit", function() {
            document.getElementById("cartInput").value = JSON.stringify(window.cart);
        });
    </script>
</body>
</html>
