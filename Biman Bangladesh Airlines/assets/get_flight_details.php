<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$flightNo = $_POST['flight_no'];
$departureDate = $_POST['departure_date'];

$sql = "SELECT * FROM flights_oneway WHERE flight_no = '$flightNo' AND departure_date = '$departureDate'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array('error' => 'No details found for this flight.'));
}

$conn->close();
?>
