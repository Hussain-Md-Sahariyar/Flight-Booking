<?php
class PassengerModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getPassengers($passport_no = '') {
        if ($passport_no) {
            $stmt = $this->conn->prepare("SELECT * FROM booking_oneway WHERE passport_no = ?");
            $stmt->bind_param("s", $passport_no);
            $stmt->execute();
            return $stmt->get_result();
        }
        return $this->conn->query("SELECT * FROM booking_oneway");
    }
}
?>
