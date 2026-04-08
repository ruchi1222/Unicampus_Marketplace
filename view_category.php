<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

$category = isset($_GET['cat']) ? $_GET['cat'] : 'All';

$stmt = $conn->prepare("SELECT * FROM product WHERE category = ?");
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category); ?> | UniMart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .category-header {
            text-align: center;
            color: #D56989;
            font-size: 40px;
            margin-top: 30px;
            text-transform: capitalize;
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

    <section class="categories">
        <h1 class="category-header"><?php echo htmlspecialchars($category); ?></h1>
        <hr class="title-line">
        
        <div class="category-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="category-box">
                        <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                        <?php $img = !empty($row['image']) ? htmlspecialchars($row['image']) : 'default.jpg'; ?>
                        <img src="<?php echo $img; ?>" alt="product" class="prod-image" onerror="this.src='default.png'">
                        <p class="price">Rs <?php echo htmlspecialchars($row['price']); ?></p>
                        <button class="btn" onclick="addToCart('<?php echo htmlspecialchars($row['product_name']); ?>', <?php echo htmlspecialchars($row['price']); ?>)">Add to Cart</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p style="text-align:center; width:100%; font-size:18px; color:#555;">No products found in this category.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <p>&copy; 2025 UniMart. All rights reserved.</p>
        </div>
    </footer>

    <script src="addtocart.js"></script>
    <script src="search.js"></script>
</body>
</html>
<?php 
$stmt->close();
$conn->close(); 
?>
