<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $price = $_POST['price'];
    $invoice = $_POST['invoice'];
    $phone = $_POST['phone'];
    $pin = $_POST['pin'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "airlinesystem");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Store data in the 'payment' table
    $stmt = $conn->prepare("INSERT INTO payment (booking_id, invoice, price, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isii", $booking_id, $invoice, $price, $phone);
    if (!$stmt->execute()) {
        die("Error inserting into payment table: " . $stmt->error);
    }

    // Fetch booking data
    $stmt = $conn->prepare("SELECT * FROM booking_oneway WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();

        // Determine gender based on title
        $gender = ($booking['title'] === 'Mr') ? 'Male' : 'Female';

        // Insert data into 'issue_oneway' table
        $stmt = $conn->prepare("
            INSERT INTO issue_oneway (
                booking_id, issue_date, booking_reference, title, first_name, last_name,
                date_of_birth, passport_no, flight_no, flying_from, flying_to, 
                departure_city_code, arrival_city_code, departure_terminal, arrival_terminal,
                departure_date, arrival_date, departure_time, arrival_time, class, 
                baggage_type, check_in_baggage, frequent_flyer_airline, frequent_flyer_no, 
                fare_basis, base_fare, taxes, price, country, email, contact
            ) VALUES (?, CURDATE(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "isssssssssssssssssssssssiiissi",
            $booking['booking_id'],
            $booking['booking_reference'],
            $booking['title'],
            $booking['first_name'],
            $booking['last_name'],
            $booking['date_of_birth'],
            $booking['passport_no'],
            $booking['flight_no'],
            $booking['flying_from'],
            $booking['flying_to'],
            $booking['departure_city_code'],
            $booking['arrival_city_code'],
            $booking['departure_terminal'],
            $booking['arrival_terminal'],
            $booking['departure_date'],
            $booking['arrival_date'],
            $booking['departure_time'],
            $booking['arrival_time'],
            $booking['class'],
            $booking['baggage_type'],
            $booking['check_in_baggage'],
            $booking['frequent_flyer_airline'],
            $booking['frequent_flyer_no'],
            $booking['fare_basis'],
            $booking['base_fare'],
            $booking['taxes'],
            $booking['price'],
            $booking['country'],
            $booking['email'],
            $booking['contact']
        );
        if (!$stmt->execute()) {
            die("Error inserting into issue_oneway table: " . $stmt->error);
        }
    } else {
        die("Booking not found for the provided booking_id.");
    }

    // Fetch issue_date and eTicket for the booking_id
    $stmt = $conn->prepare("SELECT issue_date, eTicket FROM issue_oneway WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $issueData = $result->fetch_assoc();
        $issue_date = $issueData['issue_date'];
        $eTicket = $issueData['eTicket'];
    } else {
        die("No issue data found for the provided booking_id.");
    }

    // Close resources
    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        body {
            font-family: Poppins, sans-serif;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
            height: 100%;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

       
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

      
        .logo {
            display: flex;
            align-items: center;
        }

            .logo img {
                height: 50px; 
                margin-right: 13px;
            }

   
        .header h2 {
            font-size: 24px;
            color: #ff9800;
            font-weight: bold;
            margin: 0;
        }

     
        .header-buttons {
            display: flex;
            gap: 10px;
        }

       
            .header-buttons button {
                background: #007bff;
                color: #fff;
                border: none;
                padding: 10px 20px;
                border-radius: 20px; 
                cursor: pointer;
                font-weight: bold;
                font-family: Poppins, sans-serif;
            }

                .header-buttons button:nth-child(1) {
                    background: #007bff; 
                }

                .header-buttons button:nth-child(2) {
                    background: #28a745; 
                }

                .header-buttons button:nth-child(3) {
                    background: #6f42c1; 
                }

       
        .center-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 25vh;
        }

     
        .booking-details-box {
            padding: 10px 20px;
            border: 2px solid #008080; 
            border-radius: 25px; 
            background-color: transparent;
            font-size: 20px;
            font-weight: bold;
            color: #008080; 
            text-align: center;
        }


    
        .booking-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 0;
        }

           
            .booking-table thead th {
                background-color: #f0f0f0;
                color: #000;
                font-weight: bold;
                font-size: 17px;
                text-align: left;
                padding: 10px;
                border: 1px solid #e0e0e0; 
            }

         
            .booking-table td {
                padding: 8px 12px;
                font-size: 14px;
                color: #000;
                border: 1px solid #e0e0e0; 
            }

      
        .bold-text {
            font-weight: bold;
            color: #000;
        }

   
        .red-text {
            color: red;
        }

       
        .passenger-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

    
            .passenger-table thead th {
                background-color: #f0f0f0;
                color: #000;
                font-weight: bold;
                font-size: 17px;
                text-align: left;
                padding: 10px;
                border: 1px solid #e0e0e0; 
            }

       
            .passenger-table td {
                padding: 8px 12px;
                font-size: 14px;
                color: #000;
                border: 1px solid #e0e0e0; 
            }

      
        .bold-text {
            font-weight: bold;
            color: #000;
        }

   
        .travel-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

         
            .travel-table thead th {
                background-color: #f0f0f0;
                color: #000;
                font-weight: bold;
                font-size: 17px;
                text-align: left;
                padding: 10px;
                border: 1px solid #e0e0e0; 
            }

        
            .travel-table td {
                padding: 8px 12px;
                font-size: 14px;
                color: #000;
                border: 1px solid #e0e0e0; 
                vertical-align: top;
                text-align: left;
            }

    
        .bold-text {
            font-weight: bold;
            color: #000;
        }

   
        .arrow-symbol {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-right: 2px solid #000;
            border-top: 2px solid #000;
            transform: rotate(45deg);
            margin-left: 5px;
        }

      
        .fare-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

          
            .fare-table thead th {
                background-color: #f0f0f0;
                color: #000;
                font-weight: bold;
                font-size: 17px;
                text-align: left;
                padding: 10px;
                border: 1px solid #e0e0e0; 
            }

          
            .fare-table td {
                padding: 8px 12px;
                font-size: 14px;
                color: #000;
                border: 1px solid #e0e0e0; 
                vertical-align: middle;
                text-align: right;
            }

    
        .bold-text {
            font-weight: bold;
            color: #000;
        }

     
        .grand-total {
            text-align: right;
            font-weight: bold;
        }

      
        .notice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-bottom: 1px solid #e0e0e0; 
        }

          
            .notice-table thead th {
                background-color: #f0f0f0;
                color: #000;
                font-weight: bold;
                font-size: 16px;
                text-align: left;
                padding: 10px;
                border-bottom: 1px solid #e0e0e0; 
            }

         
            .notice-table td {
                padding: 10px;
                font-size: 13px;
                color: #000;
                border-top: 1px solid #e0e0e0; 
                text-align: left;
            }
    </style>
</head>
<body>

    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Logo"> <!-- Placeholder for logo -->
            </div>
            <div class="header-buttons">
                <button id="printBtn"><img src="images/print.png" style="width: 15px; vertical-align: middle;">&nbsp;&nbsp;&nbsp;Print</button>
            </div>
        </div>

        <!-- Centering Container -->
        <div class="center-container">
            <div class="booking-details-box">
                Electronic Ticket
            </div>
        </div>

        <table class="booking-table">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th colspan="4">TICKETED</th>
                </tr>
            </thead>
            <!-- Table Body with Rows and Columns -->
            <tbody>
                <tr>
                    <td class="bold-text">Issue Date:</td>
                    <td><?php echo $issue_date; ?></td>
                    <td class="bold-text">Booking ID:</td>
                    <td>BGL<?php echo $booking['booking_id']; ?></td>
                </tr>
                <tr>
                    <td class="bold-text">E-Ticket Number:</td>
                    <td class="red-text"><?php echo $eTicket; ?></td>
                    <td class="bold-text">Booking Reference:</td>
                    <td><?php echo $booking['booking_reference']; ?></td>
                </tr>
                <tr>
                    <td class="bold-text">Booking Status:</td>
                    <td>Issued</td>
                    <td class="bold-text">Booked By:</td>
                    <td><?php echo $booking['title'] . ' ' . $booking['first_name'] . ' ' . $booking['last_name']; ?></td>
                </tr>
            </tbody>
        </table>


        <table class="passenger-table">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th colspan="5">PASSENGER DETAILS</th>
                </tr>
            </thead>
            <!-- Table Body with Rows and Columns -->
            <tbody>
                <tr>
                    <td class="bold-text">Name</td>
                    <td class="bold-text">Type</td>
                    <td class="bold-text">Gender</td>
                    <td class="bold-text">DOB</td>
                    <td class="bold-text">Passport No</td>
                </tr>
                <tr>
                    <td><?php echo $booking['title'] . ' ' . $booking['first_name'] . ' ' . $booking['last_name']; ?></td>
                    <td><?php echo $booking['baggage_type']; ?></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $booking['date_of_birth']; ?></td>
                    <td><?php echo $booking['passport_no']; ?></td>
                </tr>
            </tbody>
        </table>

        <table class="travel-table">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th colspan="9">TRAVEL SEGMENTS</th>
                </tr>
            </thead>
            <!-- Table Body with Rows and Columns -->
            <tbody>
                <tr>
                    <td class="bold-text">Airline</td>
                    <td class="bold-text">Flight</td>
                    <td class="bold-text">Departs</td>
                    <td class="bold-text">Date/Time</td>
                    <td class="bold-text">Arrives</td>
                    <td class="bold-text">Date/Time</td>
                    <td class="bold-text">Fare Basis</td>
                    <td class="bold-text">Class</td>
                    <td class="bold-text">Baggage</td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;">
                        <div><img src="images/bg_logo.png" alt="Airline Logo" style="display: inline-block; width: 40px; margin-bottom: 1px;"></div>
                        Biman Bangladesh Airlines
                    </td>
                    <td style="vertical-align: middle;"><?php echo $booking['flight_no']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $booking['flying_from']; ?> <br>(<?php echo $booking['departure_city_code']; ?>) <br>Terminal: <?php echo $booking['departure_terminal']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $booking['departure_time']; ?> <br><?php echo $booking['departure_date']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $booking['flying_to']; ?> <br>(<?php echo $booking['arrival_city_code']; ?>) <br>Terminal: <?php echo $booking['arrival_terminal']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $booking['arrival_time']; ?> <br><?php echo $booking['arrival_date']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $booking['fare_basis']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $booking['class']; ?></td>
                    <td style="vertical-align: middle;"><b><?php echo $booking['baggage_type']; ?></b> &rarr; Check In: <?php echo $booking['check_in_baggage']; ?></td>
                </tr>
            </tbody>
        </table>

        <table class="fare-table">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th colspan="6">FARE DETAILS</th>
                </tr>
            </thead>
            <!-- Table Body with Rows and Columns -->
            <tbody>
                <tr>
                    <td class="bold-text" style="text-align: left;">Type</td>
                    <td class="bold-text">Base Fare</td>
                    <td class="bold-text">Tax</td>
                    <td class="bold-text">AIT/VAT</td>
                    <td class="bold-text">Person</td>
                    <td class="bold-text">Total</td>
                </tr>
                <tr>
                    <td style="text-align: left;"><?php echo $booking['baggage_type']; ?></td>
                    <td><?php echo $booking['base_fare']; ?></td>
                    <td><?php echo $booking['taxes']; ?></td>
                    <td>0</td>
                    <td>1</td>
                    <td><?php echo $booking['price']; ?></td>
                </tr>
                <tr>
                    <td colspan="5" class="grand-total">Grand Total</td>
                    <td class="bold-text">BDT <?php echo $booking['price']; ?></td>
                </tr>
            </tbody>
        </table>

        <table class="notice-table">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th>Important Notice For Travellers</th>
                </tr>
            </thead>
            <!-- Table Body with Rows -->
            <tbody>
                <tr>
                    <td><b>E-Ticket Notice</b><br>Carriage and other services provided by the carrier are subject to conditions of carriage which are hereby incorporated by reference.These conditions may be obtained from the issuing carrier.</td>
                </tr>
                <tr>
                    <td><b>Passport/Visa/Health</b><br>Please ensure that you have all the required travel documents for your entire journey - i.e. valid passport & necessary Visas - and that you have had the recommended vaccinations / immunizations for your destination(s)</td>
                </tr>
                <tr>
                    <td><b>Carry-on Baggage Allowance</b><br>LIMIT: 1 Carry-On bag per passenger / SIZE LIMIT: 22in x 15in x 8in (L+W+H=45 inches) / WEIGHT LIMIT: Max weight 7 kg / 15 lb</td>
                </tr>
                <tr>
                    <td><b>Reporting Time</b><br>Flights open for check-in 1 hour before scheduled departure time on domestic flights and 3 hours before scheduled departure time on international flights.Passengers must check-in 1 hour before flight departure.Check -in counters close 30 minutes before flight departure for domestic, and 90 minutes before the scheduled departure for international flights.</td>
                </tr>
            </tbody>
        </table>

    </div>
    <script>
    // Ensure the library is loaded (e.g., html2pdf.js)
    document.addEventListener('DOMContentLoaded', () => {
        const generatePDF = () => {
            // Use the container as content for the PDF
            const content = document.querySelector('.container');
            if (content) {
                html2pdf().from(content).set({
                    margin: 10,
                    filename: 'IssueTicket.pdf',
                    html2canvas: { scale: 2 }, // Optional: Better resolution
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                }).save();
            } else {
                console.error('Container element not found');
            }
        };

        // Bind PDF generation to a button click (if needed)
        document.getElementById('generatePDFBtn')?.addEventListener('click', generatePDF);

        // Print button functionality
        document.getElementById('printBtn')?.addEventListener('click', () => {
            window.print(); // Open browser print dialog
        });
    });
</script>
</body>
</html>
