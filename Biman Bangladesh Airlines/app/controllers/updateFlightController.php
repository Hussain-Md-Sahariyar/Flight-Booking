<?php
require_once '../models/FlightModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new FlightModel($conn);
    $result = $model->updateFlight($_POST);

    if ($result === 'success') {
        echo "<script>alert('Flight updated successfully'); window.location.href='../views/flightManagement.php';</script>";
    } else {
        echo "<script>alert('$result'); window.history.back();</script>";
    }
}
?>
