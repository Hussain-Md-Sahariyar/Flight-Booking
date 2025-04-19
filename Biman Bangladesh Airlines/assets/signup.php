<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biman Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
       
        body, html {
            background-color: #f8f9fa;
            margin: 0;
            font-family: 'OutFit', sans-serif;
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
            max-width: 100%;
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem;
            overflow: auto; 
        }

        .form-label {
            font-weight: 700;
            color: #6c757d;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            border-radius: 5px;
            font-weight: 600;
        }

        .btn-custom {
            background-color: #770737;
            color: #fff;
            border: 2px solid #770737;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

            .btn-custom:hover {
                background-color: #fff;
                color: #770737;
                border-color: #770737;
            }

      
        .mobile-input {
            display: flex;
            align-items: center; 
            justify-content: center; 
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
                <p style="font-size: 30px; font-weight: 600; color: #301934; margin-bottom: 0px;">Customer Registration</p>
                <p style="font-size: 12px; font-weight: 600; color: #301934; margin-bottom: 10px;">Please Make Sure That All Information Are Correct</p>
            </div>
            <form id="signupForm">
                <div class="row row-custom">
                    <div class="col">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter Your First Name" required>
                    </div>
                    <div class="col">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter Your Last Name" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter Your Address" required>
                </div>
                <div class="row row-custom">
                    <div class="col">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter Your City" required>
                    </div>
                    <div class="col">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" placeholder="Country Name" required>
                    </div>
                    <div class="col">
                        <label for="postalCode" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postalCode" placeholder="Enter Your Postal Code" required>
                    </div>
                </div>
                <div class="mb-3 mobile-input">
                    <label for="mobile" class="form-label me-2 mt-1">Mobile</label>
                    <select class="form-control country-code" id="countryCode" required>
                        <option value="" disabled selected>Select Country Code</option>
                        <option value="+1">+1</option>
                        <option value="+44">+44</option>
                        <option value="+91">+91</option>
                      
                    </select>
                    <input type="text" class="form-control" id="phoneNumber" placeholder="Enter Your Phone Number" required>
                </div>
                <div class="row row-custom">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter Your Password" required>
                    </div>
                </div>
                <button type="submit" class="btn-custom w-100">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
    $('form').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = {
            firstName: $('#firstName').val(),
            lastName: $('#lastName').val(),
            address: $('#address').val(),
            city: $('#city').val(),
            country: $('#country').val(),
            postalCode: $('#postalCode').val(),
            countryCode: $('#countryCode').val(),
            phoneNumber: $('#phoneNumber').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        // Check if the email already exists
        $.ajax({
            url: 'checkEmail.php', // Backend script to check email
            type: 'POST',
            data: { email: formData.email },
            success: function (response) {
                if (response === 'exists') {
                    // Show error message and prevent submission
                    alert('This email is already registered. Please use a different email.');
                } else {
                    // If email does not exist, proceed with form submission
                    $.ajax({
                        url: 'signupData.php', // Backend script to save user data
                        type: 'POST',
                        data: formData,
                        success: function () {
                            alert('Form data saved successfully!');
                            window.location.href = 'login.php'; // Redirect to signin.php
                        },
                        error: function (xhr, status, error) {
                            alert('An error occurred: ' + error);
                        }
                    });
                }
            },
            error: function (xhr, status, error) {
                alert('An error occurred while checking the email: ' + error);
            }
        });
    });
});

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Clear the form when the page loads
    const form = document.getElementById("signupForm");
    form.reset();

    // Enforce numeric input for Postal Code
    const postalCodeInput = document.getElementById("postalCode");
    postalCodeInput.addEventListener("input", function (event) {
        this.value = this.value.replace(/[^0-9]/g, ""); // Remove non-numeric characters
    });

    // Enforce numeric input for Phone Number
    const phoneNumberInput = document.getElementById("phoneNumber");
    phoneNumberInput.addEventListener("input", function (event) {
        this.value = this.value.replace(/[^0-9]/g, ""); // Remove non-numeric characters
    });
});

    </script>

</body>
</html>