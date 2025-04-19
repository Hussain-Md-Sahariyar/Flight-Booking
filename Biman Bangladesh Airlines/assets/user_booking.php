<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection details
$host = "localhost"; 
$username = "root";  
$password = "";      
$dbname = "airlinesystem"; 

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch booking data
$sql = "SELECT * FROM booking_oneway";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Bookings</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <!-- Include FontAwesome for the edit icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #121212;
      color: #e0e0e0;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }
    .header {
      background-color: #1f1f1f;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 20px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    .header h4 {
      font-size: 24px;
      color: #ffffff;
    }
    .header .btn {
      background-color: #00bcd4;
      color: white;
      border: none;
      border-radius: 5px;
      padding: 10px 20px;
      font-size: 16px;
    }
    .header .btn:hover {
      background-color: #007f8c;
    }
    .sidebar {
      position: fixed;
      top: 80px;
      left: 0;
      background-color: #2c2f36;
      width: 250px;
      height: calc(100vh - 80px);
      color: #e0e0e0;
      padding: 35px;
      overflow-y: auto;
      z-index: 0;
    }
    .sidebar a {
      text-decoration: none;
      font-weight: 500;
      color: #e0e0e0;
      margin-bottom: 15px;
      display: block;
      transition: color 0.3s;
    }
    .sidebar a:hover {
      color: #00bcd4;
    }
    .section-title {
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 20px;
      color: #00bcd4;
      text-align: center;
    }
    .info-block {
      background: #1f1f1f;
      border: 1px solid #333;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 15px;
    }
    .info-block p {
      color: #e0e0e0;
    }
    .edit-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      border: none;
      background-color: #2c2f36;
      color: #00bcd4;
      font-size: 18px;
      border-radius: 8px;
      padding: 8px 12px;
      display: flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s, color 0.3s;
    }
    .edit-btn:hover {
      background-color: #00bcd4;
      color: #ffffff;
    }
    .edit-btn i {
      font-size: 16px;
    }
    .content {
      display: flex;
      flex-direction: row;
    }
    .main-content {
      margin-left: 250px;
      padding: 20px;
      flex: 1;
    }
    .table-container {
      background-color: #1f1f1f;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      margin-top: 30px;
    }
    .table {
      border-radius: 10px;
      overflow: hidden;
    }
    .table th {
      
      color: white;
      text-align: center;
      font-weight: bold;
    }
    .table td {
      
      text-align: center;
      color: #e0e0e0;
    }
      .modal-title {
          font-weight: bold;
          color: #800020;
      }
      .modal-body {
          color: black;
      }
  </style>
</head>
<body>
  <!-- Header Navbar -->
  <div class="header">
    <a class="navbar-brand" href="index.php">
      <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Biman Bangladesh Airlines" width="250">
    </a>
    <button class="btn" onclick="window.location.href='login.php'">Sign Out</button>
  </div>

  <!-- Content Area -->
  <div class="content">
    <!-- Sidebar -->
    <div class="sidebar">
      <p><br /></p>
      <a href="user.php">My Profile</a>
      <a href="user_booking.php">Bookings</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="container mt-3">
        <div class="table-container">
          <h3 class="section-title">Bookings Overview</h3>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Booking ID</th>
                <th>Booking Date</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Price</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                  // Output each row
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['booking_id'] . "</td>";
                      echo "<td>" . $row['booking_date'] . "</td>";
                      echo "<td>" . $row['flying_from'] . "</td>";
                      echo "<td>" . $row['flying_to'] . "</td>";
                      echo "<td>" . $row['first_name'] . "</td>";
                      echo "<td>" . $row['last_name'] . "</td>";
                      echo "<td>" . number_format($row['price']) . "/-</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='7'>No bookings found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

    

  <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
