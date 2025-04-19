<?php
require_once '../models/FlightSearchModel.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchResult = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $departure_date = $_POST['departure_date'];
    $class = $_POST['class'];

    $flightModel = new FlightSearchModel($conn);
    $searchResult = $flightModel->searchFlights($flying_from, $flying_to, $departure_date, $class);
}

include '../views/indexView.php';
?>
