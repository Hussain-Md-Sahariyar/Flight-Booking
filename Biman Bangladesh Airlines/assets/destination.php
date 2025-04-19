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
    <title>Destination - Biman Bangladesh Airlines</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Outfit', sans-serif;
            background: url('images/destination.png') no-repeat bottom center fixed;
            background-size: cover;
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
            color: #097969;
        }

            .navbar-light .navbar-nav .nav-link:hover {
                color: #097969;
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
    <!-- Navbar -->
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
                <!-- Profile Dropdown -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <img src="images/profile.png" alt="Profile" class="rounded-circle" width="40" height="40">
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="user.php">My Profile</a> <!-- Link to Profile -->
                            <a class="dropdown-item" href="login.php">Log Out</a> <!-- Log Out Link -->
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="footer">
        &copy; 2024 Biman Bangladesh Airlines. All rights reserved.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>