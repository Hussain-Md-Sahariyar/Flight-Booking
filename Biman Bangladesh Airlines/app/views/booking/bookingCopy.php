<!-- app/views/booking/bookingCopy.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: url('public/assets/images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .logo img {
            height: 50px;
        }

        .header-buttons button {
            background: #6f42c1;
            color: #fff;
            padding: 10px 20px;
            border-radius: 20px;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        h2 {
            color: #ff9800;
        }

        .section-title {
            font-size: 22px;
            font-weight: bold;
            color: #008080;
            margin: 20px 0 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th, td {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
        }

        .bold-text {
            font-weight: bold;
        }

        .red-text {
            color: red;
        }

        .action-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .action-buttons button {
            padding: 12px 25px;
            font-size: 16px;
            margin: 10px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
        }

        .issue {
            background-color: #008080;
            color: #fff;
        }

        .cancel {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="public/assets/images/Biman_Bangladesh_Airlines_Logo.png" alt="Logo">
        </div>
        <div class="header-buttons">
            <button id="printBtn">🖨️ Print</button>
        </div>
    </div>

    <h2 class="mt-3">Booking Confirmation</h2>

    <!-- Booking Info -->
    <div class="section-title">BOOKING INFORMATION</div>
    <table>
        <tr>
            <td class="bold-text">Booking Date:</td>
            <td><?= $booking['booking_date'] ?></td>
            <td class="bold-text">Booking ID:</td>
            <td>BGL<?= $booking['booking_id'] ?></td>
        </tr>
        <tr>
            <td class="bold-text">Issue Before:</td>
            <td class="red-text"><?= $booking['issue_before'] ?></td>
            <td class="bold-text">Reference:</td>
            <td><?= $booking['booking_reference'] ?></td>
        </tr>
    </table>

    <!-- Passenger Info -->
    <div class="section-title">PASSENGER DETAILS</div>
    <table>
        <tr>
            <th>Name</th><th>Type</th><th>Gender</th><th>DOB</th><th>Passport</th>
        </tr>
        <tr>
            <td><?= $booking['title'] . ' ' . $booking['first_name'] . ' ' . $booking['last_name'] ?></td>
            <td><?= $booking['baggage_type'] ?></td>
            <td><?= $gender ?></td>
            <td><?= $booking['date_of_birth'] ?></td>
            <td><?= $booking['passport_no'] ?></td>
        </tr>
    </table>

    <!-- Travel Info -->
    <div class="section-title">TRAVEL DETAILS</div>
    <table>
        <tr>
            <th>Flight</th><th>From</th><th>To</th><th>Departs</th><th>Arrives</th>
        </tr>
        <tr>
            <td><?= $booking['flight_no'] ?></td>
            <td><?= $booking['flying_from'] ?></td>
            <td><?= $booking['flying_to'] ?></td>
            <td><?= $booking['departure_time'] ?>, <?= $booking['departure_date'] ?></td>
            <td><?= $booking['arrival_time'] ?>, <?= $booking['arrival_date'] ?></td>
        </tr>
    </table>

    <!-- Fare -->
    <div class="section-title">FARE DETAILS</div>
    <table>
        <tr>
            <th>Base Fare</th><th>Tax</th><th>Total</th>
        </tr>
        <tr>
            <td><?= $booking['base_fare'] ?></td>
            <td><?= $booking['taxes'] ?></td>
            <td>BDT <?= $booking['price'] ?></td>
        </tr>
    </table>

    <!-- Contact -->
    <div class="section-title">CONTACT</div>
    <table>
        <tr>
            <th>Phone</th><th>Email</th>
        </tr>
        <tr>
            <td>+880<?= $booking['contact'] ?></td>
            <td><?= $booking['email'] ?></td>
        </tr>
    </table>

    <!-- Buttons -->
    <div class="action-buttons">
        <form action="index.php?action=issueTicket" method="GET" style="display: inline;">
            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
            <button type="submit" class="issue">Issue Ticket</button>
        </form>
        <form action="index.php?action=cancelBooking" method="POST" style="display: inline;">
            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
            <button type="submit" name="cancel_booking" class="cancel">Cancel Booking</button>
        </form>
        <form action="index.php?action=payment" method="GET">
    <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
    <input type="hidden" name="price" value="<?= $booking['price'] ?>">
    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
</form>

    </div>
</div>

<script>
    document.getElementById("printBtn")?.addEventListener("click", function () {
        window.print();
    });
</script>

</body>
</html>
