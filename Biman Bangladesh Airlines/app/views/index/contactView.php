<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Biman Bangladesh Airlines</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('../images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Outfit', sans-serif;
        }
        .contact-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 30px;
            margin-top: 80px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .contact-title {
            color: #097969;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-control:focus {
            border-color: #097969;
            box-shadow: 0 0 5px #097969;
        }
        .btn-custom {
            background-color: #097969;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container col-md-6 contact-container">
    <h2 class="contact-title">Contact Us</h2>

    <?php if (!empty($response)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($response) ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Your full name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" required placeholder="Your email address">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Your Message <span class="text-danger">*</span></label>
            <textarea name="message" id="message" rows="6" class="form-control" required placeholder="Type your message here..."></textarea>
        </div>
        <button type="submit" class="btn btn-custom w-100">Send Message</button>
    </form>
</div>

</body>
</html>
