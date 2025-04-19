<?php
class Issue {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function savePayment($booking_id, $invoice, $price, $phone) {
        $stmt = $this->conn->prepare("INSERT INTO payment (booking_id, invoice, price, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $booking_id, $invoice, $price, $phone);
        $stmt->execute();
    }

    public function issue($booking) {
        $gender = $booking['title'] === 'Mr' ? 'Male' : 'Female';

        $stmt = $this->conn->prepare("INSERT INTO issue_oneway (
            booking_id, issue_date, booking_reference, title, first_name, last_name,
            date_of_birth, passport_no, flight_no, flying_from, flying_to,
            departure_city_code, arrival_city_code, departure_terminal, arrival_terminal,
            departure_date, arrival_date, departure_time, arrival_time, class,
            baggage_type, check_in_baggage, frequent_flyer_airline, frequent_flyer_no,
            fare_basis, base_fare, taxes, price, country, email, contact
        ) VALUES (?, CURDATE(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("isssssssssssssssssssssssiiissi",
            $booking['booking_id'], $booking['booking_reference'], $booking['title'],
            $booking['first_name'], $booking['last_name'], $booking['date_of_birth'],
            $booking['passport_no'], $booking['flight_no'], $booking['flying_from'],
            $booking['flying_to'], $booking['departure_city_code'], $booking['arrival_city_code'],
            $booking['departure_terminal'], $booking['arrival_terminal'], $booking['departure_date'],
            $booking['arrival_date'], $booking['departure_time'], $booking['arrival_time'],
            $booking['class'], $booking['baggage_type'], $booking['check_in_baggage'],
            $booking['frequent_flyer_airline'], $booking['frequent_flyer_no'],
            $booking['fare_basis'], $booking['base_fare'], $booking['taxes'],
            $booking['price'], $booking['country'], $booking['email'], $booking['contact']
        );

        $stmt->execute();
    }

    public function getIssueInfo($booking_id) {
        $stmt = $this->conn->prepare("SELECT issue_date, eTicket FROM issue_oneway WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
