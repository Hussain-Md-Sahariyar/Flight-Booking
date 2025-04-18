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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Biman Bangladesh Airlines</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Outfit', sans-serif;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            padding-bottom: 20px;
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

        section {
            margin-bottom: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .dhaka-office h2,
        .other-offices h2 {
            background-color: #097969;
            padding: 10px;
            border-radius: 5px;
            color: #FFFFFF;
        }

        .office-section, .office-location {
            margin-top: 20px;
        }

            .office-section h4, .office-location h4 {
                color: #31708f;
            }

            .office-section p, .office-location p {
                margin: 5px 0;
            }

        a {
            color: #007bff;
            text-decoration: none;
        }

            a:hover {
                text-decoration: underline;
            }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
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
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Biman Bangladesh Airlines" width="300">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="destination.php">Destinations</a>
                    </li>
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item" style="font-family: Poppins, sans-serif;">
                        <a class="nav-link" href="termsCondition.php">Terms & Conditions</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <img src="images/profile.png" alt="Profile" class="rounded-circle" width="40" height="40">
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="user.php">My Profile</a>
                            <a class="dropdown-item" href="login.php">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <section class="dhaka-office">
            <h2 style="font-size: 35px; font-weight: 700; text-align: center;">Contact Us</h2>
            <div class="office-section">
                <h4>Head Office</h4>
                <p>Balaka, Kurmitola, Dhaka-1229, Bangladesh.</p>
                <p>Call Center: <a href="tel:13636">13636</a> (International: +88 096109-13636)</p>
                <p>Online Booking: <a href="mailto:ibebiman@biman.gov.bd">ibebiman@biman.gov.bd</a></p>
            </div>
            <div class="office-section">
                <h4>Biman Head Office Balaka Gate Sales Outlet</h4>
                <p>Biman Bangladesh Airlines Ltd. Balaka Bhaban, Kurmitola, Dhaka-1229.</p>
                <p>Phone: +88 01777715630, +88 01777715631</p>
                <p>Email: <a href="mailto:balakadso@biman.gov.bd">balakadso@biman.gov.bd</a></p>
                <p>Hours: 08:30 AM to 08:30 PM Every Day</p>
            </div>
        </section>

        <section class="other-offices">
            <h2 style="font-family: Poppins, sans-serif; font-size: 27px; font-weight: bold; text-align: center;">Other Domestic Offices</h2>

            <div class="office-location">
                <h4>Barishal</h4>
                <p>Address: B.S Tower (01st Floor), 595, Shaheed Nazrul Islam Sarak (Police Line Road), Barishal - 8200</p>
                <p>Sales Counter (Phone): +88-02-478865019</p>
                <p>District Manager (Mobile): +88-017-777-75530</p>
                <p>District Manager (Email): <a href="mailto:bzlulu@biman.gov.bd">bzlulu@biman.gov.bd</a></p>
            </div>

            <div class="office-location">
                <h4>Chattogram</h4>
                <p>Address: City Office: Shulashahar, Chattogram. Airport Office: Room No-307 SAIA, Chattogram.</p>
                <p>Officer-in-Charge Counter: +88-01777715723, +88-01777715725</p>
                <p>District Manager (Mobile): +88-01777715700</p>
                <p>District Manager (Phone): +88-02334450866</p>
                <p>District Manager (Email): <a href="mailto:cgpub@biman.gov.bd">cgpub@biman.gov.bd</a></p>
            </div>

        </section>
    </div>

    <div class="footer">
        &copy; 2024 Biman Bangladesh Airlines. All rights reserved.
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>