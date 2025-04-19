<?php
class UserBookingModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getBookingsByUser($email) {
        $stmt = $this->conn->prepare("SELECT * FROM booking_oneway WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
