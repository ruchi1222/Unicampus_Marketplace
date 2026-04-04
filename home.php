<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>

        /* ===== Simplified Student-style CSS ===== */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2dede;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .header-section {
            background-color: #D56989;
            color: black;
            padding-bottom: 50px;
        }

        .nav-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f3eef1;
            padding: 20px;
        }

        .logo img {
            width: 150px;
        }

        .main-menu ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        .main-menu li a {
            font-size: 20px;
            font-weight: bold;
        }

        .main-menu li a:hover {
            color: #ea9caf;
        }

        .search-box {
            background: #ea9caf;
            border-radius: 25px;
            padding: 5px 15px;
            display: flex;
            align-items: center;
        }

        .search-box input {
            border: none;
            outline: none;
            font-size: 16px;
            background: none;
        }

        .results {
            position: absolute;
            top: 60px;
            left: 0;
            width: 200px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            display: none;
        }

        .results p {
            padding: 5px;
            margin: 0;
            cursor: pointer;
        }

        .results p:hover {
            background-color: #ffe3eb;
        }

        .profile img, .cart img {
            width: 50px;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 0 20px;
        }

        .main-text h1 {
            font-size: 50px;
            color: white;
        }

        .btn-explore {
            display: inline-block;
            padding: 10px 20px;
            background: white;
            color: black;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
        }

        .btn-explore:hover {
            background-color: #ea9caf;
        }

        .main-image img {
            width: 400px;
        }

        .category-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px;
        }

        .category-box {
            background: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            width: 180px;
        }

        .category-box img {
            width: 100%;
        }

        .category-box .price {
            font-weight: bold;
            color: #D56989;
        }

        .category-box button {
            padding: 5px 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            background-color: #D56989;
            color: white;
            cursor: pointer;
        }

        .category-box button:hover {
            background-color: #c05074;
        }

        footer {
            background-color: #f2dede;
            text-align: center;
            padding: 20px;
            font-size: 16px;
        }

        /* ===== Welcome text styling ===== */
        .welcome-text {
            color: black;
            font-size: 18px; /* slightly bigger */
            font-weight: bold;
            text-align: right;
            margin-right: 20px;
            margin-top: 10px;
        }

        /* Responsive */
        @media (max-width: 800px) {
            .main-content {
                flex-direction: column;
                text-align: center;
            }

            .main-image img {
                width: 100%;
                margin-top: 20px;
            }

            .main-menu ul {
                flex-direction: column;
                gap: 10px;
            }

            .welcome-text {
                text-align: center;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <header class="header-section">
        <div class="nav-bar">
            <div class="logo">
                <img src="image-removebg-preview (9).png" alt="UniMart Logo">
            </div>

            <nav class="main-menu">
                <ul>
                    <li><a href="Home.php">Home</a></li>
                    <li><a href="category.html">Category</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="manageproduct.php">Manage Products</a></li>
                </ul>
            </nav>

            <div class="search-box">
                <input type="text" id="search" placeholder="Search...">
            </div>
            <div class="results" id="results"></div>

            <div class="profile">
                <a href="profile.html"><img src="image-removebg-preview (6).png" alt="profile"></a>
            </div>
            <div class="cart">
                <a href="cart.html"><img src="image-removebg-preview (7).png" alt="cart"></a>
            </div>
        </div>

        <!-- Welcome message -->
        <p class="welcome-text">
            Welcome, <?php echo htmlspecialchars($_SESSION["name"]); ?>
        </p>

        <div class="main-content">
            <div class="main-text">
                <h1>Sell</h1>
                <h1>Buy</h1>
                <h1>Connect</h1>
                <a href="category.html" class="btn-explore">Explore</a>
            </div>
            <div class="main-image">
                <img src="image-removebg-preview (12).png" alt="Shopping Illustration">
            </div>
        </div>
    </header>

    <section class="categories">
        <hr class="title-line">
        <div class="category-grid">

            <div class="category-box">
                <h3>Happy After All</h3>
                <img src="happy.jpeg" alt="book1">
                <p class="price">Rs 200</p>
                <button onclick="addToCart('Happy After All', 200)">Add to Cart</button>
            </div>

            <div class="category-box">
                <h3>Headphone</h3>
                <img src="headphone.jpeg" alt="headphone">
                <p class="price">Rs 200</p>
                <button onclick="addToCart('Headphone', 200)">Add to Cart</button>
            </div>

            <div class="category-box">
                <h3>Pencil</h3>
                <img src="pencil.jpeg" alt="Pencil">
                <p class="price">Rs 15</p>
                <button onclick="addToCart('Pencil', 15)">Add to Cart</button>
            </div>

            <div class="category-box">
                <h3>Vogue</h3>
                <img src="vogue.jpeg" alt="Vogue">
                <p class="price">Rs 350</p>
                <button onclick="addToCart('Vogue', 350)">Add to Cart</button>
            </div>

            <div class="category-box">
                <h3>USB drives</h3>
                <img src="usb.jpeg" alt="USB">
                <p class="price">Rs 350</p>
                <button onclick="addToCart('USB', 350)">Add to Cart</button>
            </div>

        </div>
    </section>

    <footer>
        <p>&copy; 2025 UniMart. All rights reserved.</p>
    </footer>

    <script src="addtocart.js"></script>
    <script src="search.js"></script>
</body>
</html>


