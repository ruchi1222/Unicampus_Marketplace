<?php
session_start();
$conn = new mysqli("localhost", "root", "", "unimart");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);
    $course = trim($_POST['course'] ?? '');
    $level = isset($_POST['level']) ? (int) $_POST['level'] : 0;
    $role = $_POST['role'] ?? 'buyer';

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $message = "<div class='alert error'>Please fill in all fields.</div>";
    } elseif ($password !== $confirm_password) {
        $message = "<div class='alert error'>Passwords do not match.</div>";
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "<div class='alert error'>Email already registered! Try logging in.</div>";
        } else {
            // Insert user
            $insert_stmt = $conn->prepare("INSERT INTO user (name, email, password, role, course, level) VALUES (?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssssi", $name, $email, $password, $role, $course, $level);
            if ($insert_stmt->execute()) {
                $message = "<div class='alert success'>Sign up successful! Re-directing to login...</div>";
                echo "<meta http-equiv='refresh' content='2;url=login.php'>";
            } else {
                $message = "<div class='alert error'>Error: " . $insert_stmt->error . "</div>";
            }
            $insert_stmt->close();
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - UniMart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #fff5f8;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .signup-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(252, 3, 98, 0.15);
            max-width: 450px;
            width: 100%;
            border: 2px solid #ea9caf;
            text-align: center;
        }

        .signup-title {
            color: #fc0362;
            font-size: 40px;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: bold;
            font-size: 15px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #fc0362;
            box-shadow: 0 0 5px rgba(252, 3, 98, 0.4);
        }

        .role-group {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
        }

        .role-group label {
            cursor: pointer;
            font-size: 16px;
        }

        .btn-submit {
            background-color: #fc0362;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-submit:hover {
            background-color: #d90454;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
        }

        .alert.error {
            background-color: #ffe6e6;
            color: #cc0000;
            border: 1px solid #ffcccc;
        }

        .alert.success {
            background-color: #e6ffe6;
            color: #009900;
            border: 1px solid #ccffcc;
        }

        .login-link {
            display: block;
            margin-top: 25px;
            color: #555;
            font-size: 15px;
        }

        .login-link a {
            color: #fc0362;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="signup-container">
        <h1 class="signup-title">Sign Up</h1>

        <?php echo $message; ?>

        <form action="signup.php" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="Create a password">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm-password" required placeholder="Confirm your password">
            </div>

            <div class="form-group">
                <label>Course</label>
                <input type="text" name="course" required placeholder="Enter your Course">
            </div>

            <div class="form-group">
                <label>Level</label>
                <div class="role-group">
                    <label><input type="radio" name="level" value="1" required> 1</label>
                    <label><input type="radio" name="level" value="2"> 2</label>
                    <label><input type="radio" name="level" value="3"> 3</label>
                    <label><input type="radio" name="level" value="4"> 4</label>
                    <label><input type="radio" name="level" value="5"> 5</label>
                </div>
            </div>

            <div class="form-group">
                <label>Register As</label>
                <div class="role-group">
                    <label><input type="radio" name="role" value="buyer" checked> Buyer</label>
                    <label><input type="radio" name="role" value="seller"> Seller</label>
                </div>
            </div>

            <button type="submit" class="btn-submit">Create Account</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login instead!</a>
        </div>
    </div>

</body>

</html>