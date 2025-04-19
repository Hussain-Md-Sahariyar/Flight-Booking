<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home - Biman Bangladesh Airlines</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
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
            background-color: transparent;
            padding: 15px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }

        .nav-link {
            color: white;
            font-weight: bold;
            margin-right: 20px;
        }

            .nav-link:hover {
                color: white;
            }

       
        .navbar-light .navbar-nav .nav-link {
            color: white; 
        }

            .navbar-light .navbar-nav .nav-link:hover {
                color: #097969; 
            }

        .d-flex {
            align-items: center; 
        }

        .booking-form {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 1200px;
            margin: 0px auto;
        }

        .btn-custom {
            background-color: #097969;
            color: white;
            transition: background-color 0.3s, color 0.3s;
            width: 100%;
        }

            .btn-custom:hover {
                background-color: #05a082;
                color: #ffffff;
            }

      
        .flight-type-container {
            display: flex; 
            gap: 7px; 
            justify-content: left; 
            margin-bottom: 20px; 
        }

        .btn-flight-type {
            width: 120px;
            border: 2px solid #097969;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }

            .btn-flight-type.active {
                background-color: white;
                color: #097969;
                border: 2px solid #097969;
            }

            .btn-flight-type.inactive {
                background-color: #097969;
                color: white;
            }

       
        .transparent-input {
            background-color: rgba(255, 255, 255, 0.5);
            pointer-events: none;
        }

       
        .form-label {
            font-weight: bold;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

            .form-group label {
                margin-bottom: 5px;
            }

        .form-control {
            border-radius: 5px;
            border-width: 2px;
            border-style: solid;
            border-color: #097969;
            transition: border-color 0.3s;
            width: 100%;
        }

            .form-control:focus {
                border-color: #05a082;
                box-shadow: 0 0 5px rgba(5, 160, 130, 0.5);
            }

        .search-button-container button {
            width: 100%;
            height: 40px;
            border-radius: 5px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-button-container-manage button {
            width: 100%;
            height: 40px;
            border-radius: 5px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-button-container-checkin button {
            width: 100%;
            height: 40px;
            border-radius: 5px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
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

      
        .options-bar {
            display: flex;
            justify-content: space-around;
            margin-top: 190px;
            padding: 10px;
        }

        .option {
            color: #097969;
            padding: 10px 70px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            border: 2px solid #097969;
            transition: background-color 0.3s ease;
        }

            .option.active {
                background-color: white;
                color: #097969;
            }

            .option:not(.active) {
                background-color: #097969;
                color: white;
            }

            .option:hover {
                background-color: #05a082;
                color: white;
            }

       
        .manage-booking-text {
            background-color: #004c99;
            color: white;
            padding: 13px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

      
        .manage-booking-inputs {
            display: flex;
            gap: 10px;
        }

            .manage-booking-inputs .form-group {
                flex: 1;
            }

        .search-button-container-manage {
            margin-top: 0px;
        }

      
        .web-checkin-text {
            background-color: #004c99; 
            color: white;
            padding: 13px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

      
        .web-checkin-inputs {
            display: flex;
            gap: 10px;
        }

            .web-checkin-inputs .form-group {
                flex: 1;
            }

      
        .search-button-container-checkin {
            margin-top: 0px;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-item:hover {
            background-color: #343a40; 
            color: white; 
        }

    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Biman Bangladesh Airlines" width="300" />
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="destination.php">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="termsCondition.php">Terms & Conditions</a>
                    </li>
                </ul>
                <!-- Profile Dropdown -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <img src="images/profile.png" alt="Profile" class="rounded-circle" width="40" height="40" />
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="user.php">My Profile</a><!-- Link to Profile -->
                            <a class="dropdown-item" href="login.php">Log Out</a><!-- Log Out Link -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Options Bar -->
    <div class="container options-bar">
        <div class="option active" onclick="setActive(this)">BOOK A FLIGHT</div>
        <div class="option" onclick="setActive(this)">MANAGE BOOKING</div>
        <div class="option" onclick="setActive(this)">WEB CHECK IN</div>
        <div class="option" onclick="window.location.href='flightSchedule.php'">FLIGHT SCHEDULE</div>
    </div>

    <!-- Booking Form -->
    <div class="container">
        <div class="booking-form text-center" id="bookingForm">
            <form id="flightForm" action="flights.php" method="POST">
                <div class="flight-type-container">
                    <!-- Added flex container for buttons -->
                    <button type="button" class="btn btn-flight-type active" id="oneWayBtn" onclick="setFlightType('oneWay')">One Way</button>
                    <button type="button" class="btn btn-flight-type inactive" id="roundTripBtn" onclick="setFlightType('roundTrip')">Round Trip</button>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="from" class="form-label">Flying From</label>
                        <select class="form-control" id="from" name="flying_from">
                            <option value="">Select Origin</option>
                            <option value="Abu Dhabi">Abu Dhabi</option>
                            <option value="Bangkok">Bangkok</option>
                            <option value="Dammam">Dammam</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Doha">Doha</option>
                            <option value="Dubai">Dubai</option>
                            <option value="Guangzhou">Guangzhou</option>
                            <option value="Jeddah">Jeddah</option>
                            <option value="Kathmandu">Kathmandu</option>
                            <option value="Riyadh">Riyadh</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="London">London</option>
                            <option value="Madinah">Madinah</option>
                            <option value="Manchester">Manchester</option>
                            <option value="Muscat">Muscat</option>
                            <option value="Rome">Rome</option>
                            <option value="Sharjah">Sharjah</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Tokyo">Tokyo</option>
                            <option value="Toronto">Toronto</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="to" class="form-label">Flying To</label>
                        <select class="form-control" id="to" name="flying_to">
                            <option value="">Select Destination</option>
                            <option value="Abu Dhabi">Abu Dhabi</option>
                            <option value="Bangkok">Bangkok</option>
                            <option value="Dammam">Dammam</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Doha">Doha</option>
                            <option value="Dubai">Dubai</option>
                            <option value="Guangzhou">Guangzhou</option>
                            <option value="Jeddah">Jeddah</option>
                            <option value="Kathmandu">Kathmandu</option>
                            <option value="Riyadh">Riyadh</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="London">London</option>
                            <option value="Madinah">Madinah</option>
                            <option value="Manchester">Manchester</option>
                            <option value="Muscat">Muscat</option>
                            <option value="Rome">Rome</option>
                            <option value="Sharjah">Sharjah</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Tokyo">Tokyo</option>
                            <option value="Toronto">Toronto</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="departureDate" class="form-label">Departure Date</label>
                        <input type="date" class="form-control" id="departureDate" name="departure_date" min="<?= date('Y-m-d'); ?>" />
                    </div>
                    <div class="form-group col-md-2 transparent-input">
                        <label for="returnDate" class="form-label">Return Date</label>
                        <input type="date" class="form-control" id="returnDate" name="return_date" min="<?= date('Y-m-d'); ?>" disabled />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="passengers" class="form-label">Passengers</label>
                        <input type="number" class="form-control" id="passengers" value="1" min="1" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="class" class="form-label">Class</label>
                        <select class="form-control" id="class" name="class">
                            <option>Economy</option>
                            <option>Business</option>
                            <option>First Class</option>
                        </select>
                    </div>
                </div>

                <div class="search-button-container">
                    <button type="submit" class="btn btn-custom">Search Flight</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage Booking Section -->
    <div class="container">
        <div class="booking-form text-center" id="manageBookingForm" style="display: none;">
            <div class="manage-booking-text"> &#10003; CHANGE JOURNEY DATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#10003; ADD EXTRA BAGGAGE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#10003; SELECT YOUR SEAT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#10003; UPDATE CONTACT INFO
            </div>
            <div class="manage-booking-inputs">
                <div class="form-group">
                    <label for="reservationCode" class="form-label">Reservation Code</label>
                    <input type="text" class="form-control" id="reservationCode" placeholder="PNR / Reservation Code (6 Character)" />
                </div>
                <div class="form-group">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Last Name or SURNAME" />
                </div>
            </div>
            <div class="search-button-container-manage">
                <button type="submit" class="btn btn-custom" onclick="searchBooking()">Search Booking</button>
            </div>
        </div>
    </div>

    <!-- Web Check In Section -->
    <div class="container">
        <div class="booking-form text-center" id="webCheckInForm" style="display: none;">
            <div class="web-checkin-text">
                <strong>Check in online to skip the queue and make your journey smoother.</strong>
            </div>

            <div class="web-checkin-inputs">
                <div class="form-group">
                    <label for="checkInReservationCode" class="form-label">Reservation Code</label>
                    <input type="text" class="form-control" id="checkInReservationCode" placeholder="PNR / Reservation Code (6 Character)" />
                </div>
                <div class="form-group">
                    <label for="checkInLastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="checkInLastName" placeholder="Last Name or SURNAME" />
                </div>
            </div>
            <div class="search-button-container-checkin">
                <button type="submit" class="btn btn-custom" onclick="checkIn()">Web Check In</button>
            </div>
        </div>
    </div>


    <div class="footer"> &copy; 2024 Biman Bangladesh Airlines. All rights reserved.
    </div>

    <script>
        function setActive(option) {
            const options = document.querySelectorAll('.option');
            options.forEach(opt => {
                opt.classList.remove('active');
                opt.classList.add('inactive');
            });
            option.classList.add('active');
            option.classList.remove('inactive');

            if (option.innerHTML === 'MANAGE BOOKING') {
                document.getElementById('bookingForm').style.display = 'none';
                document.getElementById('manageBookingForm').style.display = 'block';
                document.getElementById('webCheckInForm').style.display = 'none';  // Hide web check-in form
            } else if (option.innerHTML === 'WEB CHECK IN') {
                document.getElementById('bookingForm').style.display = 'none';
                document.getElementById('manageBookingForm').style.display = 'none';
                document.getElementById('webCheckInForm').style.display = 'block';  // Show web check-in form
            } else {
                document.getElementById('bookingForm').style.display = 'block';
                document.getElementById('manageBookingForm').style.display = 'none';
                document.getElementById('webCheckInForm').style.display = 'none';  // Hide web check-in form
            }
        }


        function setFlightType(type) {
            const oneWayBtn = document.getElementById('oneWayBtn');
            const roundTripBtn = document.getElementById('roundTripBtn');

            if (type === 'oneWay') {
                oneWayBtn.classList.add('active');
                oneWayBtn.classList.remove('inactive');
                roundTripBtn.classList.add('inactive');
                roundTripBtn.classList.remove('active');
                document.getElementById('returnDate').disabled = true;
            } else {
                oneWayBtn.classList.add('inactive');
                oneWayBtn.classList.remove('active');
                roundTripBtn.classList.add('active');
                roundTripBtn.classList.remove('inactive');
                document.getElementById('returnDate').disabled = false;
            }
        }

        function searchBooking() {
        const reservationCode = document.getElementById('reservationCode').value;
        const lastName = document.getElementById('lastName').value;

        // Send AJAX request
        fetch('searchBooking.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ reservationCode, lastName })
        })
        .then(response => response.json())
        .then(data => {
                        if (data.success) {
                window.location.href = `bookingCopy.php?booking_id=${data.booking_id}`;
            } else {
                alert('Booking not found. Please check your Reservation Code and Last Name.');
            }

        })
        .catch(error => console.error('Error:', error));
    }

        function searchWebCheckIn() {
            const reservationCode = document.getElementById('webCheckInReservationCode').value;
            const lastName = document.getElementById('webCheckInLastName').value;
            // Add your web check-in logic here
            alert(`Searching for web check-in with code: ${reservationCode} and last name: ${lastName}`);
        }

        // Function to clear form fields on page load
    window.onload = function() {
        document.getElementById("flightForm").reset();
        document.getElementById("manageBookingForm").reset();
    };
    </script>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>