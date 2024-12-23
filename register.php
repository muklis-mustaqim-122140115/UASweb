<?php
// Start the session
session_start(); // Memulai sesi untuk menyimpan data pengguna sementara selama sesi aktif.

// Example of setting the error message
// $_SESSION["error"] = "Invalid username or password."; // Contoh bagaimana error message disimpan ke dalam sesi (jika ada).

// Check if an error exists and store it in a variable
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : null; // Mengecek apakah terdapat pesan error di sesi, jika ada simpan dalam variabel $error.

// Clear the error after displaying it
unset($_SESSION["error"]); // Menghapus pesan error dari sesi setelah disimpan di variabel $error untuk mencegah tampil terus-menerus.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css"> <!-- Menghubungkan file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"> <!-- Menggunakan Bootstrap untuk styling responsif -->
    <style>
        .text-danger {
            display: none; /* Default sembunyikan pesan error menggunakan CSS */
        }
    </style>
</head>
<body class="container py-4">
    <h2>Register</h2>

    <!-- Tampilkan pesan error dari sesi jika ada -->
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?> <!-- Menghindari XSS dengan htmlspecialchars -->
        </div>
    <?php endif; ?>

    <!-- Tampilkan pesan error atau sukses dari URL jika ada -->
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <!-- Form pendaftaran -->
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

    <!-- JavaScript untuk validasi form -->
    <script>
        function validateForm() {
            let isValid = true; // Flag untuk status validasi
            // Ambil elemen input
            const username = document.getElementById('username');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const passwordAgain = document.getElementById('passwordAgain');
            const terms = document.getElementById('terms');

            // Ambil elemen error
            const usernameError = document.getElementById('usernameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const passwordAgainError = document.getElementById('passwordAgainError');
            const termsError = document.getElementById('termsError');

            // Reset pesan error
            usernameError.style.display = 'none';
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            passwordAgainError.style.display = 'none';
            termsError.style.display = 'none';

            // Validasi username
            if (username.value.trim() === '') { // Jika username kosong
                usernameError.style.display = 'block'; 
                isValid = false;
            }

            // Validasi email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Pola email valid
            if (email.value.trim() === '' || !emailPattern.test(email.value)) { // Jika email kosong atau tidak valid
                emailError.style.display = 'block';
                isValid = false;
            }

            // Validasi password
            if (password.value.trim() === '') { // Jika password kosong
                passwordError.style.display = 'block';
                isValid = false;
            }

            // Validasi konfirmasi password
            if (passwordAgain.value.trim() === '' || password.value !== passwordAgain.value) { // Jika password konfirmasi tidak cocok
                passwordAgainError.style.display = 'block';
                isValid = false;
            }

            // Validasi checkbox syarat layanan
            if (!terms.checked) { // Jika checkbox tidak dicentang
                termsError.style.display = 'block';
                isValid = false;
            }

            return isValid; // Kembalikan status validasi
        }
    </script>
</body>
</html>
