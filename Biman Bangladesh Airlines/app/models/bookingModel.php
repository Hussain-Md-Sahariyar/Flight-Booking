<?php
class BookingModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function addBooking($data) {
        $stmt = $this->conn->prepare("INSERT INTO booking_oneway (booking_reference, flight_no, first_name, last_name, email, phone_number, gender, dob, passport_no, nationality, booking_date, departure_date, flying_from, flying_to, class, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssssssssd",
            $data['booking_reference'],
            $data['flight_no'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone_number'],
            $data['gender'],
            $data['dob'],
            $data['passport_no'],
            $data['nationality'],
            $data['departure_date'],
            $data['flying_from'],
            $data['flying_to'],
            $data['class'],
            $data['price']
        );
        return $stmt->execute();
    }

    public function updateBooking($data) {
        $stmt = $this->conn->prepare("UPDATE booking_oneway SET first_name = ?, last_name = ?, email = ?, phone_number = ?, nationality = ?, class = ?, price = ? WHERE booking_id = ?");
        $stmt->bind_param("ssssssdi", $data['first_name'], $data['last_name'], $data['email'], $data['phone_number'], $data['nationality'], $data['class'], $data['price'], $data['booking_id']);
        return $stmt->execute() ? 'success' : $stmt->error;
    }
}
?>
