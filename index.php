<?php
require 'server.php'; // Include server.php untuk semua fungsi

// Validasi jika user belum login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Panggil fungsi untuk mendapatkan data mahasiswa
$mahasiswa = getMahasiswa();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2>Welcome, <?php echo ($_SESSION["user"]["username"]); ?></h2>

    <form method="POST" action="server.php?action=logout">
        <button type="submit" class="btn btn-danger mb-4">Logout</button>
    </form>
    
    <h3>Data Mahasiswa</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($mahasiswa)) {
                foreach ($mahasiswa as $key => $row) {
                    echo "<tr>";
                    echo "<td>" . ($key + 1) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_nim']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_prodi']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
