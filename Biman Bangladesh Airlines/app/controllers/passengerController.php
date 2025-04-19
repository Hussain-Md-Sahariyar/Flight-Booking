<?php
require_once '../models/PassengerModel.php';

// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchQuery = trim($_POST['passport_no']);
}

$model = new PassengerModel($conn);
$result = $model->getPassengers($searchQuery);

// pass to view
include '../views/passengerManagementView.php';
?>
