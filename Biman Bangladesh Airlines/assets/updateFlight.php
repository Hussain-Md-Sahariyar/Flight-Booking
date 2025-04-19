<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flight_no = $_POST['flight_no'];
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $departure_city_code = $_POST['departure_city_code'];
    $arrival_city_code = $_POST['arrival_city_code'];
    $departure_city = $_POST['departure_city'];
    $arrival_city = $_POST['arrival_city'];
    $departure_airport = $_POST['departure_airport'];
    $arrival_airport = $_POST['arrival_airport'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $departure_terminal = $_POST['departure_terminal'];
    $arrival_terminal = $_POST['arrival_terminal'];
    $duration = $_POST['duration'];
    $class = $_POST['class'];
    $refundable = $_POST['refundable'];
    $aircraft = $_POST['aircraft'];
    $available_seats = $_POST['available_seats'];
    $baggage_type = $_POST['baggage_type'];
    $cabin_baggage = $_POST['cabin_baggage'];
    $check_in_baggage = $_POST['check_in_baggage'];
    $price = $_POST['price'];
    $base_fare = $_POST['base_fare'];
    $taxes = $_POST['taxes'];

    // Update query
    $sql = "UPDATE flights_oneway SET flight_no=?, flying_from=?, flying_to=?, departure_city_code=?, arrival_city_code=?, departure_city=?, arrival_city=?, departure_airport=?, arrival_airport=?, departure_date=?, arrival_date=?, departure_time=?, arrival_time=?, departure_terminal=?, arrival_terminal=?, duration=?, class=?, refundable=?, aircraft=?, available_seats=?, baggage_type=?, cabin_baggage=?, check_in_baggage=?, price=?, base_fare=?, taxes=? WHERE flight_no=? AND departure_date=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssssssisssiii",
        $flight_no,
        $flying_from,
        $flying_to,
        $departure_city_code,
        $arrival_city_code,
        $departure_city,
        $arrival_city,
        $departure_airport,
        $arrival_airport,
        $departure_date,
        $arrival_date,
        $departure_time,
        $arrival_time,
        $departure_terminal,
        $arrival_terminal,
        $duration,
        $class,
        $refundable,
        $aircraft,
        $available_seats,
        $baggage_type,
        $cabin_baggage,
        $check_in_baggage,
        $price,
        $base_fare,
        $taxes);

    if ($stmt->execute()) {
        echo "<script>alert('Flight updated successfully!'); window.location.href='flightManagement.php';</script>";
    } else {
        echo "<script>alert('Error updating flight: " . $stmt->error . "');</script>";
    }
}
?>
