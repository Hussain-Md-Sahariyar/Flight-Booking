<!-- app/views/admin/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biman Admin Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body, html {
            background-color: #f8f9fa;
            margin: 0;
            font-family: 'Outfit', sans-serif;
            height: 100%;
            background: url('public/assets/images/back.jpeg') no-repeat center center fixed;
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

        .login-card {
            width: 500px;
            max-width: 100%;
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem;
        }

        .form-label {
            font-weight: 700;
            color: #6c757d;
        }

        .form-control {
            border-radius: 5px;
        }

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

        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <img src="public/assets/images/Biman_Bangladesh_Airlines_Logo.png" alt="Logo" class="logo">
        <div class="login-card shadow">
            <div class="text-left mb-4">
                <p style="font-size: 20px; font-weight: 600; color: #301934;">Welcome to</p>
                <p style="font-size: 35px; font-weight: 700; color: #770737;">Biman Bangladesh Airlines</p>
            </div>
            <div class="text-left mb-4">
                <p style="font-size: 20px; font-weight: 600; color: #301934;">Sign in</p>
                <p style="font-size: 15px; font-weight: 600; color: #301934;">Sign In To Continue To The Site</p>
            </div>
            <form id="loginForm">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter Your Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter Your Password" required>
                </div>
                <div class="error-message" id="error-message"></div>
                <button type="submit" class="btn-custom w-100 mt-3">Login</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const errorMessage = document.getElementById("error-message");

            fetch("index.php?action=checkCredentials", {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
})

            .then(response => response.text())
            .then(data => {
                if (data === "success") {
                    window.location.href = "index.php?action=dashboard";
                } else {
                    errorMessage.textContent = data;
                }
            })
            .catch(() => {
                errorMessage.textContent = "An error occurred. Please try again.";
            });
        });
    </script>
</body>
</html>
