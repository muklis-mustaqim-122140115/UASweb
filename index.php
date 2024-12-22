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
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</head>
<body class="container py-4">
    <h2>Welcome, <?php echo ($_SESSION["user"]["username"]); ?></h2>

    <form method="POST" action="server.php?action=logout">
        <button type="submit" class="btn btn-danger mb-4">Logout</button>
    </form>

    <h3>Tambah Data Mahasiswa</h3>
    <form method="POST" action="server.php?action=addMahasiswa" enctype="multipart/form-data" class="mb-4">
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
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    <button id="darkModeToggle">Toggle Dark Mode</button>
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
            if (!empty($mahasiswa)) {
                foreach ($mahasiswa as $key => $row) {
                    echo "<tr>";
                    echo "<td>" . ($key + 1) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_nim']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_prodi']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_tanggal_lahir']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_tempat_tinggal']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['mahasiswa_keahlian']) . "</td>";
                    echo "<td><img src='" . htmlspecialchars($row['mahasiswa_gambar']) . "' alt='Gambar Mahasiswa' class='img-thumbnail' style='width: 100px;'></td>";
                    echo "<td>";
                    echo "<form class='d-flex justify-content-center' action='server.php?action=deleteMahasiswa&id=" . $row['id'] . "' method='post' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>";
                    echo "<button class='btn btn-warning btn-sm me-2' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>Edit</button>";
                    echo "<button type='submit' class='btn btn-danger btn-sm'>Hapus</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";

                    // Modal for editing data
                    echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>";
                    echo "  <div class='modal-dialog'>";
                    echo "    <div class='modal-content'>";
                    echo "      <div class='modal-header'>";
                    echo "        <h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Edit Data Mahasiswa</h5>";
                    echo "        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                    echo "      </div>";
                    echo "      <form method='POST' action='server.php?action=editMahasiswa' enctype='multipart/form-data'>";
                    echo "        <div class='modal-body'>";
                    echo "          <input type='hidden' name='id' value='" . $row['id'] . "'>";
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
                echo "<tr><td colspan='9' class='text-center'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <script>
    // JavaScript for toggling dark mode using cookies
    const toggleButton = document.getElementById('darkModeToggle');
    const body = document.body;

    // Function to set a cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Set cookie expiration
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    // Function to get a cookie by name
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

    // Check if dark mode is enabled from the cookie
    if (getCookie('darkMode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    // Toggle dark mode on button click and save preference in cookie
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        
        // Save the mode to a cookie
        if (body.classList.contains('dark-mode')) {
            setCookie('darkMode', 'enabled', 7);  // Save for 7 days
        } else {
            setCookie('darkMode', 'disabled', 7);
        }
    });
</script>
</body>
</html>
