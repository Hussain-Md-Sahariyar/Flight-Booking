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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get total passengers (total bookings)
$sql_passengers = "SELECT COUNT(*) AS total_passengers FROM booking_oneway";
$result_passengers = $conn->query($sql_passengers);
$row_passengers = $result_passengers->fetch_assoc();
$total_passengers = $row_passengers['total_passengers'];

// Get total revenue (sum of total price in issue_oneway)
$sql_revenue = "SELECT SUM(price) AS total_revenue FROM issue_oneway";
$result_revenue = $conn->query($sql_revenue);
$row_revenue = $result_revenue->fetch_assoc();
$total_revenue = $row_revenue['total_revenue'];

// Get total flights
$sql_flights = "SELECT COUNT(*) AS total_flights FROM flights_oneway";
$result_flights = $conn->query($sql_flights);
$row_flights = $result_flights->fetch_assoc();
$total_flights = $row_flights['total_flights'];

// Get today's flights
// Get today's date in 'Y-m-d' format (e.g., 2024-11-27)
// Set timezone for Dhaka
$dhakaTimezone = new DateTimeZone('Asia/Dhaka');

// Get current UTC time
$utcTime = new DateTime('now', new DateTimeZone('UTC'));

// Convert UTC time to Dhaka time
$utcTime->setTimezone($dhakaTimezone);
$today_date = $utcTime->format('Y-m-d');

// SQL query to fetch flights with today's date
$sql_today_flights = "SELECT * FROM flights_oneway WHERE departure_date = '$today_date'";
$result_today_flights = $conn->query($sql_today_flights);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- Add Font Awesome CDN link here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
            padding-top: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 120vh;
            flex-direction: column;
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

        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 40px;
            gap: 20px;
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            position: relative;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 25%;
        }

            .card:hover {
                transform: translateY(-10px);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            }

            .card .icon {
                font-size: 50px;
                color: #00ffff;
            }

        @keyframes glow {
            0%, 100% {
                text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
            }

            50% {
                text-shadow: 0 0 20px #00ffff, 0 0 40px #00ffff;
            }
        }

        .card h5 {
            margin: 20px 0 10px;
            text-transform: uppercase;
            font-size: 18px;
            letter-spacing: 1px;
        }

        .card h3 {
            font-size: 32px;
            font-weight: bold;
            color: #ffffff;
        }

        .table-container {
            margin: 40px 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .table th, .table td {
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
        }

        .filter-btn {
            background-color: transparent;
            color: #000000;
            border: none;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

            .filter-btn:hover {
                color: #ffffff;
                background-color: transparent;
                border: 1px solid #00ffff;
                box-shadow: 0 0 10px #00ffff;
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


    <!-- Dashboard Cards -->
    <div class="container card-container">
        <div class="card">
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <h5>Total Passengers</h5>
            <h3><?php echo $total_passengers; ?></h3>
        </div>
        <div class="card">
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <h5>Revenue</h5>
            <h3><?php echo '৳ ' . number_format($total_revenue); ?></h3>
        </div>
        <div class="card">
            <div class="icon">
                <i class="fas fa-plane-departure"></i>
            </div>
            <h5>Flights</h5>
            <h3><?php echo $total_flights; ?></h3>
        </div>
    </div>

    <!-- Today's Flights Table -->
    <div class="container table-container">
        <h4 style="font-weight: bold; font-size: 28px; margin-bottom: 20px;">Today's Flights</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Flight No</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Passengers</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result_today_flights->num_rows > 0): ?>
                    <?php while ($row = $result_today_flights->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['flight_no']; ?></td><td>
                                <?php echo $row['flying_from'] . " (" . $row['departure_city_code'] . ")<br>" .
                                    $row['departure_airport'] . "<br>" .
                                    $row['departure_city'] . "<br>Terminal: " . $row['departure_terminal']; ?>
                            </td>
                            <td>
                                <?php echo $row['flying_to'] . " (" . $row['arrival_city_code'] . ")<br>" .
                                    $row['arrival_airport'] . "<br>" .
                                    $row['arrival_city'] . "<br>Terminal: " . $row['arrival_terminal']; ?>
                            </td>
                            <td><?php echo $row['departure_date']; ?><br /><?php echo $row['departure_time']; ?></td>
                            <td><?php echo $row['arrival_date']; ?><br /><?php echo $row['arrival_time']; ?></td>
                            <td><?php echo $row['available_seats']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No flights today.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>