<!-- app/views/admin/dashboard.php -->
<?php
$todays_flights = $stats['today_flights'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #301934, #770737, #953553);
            color: #fff;
            padding-top: 100px;
        }
        .navbar {
            background-color: rgba(255,255,255,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 999;
        }
        .navbar a {
            color: #fff;
            font-weight: bold;
        }
        .card {
            background: rgba(255,255,255,0.1);
            color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 15px;
            text-align: center;
        }
        .card h3 {
            font-size: 32px;
        }
        .table-container {
            margin: 40px auto;
            background: rgba(255,255,255,0.1);
            padding: 20px;
            border-radius: 15px;
            width: 90%;
        }
        .table th, .table td {
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="index.php?action=logout">Logout</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card">
                <h5>Total Passengers</h5>
                <h3><?= $stats['total_passengers'] ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5>Revenue</h5>
                <h3>৳ <?= number_format($stats['total_revenue']) ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <h5>Total Flights</h5>
                <h3><?= $stats['total_flights'] ?></h3>
            </div>
        </div>
    </div>

    <div class="table-container">
        <h4>Today's Flights</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Flight No</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Seats</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($todays_flights->num_rows > 0): ?>
                    <?php while ($row = $todays_flights->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['flight_no'] ?></td>
                            <td><?= $row['flying_from'] ?><br><?= $row['departure_airport'] ?></td>
                            <td><?= $row['flying_to'] ?><br><?= $row['arrival_airport'] ?></td>
                            <td><?= $row['departure_date'] ?><br><?= $row['departure_time'] ?></td>
                            <td><?= $row['arrival_date'] ?><br><?= $row['arrival_time'] ?></td>
                            <td><?= $row['available_seats'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No flights today.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
