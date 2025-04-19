<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Management</title>

    <!-- Bootstrap + Google Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #301934, #770737, #953553);
            background-size: 400% 400%;
            animation: gradientBackground 5s ease infinite;
            color: #ffffff;
            padding-top: 70px;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999;
        }

        .navbar-brand, .nav-link {
            color: #ffffff !important;
            font-weight: bold;
            text-transform: uppercase;
        }

        .logout-btn {
            color: #00ffff;
            border: 1px solid #00ffff;
            font-weight: bold;
        }

        .logout-btn:hover {
            background-color: #00ffff;
            color: #333;
        }

        .container {
            max-width: 1300px;
            margin: auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            padding: 30px;
            border-radius: 15px;
            margin-top: 40px;
        }

        .table th, .table td {
            color: #ffffff;
            vertical-align: middle;
        }

        .search-form input {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid #ccc;
            color: #fff;
        }

        .search-form input::placeholder {
            color: #ccc;
        }

        .search-form .btn-primary {
            background-color: #00ffff;
            border: none;
            font-weight: bold;
            color: #000;
        }

        .search-form .btn-primary:hover {
            background-color: #ffffff;
            color: #00ffff;
            box-shadow: 0 0 10px #00ffff;
        }
    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="../admin.php">Admin Panel</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item mx-2"><a class="nav-link" href="flightManagement.php">Flights</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="passengerManagement.php">Passengers</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="bookingsOverview.php">Bookings</a></li>
            <li class="nav-item mx-2"><a class="nav-link" href="settings.php">Settings</a></li>
        </ul>
        <a class="btn logout-btn ml-3" href="../logout.php">Logout</a>
    </div>
</nav>

<!-- Passenger Table -->
<div class="container">
    <h2 class="mb-4 text-center text-uppercase">Passenger Directory</h2>

    <form method="POST" class="form-inline justify-content-center mb-4 search-form">
        <input type="text" name="passport_no" class="form-control mr-2" placeholder="Enter Passport Number"
               value="<?php echo isset($searchQuery) ? htmlspecialchars($searchQuery) : ''; ?>">
        <button type="submit" name="search" class="btn btn-primary">Search</button>
    </form>

    <table class="table table-bordered table-hover text-center">
        <thead class="thead-light">
            <tr>
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Passport No</th>
                <th>Expiry Date</th>
                <th>Country</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['date_of_birth']; ?></td>
                    <td><?php echo $row['passport_no']; ?></td>
                    <td><?php echo $row['passport_expiry_date']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">No passengers found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
