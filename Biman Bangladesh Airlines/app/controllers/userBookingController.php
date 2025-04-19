<?php
require_once '../models/UserBookingModel.php';
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "airlinesystem");
$model = new UserBookingModel($conn);
$bookings = $model->getBookingsByUser($_SESSION['email']);
include '../views/userBookingView.php';
?>
