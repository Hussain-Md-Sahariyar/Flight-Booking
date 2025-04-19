<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the keys exist in the POST array before accessing them
    $flying_from = isset($_POST['flying_from']) ? $conn->real_escape_string($_POST['flying_from']) : '';
    $flying_to = isset($_POST['flying_to']) ? $conn->real_escape_string($_POST['flying_to']) : '';
    $departure_date = isset($_POST['departure_date']) ? $conn->real_escape_string($_POST['departure_date']) : '';
    $class = isset($_POST['class']) ? $conn->real_escape_string($_POST['class']) : '';
    //echo "Flying from: $flying_from, Flying to: $flying_to, Class: $class";
    if (empty($flying_from) || empty($flying_to) || empty($class)) {
        echo "Please fill in all fields.";
        exit;
    }
    // Prepare SQL query with placeholders
    $query = "SELECT * FROM flights_oneway WHERE flying_from = ? AND flying_to = ? AND departure_date = ? AND class = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("ssss", $flying_from, $flying_to, $departure_date, $class);
        // Execute the query
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();
        // Close statement
        $stmt->close();
    } else {
        // Error preparing statement
        echo "Error preparing statement: " . $conn->error;
    }
}
// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Results</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
       
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .container-fluid {
            padding: 0;
        }

        .navbar {
            background-color: #C1E1C1;
            padding: 15px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }


        .nav-link {
            color: black;
            font-weight: bold;
            margin-right: 15px;
            font-size: 30px;
        }

        .containerbox {
            display: flex;
            gap: 20px;
            padding: 20px;
        }


        .filters {
            width: 20%;
            height: 100%;
            background-color: #D3D3D3;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

            .filters h5 {
                margin-bottom: 10px;
                color: #333;
            }

        .results {
            width: 80%;
        }

        .flight-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            padding: 15px;
            display: flex;
            flex-direction: column; 
            justify-content: space-between; 
        }

        .flight-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .airline img {
            width: 50px;
            margin-right: 0px;
        }

        .flight-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 2px;
            flex: 1;
        }

            .flight-info h4 {
                margin: 0;
                font-weight: bold;
                font-size: 16px;
                color: #097969;
            }

            .flight-info p {
                margin: 0;
                font-weight: bold;
                font-size: 14px;
                color: #023020;
            }

        .flight-times {
            display: flex;
            align-items: center;
            text-align: center;
            flex: 2;
            color: #333;
            gap: 20px;
        }

        .flight-time {
            font-weight: bold; 
            font-size: 17px; 
            color: #000080;
        }

        .location {
            font-weight: bold;
            font-size: 14px; 
            color: #770737;
        }

        .date {
            font-weight: bold; 
            font-size: 12px; 
            color: #097969;
        }

        .flight-time-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .flight-pricing {
            text-align: center;
            margin-top: auto;
        }

        .price {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .book-button {
            background-color: #008080;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

            .book-button:hover {
                background-color: #097969;
            }

        .flight-details {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            font-weight: bold;
            font-size: 12px;
            color: #555;
            margin-top: 10px; 
            border-top: 1px solid #e0e0e0; 
            padding-top: 10px; 
        }

        .tag {
            background-color: #f0f0f0;
            color: #333;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
        }

        .extra-details {
            display: none; 
        }

        .toggle-dropdown {
            cursor: pointer;
            color: #007bff; 
            text-decoration: underline; 
            margin-top: 2px;
            text-align: right; 
            flex: 1;
        }

        .footer {
            background-color: #004c99;
            color: white;
            text-align: center;
            padding: 2px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Biman Bangladesh Airlines" width="300">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <span class="nav-link">Available Flights</span>
                    </li>
                </ul>
            </div>

        </div>
    </nav>


    <div class="containerbox">
        <!-- Filter Section -->
       <aside class="filters">
            <h5>Stops from Dhaka</h5>
            <label><input type="checkbox"> Non Stop</label><br>
            <label><input type="checkbox"> One Stop</label><br><br><br>

            <h5>Cabin Type</h5>
            <label><input type="checkbox"> Economy</label><br>
            <label><input type="checkbox"> Business</label><br>
            <label><input type="checkbox"> First Class</label><br><br><br>

            <h5>Refundable</h5>
            <label><input type="checkbox"> Partially Refundable</label><br>
            <label><input type="checkbox"> Non Refundable</label><br><br>
        </aside>

        <!-- Flight Results Section -->
        <main class="results">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($result) && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                    $departure_day = date('D', strtotime($row['departure_date']));
                    $arrival_day = date('D', strtotime($row['arrival_date']));
                    $detailsId = "extraDetails_" . $row['flight_no']; // Unique ID for each flight
                    ?>
            <!-- Single Flight Result Card -->
            <div class="flight-card">
                <div class="flight-header">
                    <div class="airline">
                        <img src="images/bg_logo.png" alt="Biman Bangladesh Airlines">
                    </div>
                    <div class="flight-info">
                        <p>Biman Bangladesh Airlines</p>
                        <h4><?= $row['flight_no'] ?></h4>
                    </div>
                    <div class="flight-times">
                        <div class="flight-time-section">
                            <span class="flight-time"><?= $row['departure_city_code'] ?> - <?= $row['departure_time'] ?></span>
                            <span class="location"><?= $row['departure_city'] ?></span>
                            <span class="date"><?= $row['departure_date'] ?></span>
                        </div>
                        <img src="images/flight_icon.png" alt="Flight Icon" width="20" height="19">
                        <div class="flight-time-section">
                            <span class="flight-time"><?= $row['arrival_city_code'] ?> - <?= $row['arrival_time'] ?></span>
                            <span class="location"><?= $row['arrival_city'] ?></span>
                            <span class="date"><?= $row['arrival_date'] ?></span>
                        </div>
                    </div>
                    <div class="flight-pricing">
                        <p class="price">BDT <?= $row['price'] ?></p>
                        <a href="booking.php?flight_no=<?php echo urlencode($row['flight_no']); ?>&flying_from=<?php echo urlencode($row['flying_from']); ?>&flying_to=<?php echo urlencode($row['flying_to']); ?>&departure_date=<?php echo urlencode($row['departure_date']); ?>&class=<?php echo urlencode($row['class']); ?>" class="book-button" style="text-decoration: none;">BOOK NOW</a>

                    </div>
                </div>

                <!-- New row for flight details -->
                <div class="flight-details">
                    <span class="tag">One Way</span>
                    <span class="tag">Economy</span>
                    <span class="tag">Non Refundable</span>
                    <span class="toggle-dropdown" onclick="toggleDetails('<?= $detailsId ?>')">Flight Details ▼</span> <!-- Toggle for dropdown -->
                </div>
                <div class="extra-details" id="<?= $detailsId ?>">
                    <!-- Extra details section -->
                    <div class="my-3 border">
                        <p class="border-bottom px-3 py-2 fw-bold"><?= $row['flying_from'] ?> to <?= $row['flying_to'] ?>, <?= $row['departure_date'] ?></p>
                        <div class="px-3 fdheading b-border d-flex">
                            <img src="images/bg_logo.png" alt="air-logo" class="img-fluid me-2" style="max-height: 45px; width: 45px; border-radius: 5px;">
                            <div>
                                <p class="mb-0" style="font-size: 16px;"><span class="fw-bold">Biman Bangladesh Airlines </span><?= $row['flight_no'] ?></p>
                                <div>
                                    <p class="fw-bold mb-0" style="font-size: 13px;">Aircraft: <?= $row['aircraft'] ?></p>
                                    <p class="fw-bold mb-0" style="font-size: 13px;">Operated by : BG</p>
                                    <p class="fw-bold mb-0" style="font-size: 13px;"><?= $row['class'] ?></p>
                                    <p class="fw-bold mb-0" style="font-size: 13px;">Available seats: <?= $row['available_seats'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="innerwrwppertab mt-3 mb-3">
                            <div class="flight-content d-flex gap-4 justify-content-between flex-wrap px-3">
                                <div class="depart mb-4 mb-xl-0">
                                    <p class="d-time mb-2 fw-bold" style="font-size: 14px;"><?= $row['departure_time'] ?></p>
                                    <p class="mb-0 fw-bold" style="font-size: 13px;"><?= $row['departure_date'] ?></p>
                                    <p class="d-time mb-0 fw-bold" style="font-size: 13px;">(<?= $row['departure_city_code'] ?>)</p>
                                    <p class="mb-0 fw-normal paragraph-overflow" style="font-size: 13px;">Terminal: <span><?= $row['departure_terminal'] ?></span> <br> <?= $row['departure_airport'] ?><br><?= $row['departure_city'] ?></p>
                                </div>
                                <div class="non-stop mb-4 mb-xl-0 text-center">
                                    <p class="mb-0 fw-bold" style="font-size: 14px;"><?= $row['duration'] ?></p>
                                    <p class="non-stop-icon mb-2"><img src="images/line.png" alt="shape" class="shape w-auto" style="height: 4px; width: 50px;"></p>

                                </div>
                                <div class="depart mb-4 mb-xl-0">
                                    <p class="d-time mb-2 fw-bold" style="font-size: 14px;"><?= $row['arrival_time'] ?></p>
                                    <p class="mb-0 fw-bold" style="font-size: 13px;"><?= $row['arrival_date'] ?></p>
                                    <p class="d-time mb-0 fw-bold" style="font-size: 13px;">(<?= $row['arrival_city_code'] ?>)</p>
                                    <p class="mb-0 fw-normal paragraph-overflow" style="font-size: 13px;">Terminal: <span><?= $row['arrival_terminal'] ?></span> <br> <?= $row['arrival_airport'] ?><br><?= $row['arrival_city'] ?></p>
                                </div>
                                <div class="depart mb-4 mb-xl-0">
                                    <p class=" d-time mb-2 fw-bold" style="font-size: 13px;">Baggage</p>
                                    <p class="mb-2 fw-normal" style="font-size: 12px;"><?= $row['baggage_type'] ?></p>
                                </div>
                                <div class="depart mb-4 mb-xl-0">
                                    <p class=" d-time mb-2 fw-bold" style="font-size: 13px;">Cabin</p>
                                    <p class="mb-2 fw-normal" style="font-size: 12px;"><?= $row['cabin_baggage'] ?></p>
                                </div>
                                <div class="depart mb-4 mb-xl-0">
                                    <p class=" d-time mb-2 fw-bold" style="font-size: 13px;">Check In</p>
                                    <p class="mb-2 fw-normal" style="font-size: 12px;"><?= $row['check_in_baggage'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
                <p style="color: white; font-weight: bold; text-align: center; font-size: 24px; margin: 20px;">
    No flights found with the selected criteria.
</p>

            <?php endif; ?>

        </main>
    </div>

    <div class="footer">
        &copy; 2024 Biman Bangladesh Airlines. All rights reserved.
    </div>

    <script>
        // JavaScript function to toggle extra details
        function toggleDetails(detailsId) {
            var element = document.getElementById(detailsId);
            if (element.style.display === "none" || element.style.display === "") {
                element.style.display = "block";
            } else {
                element.style.display = "none";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>