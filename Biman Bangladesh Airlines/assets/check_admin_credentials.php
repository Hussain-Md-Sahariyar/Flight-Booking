<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Compare the plaintext password
        if ($password === $row['password']) {
            $_SESSION['loggedin'] = true;
            echo "success";
        } else {
            echo "Invalid Credentials.";
        }
    } else {
        echo "Invalid Credentials.";
    }

    $stmt->close();
}

$conn->close();
?>
