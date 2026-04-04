<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unimart";

// Create connection
$conn = new mysqli(hostname: $servername, username: $username, password: $password, database: $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}