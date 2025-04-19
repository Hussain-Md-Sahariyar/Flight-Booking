<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$sql = "SELECT * FROM signupinfo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- Add Font Awesome CDN link here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
   
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #301934, #770737, #953553);
            background-size: 400% 400%;
            animation: gradientBackground 5s ease infinite;
            color: #ffffff;
            min-height: 100vh;
            overflow-x: hidden; 
            padding-top: 60px; 
        }

        @keyframes gradientBackground {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 10px 0; 
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
            position: relative; 
            overflow: hidden; 
            padding: 5px 10px;
        }

        .navbar-brand {
            font-size: 25px;
            pointer-events: auto; 
            text-decoration: none; 
            margin-left: 10px; 
        }

        .navbar-nav .nav-link:hover {
            color: #00ffff;
            text-shadow: 0 0 5px #00ffff;
        }

       
        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #00ffff, transparent);
            transition: left 0.3s ease-in-out;
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
            transition: left 0.3s ease-in-out;
        }

        .logout-btn {
            color: #00ffff;
            border: 1px solid #00ffff;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-right: 20px; 
        }

            .logout-btn:hover {
                background-color: #00ffff;
                color: #333;
                box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
            }

        .container.table-container {
            margin-top: 50px;
            margin-bottom: 50px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 1300px;
            width: 100%;
            overflow-x: auto;
        }

        .table th, .table td {
            color: #ffffff;
            text-align: center;
            font-size: 14px;
            vertical-align: middle; 
        }

        .filter-btn {
            background-color: transparent;
            color: #000000;
            border: none;
            font-size: 18px;
            padding: 4px; 
            line-height: 1; 
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block; 
            width: 28px; 
            height: 28px; 
            text-align: center; 
        }

            .filter-btn:hover {
                color: #ffffff;
                background-color: transparent;
                border: 1px solid #00ffff;
                box-shadow: 0 0 10px #00ffff;
            }

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="admin.php">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="flightManagement.php">Flights</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="passengerManagement.php">Passengers</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="bookingsOverview.php">Bookings</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="settings.php">Settings</a>
                </li>
            </ul>
            <a class="btn logout-btn ml-3" href="logout.php">Logout</a>
        </div>
    </nav>

    <!-- User Directory Table -->
    <div class="container table-container">
        <h4 style="font-weight: bold; font-size: 28px; margin-bottom: 20px; text-align: center;">User Directory</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td>
                                <?php echo $row['address']; ?>,
                                <?php echo $row['city']; ?> - <?php echo $row['postal_code']; ?>,
                                <?php echo $row['country']; ?>
                            </td>

                            <td>
                                <?php echo $row['country_code']; ?>
                                <?php echo $row['phone_number']; ?>
                            </td>

                            <td><?php echo $row['email']; ?></td>
                            <td>
    <button class="btn filter-btn delete-btn" data-id="<?php echo $row['id']; ?>"><i class="fas fa-trash"></i></button>
</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- Bootstrap JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    // Select all the delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        // Add a click event listener to each delete button
        button.addEventListener('click', () => {
            // Get the user ID from the data-id attribute
            const userId = button.getAttribute('data-id');
            
            // Confirm the deletion
            if (confirm('Are you sure you want to delete this user?')) {
                // Send an AJAX request to delete_user.php
                fetch('delete_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ id: userId })
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        // If deletion was successful, remove the row from the table
                        button.closest('tr').remove();
                        alert('User deleted successfully!');
                    } else {
                        alert('Failed to delete user.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the user.');
                });
            }
        });
    });
});

    </script>

</body>
</html>