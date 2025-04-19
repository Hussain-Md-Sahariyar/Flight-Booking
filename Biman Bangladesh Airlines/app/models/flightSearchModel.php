<?php
class FlightSearchModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function searchFlights($flying_from, $flying_to, $departure_date, $class) {
        $query = "SELECT * FROM flights_oneway WHERE flying_from = ? AND flying_to = ? AND departure_date = ? AND class = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $flying_from, $flying_to, $departure_date, $class);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>
