<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';
$catResult = $conn->query("SELECT DISTINCT category FROM product");
$categories = [];
if ($catResult->num_rows > 0) {
    while($cRow = $catResult->fetch_assoc()) {
        if(!empty(trim($cRow['category']))) {
            $categories[] = trim($cRow['category']);
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - UniMart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="categories">
        <h1 style="text-align:center; color: black; font-size:40px; margin-top:30px;">Category</h1>
        <hr class="title-line">
        <div class="category-grid">
            <?php foreach($categories as $cat): ?>
                <?php
                    // Simple logic to pick an icon based on name matching
                    $icon = 'stationary.png'; // default
                    $lowerCat = strtolower($cat);
                    if (strpos($lowerCat, 'tech') !== false || strpos($lowerCat, 'appliance') !== false) {
                        $icon = 'tech.png';
                    } elseif (strpos($lowerCat, 'book') !== false) {
                        $icon = 'book.png';
                    }
                ?>
                <div class="category-box">
                    <h3 style="text-transform: capitalize; padding-bottom: 20px;"><?php echo htmlspecialchars($cat); ?></h3>
                    <a href="view_category.php?cat=<?php echo urlencode($cat); ?>"><img src="<?php echo $icon; ?>" alt="category" onerror="this.src='default.png'"></a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 UniMart. All rights reserved.</p>
    </footer>

    <script src="addtocart.js"></script>
    <script src="search.js"></script>
</body>
</html>