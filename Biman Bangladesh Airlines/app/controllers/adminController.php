<?php
require_once '../models/AdminModel.php';

class AdminController {
    private $admin;

    public function __construct($db) {
        $this->admin = new AdminModel($db);
    }

    public function login() {
        session_start();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->admin->checkLogin($email, $password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            echo "success";
        } else {
            echo "Invalid credentials";
        }
    }

    public function dashboard() {
        session_start();
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
            header("Location: ../admin_login.php");
            exit;
        }

        $stats = $this->admin->getDashboardStats();
        include '../views/adminDashboard.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: ../admin_login.php");
    }
}
