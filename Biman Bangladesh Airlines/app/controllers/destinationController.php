<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login.php");
    exit;
}

require_once '../models/DestinationModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");
$model = new DestinationModel($conn);
$destinations = $model->getDestinations();
include '../views/destinationView.php';
?>
