<?php
class Koneksi {
    private $host = 'junction.proxy.rlwy.net'; // Host database
    private $user = 'root'; // User default MySQL di XAMPP
    private $password = 'COzArnuNlbNVBYvsXUUyGrggGRZxMmlH'; // Default password kosong di XAMPP
    private $dbname = 'railway'; // Nama database sesuai dengan yang telah Anda buat
    private $port = 54932;
    private $conn;

    // Constructor untuk membuka koneksi
    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port);

        // Periksa koneksi, tampilkan pesan error jika gagal
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    // Fungsi untuk mendapatkan instance koneksi
    public function getConnection() {
        return $this->conn;
    }

    // Fungsi untuk menutup koneksi (opsional, berguna untuk resource management)
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }

    // Fungsi tambahan untuk eksekusi query (opsional, membuat kode lebih modular)
    public function executeQuery($sql, $params = [], $types = '') {
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $this->conn->error);
        }

        // Bind parameters jika ada
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            die("Error executing query: " . $stmt->error);
        }

        return $stmt;
    }

    // Fungsi untuk mengambil semua hasil query
    public function fetchAll($sql, $params = [], $types = '') {
        $stmt = $this->executeQuery($sql, $params, $types);
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Fungsi untuk mengambil satu baris hasil query
    public function fetchOne($sql, $params = [], $types = '') {
        $stmt = $this->executeQuery($sql, $params, $types);
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
