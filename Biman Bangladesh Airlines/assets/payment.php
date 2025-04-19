<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airlinesystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate GET parameters
if (isset($_GET['booking_id']) && isset($_GET['price'])) {
    $booking_id = $_GET['booking_id'];
    $price = $_GET['price'];
    $invoice = 'D' . uniqid(); // Generate a unique invoice number
} else {
    die("Invalid request.");
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>bKash Payment</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
      body {
          background-color: #f5f5f5;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
      }

      .payment-container {
          background-color: #ffffff;
          width: 550px;
          height: 500px;
          border-radius: 10px;
          box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
          overflow: hidden;
          font-family: Arial, sans-serif;
          display: flex;
          flex-direction: column;
      }

      .header {
          background-color: #FFFFFF;
          color: white;
          padding: 10px;
          text-align: center;
          font-size: 24px;
          font-weight: bold;
          border-bottom: 6px solid #C21E56;
      }

      .merchant-info {
          display: flex;
          align-items: center;
          justify-content: center;
          padding: 30px;
          border-bottom: solid #f0f0f0;
          text-align: left;
      }

      .merchant-logo {
          width: 50px;
          object-fit: contain;
          margin-right: 10px;
      }

      .merchant-details {
          margin-right: auto;
      }

      .merchant-name {
          font-size: 16px;
          font-weight: bold;
          color: #333;
      }

      .invoice {
          font-size: 14px;
          color: #666;
          margin-bottom: 0;
      }

      .amount {
          font-size: 36px;
          color: #953553;
          font-weight: bold;
          text-align: right;
      }

      .form-section {
          padding: 40px 50px; 
          background-color: #E0115F;
          text-align: center;
          color: white;
          display: flex;
          flex-direction: column;
          align-items: center;
      }

          .form-section input {
              width: 100%;
              padding: 8px;
              font-size: 30px;
              font-weight: bold;
              margin-top: 5px;
              margin-bottom: 20px;
              border-radius: 5px;
              border: 1px solid #ddd;
              text-align: center;
          }

          .form-section .terms {
              font-size: 14px;
              margin-top: 3px;
              text-align: center;
          }

              .form-section .terms a {
                  color: white;
                  text-decoration: underline;
              }

      .buttons {
          display: flex;
          align-items: center;
          justify-content: space-between;
          height: 60px; 
      }


      .btn-clos,
      .btn-confirm {
          flex: 1;
          padding: 15px 0;
          font-size: 18px;
          text-align: center;
          cursor: pointer;
          border: none;
          font-weight: bold;
          color: #000000; 
          background-color: #D3D3D3; 
          position: relative;
          overflow: hidden; 
      }

     
      .ripple {
          position: absolute;
          width: 10px;
          height: 10px;
          background: rgba(128, 128, 128, 0.5); 
          border-radius: 50%;
          transform: scale(0);
          animation: ripple-animation 0.6s linear;
      }

     
      @keyframes ripple-animation {
          to {
              transform: scale(10);
              opacity: 0;
          }
      }

      .separator {
          width: 1px; 
          background-color: #E0115F; 
          height: 100%; 
      }

  </style>
</head>
<body>

<div class="payment-container">
  <div class="header">
     <img src="images/bkash.png" alt="Bkash" width="150"> 
  </div>

      <div class="merchant-info">
    <img src="images/bg_logo.png" alt="Biman Bangladesh Airlines" class="merchant-logo">
    <div class="merchant-details">
      <div class="merchant-name">BIMAN BANGLADESH AIRLINES</div>
      <div class="invoice">Invoice: <?php echo $invoice; ?></div>
    </div>
    <div class="amount">৳<?php echo $price; ?></div>
  </div>

  <form action="pin.php" method="GET">
    <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
    <input type="hidden" name="price" value="<?php echo $price; ?>">
    <input type="hidden" name="invoice" value="<?php echo $invoice; ?>">
    
      <div class="form-section">
      <label for="phone" class="form-label" style="font-size: 20px;">Your bKash Account number</label>
    <input type="text" name="phone" id="phone" placeholder="e.g 01XXXXXXXXX">
    <div class="terms">By clicking on <b>Confirm</b>, you are agreeing to the <a href="#"><b>terms & conditions</b></a></div>
    </div>
    <div class="buttons">
      <button type="submit" class="btn-confirm">CONFIRM</button>
        <div class="separator"></div> <!-- Box between buttons -->
      <button type="button" class="btn-clos" onclick="window.history.back();">CLOSE</button>
    </div>
  </form>
</div>
    <script>
  // Function to create the ripple effect
  document.querySelectorAll('.btn-clos, .btn-confirm').forEach(button => {
    button.addEventListener('click', function (e) {
      const ripple = document.createElement('span');
      ripple.classList.add('ripple');
      // Position the ripple element at the click point
      ripple.style.left = `${e.clientX - button.offsetLeft}px`;
      ripple.style.top = `${e.clientY - button.offsetTop}px`;
      button.appendChild(ripple);

      // Remove the ripple element after animation ends
      ripple.addEventListener('animationend', () => {
        ripple.remove();
      });
    });
  });
</script>

</body>
</html>
