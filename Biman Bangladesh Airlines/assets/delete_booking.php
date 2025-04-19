<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if booking ID is provided
if (isset($_POST['booking_id'])) {
    $booking_id = $conn->real_escape_string($_POST['booking_id']);
    $sql = "DELETE FROM booking_oneway WHERE booking_id = '$booking_id'";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid_request";
}

$conn->close();
?>
