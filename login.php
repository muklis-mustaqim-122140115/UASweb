<?php
// Start the session
session_start(); // Memulai sesi untuk menyimpan data pengguna sementara selama sesi aktif.

// Contoh pengaturan pesan kesalahan
// $_SESSION["error"] = "Invalid username or password."; // Contoh bagaimana error message disimpan ke dalam sesi (jika ada).

// Periksa apakah ada eror dan simpan dalam variabel
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : null; // Mengecek apakah terdapat pesan error di sesi, jika ada simpan dalam variabel $error.

// Hapus eror setelah menampilkannya
unset($_SESSION["error"]); // Menghapus pesan error dari sesi setelah disimpan di variabel $error untuk mencegah tampil terus-menerus.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Menghubungkan file CSS eksternal untuk styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"> <!-- Bootstrap untuk styling responsif -->
</head>
<body class="container py-4"> <!-- Menggunakan Bootstrap untuk memberikan padding dan styling -->
    <h2>Login</h2>

    <!-- Menampilkan pesan error jika ada -->
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?> <!-- Menampilkan pesan error dengan menghindari karakter berbahaya (XSS). -->
        </div>
    <?php endif; ?>

    <!-- Form login dan masukkan password , semuanya terhubung dengan action pada server.php-->
    <form id="loginForm" method="post" action="server.php?action=login">
    <div class="mb-3">
        <label for="username" class="form-label">Username:</label>
        <input type="text" id="username" name="username" class="form-control">
        <div id="usernameError" class="text-danger" style="display: none;">Username is required.</div> <!-- Pesan error jika username kosong -->
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" id="password" name="password" class="form-control">
        <div id="passwordError" class="text-danger" style="display: none;">Password is required.</div> <!-- Pesan error jika password kosong -->
    </div>
    <button type="submit" class="btn btn-primary">Login</button> <!-- Tombol login -->

    <!-- Link ke halaman register -->
    <p class="text-center mt-3">
                Don't have an account? <a href="register.php">Register</a> <!-- Link untuk mendaftar jika belum punya akun -->
    </p>
</form>

    <script>//JavaScript untuk validasi form
    // Menambahkan event listener pada form saat disubmit
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        let isValid = true; // Flag untuk validasi

        // Mengambil elemen input form
        const username = document.getElementById('username');
        const password = document.getElementById('password');

        // Mengambil elemen error
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');

        // Reset pesan error
        usernameError.style.display = 'none';
        passwordError.style.display = 'none';

        // Validasi username
        if (username.value.trim() === '') {
            usernameError.style.display = 'block';
            isValid = false;
        }

        // Validasi password
        if (password.value.trim() === '') {
            passwordError.style.display = 'block';
            isValid = false;
        }

        // Mencegah pengiriman form jika validasi gagal
        if (!isValid) {
            event.preventDefault(); // Mencegah aksi submit form
        }
    });
</script>
</body>
</html>
