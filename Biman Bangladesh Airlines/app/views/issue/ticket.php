<!-- app/views/issue/ticket.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Details</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header img {
            height: 50px;
        }

        .header-buttons button {
            background-color: #008080;
            color: #fff;
            padding: 10px 30px;
            margin: 0 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .booking-details-box {
            text-align: center;
            font-weight: bold;
            font-size: 22px;
            color: #770737;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        th, td {
            border: 1px solid #e0e0e0;
            padding: 10px;
            font-size: 14px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            color: #000;
        }

        .grand-total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Logo">
        <div class="header-buttons">
            <button onclick="window.print()">🖨 Print</button>
        </div>
    </div>

    <div class="booking-details-box">Electronic Ticket</div>

    <!-- Ticket Info Table -->
    <table>
        <thead><tr><th colspan="4">TICKETED</th></tr></thead>
        <tbody>
        <tr>
            <td><b>Issue Date:</b></td><td><?= $issue_date ?></td>
            <td><b>Booking ID:</b></td><td>BGL<?= $booking['booking_id'] ?></td>
        </tr>
        <tr>
            <td><b>E-Ticket Number:</b></td><td class="text-danger"><?= $eTicket ?></td>
            <td><b>Booking Ref:</b></td><td><?= $booking['booking_reference'] ?></td>
        </tr>
        <tr>
            <td><b>Status:</b></td><td>Issued</td>
            <td><b>Passenger:</b></td><td><?= "{$booking['title']} {$booking['first_name']} {$booking['last_name']}" ?></td>
        </tr>
        </tbody>
    </table>

    <!-- Passenger Info -->
    <table>
        <thead><tr><th colspan="5">PASSENGER DETAILS</th></tr></thead>
        <tr>
            <td><b>Name</b></td>
            <td><b>Type</b></td>
            <td><b>Gender</b></td>
            <td><b>DOB</b></td>
            <td><b>Passport No</b></td>
        </tr>
        <tr>
            <td><?= "{$booking['title']} {$booking['first_name']} {$booking['last_name']}" ?></td>
            <td><?= $booking['baggage_type'] ?></td>
            <td><?= $gender ?></td>
            <td><?= $booking['date_of_birth'] ?></td>
            <td><?= $booking['passport_no'] ?></td>
        </tr>
    </table>

    <!-- Travel Segments -->
    <table>
        <thead><tr><th colspan="9">TRAVEL SEGMENTS</th></tr></thead>
        <tr>
            <td><b>Airline</b></td><td><b>Flight</b></td><td><b>Departs</b></td><td><b>Date/Time</b></td>
            <td><b>Arrives</b></td><td><b>Date/Time</b></td><td><b>Fare</b></td><td><b>Class</b></td><td><b>Baggage</b></td>
        </tr>
        <tr>
            <td>Biman Bangladesh Airlines</td>
            <td><?= $booking['flight_no'] ?></td>
            <td><?= $booking['flying_from'] ?> (<?= $booking['departure_city_code'] ?>)</td>
            <td><?= "{$booking['departure_date']} / {$booking['departure_time']}" ?></td>
            <td><?= $booking['flying_to'] ?> (<?= $booking['arrival_city_code'] ?>)</td>
            <td><?= "{$booking['arrival_date']} / {$booking['arrival_time']}" ?></td>
            <td><?= $booking['fare_basis'] ?></td>
            <td><?= $booking['class'] ?></td>
            <td><?= $booking['baggage_type'] ?> → <?= $booking['check_in_baggage'] ?></td>
        </tr>
    </table>

    <!-- Fare Table -->
    <table>
        <thead><tr><th colspan="6">FARE DETAILS</th></tr></thead>
        <tr>
            <td><b>Type</b></td><td><b>Base Fare</b></td><td><b>Tax</b></td><td><b>AIT/VAT</b></td><td><b>Person</b></td><td><b>Total</b></td>
        </tr>
        <tr>
            <td><?= $booking['baggage_type'] ?></td>
            <td><?= $booking['base_fare'] ?></td>
            <td><?= $booking['taxes'] ?></td>
            <td>0</td>
            <td>1</td>
            <td>BDT <?= $booking['price'] ?></td>
        </tr>
        <tr>
            <td colspan="5" class="grand-total">Grand Total</td>
            <td><b>BDT <?= $booking['price'] ?></b></td>
        </tr>
    </table>

</div>
</body>
</html>
