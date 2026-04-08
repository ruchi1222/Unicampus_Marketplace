<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="header-section">
    <div class="nav-bar">
        <div class="logo">
            <img src="image-removebg-preview (9).png" alt="UniMart Logo" style="height: 60px; width: auto;">
        </div>

        <nav class="main-menu">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="category.php">Category</a></li>
                <li><a href="about.php">About</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'seller'): ?>
                    <li><a href="manageproduct.php">Manage</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="search-box">
            <input type="text" id="search" placeholder="Search">
            <button class="search-btn"><span style="font-size: 20px; color: white;">&#128269;</span></button>
            <div class="results" id="results"></div>
        </div>

        <div class="icons">
            <div class="profile">
                <a href="profile.php"><img src="image-removebg-preview (6).png" alt="profile"
                        style="height: 40px; width: auto;"></a>
            </div>
            <div class="cart">
                <a href="cart.php"><img src="image-removebg-preview (7).png" alt="cart"
                        style="height: 40px; width: auto;"></a>
            </div>
        </div>
    </div>
</header>