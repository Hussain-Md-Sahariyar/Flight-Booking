<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$reservationCode = $data['reservationCode'];
$lastName = $data['lastName'];
// Prepare and execute query
$stmt = $conn->prepare("SELECT booking_id FROM booking_oneway WHERE booking_reference = ? AND last_name = ?");
$stmt->bind_param("ss", $reservationCode, $lastName);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'booking_id' => $row['booking_id']]);
} else {
    echo json_encode(['success' => false]);
}
$stmt->close();
$conn->close();
?>
