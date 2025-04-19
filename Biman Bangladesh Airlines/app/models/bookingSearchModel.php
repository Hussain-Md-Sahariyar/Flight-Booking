<?php
class BookingSearchModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function findBooking($code, $lastName) {
        $stmt = $this->conn->prepare("SELECT booking_id FROM booking_oneway WHERE booking_reference = ? AND last_name = ?");
        $stmt->bind_param("ss", $code, $lastName);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
