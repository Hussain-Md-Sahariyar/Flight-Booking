<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Destinations | Biman Bangladesh Airlines</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Outfit', sans-serif;
      background: url('../images/destination.png') no-repeat center bottom fixed;
      background-size: cover;
      color: white;
    }
    .container {
      margin-top: 100px;
      background-color: rgba(0,0,0,0.6);
      padding: 30px;
      border-radius: 15px;
    }
    h2 {
      font-size: 32px;
      font-weight: bold;
      color: #00ffff;
      text-align: center;
      margin-bottom: 30px;
    }
    .table th {
      background-color: #097969;
      color: white;
    }
    .table td, .table th {
      vertical-align: middle;
      text-align: center;
      color: white;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Explore Our Destinations</h2>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>From</th>
        <th>To</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Flight No</th>
        <th>Duration</th>
        <th>Seats</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($destinations && $destinations->num_rows > 0): ?>
        <?php while ($row = $destinations->fetch_assoc()): ?>
          <tr>
            <td><?= $row['flying_from'] ?> (<?= $row['departure_city_code'] ?>)</td>
            <td><?= $row['flying_to'] ?> (<?= $row['arrival_city_code'] ?>)</td>
            <td><?= date("H:i", strtotime($row['departure_time'])) ?></td>
            <td><?= date("H:i", strtotime($row['arrival_time'])) ?></td>
            <td><?= $row['flight_no'] ?></td>
            <td><?= $row['duration'] ?></td>
            <td><?= $row['available_seats'] ?></td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="7">No destinations found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
