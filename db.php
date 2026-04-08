<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unimart";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create table if it doesn't exist
$tableSql = "CREATE TABLE IF NOT EXISTS product (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT 'default.jpg'
)";
if (!$conn->query($tableSql)) {
    die("Error creating table: " . $conn->error);
}

// 2. Check if table is empty before seeding
$checkSql = "SELECT COUNT(*) as count FROM product";
$result = $conn->query($checkSql);
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    // 3. Seed data if empty
    $seedSql = "INSERT INTO product (product_id, user_id, product_name, price, category, image) VALUES 
        (1, 1, 'Blue Pen', 10.00, 'Stationary', 'bluepen.jpeg'),
        (2, 1, 'Black Pen', 10.00, 'Stationary', 'blackpen.jpeg'),
        (3, 1, 'Ruler', 15.00, 'Stationary', 'ruler.jpeg'),
        (4, 1, 'Pencil', 5.00, 'Stationary', 'pencil.jpeg'),
        (5, 1, 'Glue', 20.00, 'Stationary', 'glue.jpeg'),
        (6, 1, 'Copybook', 50.00, 'Stationary', 'copybook.jpeg'),
        (7, 1, 'Headphone', 1500.00, 'Tech', 'headphone.jpeg'),
        (8, 1, 'Mouse', 400.00, 'Tech', 'mouse.jpeg'),
        (9, 1, 'USB Drives', 800.00, 'Tech', 'usb.jpeg'),
        (10, 1, 'Laptop Bag', 1200.00, 'Tech', 'bag.jpeg'),
        (11, 1, 'LED Desk Lamp', 500.00, 'Tech', 'ledlamp.jpeg'),
        (12, 1, 'Powerbank', 1000.00, 'Tech', 'powerbank.jpeg'),
        (13, 1, 'Happy After All', 200.00, 'Books', 'happy.jpeg'),
        (14, 1, 'National Geographic', 150.00, 'Books', 'national.jpeg'),
        (15, 1, 'Vogue', 350.00, 'Books', 'vogue.jpeg'),
        (16, 1, 'Pride And Prejudice', 500.00, 'Books', 'pride.jpeg')
    ";
    
    if ($conn->query($seedSql)) {
        // Automatically created logic, no print to prevent messing up UI included files
    } else {
        error_log("Failed to seed product table: " . $conn->error);
    }
}
?>