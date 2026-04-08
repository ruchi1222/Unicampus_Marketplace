<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "unimart");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT name, email, role FROM user WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$userProfile = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - UniMart</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <div class="profile-content">
            <h1 style="text-align: center;">My Profile</h1>
            <div class="profile-icon" style="text-align: center;">
                <img src="image-removebg-preview (6).png" alt="profile"
                    style="height: 150px; width: auto; margin-bottom: 20px; margin-left: 80px;">
            </div>

            <?php if ($userProfile): ?>
                <div class="profile-info">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($userProfile['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($userProfile['email']); ?></p>
                    <p><strong>Account Type:</strong> <?php echo htmlspecialchars(ucfirst($userProfile['role'])); ?></p>
                </div>
            <?php else: ?>
                <p>User profile could not be loaded.</p>
            <?php endif; ?>

            <a href="login.php" class="logout-btn">Log Out</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 UniMart. All rights reserved.</p>
    </footer>

    <script src="addtocart.js"></script>
    <script src="search.js"></script>
</body>

</html>