<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Login</h2>

    <!-- Menampilkan pesan kesalahan jika ada -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <form id="loginForm" method="post" action="server.php?action=login">
    <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" id="username" name="username" class="form-control">
        <div id="usernameError" class="text-danger" style="display: none;">Username is required.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" name="password" class="form-control">
        <div id="passwordError" class="text-danger" style="display: none;">Password is required.</div>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-secondary">Register</a>
</form>

    <script>
    // JavaScript validation
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Get the form inputs
        const username = document.getElementById('username');
        const password = document.getElementById('password');

        // Error elements
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');

        // Reset error messages
        usernameError.style.display = 'none';
        passwordError.style.display = 'none';

        // Validate username
        if (username.value.trim() === '') {
            usernameError.style.display = 'block';
            isValid = false;
        }

        // Validate password
        if (password.value.trim() === '') {
            passwordError.style.display = 'block';
            isValid = false;
        }

        // Prevent form submission if invalid
        if (!isValid) {
            event.preventDefault();
        }
    });
</script>
</body>
</html>
