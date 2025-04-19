<?php
class PaymentController {
    public function showBkashForm() {
        if (isset($_GET['booking_id']) && isset($_GET['price'])) {
            $booking_id = $_GET['booking_id'];
            $price = $_GET['price'];
            $invoice = 'D' . uniqid(); // Unique invoice

            require 'app/views/payment/bkash.php';
        } else {
            echo "Invalid payment request.";
        }
    }

    public function pinVerify() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $booking_id = $_POST['booking_id'];
            $price = $_POST['price'];
            $invoice = $_POST['invoice'];
            $phone = $_POST['phone'];

            // Redirect to IssueController with data
            echo '<form id="autoForm" action="index.php?action=issueTicket" method="POST">';
            echo '<input type="hidden" name="booking_id" value="' . $booking_id . '">';
            echo '<input type="hidden" name="price" value="' . $price . '">';
            echo '<input type="hidden" name="invoice" value="' . $invoice . '">';
            echo '<input type="hidden" name="phone" value="' . $phone . '">';
            echo '<input type="hidden" name="pin" value="1234">';
            echo '</form>';
            echo '<script>document.getElementById("autoForm").submit();</script>';
        }
    }

    public function showPinScreen() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $booking_id = $_GET['booking_id'];
            $price = $_GET['price'];
            $invoice = $_GET['invoice'];
            $phone = $_GET['phone'];
    
            require 'app/views/payment/pin.php';
        }
    }
    
}
