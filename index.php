<?php
require 'server.php'; // Mengimpor file server.php untuk memuat fungsi-fungsi penting, seperti CRUD data.

// Validasi jika user belum login
if (!isset($_SESSION['user'])) { // Mengecek apakah sesi 'user' sudah di-set.
    header('Location: login.php'); // Jika tidak, redirect ke halaman login.
    exit; // Menghentikan eksekusi script setelah redirect.
}

// Panggil fungsi untuk mendapatkan data mahasiswa
$mahasiswa = getMahasiswa(); // Memanggil fungsi dari server.php untuk mendapatkan data mahasiswa dalam bentuk array.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Aqim 122140115</title>
    <link rel="stylesheet" href="styles.css"> <!-- Mengimpor file CSS eksternal untuk styling. -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css"> <!-- Mengimpor Bootstrap untuk styling responsif. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS untuk fitur interaktif. -->
</head>
<body class="container py-4"> <!-- Memberikan kelas Bootstrap untuk margin dan padding. -->
    <h2>Welcome, <?php echo ($_SESSION["user"]["username"]); ?></h2> <!-- Menampilkan username pengguna yang login. -->

    <!-- Form logout -->
    <form method="POST" action="server.php?action=logout">
        <button type="submit" class="btn btn-danger mb-4">Logout</button><!-- Tombol untuk logout. -->
    </form>

    <!-- Tombol toggle untuk dark mode -->
    <button type="button" class="my-3" id="darkModeToggle">Dark Mode</button>

    <!-- Form untuk menambahkan data mahasiswa -->
    <h3>Tambah Data Mahasiswa</h3>
    <form method="POST" action="server.php?action=addMahasiswa" enctype="multipart/form-data" class="mb-4">
         <!-- Semua yang dibawah ini untuk menginputkan Nim, Nama, Prodi, Tempat tanggal lahir, Tempat tinggal, Keahlian dan gambar -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi</label>
            <input type="text" name="prodi" id="prodi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tempat_tinggal" class="form-label">Tempat Tinggal</label>
            <input type="text" name="tempat_tinggal" id="tempat_tinggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="keahlian" class="form-label">Keahlian</label>
            <input type="text" name="keahlian" id="keahlian" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button> <!-- Tombol submit form -->
    </form>

    <!-- Tabel data mahasiswa -->
    <h3>Data Mahasiswa</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Tinggal</th>
                <th>Keahlian</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($mahasiswa)) { // Mengecek apakah ada data mahasiswa.
                foreach ($mahasiswa as $key => $row) { // Looping melalui setiap data mahasiswa.
                    echo "<tr>";
                    echo "<td>" . ($key + 1) . "</td>"; // Menampilkan nomor urut.
                    echo "<td>" . htmlspecialchars($row['mahasiswa_nim']) . "</td>"; // Menampilkan NIM.
                    echo "<td>" . htmlspecialchars($row['mahasiswa_nama']) . "</td>"; // Menampilkan Nama.
                    echo "<td>" . htmlspecialchars($row['mahasiswa_prodi']) . "</td>"; // Menampilkan Prodi.
                    echo "<td>" . htmlspecialchars($row['mahasiswa_tanggal_lahir']) . "</td>"; // Menampilkan Tanggal Lahir.
                    echo "<td>" . htmlspecialchars($row['mahasiswa_tempat_tinggal']) . "</td>"; // Menampilkan Tempat Tinggal.
                    echo "<td>" . htmlspecialchars($row['mahasiswa_keahlian']) . "</td>"; // Menampilkan Keahlian.
                    echo "<td><img src='" . htmlspecialchars($row['mahasiswa_gambar']) . "' alt='Gambar Mahasiswa' class='img-thumbnail' style='width: 100px;'></td>"; // Menampilkan Gambar.
                    echo "<td>";
                    // Tombol Edit dan Hapus
                    echo "<form style='all: unset;' class='d-flex justify-content-center' action='server.php?action=deleteMahasiswa&id=" . $row['id'] . "' method='post' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>";
                    echo "<button type='button' class='btn btn-warning btn-sm me-2' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Edit</button>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Hapus</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";

                    // Modal untuk form edit data mahasiswa
                    echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>";
                    echo "  <div class='modal-dialog'>";
                    echo "    <div class='modal-content'>";
                    echo "      <div class='modal-header'>";
                    echo "        <h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Edit Data Mahasiswa</h5>";
                    echo "        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                    echo "      </div>";
                    echo "      <form style='all: unset;' method='POST' action='server.php?action=editMahasiswa' enctype='multipart/form-data'>";
                    echo "        <div class='modal-body'>";
                    echo "          <input type='hidden' name='id' value='" . $row['id'] . "'>"; // Input hidden untuk ID mahasiswa
                    echo "          <div class='mb-3'>";
                    echo "            <label for='nim' class='form-label'>NIM</label>";
                    echo "            <input type='text' name='nim' id='nim' class='form-control' value='" . htmlspecialchars($row['mahasiswa_nim']) . "' required>";
                    echo "          </div>";
                    echo "          <div class='mb-3'>";
                    echo "            <label for='nama' class='form-label'>Nama</label>";
                    echo "            <input type='text' name='nama' id='nama' class='form-control' value='" . htmlspecialchars($row['mahasiswa_nama']) . "' required>";
                    echo "          </div>";
                    echo "          <div class='mb-3'>";
                    echo "            <label for='prodi' class='form-label'>Prodi</label>";
                    echo "            <input type='text' name='prodi' id='prodi' class='form-control' value='" . htmlspecialchars($row['mahasiswa_prodi']) . "' required>";
                    echo "          </div>";
                    echo "          <div class='mb-3'>";
                    echo "            <label for='tanggal_lahir' class='form-label'>Tanggal Lahir</label>";
                    echo "            <input type='date' name='tanggal_lahir' id='tanggal_lahir' class='form-control' value='" . htmlspecialchars($row['mahasiswa_tanggal_lahir']) . "' required>";
                    echo "          </div>";
                    echo "          <div class='mb-3'>";
                    echo "            <label for='tempat_tinggal' class='form-label'>Tempat Tinggal</label>";
                    echo "            <input type='text' name='tempat_tinggal' id='tempat_tinggal' class='form-control' value='" . htmlspecialchars($row['mahasiswa_tempat_tinggal']) . "' required>";
                    echo "          </div>";
                    echo "          <div class='mb-3'>";
                    echo "            <label for='keahlian' class='form-label'>Keahlian</label>";
                    echo "            <input type='text' name='keahlian' id='keahlian' class='form-control' value='" . htmlspecialchars($row['mahasiswa_keahlian']) . "' required>";
                    echo "          </div>";
                    echo "          <div class='mb-3'>";
                    echo "            <label for='gambar' class='form-label'>Upload Gambar Baru</label>";
                    echo "            <input type='file' name='gambar' id='gambar' class='form-control' accept='image/*'>";
                    echo "          </div>";

                    // ... input lainnya untuk edit data mahasiswa.
                    echo "        </div>";
                    echo "        <div class='modal-footer'>";
                    echo "          <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
                    echo "          <button type='submit' class='btn btn-primary'>Save changes</button>";
                    echo "        </div>";
                    echo "      </form>";
                    echo "    </div>";
                    echo "  </div>";
                    echo "</div>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No data available</td></tr>"; // Pesan jika data kosong.
            }
            ?>
        </tbody>
    </table>
    <script>
    // JavaScript untuk toogle tombol dark mode
    const toggleButton = document.getElementById('darkModeToggle');
    const body = document.body;

    // Fungsi untuk set cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Mengatur masa aktif cookie.
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    // Fungsi untuk mendapatkan cookie
    function getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    }

    // Aktifkan dark mode jika cookie di-set
    if (getCookie('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    // Toggle dark mode saat tombol diklik
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        
        // Save the mode to a cookie
        if (body.classList.contains('dark-mode')) {
            setCookie('darkMode', 'enabled', 7);  // Simpan dark mode dalam cookie 7 hari.
        } else {
            setCookie('darkMode', 'disabled', 7); // Nonaktifkan dark mode.
        }
    });
</script>
</body>
</html>
