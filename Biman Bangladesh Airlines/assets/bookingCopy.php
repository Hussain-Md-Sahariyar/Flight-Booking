<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if required parameters are provided in the URL
if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Prepare and execute the query to fetch flight details
    $stmt = $conn->prepare("SELECT * FROM booking_oneway WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();
        // Determine gender based on title
        if (strtolower($booking['title']) === "mr") {
            $gender = "Male";
        } else {
            $gender = "Female";
        }
    } else {
        die("Booking not found.");
    }
    $stmt->close();
} else {
    die("Booking ID not specified.");
}

// Check if the cancel booking button was clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking'])) {
    $booking_id = $_POST['booking_id'];

    // Delete the booking record
    $query = "DELETE FROM booking_oneway WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        // Redirect to index.php after successful deletion
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Could not delete booking.";
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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

      
        .contact-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            table-layout: fixed; 
        }

         
            .contact-table thead th {
                background-color: #f0f0f0;
                color: #000;
                font-weight: bold;
                font-size: 17px;
                text-align: left;
                padding: 10px;
                border: 1px solid #e0e0e0; 
            }

       
            .contact-table td {
                padding: 10px;
                font-size: 14px;
                color: #000;
                border: 1px solid #e0e0e0; 
                text-align: center; 
                vertical-align: middle;
            }

      
        .bold-text {
            font-weight: bold;
            color: #000;
        }



        .action-buttons {
            display: flex;
            justify-content: center;
            margin-top: 60px;
        }

            .action-buttons button {
                background-color: #008080;
                color: #fff;
                padding: 10px 30px;
                margin: 0 10px;
                border: none;
                border-radius: 10px;
                cursor: pointer;
                font-size: 16px;
                font-weight: bold;
                font-family: Poppins, sans-serif;
            }

                .action-buttons button.cancel {
                    background-color: #dc3545;
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
                Booking Details
            </div>
        </div>

        <table class="booking-table">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th colspan="4">BOOKING CONFIRMED</th>
                </tr>
            </thead>
            <!-- Table Body with Rows and Columns -->
            <tbody>
                <tr>
                    <td class="bold-text">Booking Date:</td>
                    <td><?php echo $booking['booking_date']; ?></td>
                    <td class="bold-text">Booking ID:</td>
                    <td>BGL<?php echo $booking['booking_id']; ?></td>
                </tr>
                <tr>
                    <td class="bold-text">Issue Before:</td>
                    <td class="red-text"><?php echo $booking['issue_before']; ?></td>
                    <td class="bold-text">Booking Reference:</td>
                    <td><?php echo $booking['booking_reference']; ?></td>
                </tr>
                <tr>
                    <td class="bold-text">Booking Status:</td>
                    <td>Booked</td>
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

        <table class="contact-table">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th colspan="2">CONTACT DETAILS</th>
                </tr>
            </thead>
            <!-- Table Body with Rows and Columns -->
            <tbody>
                <tr>
                    <td class="bold-text">DEPARTS</td>
                    <td class="bold-text">PHONE NUMBER</td>
                </tr>
                <tr>
                    <td><?php echo $booking['flying_from']; ?></td>
                    <td>+880<?php echo $booking['contact']; ?></td>
                </tr>
            </tbody>
        </table>


        <div class="action-buttons">
    <form action="payment.php" method="GET" style="display: inline;">
        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
        <input type="hidden" name="price" value="<?php echo $booking['price']; ?>">
        <button type="submit" class="issue">Issue Ticket</button>
    </form>
    <form action="" method="POST" style="display: inline;">
        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
        <button type="submit" name="cancel_booking" class="cancel">Cancel Booking</button>
    </form>
</div>


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
                    filename: 'BookingDetails.pdf',
                    html2canvas: { scale: 2 }, // Optional: Better resolution
                    jsPDF: { unit: 'mm', format: 'a3', orientation: 'portrait' }
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