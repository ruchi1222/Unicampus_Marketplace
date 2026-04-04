<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "unimart";

$conn = new mysqli($servername, $username, $password, $dbname);

// To check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// after form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["name"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        echo "<p style='color:red; text-align:center;'>Please fill in all fields.</p>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            if ($row["password"] === $password) {
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["role"] = $row["role"];

                echo "<p style='color:green; text-align:center;'>Login successful! Welcome, " . htmlspecialchars($row['name']) . ".</p>";
                echo "<meta http-equiv='refresh' content='2;url=Home.php'>";
            } else {
                echo "<p style='color:red; text-align:center;'>Incorrect password. Try again.</p>";
            }
        } else {
            echo "<p style='color:red; text-align:center;'>No account found with that email.</p>";
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
  <title>Login</title>

  <!-- CSS -->
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff5f8;
      margin: 0;
      padding: 0;
    }

    h2 {
      text-align: center;
      color: #fc0362;
      margin-top: 40px;
    }

    table {
      margin: 0 auto;
      border: 2px solid #fc0362;
      border-radius: 10px;
      padding: 20px;
      background-color: white;
      
    }

    td {
      padding: 10px 15px;
      font-size: 16px;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 200px;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"],
    input[type="reset"] {
      background-color: #fc0362;
      border: none;
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover,
    input[type="reset"]:hover {
      background-color: #d90454;
    }

    p {
      text-align: center;
      font-size: 16px;
    }

    a {
      color: #fc0362;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <h2>Login</h2>

  <form action="login.php" method="post">
    <table>
      <tr>
        <td><label for="name">Email:</label></td>
        <td><input type="email" id="name" name="name" required placeholder="Enter your email"></td>
      </tr>
      <tr>
        <td><label for="password">Password:</label></td>
        <td><input type="password" id="password" name="password" required placeholder="Enter your password"></td>
      </tr>
    </table>
    <p>
      <input type="submit" value="Login" style="margin-right: 10px;">
      <input type="reset" value="Clear">
    </p>
  </form>

  <p>Don't have an account? <a href="signup.html">Sign up!</a></p>
</body>
</html>

