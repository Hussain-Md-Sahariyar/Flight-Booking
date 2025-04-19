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
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- Include FontAwesome for the edit icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #1f1f1f;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header h4 {
            font-size: 24px;
            color: #ffffff;
        }

        .header .btn {
            background-color: #00bcd4;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .header .btn:hover {
            background-color: #007f8c;
        }

        .sidebar {
            position: fixed;
            top: 80px;
            left: 0;
            background-color: #2c2f36;
            width: 250px;
            height: calc(100vh - 80px);
            color: #e0e0e0;
            padding: 35px;
            overflow-y: auto;
            z-index: 0;
        }

        .sidebar a {
            text-decoration: none;
            font-weight: 500;
            color: #e0e0e0;
            margin-bottom: 15px;
            display: block;
            transition: color 0.3s;
        }

        .sidebar a:hover {
            color: #00bcd4;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .profile-card {
            background-color: #1f1f1f;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-card h5 {
            font-size: 22px;
            color: #00bcd4;
            margin-bottom: 20px;
        }

        .profile-card p {
            font-size: 18px;
            color: #e0e0e0;
            margin-bottom: 10px;
        }

        .profile-card i {
            color: #00bcd4;
            cursor: pointer;
            margin-left: 10px;
        }

        .modal-header {
            background-color: #007f8c;
            color: white;
        }

        .modal-header h5 {
            margin: 0;
        }

        .modal-content {
            background-color: #1f1f1f;
            color: #e0e0e0;
        }

        .form-control {
            background-color: #121212;
            border: 1px solid #00bcd4;
            color: #e0e0e0;
        }

        .form-control:focus {
            background-color: #121212;
            border-color: #007f8c;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <!-- Header Navbar -->
    <div class="header">
        <a class="navbar-brand" href="index.php">
            <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Biman Bangladesh Airlines" width="250">
        </a>
        <button class="btn" onclick="window.location.href='login.php'">Sign Out</button>
    </div>

    <!-- Content Area -->
    <div class="content">
        <!-- Sidebar -->
        <div class="sidebar">
            <p><br /></p>
            <a href="user.php">My Profile</a>
            <a href="user_booking.php">Bookings</a>
        </div>

        <!-- Profile Card -->
        <div class="profile-card">
            <h5>User Information <i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#editModal"></i></h5>
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> john.doe@example.com</p>
            <p><strong>Contact:</strong> +1234567890</p>
            <p><strong>Address:</strong> 123 Street, City, Country</p>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" value="John Doe">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" value="john.doe@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="editContact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="editContact" value="+1234567890">
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" value="123 Street, City, Country">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
