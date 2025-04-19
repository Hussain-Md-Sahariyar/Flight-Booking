<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Biman Airlines - Book Flights</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f0f0; }
        .container { margin-top: 40px; }
        .flight-card { border: 1px solid #ddd; padding: 20px; border-radius: 10px; margin-bottom: 20px; background: #fff; }
        .flight-card h5 { margin: 0; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Search Flights</h2>

    <form method="POST" class="row g-3">
        <div class="col-md-3">
            <label for="flying_from" class="form-label">Flying From</label>
            <input type="text" class="form-control" id="flying_from" name="flying_from" required>
        </div>
        <div class="col-md-3">
            <label for="flying_to" class="form-label">Flying To</label>
            <input type="text" class="form-control" id="flying_to" name="flying_to" required>
        </div>
        <div class="col-md-3">
            <label for="departure_date" class="form-label">Departure Date</label>
            <input type="date" class="form-control" id="departure_date" name="departure_date" min="<?= date('Y-m-d'); ?>" required>
        </div>
        <div class="col-md-2">
            <label for="class" class="form-label">Class</label>
            <select class="form-control" name="class" id="class">
                <option>Economy</option>
                <option>Business</option>
                <option>First Class</option>
            </select>
        </div>
        <div class="col-md-1 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    <hr>

    <?php if (isset($searchResult)): ?>
        <h4 class="mt-4">Available Flights:</h4>
        <?php if ($searchResult->num_rows > 0): ?>
            <?php while ($flight = $searchResult->fetch_assoc()): ?>
                <div class="flight-card">
                    <div class="row">
                        <div class="col-md-4">
                            <h5><?= $flight['flight_no'] ?> | <?= $flight['class'] ?></h5>
                            <p><strong>From:</strong> <?= $flight['flying_from'] ?> (<?= $flight['departure_city_code'] ?>)</p>
                            <p><strong>To:</strong> <?= $flight['flying_to'] ?> (<?= $flight['arrival_city_code'] ?>)</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Departure:</strong> <?= $flight['departure_date'] ?> at <?= $flight['departure_time'] ?></p>
                            <p><strong>Arrival:</strong> <?= $flight['arrival_date'] ?> at <?= $flight['arrival_time'] ?></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Price:</strong> ৳<?= number_format($flight['price']) ?></p>
                            <p><strong>Seats Available:</strong> <?= $flight['available_seats'] ?></p>
                            <a href="booking.php?flight_no=<?= $flight['flight_no'] ?>&departure_date=<?= $flight['departure_date'] ?>" class="btn btn-success">Book Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="alert alert-warning">No flights found with the selected criteria.</div>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
