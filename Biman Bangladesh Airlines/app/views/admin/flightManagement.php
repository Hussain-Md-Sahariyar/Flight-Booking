<!-- app/views/admin/flightManagement.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Flights - Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #f0f2f5;
            padding-top: 80px;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .modal-header {
            background-color: #0d6efd;
            color: white;
        }

        .btn-edit, .btn-delete {
            padding: 5px 10px;
        }

        .table th, .table td {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>

<div class="container">
    <h3 class="mb-4">Flight Management</h3>

    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#flightModal" onclick="openAddModal()">+ Add Flight</button>

    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
        <tr>
            <th>Flight No</th>
            <th>From</th>
            <th>To</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Class</th>
            <th>Seats</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($flights as $flight): ?>
            <tr>
                <td><?= $flight['flight_no'] ?></td>
                <td><?= $flight['flying_from'] ?> (<?= $flight['departure_city_code'] ?>)</td>
                <td><?= $flight['flying_to'] ?> (<?= $flight['arrival_city_code'] ?>)</td>
                <td><?= $flight['departure_date'] ?> <?= $flight['departure_time'] ?></td>
                <td><?= $flight['arrival_date'] ?> <?= $flight['arrival_time'] ?></td>
                <td><?= $flight['class'] ?></td>
                <td><?= $flight['available_seats'] ?></td>
                <td>৳<?= $flight['price'] ?></td>
                <td>
                    <button class="btn btn-sm btn-primary btn-edit" onclick="editFlight('<?= $flight['flight_no'] ?>', '<?= $flight['departure_date'] ?>')">Edit</button>
                    <button class="btn btn-sm btn-danger btn-delete" onclick="deleteFlight('<?= $flight['flight_no'] ?>', '<?= $flight['departure_date'] ?>')">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Flight Modal -->
<div class="modal fade" id="flightModal" tabindex="-1" aria-labelledby="flightModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form method="POST" action="index.php?action=addOrUpdateFlight" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flightModalLabel">Add/Edit Flight</h5>
                <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                <!-- Input fields go here -->
                <div class="col-md-4">
                    <label class="form-label">Flight No</label>
                    <input type="text" class="form-control" name="flight_no" id="flight_no" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Flying From</label>
                    <input type="text" class="form-control" name="flying_from" id="flying_from" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Flying To</label>
                    <input type="text" class="form-control" name="flying_to" id="flying_to" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Departure Date</label>
                    <input type="date" class="form-control" name="departure_date" id="departure_date" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Arrival Date</label>
                    <input type="date" class="form-control" name="arrival_date" id="arrival_date" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Departure Time</label>
                    <input type="time" class="form-control" name="departure_time" id="departure_time" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Arrival Time</label>
                    <input type="time" class="form-control" name="arrival_time" id="arrival_time" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Duration</label>
                    <input type="text" class="form-control" name="duration" id="duration">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Class</label>
                    <select class="form-select" name="class" id="class" required>
                        <option>Economy</option>
                        <option>Business</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Aircraft</label>
                    <input type="text" class="form-control" name="aircraft" id="aircraft">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Seats</label>
                    <input type="number" class="form-control" name="available_seats" id="available_seats">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" id="price" required>
                </div>

                <!-- Add more fields as needed -->

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Save Flight</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('flightModalLabel').innerText = 'Add Flight';
        document.querySelector('#flightModal form').reset();
    }

    function editFlight(flight_no, departure_date) {
        fetch("index.php?action=getFlightDetails", {
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `flight_no=${encodeURIComponent(flight_no)}&departure_date=${encodeURIComponent(departure_date)}`
        })
        .then(res => res.json())
        .then(data => {
            for (const key in data) {
                const input = document.getElementById(key);
                if (input) input.value = data[key];
            }
            document.getElementById('flightModalLabel').innerText = 'Edit Flight';
            new bootstrap.Modal(document.getElementById('flightModal')).show();
        });
    }

    function deleteFlight(flight_no, departure_date) {
        if (confirm("Are you sure you want to delete this flight?")) {
            fetch("index.php?action=deleteFlight", {
                method: "POST",
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ flight_no, departure_date })
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    alert("Flight deleted successfully.");
                    location.reload();
                } else {
                    alert("Failed to delete flight.");
                }
            });
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
