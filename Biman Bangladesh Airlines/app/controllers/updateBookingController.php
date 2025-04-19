<?php
require_once '../models/BookingModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = new BookingModel($conn);
    echo $model->updateBooking($_POST);
}
?>
