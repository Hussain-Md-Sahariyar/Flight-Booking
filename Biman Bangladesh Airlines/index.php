<?php
require_once 'config/database.php';

$db = Database::connect();

// Load controllers
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/BookingController.php';
require_once 'app/controllers/FlightController.php';
require_once 'app/controllers/AdminFlightController.php';
require_once 'app/controllers/IssueController.php';
require_once 'app/controllers/PaymentController.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/AuthController.php'; // if exists

// Initialize controllers
$adminController = new AdminController($db);
$adminFlightController = new AdminFlightController($db);
$adminFlightController = new AdminFlightController($db);
$issueController = new IssueController($db);
$paymentController = new PaymentController();


// Determine action
$action = $_GET['action'] ?? 'showLogin';

// Route actions
switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController->login();
        }
        break;

    case 'dashboard':
        $adminController->dashboard();
        break;

    case 'logout':
        $adminController->logout();
        break;

    // Booking
    case 'book':
        $bookingController->showForm();
        break;

    case 'submitBooking':
        $bookingController->submitForm();
        break;

    case 'bookingCopy':
        isset($_GET['booking_id'])
            ? $bookingController->showBookingCopy($_GET['booking_id'])
            : print("Booking ID missing.");
        break;

    case 'cancelBooking':
        $bookingController->cancelBooking();
        break;

    case 'issueTicket':
        $issueController->issueTicket(); // avoid double mapping
        break;

    case 'bookingsOverview':
        $bookingController->showBookingsOverview();
        break;

    case 'fetchBookingDetails':
        $bookingController->fetchBookingDetails();
        break;

    case 'deleteBooking':
        $bookingController->deleteBooking();
        break;

    // Flights
    case 'searchFlights':
        $flightController->search();
        break;

    case 'flightSchedule':
        $flightController->showSchedule();
        break;

    case 'getFlightDetails':
        $flightController->getFlightDetails();
        break;

    // Admin Flight Management
    case 'flightManagement':
        $adminFlightController->index();
        break;

    case 'addOrUpdateFlight':
        $adminFlightController->addOrUpdateFlight();
        break;

    case 'deleteFlight':
        $adminFlightController->deleteFlight();
        break;

    // Payment
    case 'payment':
        $paymentController->showBkashForm();
        break;

    case 'pinVerify':
        $paymentController->pinVerify();
        break;

    case 'pin':
        $paymentController->showPinScreen();
        break;

    // Auth (Signup/Login)
    case 'signup':
        $authController->showSignupForm();
        break;

    case 'registerUser':
        $authController->registerUser();
        break;

    case 'checkEmail':
        $authController->checkEmailExists();
        break;

    case 'checkCredentials':
        $authController->verifyCredentials();
        break;

    // User
    case 'deleteUser':
        $userController->deleteUser();
        break;

    default:
        http_response_code(404);
        echo "404 - Page not found.";
}
