<?php
require 'koneksi.php';
session_start();

// Fungsi Register
function registerUser($username, $email, $password) {
    try {
        $conn = (new Koneksi())->getConnection();
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $params = [$username, $email, $hashedPassword];
        $types = "sss"; // 3 string (username, email, password)

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $_SESSION["error"] = "Error preparing statement: " . $conn->error;
            header("Location: register.php");
            exit;
        }
        $stmt->bind_param($types, ...$params);
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            $_SESSION["error"] = "Error executing query: " . $stmt->error;
            header("Location: login.php");
            exit;
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $_SESSION["error"] = $e->getMessage();
        header("Location: register.php");
        exit;
    }
}

// Fungsi Login
function loginUser($username, $password) {
    $conn = (new Koneksi())->getConnection();

    $sql = "SELECT * FROM users WHERE username = ?";
    $params = [$username];
    $types = "s"; // 1 string (username)

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $_SESSION["error"] = "Error preparing statement: " . $conn->error;
        header("Location: login.php");
        exit;
    }
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['browser'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                header("Location: index.php");
                exit;
            } else {
                $_SESSION["error"] = "Invalid Password";
                header("Location: login.php");
                exit;
            }
        } else {
            $_SESSION["error"] = "User not found.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION["error"] = "Error executing query: " . $stmt->error;
        header("Location: login.php");
        exit;
    }
    $stmt->close();
    $conn->close();
}

// Fungsi untuk Mendapatkan Data Mahasiswa
function getMahasiswa() {
    $conn = (new Koneksi())->getConnection();

    $sql = "SELECT * FROM tblMahasiswa";
    $result = $conn->query($sql);
    if (!$result) {
        die("Error retrieving data: " . $conn->error);
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $conn->close();
    return $data;
}

// Fungsi untuk Menambahkan Data Mahasiswa
function addMahasiswa($nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian) {
    $conn = (new Koneksi())->getConnection();

    // Upload file gambar
    // $gambarPath = uploadGambar($gambar);

    $sql = "INSERT INTO tblMahasiswa (mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi, mahasiswa_tanggal_lahir, mahasiswa_tempat_tinggal, mahasiswa_keahlian) VALUES (?, ?, ?, ?, ?, ?)";
    $params = [$nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian];
    $types = "ssssss";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        die("Error executing query: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
}

// Fungsi untuk Mengedit Data Mahasiswa
function editMahasiswa($id, $nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian) {
    $conn = (new Koneksi())->getConnection();

    // Jika ada gambar baru diunggah, upload file gambar dan dapatkan path-nya
    // $gambarPath = null;
    // if ($gambar && $gambar['error'] === UPLOAD_ERR_OK) {
    //     $gambarPath = uploadGambar($gambar);
    // }

    $sql = "UPDATE tblMahasiswa SET mahasiswa_nim = ?, mahasiswa_nama = ?, mahasiswa_prodi = ?, mahasiswa_tanggal_lahir = ?, mahasiswa_tempat_tinggal = ?, mahasiswa_keahlian = ?";
    $params = [$nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian];
    $types = "ssssss";

    // if ($gambarPath) {
    //     $sql .= ", mahasiswa_gambar = ?";
    //     $params[] = $gambarPath;
    //     $types .= "s";
    // }

    $sql .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        die("Error executing query: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
}

// Fungsi untuk Menghapus Data Mahasiswa
function deleteMahasiswa($id) {
    $conn = (new Koneksi())->getConnection();

    $sql = "DELETE FROM tblMahasiswa WHERE id = ?";
    $params = [$id];
    $types = "i";
    
    $stmt = $conn->prepare($sql);
    echo $stmt->execute($params);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        die("Error executing query: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
}

// Fungsi untuk Upload Gambar
// function uploadGambar($gambar) {
//     $uploadDir = 'uploads/';
//     // Pastikan folder uploads ada
//     if (!is_dir($uploadDir)) {
//         mkdir($uploadDir, 0777, true);
//     }
//     $fileName = basename($gambar['name']);
//     $targetPath = $uploadDir . uniqid() . "_" . $fileName;

//     if (!move_uploaded_file($gambar['tmp_name'], $targetPath)) {
//         die("Error uploading file.");
//     }
//     return $targetPath;
// }

// Proses berdasarkan REQUEST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'];

    switch ($action) {
        case 'registerUser':
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            registerUser($username, $email, $password);
            break;

        case 'login':
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            loginUser($username, $password);
            break;

        case 'logout':
            session_unset();
            session_destroy();
            header("Location: login.php");
            break;

        case 'addMahasiswa':
            $nim = trim($_POST['nim']);
            $nama = trim($_POST['nama']);
            $prodi = trim($_POST['prodi']);
            $tanggal_lahir = trim($_POST['tanggal_lahir']);
            $tempat_tinggal = trim($_POST['tempat_tinggal']);
            $keahlian = trim($_POST['keahlian']);
            addMahasiswa($nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian);
            break;

        case 'editMahasiswa':
            $id = trim($_POST['id']);
            $nim = trim($_POST['nim']);
            $nama = trim($_POST['nama']);
            $prodi = trim($_POST['prodi']);
            $tanggal_lahir = trim($_POST['tanggal_lahir']);
            $tempat_tinggal = trim($_POST['tempat_tinggal']);
            $keahlian = trim($_POST['keahlian']);
            editMahasiswa($id, $nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian);
            break;

        case 'deleteMahasiswa':
            $id = trim($_GET['id']);
            deleteMahasiswa($id);
            break;

        default:
            die("Unknown action: $action");
    }
}
