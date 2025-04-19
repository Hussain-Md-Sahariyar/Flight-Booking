<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch flight data
$sql = "SELECT * FROM flights_oneway";
$result = $conn->query($sql);

// Handle form submission for adding or updating a flight
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flight_no = $_POST['flight_no'];
    $flying_from = $_POST['flying_from'];
    $flying_to = $_POST['flying_to'];
    $departure_city_code = $_POST['departure_city_code'];
    $arrival_city_code = $_POST['arrival_city_code'];
    $departure_city = $_POST['departure_city'];
    $arrival_city = $_POST['arrival_city'];
    $departure_airport = $_POST['departure_airport'];
    $arrival_airport = $_POST['arrival_airport'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $departure_terminal = $_POST['departure_terminal'];
    $arrival_terminal = $_POST['arrival_terminal'];
    $duration = $_POST['duration'];
    $class = $_POST['class'];
    $refundable = $_POST['refundable'];
    $aircraft = $_POST['aircraft'];
    $available_seats = $_POST['available_seats'];
    $baggage_type = $_POST['baggage_type'];
    $cabin_baggage = $_POST['cabin_baggage'];
    $check_in_baggage = $_POST['check_in_baggage'];
    $price = $_POST['price'];
    $base_fare = $_POST['base_fare'];
    $taxes = $_POST['taxes'];

    // Check if the flight already exists
    $check_sql = "SELECT * FROM flights_oneway WHERE flight_no = ? AND departure_date = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $flight_no, $departure_date);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Flight exists, perform update
        $sql = "UPDATE flights_oneway SET 
                    flying_from = ?, flying_to = ?, departure_city_code = ?, arrival_city_code = ?, departure_city = ?, arrival_city = ?, 
                    departure_airport = ?, arrival_airport = ?, arrival_date = ?, departure_time = ?, arrival_time = ?, 
                    departure_terminal = ?, arrival_terminal = ?, duration = ?, class = ?, refundable = ?, aircraft = ?, 
                    available_seats = ?, baggage_type = ?, cabin_baggage = ?, check_in_baggage = ?, price = ?, base_fare = ?, taxes = ?
                WHERE flight_no = ? AND departure_date = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssssssisssiiiss",
            $flying_from,
            $flying_to,
            $departure_city_code,
            $arrival_city_code,
            $departure_city,
            $arrival_city,
            $departure_airport,
            $arrival_airport,
            $arrival_date,
            $departure_time,
            $arrival_time,
            $departure_terminal,
            $arrival_terminal,
            $duration,
            $class,
            $refundable,
            $aircraft,
            $available_seats,
            $baggage_type,
            $cabin_baggage,
            $check_in_baggage,
            $price,
            $base_fare,
            $taxes,
            $flight_no,
            $departure_date
        );

        if ($stmt->execute()) {
            echo "<script>alert('Flight updated successfully!'); window.location.href='flightManagement.php';</script>";
        } else {
            echo "<script>alert('Error updating flight: " . $stmt->error . "');</script>";
        }
    } else {
        // Flight does not exist, perform insert
        $sql = "INSERT INTO flights_oneway (
                    flight_no, flying_from, flying_to, departure_city_code, arrival_city_code, departure_city, arrival_city, 
                    departure_airport, arrival_airport, departure_date, arrival_date, departure_time, arrival_time, 
                    departure_terminal, arrival_terminal, duration, class, refundable, aircraft, available_seats, 
                    baggage_type, cabin_baggage, check_in_baggage, price, base_fare, taxes
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssssssssssssisssiii",
            $flight_no,
            $flying_from,
            $flying_to,
            $departure_city_code,
            $arrival_city_code,
            $departure_city,
            $arrival_city,
            $departure_airport,
            $arrival_airport,
            $departure_date,
            $arrival_date,
            $departure_time,
            $arrival_time,
            $departure_terminal,
            $arrival_terminal,
            $duration,
            $class,
            $refundable,
            $aircraft,
            $available_seats,
            $baggage_type,
            $cabin_baggage,
            $check_in_baggage,
            $price,
            $base_fare,
            $taxes
        );

        if ($stmt->execute()) {
            echo "<script>alert('Flight added successfully!'); window.location.href='flightManagement.php';</script>";
        } else {
            echo "<script>alert('Error adding flight: " . $stmt->error . "');</script>";
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Add Font Awesome CDN link here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #301934, #770737, #953553);
            background-size: 400% 400%;
            animation: gradientBackground 5s ease infinite;
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden;
            padding-top: 60px; 
        }

        @keyframes gradientBackground {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 10px 0; 
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            position: relative; 
            overflow: hidden; 
            padding: 5px 10px;
        }

        .navbar-brand {
            font-size: 25px;
            pointer-events: auto; 
            text-decoration: none; 
            margin-left: 10px; 
        }

        .navbar-nav .nav-link:hover {
            color: #00ffff;
            text-shadow: 0 0 5px #00ffff;
        }

      
        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00ffff, transparent);
            transition: left 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
            transition: left 0.3s ease-in-out;
        }


        .logout-btn {
            color: #00ffff;
            border: 1px solid #00ffff;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-right: 20px; 
        }

            .logout-btn:hover {
                background-color: #00ffff;
                color: #333;
                box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
            }

        .container.table-container {
            margin-top: 50px;
            margin-bottom: 50px; 
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 1300px;
            width: 100%;
            overflow-x: auto;
        }

        .table th, .table td {
            color: #ffffff;
            text-align: center;
            font-size: 14px;
            vertical-align: middle; 
        }

        .filter-btn {
            background-color: transparent;
            color: #000000;
            border: none;
            font-size: 18px; 
            padding: 4px; 
            line-height: 1; 
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block; 
            width: 28px; 
            height: 28px; 
            text-align: center; 
        }

            .filter-btn:hover {
                color: #ffffff;
                background-color: transparent;
                border: 1px solid #00ffff;
                box-shadow: 0 0 10px #00ffff;
            }

        .btn-add-option {
            background: linear-gradient(135deg, #28a745, #1d8240); 
            color: #ffffff;
            font-weight: bold;
            border: none;
            border-radius: 5px; 
            padding: 10px 20px;
            font-size: 16px; 
            transition: all 0.4s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px; 
            text-transform: uppercase; 
            letter-spacing: 1px; 
            box-shadow: 0 0 15px rgba(40, 167, 69, 0.5); 
            cursor: pointer;
        }

            .btn-add-option:hover {
                background: linear-gradient(135deg, #34c759, #28a745); 
                box-shadow: 0 0 20px rgba(52, 199, 89, 0.8), 0 0 30px rgba(52, 199, 89, 0.5); 
                transform: translateY(-2px) scale(1.05); 
                color: #ffffff;
            }

            .btn-add-option i {
                font-size: 18px; 
                transition: transform 0.3s ease;
            }

            .btn-add-option:hover i {
                transform: rotate(360deg); 
            }


    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
               
                <li class="nav-item mx-2">
                    <a class="nav-link" href="flightManagement.php">Flights</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="passengerManagement.php">Passengers</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="bookingsOverview.php">Bookings</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="settings.php">Settings</a>
                </li>
            </ul>
            <a class="btn logout-btn ml-3" href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- Today's Flights Table -->
    <div class="container table-container">
        <div class="d-flex flex-column align-items-center mb-4 position-relative">
    <h4 style="font-weight: bold; font-size: 28px; margin-bottom: 0; text-align: center;">Flight Information</h4>
    <button class="btn btn-add-option position-absolute" style="right: 0;">
        <i class="fas fa-plus"></i> Add
    </button>
</div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Flight No</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Duration</th>
                    <th>Aircraft</th>
                    <th>Seats</th>
                    <th>Base Fare</th>
                    <th>Tax</th>
                    <th style="width:85px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['flight_no']; ?></td>
                            <td>
                                <?php echo $row['flying_from'] . " (" . $row['departure_city_code'] . ")<br>" .
                                    $row['departure_airport'] . ",<br>" .
                                    $row['departure_city'] . "<br>Terminal: " . $row['departure_terminal']; ?>
                            </td>
                            <td>
                                <?php echo $row['flying_to'] . " (" . $row['arrival_city_code'] . ")<br>" .
                                    $row['arrival_airport'] . ",<br>" .
                                    $row['arrival_city'] . "<br>Terminal: " . $row['arrival_terminal']; ?>
                            </td>
                            <td>
                                <?php echo $row['departure_date'] . "<br>" . $row['departure_time']; ?>
                            </td>
                            <td>
                                <?php echo $row['arrival_date'] . "<br>" . $row['arrival_time']; ?>
                            </td>
                            <td><?php echo $row['duration']; ?></td>
                            <td><?php echo $row['aircraft']; ?></td>
                            <td><?php echo $row['available_seats']; ?></td>
                            <td><?php echo number_format($row['base_fare']); ?>/-</td>
                            <td><?php echo number_format($row['taxes']); ?>/-</td>
                            <td>
                                <button class="btn filter-btn edit-btn" data-flightno="<?php echo $row['flight_no']; ?>" data-departure="<?php echo $row['departure_date']; ?>">
    <i class="fas fa-edit"></i>
</button>

                                <button class="btn filter-btn delete-btn" data-id="<?php echo $row['flight_no']; ?>" data-departure="<?php echo $row['departure_date']; ?>">
    <i class="fas fa-trash"></i>
</button>


                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11">No flights found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Flight Modal -->
<div class="modal fade" id="addFlightModal" tabindex="-1" role="dialog" aria-labelledby="addFlightModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white d-flex justify-content-center">
    <h5 class="modal-title font-weight-bold" id="addFlightModalLabel">Add Flight Details</h5>
    <button type="button" class="close text-white position-absolute" style="right: 1rem;" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


            <form method="POST" style="font-family: Poppins, sans-serif; font-size: 14px; color: black;">
                <div class="modal-body" style="background-color: #f8f9fa;">
                    <div class="container">
                        <div class="form-row">
                            <!-- Flight Information -->
                            <div class="form-group col-md-4">
                                <label for="flight_no">Flight Number</label>
                                <input type="text" class="form-control" id="flight_no" name="flight_no" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="flying_from">Flying From</label>
                                <input type="text" class="form-control" id="flying_from" name="flying_from" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="flying_to">Flying To</label>
                                <input type="text" class="form-control" id="flying_to" name="flying_to" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="departure_city_code">Departure City Code</label>
                                <input type="text" class="form-control" id="departure_city_code" name="departure_city_code" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="arrival_city_code">Arrival City Code</label>
                                <input type="text" class="form-control" id="arrival_city_code" name="arrival_city_code" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="departure_city">Departure City</label>
                                <input type="text" class="form-control" id="departure_city" name="departure_city" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="arrival_city">Arrival City</label>
                                <input type="text" class="form-control" id="arrival_city" name="arrival_city" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="departure_airport">Departure Airport</label>
                                <input type="text" class="form-control" id="departure_airport" name="departure_airport" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="arrival_airport">Arrival Airport</label>
                                <input type="text" class="form-control" id="arrival_airport" name="arrival_airport" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="departure_date">Departure Date</label>
                                <input type="date" class="form-control" id="departure_date" name="departure_date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="arrival_date">Arrival Date</label>
                                <input type="date" class="form-control" id="arrival_date" name="arrival_date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="departure_time">Departure Time</label>
                                <input type="time" class="form-control" id="departure_time" name="departure_time" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="arrival_time">Arrival Time</label>
                                <input type="time" class="form-control" id="arrival_time" name="arrival_time" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="departure_terminal">Departure Terminal</label>
                                <input type="text" class="form-control" id="departure_terminal" name="departure_terminal">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="arrival_terminal">Arrival Terminal</label>
                                <input type="text" class="form-control" id="arrival_terminal" name="arrival_terminal">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="duration">Duration</label>
                                <input type="text" class="form-control" id="duration" name="duration" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="class">Class</label>
                                <input type="text" class="form-control" id="class" name="class" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="refundable">Refundable</label>
                                <input type="text" class="form-control" id="refundable" name="refundable" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="aircraft">Aircraft</label>
                                <input type="text" class="form-control" id="aircraft" name="aircraft" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="available_seats">Available Seats</label>
                                <input type="number" class="form-control" id="available_seats" name="available_seats" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="baggage_type">Baggage Type</label>
                                <input type="text" class="form-control" id="baggage_type" name="baggage_type">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cabin_baggage">Cabin Baggage</label>
                                <input type="text" class="form-control" id="cabin_baggage" name="cabin_baggage">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="check_in_baggage">Check-in Baggage</label>
                                <input type="text" class="form-control" id="check_in_baggage" name="check_in_baggage">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="price">Price</label>
                                <input type="text" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="base_fare">Base Fare</label>
                                <input type="text" class="form-control" id="base_fare" name="base_fare">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="taxes">Taxes</label>
                                <input type="text" class="form-control" id="taxes" name="taxes">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #e9ecef;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Flight</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Edit Flight Modal -->
<div class="modal fade" id="editFlightModal" tabindex="-1" role="dialog" aria-labelledby="editFlightModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white d-flex justify-content-center">
                <h5 class="modal-title font-weight-bold" id="editFlightModalLabel">Edit Flight Details</h5>
                <button type="button" class="close text-white position-absolute" style="right: 1rem;" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="editFlightForm" style="font-family: Poppins, sans-serif; font-size: 14px; color: black;">
                <div class="modal-body" style="background-color: #f8f9fa;">
                    <div class="container">
                        <div class="form-row">
                            <input type="hidden" id="edit_flight_no" name="flight_no">
                            <div class="form-group col-md-4">
                                <label for="edit_flying_from">Flying From</label>
                                <input type="text" class="form-control" id="edit_flying_from" name="flying_from" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_flying_to">Flying To</label>
                                <input type="text" class="form-control" id="edit_flying_to" name="flying_to" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_departure_city_code">Departure City Code</label>
                                <input type="text" class="form-control" id="edit_departure_city_code" name="departure_city_code" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_arrival_city_code">Arrival City Code</label>
                                <input type="text" class="form-control" id="edit_arrival_city_code" name="arrival_city_code" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_departure_city">Departure City</label>
                                <input type="text" class="form-control" id="edit_departure_city" name="departure_city" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_arrival_city">Arrival City</label>
                                <input type="text" class="form-control" id="edit_arrival_city" name="arrival_city" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_departure_airport">Departure Airport</label>
                                <input type="text" class="form-control" id="edit_departure_airport" name="departure_airport" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_arrival_airport">Arrival Airport</label>
                                <input type="text" class="form-control" id="edit_arrival_airport" name="arrival_airport" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_departure_date">Departure Date</label>
                                <input type="date" class="form-control" id="edit_departure_date" name="departure_date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_arrival_date">Arrival Date</label>
                                <input type="date" class="form-control" id="edit_arrival_date" name="arrival_date" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_departure_time">Departure Time</label>
                                <input type="time" class="form-control" id="edit_departure_time" name="departure_time" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_arrival_time">Arrival Time</label>
                                <input type="time" class="form-control" id="edit_arrival_time" name="arrival_time" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_departure_terminal">Departure Terminal</label>
                                <input type="text" class="form-control" id="edit_departure_terminal" name="departure_terminal">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_arrival_terminal">Arrival Terminal</label>
                                <input type="text" class="form-control" id="edit_arrival_terminal" name="arrival_terminal">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_duration">Duration</label>
                                <input type="text" class="form-control" id="edit_duration" name="duration" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_class">Class</label>
                                <input type="text" class="form-control" id="edit_class" name="class" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_refundable">Refundable</label>
                                <input type="text" class="form-control" id="edit_refundable" name="refundable" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_aircraft">Aircraft</label>
                                <input type="text" class="form-control" id="edit_aircraft" name="aircraft" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_available_seats">Available Seats</label>
                                <input type="number" class="form-control" id="edit_available_seats" name="available_seats" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_baggage_type">Baggage Type</label>
                                <input type="text" class="form-control" id="edit_baggage_type" name="baggage_type">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_cabin_baggage">Cabin Baggage</label>
                                <input type="text" class="form-control" id="edit_cabin_baggage" name="cabin_baggage">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_check_in_baggage">Check-in Baggage</label>
                                <input type="text" class="form-control" id="edit_check_in_baggage" name="check_in_baggage">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="edit_price">Price</label>
                                <input type="text" class="form-control" id="edit_price" name="price" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_base_fare">Base Fare</label>
                                <input type="text" class="form-control" id="edit_base_fare" name="base_fare">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="edit_taxes">Taxes</label>
                                <input type="text" class="form-control" id="edit_taxes" name="taxes">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #e9ecef;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const flightNo = this.getAttribute('data-id');
            const departureDate = this.getAttribute('data-departure');

            if (confirm(`Are you sure you want to delete the flight ${flightNo} on ${departureDate}?`)) {
                fetch('deleteFlight.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ flight_no: flightNo, departure_date: departureDate })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Flight deleted successfully.');
                        // Remove the row from the table
                        this.closest('tr').remove();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the flight.');
                });
            }
        });
    });
});
</script>
    <!-- Script for Modal -->
<script>
    document.querySelector('.btn-add-option').addEventListener('click', function () {
        $('#addFlightModal').modal('show');
    });
</script>
    <script>
        $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var flightNo = $(this).data('flightno');
        var departureDate = $(this).data('departure');

        // Fetch flight details via AJAX
        $.ajax({
            url: 'get_flight_details.php',
            type: 'POST',
            data: { flight_no: flightNo, departure_date: departureDate },
            success: function(response) {
                var flight = JSON.parse(response);

                // Populate the form fields in the modal
                $('#edit_flight_no').val(flight.flight_no);
                $('#edit_flying_from').val(flight.flying_from);
                $('#edit_flying_to').val(flight.flying_to);
                $('#edit_departure_city_code').val(flight.departure_city_code);
                $('#edit_arrival_city_code').val(flight.arrival_city_code);
                $('#edit_departure_city').val(flight.departure_city);
                $('#edit_arrival_city').val(flight.arrival_city);
                $('#edit_departure_airport').val(flight.departure_airport);
                $('#edit_arrival_airport').val(flight.arrival_airport);
                $('#edit_departure_date').val(flight.departure_date);
                $('#edit_arrival_date').val(flight.arrival_date);
                $('#edit_departure_time').val(flight.departure_time);
                $('#edit_arrival_time').val(flight.arrival_time);
                $('#edit_departure_terminal').val(flight.departure_terminal);
                $('#edit_arrival_terminal').val(flight.arrival_terminal);
                $('#edit_duration').val(flight.duration);
                $('#edit_class').val(flight.class);
                $('#edit_refundable').val(flight.refundable);
                $('#edit_aircraft').val(flight.aircraft);
                $('#edit_available_seats').val(flight.available_seats);
                $('#edit_baggage_type').val(flight.baggage_type);
                $('#edit_cabin_baggage').val(flight.cabin_baggage);
                $('#edit_check_in_baggage').val(flight.check_in_baggage);
                $('#edit_price').val(flight.price);
                $('#edit_base_fare').val(flight.base_fare);
                $('#edit_taxes').val(flight.taxes);

                // Show the modal
                $('#editFlightModal').modal('show');
            }
        });
    });
});

    </script>
</body>
</html>