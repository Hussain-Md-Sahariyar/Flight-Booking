<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['flight_no']) && isset($data['departure_date'])) {
    $flightNo = $conn->real_escape_string($data['flight_no']);
    $departureDate = $conn->real_escape_string($data['departure_date']);

    // Delete query
    $sql = "DELETE FROM flights_oneway WHERE flight_no = '$flightNo' AND departure_date = '$departureDate'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
?>
