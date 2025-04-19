<?php
require_once '../models/FlightModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['flight_no'])) {
    $model = new FlightModel($conn);
    $deleted = $model->deleteFlight($_POST['flight_no']);
    $status = $deleted ? 'success' : 'error';
    header("Location: ../views/flightManagement.php?status=$status");
}
?>
