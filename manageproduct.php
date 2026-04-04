<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// --- DATABASE CONNECTION ---
$conn = new mysqli("localhost", "root", "", "unimart");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- ADD NEW PRODUCT ---
if (isset($_POST['add_product'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['pname'];
    $price = $_POST['pprice'];
    $category = $_POST['pcategory'];

    $stmt = $conn->prepare("INSERT INTO product (user_id, product_name, price, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isds", $user_id, $name, $price, $category);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Product added successfully!');</script>";
    } else {
        echo "<script>alert('❌ Error adding product: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// --- UPDATE PRODUCT ---
if (isset($_POST['update_product'])) {
    $id = $_POST['pid'];
    $newPrice = $_POST['newprice'];

    $stmt = $conn->prepare("UPDATE product SET price=? WHERE product_id=?");
    $stmt->bind_param("di", $newPrice, $id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Product updated successfully!');</script>";
    } else {
        echo "<script>alert('❌ Error updating product: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// --- RETRIEVE PRODUCTS ---
$result = $conn->query("SELECT * FROM product");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | UniMart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            margin: 0;
        }

        header {
            background: #ff9CB5;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        .container {
            width: 90%;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #ff6f91;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #ff9cb5;
            color: white;
        }

        tr:hover {
            background: #f3f3f3;
        }

        input[type=text], input[type=number] {
            padding: 8px;
            width: 220px;
            margin: 5px;
        }

        input[type=submit] {
            background: #ff9cb5;
            color: white;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type=submit]:hover {
            background: #f59abdff;
        }

        .logout {
            text-align: right;
            margin: 10px 30px;
        }

        .logout a {
            color: #ff9cb5;
            text-decoration: none;
            font-weight: bold;
        }

        .logout a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h2>UniMart Admin Panel</h2>
    <nav>
        <a href="home.php">Home</a>
        <a href="manage_products.php">Manage Products</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<div class="logout">
    Logged in as <b><?php echo htmlspecialchars($_SESSION['name']); ?></b>
</div>

<div class="container">
    <h2>Add a New Product</h2>
    <form method="post">
        <input type="text" name="pname" placeholder="Product Name" required>
        <input type="number" step="0.01" name="pprice" placeholder="Price" required>
        <input type="text" name="pcategory" placeholder="Category" required>
        <input type="submit" name="add_product" value="Add Product">
    </form>

    <h2>Update Product Price</h2>
    <form method="post">
        <input type="number" name="pid" placeholder="Product ID" required>
        <input type="number" step="0.01" name="newprice" placeholder="New Price" required>
        <input type="submit" name="update_product" value="Update Product">
    </form>

    <h2>All Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Price (Rs)</th>
            <th>Category</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['product_id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['product_name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['category']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No products found.</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
<?php $conn->close(); ?>
