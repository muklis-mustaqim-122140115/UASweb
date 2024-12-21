<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script>
        function validateForm() {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordAgain = document.getElementById('passwordAgain').value;
            if (username === '' || email === '' || password === '' || passwordAgain === '') {
                alert('All fields must be filled out.');
                return false;
            }
            if (password !== passwordAgain) {
                alert('Passwords do not match.');
                return false;
            }
            return true;
        }
    </script>
</head>
<body class="container py-4">
    <h2>Register</h2>

    <!-- Menampilkan pesan kesalahan atau keberhasilan -->
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
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="passwordAgain" class="form-label">Password Again:</label>
            <input type="password" id="passwordAgain" name="passwordAgain" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="checkbox" id="terms" name="terms" required>
            <label for="terms">I agree with the terms of service</label>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        <a href="login.php" class="btn btn-secondary">Login</a>
    </form>
</body>
</html>
