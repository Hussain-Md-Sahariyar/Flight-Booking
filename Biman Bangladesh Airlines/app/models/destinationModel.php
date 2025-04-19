<?php
class DestinationModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getDestinations() {
        return $this->conn->query("SELECT DISTINCT flying_from, flying_to, departure_city_code, arrival_city_code, departure_time, arrival_time, duration, flight_no, available_seats FROM flights_oneway ORDER BY flying_from, flying_to");
    }
}
?>
