<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - UniMart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="cart-section" style="max-width: 1000px; margin: 40px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 class="cart-title" style="text-align: center; color: #D56989; font-size: 30px;">🛒 Your Cart</h2>
        <table id="cartTable" class="cart-table" style="width: 100%; text-align: center;">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price (Rs)</th>
                    <th>Quantity</th>
                    <th>Total (Rs)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <h3 id="totalPrice" class="cart-total" style="text-align: center; margin-top: 20px;">Total: Rs 0</h3>
        <div style="text-align: center; margin-top: 15px; display:flex; justify-content:center; gap: 20px;">
            <button class="btn" onclick="clearCart()" style="background-color: #ff9cb5;">Clear Cart</button>
            <a href="payment.html" class="btn" style="background-color: #D56989; color:white; text-decoration:none;">Checkout</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 UniMart. All rights reserved.</p>
    </footer>

    <script src="addtocart.js"></script>
    <script src="search.js"></script>
    <script>
        displayCart();
    </script>
</body>
</html>
