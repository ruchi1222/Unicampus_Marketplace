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
    <title>About Us - UniMart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container about-content">
        <h1>About Us</h1>
        <div class="logo-icon" style="margin-bottom: 20px;">
            <img src="image-removebg-preview (9).png" alt="UniMart Logo" style="height: 100px; width: auto;">
        </div>
        
        <p style="text-align: justify; font-size: 16px; line-height: 1.6; color: #555;">UniMart is a digital cross-campus platform.</p>
        <p style="text-align: justify; font-size: 16px; line-height: 1.6; color: #555;"> It allows students, educators and staff to sell or buy products and services primarily within the campus.</p> 
        <p style="text-align: justify; font-size: 16px; line-height: 1.6; color: #555;"> It serves as a virtual portal, eliminating alternatives such as social media groups, message boards and anonymous public auction places to provide a much more secure and convenient local bargaining experience.</p>
    </div>

    <footer>
        <p>&copy; 2025 UniMart. All rights reserved.</p>
    </footer>

    <script src="addtocart.js"></script>
    <script src="search.js"></script>
</body>
</html>
