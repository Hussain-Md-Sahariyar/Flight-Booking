<?php
class FlightModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllFlights() {
        return $this->conn->query("SELECT * FROM flights_oneway ORDER BY departure_date DESC");
    }

    public function searchFlights($from, $to, $date, $class) {
        $stmt = $this->conn->prepare("SELECT * FROM flights_oneway WHERE flying_from = ? AND flying_to = ? AND departure_date = ? AND class = ?");
        $stmt->bind_param("ssss", $from, $to, $date, $class);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function deleteFlight($flight_no) {
        $stmt = $this->conn->prepare("DELETE FROM flights_oneway WHERE flight_no = ?");
        $stmt->bind_param("s", $flight_no);
        return $stmt->execute();
    }

    public function updateFlight($data) {
        $stmt = $this->conn->prepare("UPDATE flights_oneway SET flying_from=?, flying_to=?, departure_time=?, arrival_time=?, departure_date=?, arrival_date=?, duration=?, class=?, aircraft=?, available_seats=?, price=? WHERE flight_no=? AND departure_date=?");
        $stmt->bind_param(
            "ssssssssiiiss",
            $data['flying_from'],
            $data['flying_to'],
            $data['departure_time'],
            $data['arrival_time'],
            $data['departure_date'],
            $data['arrival_date'],
            $data['duration'],
            $data['class'],
            $data['aircraft'],
            $data['available_seats'],
            $data['price'],
            $data['flight_no'],
            $data['departure_date']
        );
        return $stmt->execute() ? 'success' : $stmt->error;
    }
}
?>
