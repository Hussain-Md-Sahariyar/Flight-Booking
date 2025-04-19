<?php
require_once '../models/BookingModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");
$model = new BookingModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $model->addBooking($_POST);
    if ($result) {
        $bookingId = $conn->insert_id;
        header("Location: ../views/bookingCopy.php?booking_id=$bookingId");
    } else {
        echo "Booking failed.";
    }
}
?>
