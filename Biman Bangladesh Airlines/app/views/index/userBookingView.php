<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Bookings - Biman Bangladesh Airlines</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: 'Poppins', sans-serif;
    }
    .header {
      background-color: #1f1f1f;
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header .btn {
      background-color: #00bcd4;
      color: white;
    }
    .sidebar {
      position: fixed;
      top: 80px;
      left: 0;
      width: 250px;
      height: calc(100vh - 80px);
      background-color: #2c2f36;
      padding: 30px;
      font-size: 16px;
    }
    .sidebar a {
      color: #e0e0e0;
      display: block;
      margin-bottom: 15px;
      text-decoration: none;
    }
    .content {
      margin-left: 270px;
      padding: 30px;
    }
    .table-container {
      background-color: #1f1f1f;
      padding: 25px;
      border-radius: 10px;
    }
    .table th {
      color: white;
      text-align: center;
    }
    .table td {
      color: #e0e0e0;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="header">
  <h4>My Bookings</h4>
  <a href="logout.php" class="btn">Logout</a>
</div>

<div class="sidebar">
  <a href="user.php">My Profile</a>
  <a href="user_booking.php" class="fw-bold text-info">Bookings</a>
</div>

<div class="content">
  <div class="table-container">
    <h3 class="mb-4">Bookings Overview</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Booking ID</th>
          <th>Date</th>
          <th>Flight No</th>
          <th>From</th>
          <th>To</th>
          <th>Name</th>
          <th>Price</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($bookings && $bookings->num_rows > 0): ?>
          <?php while ($row = $bookings->fetch_assoc()): ?>
            <tr>
              <td><?= $row['booking_id'] ?></td>
              <td><?= $row['booking_date'] ?></td>
              <td><?= $row['flight_no'] ?></td>
              <td><?= $row['flying_from'] ?></td>
              <td><?= $row['flying_to'] ?></td>
              <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
              <td>৳<?= number_format($row['price']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="7">No bookings found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
