<!-- app/views/auth/signup.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Biman Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body, html {
            background-color: #f8f9fa;
            margin: 0;
            font-family: 'Outfit', sans-serif;
            height: 100%;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .container-fluid {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            height: 100vh;
            padding-right: 50px;
        }

        .logo {
            position: absolute;
            top: 30px;
            left: 45px;
            width: 400px;
            height: auto;
        }

        .signup-card {
            width: 550px;
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem;
            overflow: auto;
        }

        .form-label { font-weight: 700; color: #6c757d; }
        .form-control { border-radius: 5px; }
        .btn-custom {
            background-color: #770737;
            color: #fff;
            border: 2px solid #770737;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-custom:hover {
            background-color: #fff;
            color: #770737;
            border-color: #770737;
        }

        .mobile-input {
            display: flex;
            align-items: center;
        }
        .country-code {
            width: 100px;
            margin-right: 10px;
            height: 38px;
        }
        .mobile-input input {
            height: 38px;
        }
        .row-custom {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <img src="images/Biman_Bangladesh_Airlines_Logo.png" alt="Logo" class="logo">
    <div class="signup-card shadow">
        <div class="text-center mb-4">
            <p style="font-size: 30px; font-weight: 600; color: #301934;">Customer Registration</p>
            <p style="font-size: 12px; font-weight: 600; color: #301934;">Please Make Sure That All Information Are Correct</p>
        </div>

        <form method="POST" action="index.php?action=registerUser">
            <div class="row row-custom">
                <div class="col">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstName" required>
                </div>
                <div class="col">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastName" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="address" required>
            </div>

            <div class="row row-custom">
                <div class="col">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name="city" required>
                </div>
                <div class="col">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control" name="country" required>
                </div>
                <div class="col">
                    <label class="form-label">Postal Code</label>
                    <input type="text" class="form-control" name="postalCode" required>
                </div>
            </div>

            <div class="mb-3 mobile-input">
                <label class="form-label me-2 mt-1">Mobile</label>
                <select class="form-control country-code" name="countryCode" required>
                    <option value="+880" selected>+880</option>
                    <option value="+91">+91</option>
                    <option value="+44">+44</option>
                </select>
                <input type="text" class="form-control" name="phoneNumber" required>
            </div>

            <div class="row row-custom">
                <div class="col">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="col">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>

            <button type="submit" class="btn-custom w-100">Submit</button>
        </form>
    </div>
</div>
$.ajax({
    url: 'index.php?action=registerUser',
    type: 'POST',
    data: formData,
    success: function () {
        alert('Form data saved successfully!');
        window.location.href = 'index.php?action=login';
    },
    error: function (xhr, status, error) {
        alert('An error occurred: ' + error);
    }
});

</body>
</html>
