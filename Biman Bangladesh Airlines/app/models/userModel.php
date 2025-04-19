<?php
class UserModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllUsers() {
        return $this->conn->query("SELECT * FROM signupinfo");
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM signupinfo WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM signupinfo WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($id, $name, $email, $contact, $address) {
        $stmt = $this->conn->prepare("UPDATE signupinfo SET first_name = ?, email = ?, phone_number = ?, address = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $email, $contact, $address, $id);
        return $stmt->execute();
    }
}
?>
