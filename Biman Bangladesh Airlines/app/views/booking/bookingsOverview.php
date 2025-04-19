<!-- app/views/booking/bookingsOverview.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Bookings Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #301934, #770737, #953553);
            background-size: 400% 400%;
            animation: gradientBackground 5s ease infinite;
            color: #fff;
            padding-top: 60px;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .table-container {
            background-color: #1f1f1f;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin: 20px auto;
            max-width: 95%;
        }

        .table th {
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .table td {
            color: #e0e0e0;
            text-align: center;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .search-form {
            margin-bottom: 20px;
        }

        .search-form input {
            height: 45px;
            border-radius: 8px 0 0 8px;
        }

        .search-form button {
            height: 45px;
            border-radius: 0 8px 8px 0;
        }
    </style>
</head>
<body>

<div class="container table-container">
    <h3 class="section-title text-white">Bookings Overview</h3>

    <form method="POST" class="search-form d-flex">
        <input type="number" name="booking_id" class="form-control" placeholder="Enter Booking ID"
               value="<?= isset($searchQuery) ? htmlspecialchars($searchQuery) : '' ?>">
        <button type="submit" name="search" class="btn btn-primary ml-2">Search</button>
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Booking ID</th>
            <th>Booking Date</th>
            <th>Flight No</th>
            <th>Origin</th>
            <th>Destination</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($bookings)): ?>
            <?php foreach ($bookings as $row): ?>
                <tr>
                    <td><?= $row['booking_id'] ?></td>
                    <td><?= $row['booking_date'] ?></td>
                    <td><?= $row['flight_no'] ?></td>
                    <td><?= $row['flying_from'] ?></td>
                    <td><?= $row['flying_to'] ?></td>
                    <td><?= $row['first_name'] ?></td>
                    <td><?= $row['last_name'] ?></td>
                    <td><?= number_format($row['price']) ?>/-</td>
                    <td>
                        <a href="index.php?action=bookingCopy&booking_id=<?= $row['booking_id'] ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9">No bookings found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
fetch('index.php?action=deleteBooking', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ booking_id: bookingId }),
})
.then(response => response.text())
.then(data => {
    if (data.trim() === 'success') {
        button.closest('tr').remove();
        alert('Booking deleted successfully!');
    } else {
        alert('Failed to delete booking.');
    }
})
.catch(error => console.error('Error:', error));

</body>
</html>
