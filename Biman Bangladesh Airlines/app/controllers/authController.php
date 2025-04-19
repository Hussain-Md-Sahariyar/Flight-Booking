<?php
class AuthController {
    public function showSignupForm() {
        require 'app/views/auth/signup.php';
    }

    public function registerUser() {
        $conn = new mysqli("localhost", "root", "", "airlinesystem");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postalCode = $_POST['postalCode'];
        $countryCode = $_POST['countryCode'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO signupinfo (first_name, last_name, address, city, country, postal_code, country_code, phone_number, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $firstName, $lastName, $address, $city, $country, $postalCode, $countryCode, $phoneNumber, $email, $password);

        if ($stmt->execute()) {
            header("Location: index.php?action=login");
            exit();
        } else {
            echo "Registration failed: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }

    public function registerUser() {
        // Enable error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
    
        // Database connection
        $conn = new mysqli("localhost", "root", "", "airlinesystem");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Get POST data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $country = $_POST['country'];
        $postalCode = $_POST['postalCode'];
        $countryCode = $_POST['countryCode'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
        // Insert user data
        $stmt = $conn->prepare("INSERT INTO signupinfo (first_name, last_name, address, city, country, postal_code, country_code, phone_number, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $firstName, $lastName, $address, $city, $country, $postalCode, $countryCode, $phoneNumber, $email, $password);
    
        if ($stmt->execute()) {
            echo "success"; // For AJAX
        } else {
            echo "Error: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    }

    public function checkEmailExists() {
        $conn = new mysqli("localhost", "root", "", "airlinesystem");
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
    
            $stmt = $conn->prepare("SELECT email FROM signupinfo WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                echo 'exists';
            } else {
                echo 'not_exists';
            }
    
            $stmt->close();
            $conn->close();
        }
    }

    public function verifyCredentials() {
        session_start();
        $conn = new mysqli("localhost", "root", "", "airlinesystem");
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            if (empty($email) || empty($password)) {
                echo "Please fill in all fields.";
                exit();
            }
    
            $sql = "SELECT * FROM signupinfo WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $row['first_name']; // optional
                    echo "success"; // AJAX expects this
                } else {
                    echo "Incorrect password.";
                }
            } else {
                echo "Email not found.";
            }
    
            $stmt->close();
        }
    
        $conn->close();
    }
    
    public function showLoginForm() {
        require 'app/views/auth/login.php';
    }
    
    
    
}
