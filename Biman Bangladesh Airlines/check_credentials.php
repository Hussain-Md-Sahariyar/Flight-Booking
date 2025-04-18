<?php
session_start();
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
    $sql = "SELECT * FROM signupinfo WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            echo "success";
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }
    $stmt->close();
}
$conn->close();
?>