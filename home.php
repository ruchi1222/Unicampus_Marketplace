<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';
// Fetch 5 recent products for the homepage
$homeItemsQuery = $conn->query("SELECT * FROM product ORDER BY product_id DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - UniMart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .welcome-text {
            color: #ecc1ccff;
            font-size: 35px;
            font-weight: bold;
            text-align: left;
            margin-left: 0px;
            margin-top: 10px;
        }
        .prod-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="main-content">
        <div class="main-text">
            <h2 class="welcome-text" style="font-family: 'Times New Roman', Times, serif;">
                Welcome, <?php echo htmlspecialchars($_SESSION["name"] ?? "User"); ?></h2>
            <h1>Sell</h1>
            <h1>Buy</h1>
            <h1>Connect</h1>
            <a href="category.php" class="btn-explore">Explore</a>
        </div>
        <div class="main-image">
            <img src="image-removebg-preview (12).png" alt="Shopping Illustration">
        </div>
    </div>

    <section class="categories">
        <hr class="title-line">
        <h2 style="text-align:center; color:#333; margin-bottom:30px;">Latest Arrivals</h2>
        <div class="category-grid">
            <?php
            if ($homeItemsQuery && $homeItemsQuery->num_rows > 0) {
                while($item = $homeItemsQuery->fetch_assoc()) {
                    $imgUrl = !empty($item['image']) ? htmlspecialchars($item['image']) : 'default.jpg';
                    $itemName = htmlspecialchars($item['product_name']);
                    $itemPrice = htmlspecialchars($item['price']);
                    
                    echo "<div class='category-box'>";
                    echo "<h3>{$itemName}</h3>";
                    echo "<img src='{$imgUrl}' alt='product' class='prod-image' onerror=\"this.src='default.png'\">";
                    echo "<p class='price'>Rs {$itemPrice}</p>";
                    // Need to cleanly escape strings for JS function parameter
                    $escapedItemName = addslashes($itemName);
                    echo "<button class='btn' onclick=\"addToCart('{$escapedItemName}', {$itemPrice})\">Add to Cart</button>";
                    echo "</div>";
                }
            } else {
                echo "<p style='text-align:center; width:100%;'>No recent items found.</p>";
            }
            ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 UniMart. All rights reserved.</p>
    </footer>

    <script src="addtocart.js"></script>
    <script src="search.js"></script>
</body>

</html>
<?php 
if (isset($conn)) {
    $conn->close();
}
?>