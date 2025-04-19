<?php
require_once 'app/models/Flight.php';

class AdminFlightController {
    private $flight;

    public function __construct($db) {
        $this->flight = new Flight($db);
    }

    public function index() {
        $flights = $this->flight->getAllFlights();
        require 'app/views/admin/flightManagement.php';
    }

    public function addOrUpdateFlight() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $result = $this->flight->addOrUpdateFlight($data);

            if ($result) {
                echo "<script>alert('Flight saved successfully!'); window.location.href='index.php?action=flightManagement';</script>";
            } else {
                echo "<script>alert('Error saving flight.'); window.location.href='index.php?action=flightManagement';</script>";
            }
        }
    }

    public function deleteFlight() {
        $input = json_decode(file_get_contents("php://input"), true);

        if (isset($input['flight_no'], $input['departure_date'])) {
            $success = $this->flight->deleteFlight($input['flight_no'], $input['departure_date']);
            echo json_encode(['success' => $success]);
        }
    }

    public function getFlightDetails() {
        $flight_no = $_POST['flight_no'];
        $departure_date = $_POST['departure_date'];

        $flight = $this->flight->getFlightByNoAndDate($flight_no, $departure_date);
        echo json_encode($flight);
    }
}
