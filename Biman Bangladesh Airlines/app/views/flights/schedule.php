<!-- app/views/flights/schedule.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Schedule - Biman Bangladesh Airlines</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: url('images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            padding-top: 80px;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.65);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .table {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .table th, .table td {
            color: white;
            vertical-align: middle;
            text-align: center;
        }

        .footer {
            text-align: center;
            color: white;
            margin-top: 50px;
            padding: 15px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Weekly Flight Schedule</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>From (Time)</th>
            <th>To (Time)</th>
            <th>Duration</th>
            <th>Flight No</th>
            <th>Availability</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($schedules)): ?>
            <?php foreach ($schedules as $row): ?>
                <tr>
                    <td><b><?= $row['flying_from'] ?> (<?= $row['departure_city_code'] ?>)</b><br><?= date("H:i", strtotime($row['departure_time'])) ?></td>
                    <td><b><?= $row['flying_to'] ?> (<?= $row['arrival_city_code'] ?>)</b><br><?= date("H:i", strtotime($row['arrival_time'])) ?></td>
                    <td><?= $row['duration'] ?></td>
                    <td><img src="images/bg_logo.png" alt="Logo" width="20" height="20"> <?= $row['flight_no'] ?></td>
                    <td><?= $row['availability'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5">No flight schedules found</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="footer">
    &copy; 2024 Biman Bangladesh Airlines. All rights reserved.
</div>

</body>
</html>
