<?php
class ContactModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function submitContact($name, $email, $message) {
        $stmt = $this->conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        return $stmt->execute();
    }
}
?>
