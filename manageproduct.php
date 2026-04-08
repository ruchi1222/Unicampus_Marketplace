<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

// Add New Product
if (isset($_POST['add_product'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['pname'];
    $price = $_POST['pprice'];

    // Category Logic
    $category = $_POST['pcategory'];
    if ($category === "NEW_CATEGORY") {
        $category = $_POST['new_category_name'];
    }

    // Image Upload Logic
    $imagePath = 'default.jpg';
    if (!empty($_FILES['pimage']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir))
            mkdir($targetDir, 0777, true);

        $imageName = basename($_FILES['pimage']['name']);

        // Remove spaces and make unique
        $cleanImageName = time() . "_" . str_replace(" ", "_", $imageName);
        $targetFilePath = $targetDir . $cleanImageName;

        if (move_uploaded_file($_FILES['pimage']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath;
        }
    }

    $stmt = $conn->prepare("INSERT INTO product (user_id, product_name, price, category, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdss", $user_id, $name, $price, $category, $imagePath);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Product added successfully!');</script>";
    } else {
        echo "<script>alert('❌ Error adding product: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Update Product
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

// Fetch distinct categories
$catResult = $conn->query("SELECT DISTINCT category FROM product");
$categories = [];
if ($catResult->num_rows > 0) {
    while ($cRow = $catResult->fetch_assoc()) {
        if (!empty(trim($cRow['category']))) {
            $categories[] = trim($cRow['category']);
        }
    }
}

$result = $conn->query("SELECT * FROM product ORDER BY product_id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | UniMart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-title {
            text-align: center;
            color: #ffffffff;
            font-size: 40px;
            margin: 30px 0;
            font-weight: bold;
        }

        .admin-card {
            background: white;
            max-width: 1000px;
            margin: 0 auto 50px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .admin-card h2 {
            color: #ff6f91;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
            align-items: center;
        }

        .form-row input[type="text"],
        .form-row input[type="number"],
        .form-row select {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .admin-btn {
            background-color: #ff9cb5;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .admin-btn:hover {
            background-color: #ff6f91;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .admin-table th {
            background-color: #ff9cb5;
            color: white;
            padding: 15px;
            text-align: left;
            font-size: 18px;
        }

        .admin-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 16px;
            vertical-align: middle;
        }

        .empty-row td {
            text-align: center;
            color: #333;
        }

        .prod-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <h1 class="admin-title">Admin Product Management</h1>

    <div class="admin-card">

        <!-- Add Product -->
        <h2>Add a New Product</h2>
        <form method="post" class="form-row" enctype="multipart/form-data" style="flex-wrap: wrap;">
            <input type="text" name="pname" placeholder="Product Name" required style="min-width: 200px;">
            <input type="number" step="0.01" name="pprice" placeholder="Price" required
                style="min-width: 100px; max-width:150px;">

            <!-- Dynamic Category Dropdown -->
            <select name="pcategory" id="catSelector" onchange="toggleNewCategory()" required style="min-width: 150px;">
                <option value="" disabled selected hidden>Select Category</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
                <?php endforeach; ?>
                <option value="NEW_CATEGORY">+ Add New Category</option>
            </select>

            <input type="text" name="new_category_name" id="newCatInput" placeholder="New Category Name"
                style="display:none; min-width:150px;">

            <label
                style="display:flex; align-items:center; background:#f0f0f0; padding:10px; border-radius:5px; border:1px solid #ddd; cursor:pointer;">
                <span style="margin-right:5px; font-weight:bold; color:#ff6f91;">Pic:</span>
                <input type="file" name="pimage" accept="image/*" style="font-size:14px;">
            </label>

            <input type="submit" name="add_product" value="Add Product" class="admin-btn">
        </form>

        <script>
            function toggleNewCategory() {
                var selector = document.getElementById('catSelector');
                var input = document.getElementById('newCatInput');
                if (selector.value === "NEW_CATEGORY") {
                    input.style.display = 'block';
                    input.setAttribute('required', 'required');
                } else {
                    input.style.display = 'none';
                    input.removeAttribute('required');
                }
            }
        </script>

        <!-- Update Product -->
        <h2>Update Product Price</h2>
        <form method="post" class="form-row">
            <input type="number" name="pid" placeholder="Product ID" required style="max-width:200px;">
            <input type="number" step="0.01" name="newprice" placeholder="New Price" required style="max-width:200px;">
            <input type="submit" name="update_product" value="Update Product" class="admin-btn">
        </form>

        <!-- All Products -->
        <h2>All Products</h2>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price (Rs)</th>
                <th>Category</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                       
                        <td>{$row['product_id']}</td>
                        <td>{$row['product_name']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['category']}</td>
                      </tr>";
                }
            } else {
                echo "<tr class='empty-row'><td colspan='5'>No products found.</td></tr>";
            }
            ?>
        </table>

    </div>

</body>

</html>
<?php $conn->close(); ?>