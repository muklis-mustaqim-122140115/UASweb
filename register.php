<?php
// Start the session
session_start();

// Example of setting the error message
// $_SESSION["error"] = "Invalid username or password.";

// Check if an error exists and store it in a variable
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : null;

// Clear the error after displaying it
unset($_SESSION["error"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        .text-danger {
            display: none;
        }
    </style>
</head>
<body class="container py-4">
    <h2>Register</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <!-- Display server-side error or success messages -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <form onsubmit="return validateForm();" method="post" action="server.php?action=registerUser">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" id="username" name="username" class="form-control">
            <div id="usernameError" class="text-danger">Username is required.</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control">
            <div id="emailError" class="text-danger">Please enter a valid email address.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control">
            <div id="passwordError" class="text-danger">Password is required.</div>
        </div>
        <div class="mb-3">
            <label for="passwordAgain" class="form-label">Password Again:</label>
            <input type="password" id="passwordAgain" name="passwordAgain" class="form-control">
            <div id="passwordAgainError" class="text-danger">Passwords do not match.</div>
        </div>
        <div class="mb-3">
            <input type="checkbox" id="terms" name="terms">
            <label for="terms">I agree with the terms of service</label>
            <div id="termsError" class="text-danger">You must agree to the terms of service.</div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <p class="text-center mt-3">
                Already have an account? <a href="login.php">Log In</a>
        </p>
    </form>
    <script>
        function validateForm() {
            let isValid = true;
            // Get form values
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const passwordAgain = document.getElementById('passwordAgain');
            const terms = document.getElementById('terms');

            // Get error elements
            const usernameError = document.getElementById('usernameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const passwordAgainError = document.getElementById('passwordAgainError');
            const termsError = document.getElementById('termsError');

            // Reset error messages
            usernameError.style.display = 'none';
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            passwordAgainError.style.display = 'none';
            termsError.style.display = 'none';

            // Username validation
            if (username.value.trim() === '') {
                usernameError.style.display = 'block';
                isValid = false;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() === '' || !emailPattern.test(email.value)) {
                emailError.style.display = 'block';
                isValid = false;
            }

            // Password validation
            if (password.value.trim() === '') {
                passwordError.style.display = 'block';
                isValid = false;
            }

            // Confirm password validation
            if (passwordAgain.value.trim() === '' || password.value !== passwordAgain.value) {
                passwordAgainError.style.display = 'block';
                isValid = false;
            }

            // Terms validation
            if (!terms.checked) {
                termsError.style.display = 'block';
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>
