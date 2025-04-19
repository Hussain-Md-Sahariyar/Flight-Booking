<!-- app/views/booking/form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: url('images/back.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .booking-form {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 1000px;
            margin: 30px auto;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-continue {
            background-color: #d22630;
            color: white;
            border: none;
            font-size: 1.1rem;
            width: 100%;
            margin-top: 20px;
        }

        .btn-continue:hover {
            background-color: #b91d29;
        }

        .total-cost {
            background-color: #ffe3e3;
            font-weight: bold;
            padding: 10px;
            border-radius: 8px;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="booking-form">
    <h4 class="mb-4 text-center">Traveler Details</h4>

    <form action="index.php?action=submitBooking" method="POST" id="travellerForm">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="title" class="form-label">Title</label>
                <select name="title" id="title" class="form-control" required>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="first_name" class="form-label">First Name</label>
                <input name="first_name" id="first_name" class="form-control" required />
            </div>
            <div class="col-md-4">
                <label for="last_name" class="form-label">Last Name</label>
                <input name="last_name" id="last_name" class="form-control" required />
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required />
            </div>
            <div class="col-md-4">
                <label for="passport_no" class="form-label">Passport No</label>
                <input type="text" name="passport_no" id="passport_no" class="form-control" required />
            </div>
            <div class="col-md-4">
                <label for="passport_expiry_date" class="form-label">Passport Expiry Date</label>
                <input type="date" name="passport_expiry_date" id="passport_expiry_date" class="form-control" required />
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <label for="country" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="country" name="country" required />
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required />
            </div>
            <div class="col-md-4">
                <label for="contact" class="form-label">Contact Number</label>
                <input type="text" class="form-control" id="contact" name="contact" required />
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" name="continue" class="btn btn-continue">Continue</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Set max DOB to 12 years ago
        const today = new Date();
        const dobMaxDate = new Date(today.getFullYear() - 12, today.getMonth(), today.getDate());
        document.getElementById("date_of_birth").setAttribute("max", dobMaxDate.toISOString().split("T")[0]);

        // Set min expiry date to 6 months from now
        const expiryMinDate = new Date(today.getFullYear(), today.getMonth() + 6, today.getDate());
        document.getElementById("passport_expiry_date").setAttribute("min", expiryMinDate.toISOString().split("T")[0]);

        // Force numbers in contact input
        const contactInput = document.getElementById("contact");
        contactInput.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, "");
        });
    });
</script>

</body>
</html>
