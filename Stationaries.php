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
  <title>Stationary</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php include 'header.php'; ?>

  <!-- Stationary grids and stationaries -->
  <section class="categories">
    <h1 style="text-align:center;">Stationaries</h1>
    <hr class="title-line">
    <div class="category-grid">

      <div class="category-box">
        <h3>Black Pen</h3>
        <img src="blackpen.jpeg" alt="BlackPen">
        <p class="price">Rs 20</p>
        <button class="btn" onclick="addToCart('BlackPen', 20)">Add to Cart</button>
      </div>

      <div class="category-box">
        <h3>Blue Pen</h3>
        <img src="bluepen.jpeg" alt="BluePen">
        <p class="price">Rs 20</p>
        <button class="btn" onclick="addToCart('BluePen', 20)">Add to Cart</button>
      </div>

      <div class="category-box">
        <h3>Pencil</h3>
        <img src="pencil.jpeg" alt="Pencil">
        <p class="price">Rs 15</p>
        <button class="btn" onclick="addToCart('Pencil', 15)">Add to Cart</button>
      </div>

      <div class="category-box">
        <h3>Eraser</h3>
        <img src="eraser.jpeg" alt="Eraser">
        <p class="price">Rs 30</p>
        <button class="btn" onclick="addToCart('Eraser', 30)">Add to Cart</button>
      </div>

      <div class="category-box">
        <h3>Ruler</h3>
        <img src="ruler.jpeg" alt="Ruler">
        <p class="price">Rs 35</p>
        <button class="btn" onclick="addToCart('Ruler', 35)">Add to Cart</button>
      </div>

      <div class="category-box">
        <h3>Scissor</h3>
        <img src="Scissor.jpeg" alt="Scissor">
        <p class="price">Rs 50</p>
        <button class="btn" onclick="addToCart('Scissor', 50)">Add to Cart</button>
      </div>

      <div class="category-box">
        <h3>Glue</h3>
        <img src="glue.jpeg" alt="Glue">
        <p class="price">Rs 50</p>
        <button class="btn" onclick="addToCart('Glue', 50)">Add to Cart</button>
      </div>

      <div class="category-box">
        <h3>Copybook</h3>
        <img src="Copybook.jpeg" alt="Copybook">
        <p class="price">Rs 125</p>
        <button class="btn" onclick="addToCart('Copybook', 125)">Add to Cart</button>
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