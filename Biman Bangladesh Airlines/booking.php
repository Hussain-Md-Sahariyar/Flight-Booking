<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['flight_no'], $_GET['flying_from'], $_GET['flying_to'], $_GET['departure_date'])) {
    $flight_no = $_GET['flight_no'];
    $flying_from = $_GET['flying_from'];
    $flying_to = $_GET['flying_to'];
    $departure_date = $_GET['departure_date'];

    $stmt = $conn->prepare("SELECT * FROM flights_oneway WHERE flight_no = ? AND flying_from = ? AND flying_to = ? AND departure_date = ?");
    $stmt->bind_param("ssss", $flight_no, $flying_from, $flying_to, $departure_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $flight = $result->fetch_assoc();
    } else {
        die("Flight not found.");
    }
    $stmt->close();
} else {
    die("Flight ID not specified.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['continue'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $date_of_birth = $conn->real_escape_string($_POST['date_of_birth']);
    $passport_no = $conn->real_escape_string($_POST['passport_no']);
    $passport_expiry_date = $conn->real_escape_string($_POST['passport_expiry_date']);
    $country = $conn->real_escape_string($_POST['country']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);

    $query = "INSERT INTO booking_oneway (flight_no, flying_from, flying_to, departure_city_code, arrival_city_code, departure_date, arrival_date, departure_time, arrival_time, departure_terminal, arrival_terminal, class, baggage_type, check_in_baggage, price, base_fare, taxes, title, first_name, last_name, date_of_birth, passport_no, passport_expiry_date, country, email, contact)
          SELECT flight_no, flying_from, flying_to, departure_city_code, arrival_city_code, departure_date, arrival_date, departure_time, arrival_time, departure_terminal, arrival_terminal, class, baggage_type, check_in_baggage, price, base_fare, taxes, ?, ?, ?, ?, ?, ?, ? ,?, ?
          FROM flights_oneway WHERE flight_no = ? AND flying_from = ? AND flying_to = ? AND departure_date = ?;";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssssissss", $title, $first_name, $last_name, $date_of_birth, $passport_no, $passport_expiry_date, $country, $email, $contact, $flight_no, $flying_from, $flying_to, $departure_date);

    if ($stmt->execute()) {
        $booking_id = $conn->insert_id;
        header("Location: bookingCopy.php?booking_id=" . $booking_id);
        exit;
    } else {
        echo "<div class='alert alert-danger'>Booking failed. Please try again.</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Results</title>
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

        .navbar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .nav-text {
            color: white;
            font-weight: bold;
            font-size: 30px;
        }

        .containerbox {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .section-title {
            background-color: rgba(249, 250, 251, 0.8);
            font-weight: bold;
            font-size: 22px;
            color: #880808;
            margin-bottom: 10px;
            display: inline-block;
            padding: 10px;
            border-radius: 8px;
        }

        .card {
            border: none;
            margin-bottom: 20px;
        }

        .card-header, .fare-summary-header {
            background-color: #f9fafb;
            font-weight: bold;
            font-size: 18px;
            color: #355E3B;
            border-bottom: 1px solid #dee2e6;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .card-body {
            font-size: 0.9rem;
        }

        .fare-summary {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            width: 900px;
            height: 400px;
        }

        .fare-summary-header2 {
            font-size: 1.2rem;
            font-weight: bold;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .total-cost {
            background-color: #ffe3e3;
            font-weight: bold;
            padding: 10px;
            border-radius: 8px;
            font-size: 1rem;
        }

        .note-text {
            color: red;
            font-size: 0.85rem;
        }

        .btn-continue {
            background-color: #d22630;
            color: white;
            border: none;
            font-size: 1.1rem;
            width: 100%;
        }

            .btn-continue:hover {
                background-color: #b91d29;
            }

        .form-check-label {
            font-weight: bold;
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
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <span class="nav-text">Review Your Booking</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php if (isset($flight)): ?>
    <div class="containerbox">
        <main class="results">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p style="color: #355E3B; font-size: 18px; font-weight: bold;">Flight Summary</p>
                    </div>

                    <div class="my-3 border">
                        <p class="border-bottom px-3 py-2 fw-bold"><?php echo $flight['flying_from']; ?> to <?php echo $flight['flying_to']; ?>, <?php echo $flight['departure_date']; ?></p>
                        <div class="px-3 fdheading b-border d-flex">
                            <img src="images/bg_logo.png" alt="air-logo" class="img-fluid me-2" style="max-height: 45px; width: 45px; border-radius: 5px;">
                            <div>
                                <p class="mb-0" style="font-size: 16px;"><span class="fw-bold">Biman Bangladesh Airlines </span><?php echo $flight['flight_no']; ?></p>
                                <div>
                                    <p class="fw-bold mb-0" style="font-size: 13px;">Aircraft: <?php echo $flight['aircraft']; ?></p>
                                    <p class="fw-bold mb-0" style="font-size: 13px;">Operated by : BG</p>
                                    <p class="fw-bold mb-0" style="font-size: 13px;"><?php echo $flight['class']; ?></p>
                                    <p class="fw-bold mb-0" style="font-size: 13px;">Available seats: <?php echo $flight['available_seats']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="innerwrwppertab mt-3 mb-3">
                            <div class="flight-content d-flex gap-4 justify-content-between flex-wrap px-3">
                                <div class="depart mb-4 mb-xl-0">
                                    <p class="time mb-2 fw-bold" style="font-size: 14px;"><?php echo $flight['departure_time']; ?></p>
                                    <p class="mb-0 fw-bold" style="font-size: 13px;"><?php echo $flight['departure_date']; ?></p>
                                    <p class="d-time mb-0 fw-bold" style="font-size: 13px;">(<?php echo $flight['departure_city_code']; ?>)</p>
                                    <p class="mb-0 fw-normal paragraph-overflow" style="font-size: 13px;">Terminal: <span><?php echo $flight['departure_terminal']; ?></span> <br> <?php echo $flight['departure_airport']; ?><br><?php echo $flight['departure_city']; ?></p>
                                </div>
                                <div class="non-stop mb-4 mb-xl-0 text-center">
                                    <p class="mb-0 fw-bold" style="font-size: 14px;"><?php echo $flight['duration']; ?></p>
                                    <p class="non-stop-icon mb-2"><img src="images/line.png" alt="shape" class="shape w-auto" style="height: 4px; width: 50px;"></p>

                                </div>
                                <div class="depart mb-4 mb-xl-0">
                                    <p class="d-time mb-2 fw-bold" style="font-size: 14px;"><?php echo $flight['arrival_time']; ?></p>
                                    <p class="mb-0 fw-bold" style="font-size: 13px;"><?php echo $flight['arrival_date']; ?></p>
                                    <p class="d-time mb-0 fw-bold" style="font-size: 13px;">(<?php echo $flight['arrival_city_code']; ?>)</p>
                                    <p class="mb-0 fw-normal paragraph-overflow" style="font-size: 13px;">Terminal: <span><?php echo $flight['arrival_terminal']; ?></span> <br> <?php echo $flight['arrival_airport']; ?><br><?php echo $flight['arrival_city']; ?></p>
                                </div>
                                <div class="depart mb-4 mb-xl-0">
                                    <p class=" d-time mb-2 fw-bold" style="font-size: 13px;">Cabin</p>
                                    <p class="mb-2 fw-normal" style="font-size: 12px;"><?php echo $flight['cabin_baggage']; ?></p>
                                </div>
                                <div class="depart mb-4 mb-xl-0">
                                    <p class=" d-time mb-2 fw-bold" style="font-size: 13px;">Check In</p>
                                    <p class="mb-2 fw-normal" style="font-size: 12px;"><?php echo $flight['check_in_baggage']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-title">Enter Traveler Details</div>
            <div class="card">
                <div class="card-header">
                    Traveler 1 <span class="badge bg-primary ms-2">Adult</span>
                </div>
                <div class="card-body">
                    <form id="travellerForm" method="POST" action="booking.php?flight_no=<?php echo $flight_no; ?>&flying_from=<?php echo $flying_from; ?>&flying_to=<?php echo $flying_to; ?>&departure_date=<?php echo $departure_date; ?>">
                        <!-- Personal Details -->
                        <div class="mb-4">
                            <h5>Personal Details (Adult)</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="passportCheck">
                                <label class="form-check-label" for="passportCheck">As mentioned on your passport or government approved IDs</label>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-2">
                                    <label for="title" class="form-label">Select Title <span class="text-danger">*</span></label>
                                    <select id="title" name="title" class="form-select" required>
                                        <option>Mr</option>
                                        <option>Mrs</option>
                                        <option>Ms</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="passport_no" class="form-label">Passport Number <span class="text-danger">*</span></label>
                                    <input type="text" id="passport_no" name="passport_no" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="passport_expiry_date" class="form-label">Passport Expiry Date <span class="text-danger">*</span></label>
                                    <input type="date" id="passport_expiry_date" name="passport_expiry_date" class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                    <select id="country" name="country" class="form-select" required>
                                        <option selected>Bangladesh</option>
                                    </select>
                                </div>
                                <div class="col-12 note-text">
                                    Note*: Your passport should have at least six months of validity from the date of departure.
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Frequent Flyer</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="airline" class="form-label">Frequent Flyer Airline (If Any)</label>
                                    <input type="text" id="airline" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="flyerNumber" class="form-label">Frequent Flyer Number</label>
                                    <input type="text" id="flyerNumber" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h5>Contact Details</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bookingUpdates">
                                <label class="form-check-label" for="bookingUpdates">Receive booking confirmation & updates</label>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contact" class="form-label">Contact Number <span class="text-danger">*</span></label>
                                    <input type="tel" id="contact" name="contact" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" name="continue" class="btn btn-continue">Continue</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>

        <aside class="card fare-summary">
            <div class="fare-summary-header text-center">
                <img src="images/bg_logo.png" alt="Airline Logo" width="40" class="me-2">
                Biman Bangladesh Airlines
            </div>
            <div class="card-body">
                <div class="fare-summary-header2">Fare Summary</div>
                <div class="d-flex justify-content-between">
                    <span style="font-size: 16px;">Adult (1 traveler)</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Base Fare</span>
                    <span style="font-size: 18px;">BDT <?php echo $flight['base_fare']; ?></span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Taxes + Fees</span>
                    <span style="font-size: 18px;">BDT <?php echo $flight['taxes']; ?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>Sub-total</span>
                    <span style="font-size: 18px;">BDT <?php echo $flight['price']; ?></span>
                </div>
                <div class="total-cost d-flex justify-content-between mt-3">
                    <span style="font-size: 15px;">You Pay</span>
                    <span style="font-size: 20px;">BDT <?php echo $flight['price']; ?></span>
                </div>
            </div>
        </aside>
    </div>

    <div class="footer">
        &copy; 2024 Biman Bangladesh Airlines. All rights reserved.
    </div>

    <script>
        function toggleDetails(id) {
            const extraDetails = document.getElementById(id);
            if (extraDetails.style.display === "none" || extraDetails.style.display === "") {
                extraDetails.style.display = "block";
            } else {
                extraDetails.style.display = "none";
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
    const today = new Date();

    const dobMaxDate = new Date(today.getFullYear() - 12, today.getMonth(), today.getDate());
    document.getElementById("date_of_birth").setAttribute("max", dobMaxDate.toISOString().split("T")[0]);

    const expiryMinDate = new Date(today.getFullYear(), today.getMonth() + 6, today.getDate());
    document.getElementById("passport_expiry_date").setAttribute("min", expiryMinDate.toISOString().split("T")[0]);
});

    </script>
     <script>
        document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("travellerForm");
    form.reset();

    const postalCodeInput = document.getElementById("contact");
    postalCodeInput.addEventListener("input", function (event) {
        this.value = this.value.replace(/[^0-9]/g, "");
    });
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <?php else: ?>
        <p>Flight details not available.</p>
    <?php endif; ?>

</body>
</html>