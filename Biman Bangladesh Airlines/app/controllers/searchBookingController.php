<?php
require_once '../models/BookingSearchModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");
$model = new BookingSearchModel($conn);

$data = json_decode(file_get_contents("php://input"), true);
$result = $model->findBooking($data['reservationCode'], $data['lastName']);

echo json_encode($result ? ["success" => true, "booking_id" => $result['booking_id']] : ["success" => false, "message" => "Not found"]);
?>
