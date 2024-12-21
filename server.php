<?php
require 'koneksi.php';
session_start();

// Fungsi Register
function registerUser($username, $email, $password) {
    $conn = (new Koneksi())->getConnection();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $params = [$username, $email, $hashedPassword];
    $types = "sss"; // 3 string (username, email, password)

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        die("Error executing query: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
}

// Fungsi Login
function loginUser($username, $password) {
    $conn = (new Koneksi())->getConnection();

    $sql = "SELECT * FROM users WHERE username = ?";
    $params = [$username];
    $types = "s"; // 1 string (username)

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
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
                die("Invalid password.");
            }
        } else {
            die("User not found.");
        }
    } else {
        die("Error executing query: " . $stmt->error);
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

            default:
                die("Unknown action: $action");
        }
    }
?>
