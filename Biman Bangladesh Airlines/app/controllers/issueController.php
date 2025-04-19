<?php
require_once 'app/models/Booking.php';
require_once 'app/models/Issue.php';

class IssueController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function issueTicket() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $booking_id = $_POST['booking_id'];
            $price = $_POST['price'];
            $invoice = $_POST['invoice'];
            $phone = $_POST['phone'];
            $pin = $_POST['pin'];

            $bookingModel = new Booking($this->conn);
            $issueModel = new Issue($this->conn);

            $booking = $bookingModel->getBookingById($booking_id);
            if (!$booking) die("Booking not found");

            $issueModel->savePayment($booking_id, $invoice, $price, $phone);
            $issueModel->issue($booking);

            $gender = $booking['title'] === 'Mr' ? 'Male' : 'Female';
            $ticketInfo = $issueModel->getIssueInfo($booking_id);
            $issue_date = $ticketInfo['issue_date'];
            $eTicket = $ticketInfo['eTicket'];

            require 'app/views/issue/ticket.php';
        }
    }
}
