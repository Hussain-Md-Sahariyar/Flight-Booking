<?php
class AdminModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function checkLogin($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows === 1;
    }

    public function getDashboardStats() {
        $stats = [];
        $queries = [
            'total_passengers' => "SELECT COUNT(*) AS total FROM booking_oneway",
            'total_revenue' => "SELECT SUM(price) AS total FROM issue_oneway",
            'total_flights' => "SELECT COUNT(*) AS total FROM flights_oneway"
        ];
        foreach ($queries as $key => $sql) {
            $result = $this->conn->query($sql);
            $row = $result->fetch_assoc();
            $stats[$key] = $row['total'] ?? 0;
        }

        $today = (new DateTime('now', new DateTimeZone('Asia/Dhaka')))->format('Y-m-d');
        $stats['today_flights'] = $this->conn->query("SELECT * FROM flights_oneway WHERE departure_date = '$today'");
        return $stats;
    }
}
?>
