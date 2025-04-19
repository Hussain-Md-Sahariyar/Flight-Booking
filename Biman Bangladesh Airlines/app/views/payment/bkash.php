<!-- app/views/payment/bkash.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
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
      text-align: center;
      border-bottom: 6px solid #C21E56;
    }
    .merchant-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 30px;
      border-bottom: solid #f0f0f0;
    }
    .merchant-logo { width: 50px; margin-right: 10px; }
    .amount { font-size: 36px; color: #953553; font-weight: bold; }
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
      margin: 5px 0 20px;
      border-radius: 5px;
      border: 1px solid #ddd;
      text-align: center;
    }
    .buttons {
      display: flex;
      justify-content: space-between;
      height: 60px;
    }
    .btn-clos, .btn-confirm {
      flex: 1;
      padding: 15px 0;
      font-size: 18px;
      font-weight: bold;
      background-color: #D3D3D3;
      border: none;
      cursor: pointer;
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
    <img src="images/bg_logo.png" class="merchant-logo" alt="Biman">
    <div>
      <div class="fw-bold">BIMAN BANGLADESH AIRLINES</div>
      <div class="text-muted">Invoice: <?= $invoice ?></div>
    </div>
    <div class="amount">৳<?= $price ?></div>
  </div>

  <form method="POST" action="index.php?action=pinVerify">
    <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
    <input type="hidden" name="price" value="<?= $price ?>">
    <input type="hidden" name="invoice" value="<?= $invoice ?>">

    <div class="form-section">
      <label for="phone" class="form-label" style="font-size: 20px;">Your bKash Number</label>
      <input type="text" name="phone" id="phone" required placeholder="e.g. 01XXXXXXXXX">
      <div class="terms">By clicking <b>Confirm</b>, you agree to the <a href="#"><b>terms</b></a></div>
    </div>

    <div class="buttons">
      <button type="submit" class="btn-confirm">CONFIRM</button>
      <div class="separator"></div>
      <button type="button" class="btn-clos" onclick="history.back();">CLOSE</button>
    </div>
  </form>
</div>

</body>
</html>
