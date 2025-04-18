<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin_login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT booking_id, booking_date, flight_no, flying_from, flying_to, first_name, last_name, price FROM booking_oneway";
$result = $conn->query($sql);

$searchQuery = '';
if (isset($_POST['search']) && !empty($_POST['booking_id'])) {
    $searchQuery = $_POST['booking_id'];
    $sql = "SELECT booking_id, booking_date, flight_no, flying_from, flying_to, first_name, last_name, price
            FROM booking_oneway
            WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $searchQuery);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT booking_id, booking_date, flight_no, flying_from, flying_to, first_name, last_name, price FROM booking_oneway";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
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

        .custom-modal-header {
            background-color: purple;
            color: white;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

            .custom-modal-header .close {
                position: absolute;
                right: 15px;
                color: white;
            }

        .heading-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .futuristic-search-group {
            display: flex;
            align-items: center;
            width: 300px;
        }

        .futuristic-search-box {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
        }

            .futuristic-search-box:focus {
                background: rgba(0, 0, 0, 0.5);
                border-color: #00ffff;
                box-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff;
                outline: none;
            }

        .input-group-append .btn-primary {
            margin-left: 10px;
            background-color: #00ffff;
            border: none;
            border-radius: 10px;
            color: #333;
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }

            .input-group-append .btn-primary:hover {
                background-color: #ffffff;
                color: #00ffff;
                box-shadow: 0 0 10px #00ffff;
            }

    </style>
</head>
<body>
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

    <div class="container table-container">
        <div class="heading-container">
            <h4 style="font-weight: bold; font-size: 28px;">Bookings Overview</h4>
            <form method="POST" class="search-form">
                <div class="input-group futuristic-search-group">
                    <input
                        type="number"
                        name="booking_id"
                        class="form-control futuristic-search-box"
                        placeholder="Enter Booking ID"
                        value="<?php echo isset($searchQuery) ? htmlspecialchars($searchQuery) : ''; ?>" />
                    <div class="input-group-append">
                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>

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
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['booking_id']; ?></td>
                            <td><?php echo $row['booking_date']; ?></td>
                            <td><?php echo $row['flight_no']; ?></td>
                            <td><?php echo $row['flying_from']; ?></td>
                            <td><?php echo $row['flying_to']; ?></td>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo number_format($row['price']); ?>/-</td>
                            <td>
                                <button class="btn filter-btn edit-btn" data-bookingid="<?php echo $row['booking_id']; ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn filter-btn delete-btn" data-bookingid="<?php echo $row['booking_id']; ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="editBookingModal" tabindex="-1" role="dialog" aria-labelledby="editBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header custom-modal-header">
                    <h5 class="modal-title" id="editBookingModalLabel">Edit Booking Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBookingForm" style="color: black;">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="booking_id">Booking ID</label>
                                <input type="number" class="form-control" id="booking_id" name="booking_id" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="booking_reference">Booking Reference</label>
                                <input type="text" class="form-control" id="booking_reference" name="booking_reference" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="booking_date">Booking Date</label>
                                <input type="date" class="form-control" id="booking_date" name="booking_date" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="issue_before">Issue Before</label>
                                <input type="datetime" class="form-control" id="issue_before" name="issue_before" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="passport_no">Passport No</label>
                                <input type="text" class="form-control" id="passport_no" name="passport_no" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="passport_expiry_date">Passport Expiry Date</label>
                                <input type="date" class="form-control" id="passport_expiry_date" name="passport_expiry_date" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="flight_no">Flight No</label>
                                <input type="text" class="form-control" id="flight_no" name="flight_no" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="flying_from">Flying From</label>
                                <input type="text" class="form-control" id="flying_from" name="flying_from" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="flying_to">Flying To</label>
                                <input type="text" class="form-control" id="flying_to" name="flying_to" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="departure_city_code">Departure City Code</label>
                                <input type="text" class="form-control" id="departure_city_code" name="departure_city_code" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="arrival_city_code">Arrival City Code</label>
                                <input type="text" class="form-control" id="arrival_city_code" name="arrival_city_code" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="departure_terminal">Departure Terminal</label>
                                <input type="text" class="form-control" id="departure_terminal" name="departure_terminal" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="arrival_terminal">Arrival Terminal</label>
                                <input type="text" class="form-control" id="arrival_terminal" name="arrival_terminal" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="departure_date">Departure Date</label>
                                <input type="date" class="form-control" id="departure_date" name="departure_date" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="arrival_date">Arrival Date</label>
                                <input type="date" class="form-control" id="arrival_date" name="arrival_date" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="departure_time">Departure Time</label>
                                <input type="text" class="form-control" id="departure_time" name="departure_time" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="arrival_time">Arrival Time</label>
                                <input type="text" class="form-control" id="arrival_time" name="arrival_time" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="class">Class</label>
                                <input type="text" class="form-control" id="class" name="class" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="baggage_type">Baggage Type</label>
                                <input type="text" class="form-control" id="baggage_type" name="baggage_type" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="check_in_baggage">Check-in Baggage</label>
                                <input type="text" class="form-control" id="check_in_baggage" name="check_in_baggage" readonly />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="frequent_flyer_airline">Frequent Flyer Airline</label>
                                <input type="text" class="form-control" id="frequent_flyer_airline" name="frequent_flyer_airline" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="frequent_flyer_no">Frequent Flyer No</label>
                                <input type="text" class="form-control" id="frequent_flyer_no" name="frequent_flyer_no" />
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="fare_basis">Fare Basis</label>
                                <input type="text" class="form-control" id="fare_basis" name="fare_basis" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="base_fare">Base Fare</label>
                                <input type="number" class="form-control" id="base_fare" name="base_fare" readonly />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="taxes">Taxes</label>
                                <input type="number" class="form-control" id="taxes" name="taxes" readonly />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="country">Nationality</label>
                                <input type="text" class="form-control" id="country" name="country" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="contact">Contact</label>
                                <input type="number" class="form-control" id="contact" name="contact" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const bookingId = button.getAttribute('data-bookingid');
                    if (confirm('Are you sure you want to delete this booking?')) {
                        fetch('delete_booking.php', {
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
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const bookingId = button.getAttribute('data-bookingid');

                    fetch(`fetch_booking_details.php?booking_id=${bookingId}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('booking_id').value = data.booking_id;
                            document.getElementById('booking_date').value = data.booking_date;
                            document.getElementById('issue_before').value = data.issue_before;
                            document.getElementById('title').value = data.title;
                            document.getElementById('first_name').value = data.first_name;
                            document.getElementById('last_name').value = data.last_name;
                            document.getElementById('date_of_birth').value = data.date_of_birth;
                            document.getElementById('passport_no').value = data.passport_no;
                            document.getElementById('passport_expiry_date').value = data.passport_expiry_date;
                            document.getElementById('flight_no').value = data.flight_no;
                            document.getElementById('flying_from').value = data.flying_from;
                            document.getElementById('flying_to').value = data.flying_to;
                            document.getElementById('departure_city_code').value = data.departure_city_code;
                            document.getElementById('arrival_city_code').value = data.arrival_city_code;
                            document.getElementById('departure_terminal').value = data.departure_terminal;
                            document.getElementById('arrival_terminal').value = data.arrival_terminal;
                            document.getElementById('departure_date').value = data.departure_date;
                            document.getElementById('arrival_date').value = data.arrival_date;
                            document.getElementById('departure_time').value = data.departure_time;
                            document.getElementById('arrival_time').value = data.arrival_time;
                            document.getElementById('class').value = data.class;
                            document.getElementById('baggage_type').value = data.baggage_type;
                            document.getElementById('check_in_baggage').value = data.check_in_baggage;
                            document.getElementById('frequent_flyer_airline').value = data.frequent_flyer_airline;
                            document.getElementById('frequent_flyer_no').value = data.frequent_flyer_no;
                            document.getElementById('base_fare').value = data.base_fare;
                            document.getElementById('taxes').value = data.taxes;
                            document.getElementById('price').value = data.price;
                            document.getElementById('country').value = data.country;
                            document.getElementById('email').value = data.email;
                            document.getElementById('contact').value = data.contact;
                            document.getElementById('booking_reference').value = data.booking_reference;
                            document.getElementById('fare_basis').value = data.fare_basis;

                            $('#editBookingModal').modal('show');
                        })
                        .catch(error => console.error('Error fetching booking details:', error));
                });
            });

            document.getElementById('editBookingForm').addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                fetch('update_booking.php', {
                    method: 'POST',
                    body: formData,
                })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === 'success') {
                            alert('Booking updated successfully!');
                            location.reload();
                        } else {
                            alert('Failed to update booking.');
                        }
                    })
                    .catch(error => console.error('Error updating booking:', error));
            });
        });

    </script>

    <script>
        window.addEventListener('load', function () {
            document.querySelector('input[name="booking_id"]').value = '';
        });
    </script>

</body>
</html>