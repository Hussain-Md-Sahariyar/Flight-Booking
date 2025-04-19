<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "airlinesystem");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect POST data
    $booking_id = $_POST['booking_id'];
    $booking_date = $_POST['booking_date'];
    $issue_before = $_POST['issue_before'];
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $passport_no = $_POST['passport_no'];
    $passport_expiry_date = $_POST['passport_expiry_date'];
    $flight_no = $_POST['flight_no'];
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $departure_city_code = $_POST['departure_city_code'];
    $arrival_city_code = $_POST['arrival_city_code'];
    $departure_terminal = $_POST['departure_terminal'];
    $arrival_terminal = $_POST['arrival_terminal'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $class = $_POST['class'];
    $baggage_type = $_POST['baggage_type'];
    $check_in_baggage = $_POST['check_in_baggage'];
    $frequent_flyer_airline = $_POST['frequent_flyer_airline'];
    $frequent_flyer_no = $_POST['frequent_flyer_no'];
    $base_fare = (int) $_POST['base_fare'];
    $taxes = (int) $_POST['taxes'];
    $price = (int) $_POST['price'];
    $country = $_POST['country'];
    $email = $_POST['email'];
    $contact = (int) $_POST['contact'];
    $booking_reference = $_POST['booking_reference'];
    $fare_basis = $_POST['fare_basis'];

    // Prepare SQL statement
    $sql = "UPDATE booking_oneway 
            SET booking_date = ?, issue_before = ?, title = ?, first_name = ?, last_name = ?, 
                date_of_birth = ?, passport_no = ?, passport_expiry_date = ?, flight_no = ?, 
                flying_from = ?, flying_to = ?, departure_city_code = ?, arrival_city_code = ?, 
                departure_terminal = ?, arrival_terminal = ?, departure_date = ?, arrival_date = ?, 
                departure_time = ?, arrival_time = ?, class = ?, baggage_type = ?, check_in_baggage = ?, 
                frequent_flyer_airline = ?, frequent_flyer_no = ?, base_fare = ?, taxes = ?, 
                price = ?, country = ?, email = ?, contact = ?, booking_reference = ?, fare_basis = ? 
            WHERE booking_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param(
        "ssssssssssssssssssssssssiiississi",
        $booking_date,
        $issue_before,
        $title,
        $first_name,
        $last_name,
        $date_of_birth,
        $passport_no,
        $passport_expiry_date,
        $flight_no,
        $flying_from,
        $flying_to,
        $departure_city_code,
        $arrival_city_code,
        $departure_terminal,
        $arrival_terminal,
        $departure_date,
        $arrival_date,
        $departure_time,
        $arrival_time,
        $class,
        $baggage_type,
        $check_in_baggage,
        $frequent_flyer_airline,
        $frequent_flyer_no,
        $base_fare,
        $taxes,
        $price,
        $country,
        $email,
        $contact,
        $booking_reference,
        $fare_basis,
        $booking_id
    );

    // Execute and handle result
    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'Failed to update booking: ' . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
