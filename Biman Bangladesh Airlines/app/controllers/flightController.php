<?php
require_once '../models/FlightModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");
$model = new FlightModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $from = $_POST['flying_from'];
    $to = $_POST['flying_to'];
    $date = $_POST['departure_date'];
    $class = $_POST['class'];

    $flights = $model->searchFlights($from, $to, $date, $class);
    include '../views/searchResultsView.php';
}
?>
