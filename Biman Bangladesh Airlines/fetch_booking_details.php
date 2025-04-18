<?php
if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "airlinesystem");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM booking_oneway WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(['error' => 'Booking not found']);
    }

    $stmt->close();
    $conn->close();
}
?>
