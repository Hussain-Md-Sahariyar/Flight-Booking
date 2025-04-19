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
    <title>User Settings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
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

        .container.table-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 15px;
            margin: 40px auto;
            max-width: 1300px;
        }

        .table th, .table td {
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
        }

        .btn-delete {
            color: red;
            cursor: pointer;
            font-size: 18px;
        }

        .btn-delete:hover {
            text-shadow: 0 0 5px red;
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

<!-- Settings Content -->
<div class="container table-container">
    <h4 class="text-center font-weight-bold mb-4" style="font-size: 28px;">User Directory</h4>
    <table class="table table-bordered table-hover text-center">
        <thead class="thead-light">
        <tr>
            <th>User ID</th><th>Name</th><th>Address</th><th>Phone</th><th>Email</th><th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($users && $users->num_rows > 0): ?>
            <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                    <td><?= $row['address'] . ', ' . $row['city'] . ', ' . $row['country'] ?></td>
                    <td><?= $row['country_code'] . ' ' . $row['phone_number'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><span class="btn-delete" data-id="<?= $row['id'] ?>"><i class="fas fa-trash"></i></span></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No users found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        if (confirm("Are you sure you want to delete this user?")) {
            fetch('../controllers/UserController.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=delete&id=${id}`
            })
            .then(res => res.text())
            .then(response => {
                if (response === 'success') {
                    alert("User deleted successfully.");
                    location.reload();
                } else {
                    alert("Failed to delete user.");
                }
            });
        }
    });
});
</script>

</body>
</html>
