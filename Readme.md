# Nama    : Muklis Mustaqim
# Nim     : 122140115
# UAS     : Pemrograman Website RA


# **Apa saja yang sudah dikerjakan untuk UAS Pemrograman Website RA ini**
## Penjelasannya

1. Membuat fitur Register dengan menggunakan php dan javascript
2. Membuat fitur Login dengan menggunakan php dan javascript
3. Membuat index atau halaman utama dengan berisikan form untuk memasukkan data
4. Membuat server untuk menghubungkan action di semua tempat yaitu di bagian register, login dan tentunya pada index
5. Membuat koneksi sebagai tempat nantinya melakukan hosting pada website railway
6. Menambahkan fitur CSS untuk register, login dan index

# **Penjelasan Register----------->>>>>**

## Register

1. Register
Berikut ini yang dilakukan pada register
1. Inisialisasi Sesi PHP

Kode PHP diawali dengan memulai sesi menggunakan session_start(). Ini memungkinkan server untuk menyimpan data sementara seperti pesan kesalahan.

Fungsi: Memastikan data sesi aktif dapat diakses.

Penggunaan Variabel Sesi:Variabel sesi digunakan untuk menyimpan pesan kesalahan dari server $_SESSION"error", dan kemudian ditampilkan di halaman jika ada.
session_start();
<!-- $error = isset($_SESSION["error"]) ? $_SESSION["error"] : null;
unset($_SESSION["error"]); // Pesan error dihapus setelah diambil -->

2. Struktur HTML

-Elemen Dasar
Formulir terdiri dari elemen-elemen dasar seperti input untuk username, email, password, konfirmasi password, dan checkbox persetujuan.
Input Fields:Menggunakan elemen input untuk menerima data pengguna.
Pesan Error:Elemen div dengan class text-danger digunakan untuk menampilkan pesan error jika validasi gagal.
<!-- <div class="mb-3">
    <label for="username" class="form-label">Username:</label>
    <input type="text" id="username" name="username" class="form-control">
    <div id="usernameError" class="text-danger">Username is required.</div>
</div> -->

-Pesan Dinamis dari Server
Formulir juga dapat menampilkan pesan error atau sukses yang dikirim dari server melalui parameter URL (GET).
<!-- <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php elseif (isset($_GET['success'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo htmlspecialchars($_GET['success']); ?>
    </div>
<?php endif; ?> -->

3. Validasi Sisi Klien dengan JavaScript
JavaScript digunakan untuk memastikan data yang dimasukkan pengguna memenuhi kriteria sebelum dikirim ke server.

-Fungsi Validasi
Fungsi validateForm() digunakan untuk:
1. Memastikan semua field yang wajib diisi (username, email, password) tidak kosong.
2. Memvalidasi format email menggunakan regular expression.
3. Memastikan password dan konfirmasi password cocok.
4. Memastikan checkbox persetujuan dicentang.

-Pesan Error
Pesan error hanya akan ditampilkan jika validasi gagal, sehingga memberikan umpan balik langsung kepada pengguna tanpa perlu memuat ulang halaman.

4. Styling dengan Bootstrap dan CSS

5. Pengiriman Data ke Server
Data dari formulir dikirim ke server melalui metode POST ke URL yang ditentukan di atribut action. Server akan memproses data dan memberikan respon (sukses atau error).

# **Penjelasan Login-------->>>>**
## Login
2. Pada fitur Login saya juga menggunakan php dan javascript seperti bootstrap
    Berikut ini penjelasan tentang login
1. Inisialisasi Sesi PHP
Kode PHP diawali dengan memulai sesi menggunakan session_start(). Ini memungkinkan server untuk menyimpan data sementara seperti pesan kesalahan.
Fungsi:Memastikan data sesi aktif dapat diakses.
Penggunaan Variabel Sesi:Variabel sesi digunakan untuk menyimpan pesan kesalahan dari server $_SESSION"error", dan kemudian ditampilkan di halaman jika ada.
<!-- session_start();
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : null;
unset($_SESSION["error"]); // Pesan error dihapus setelah diambil -->

2. Struktur HTML
    -Elemen Dasar
        Form login terdiri dari elemen input untuk username dan password serta tombol submit. Elemen ini dilengkapi dengan validasi dan pesan error dinamis.
            Input Fields:Menggunakan elemen input untuk menerima data pengguna.
                Pesan Error:Elemen div dengan class text-danger digunakan untuk menampilkan pesan error jika validasi 2. Struktur HTML

    -Pesan Error dari Server
        Formulir juga dapat menampilkan pesan error yang dikirim dari server melalui variabel PHP.

3. Validasi Sisi Klien dengan JavaScript
JavaScript digunakan untuk memastikan data yang dimasukkan pengguna memenuhi kriteria sebelum dikirim ke server.

    -Fungsi Validasi
        Validasi dilakukan dengan memeriksa apakah field username dan password diisi. Jika tidak, pesan error akan ditampilkan.

    -Pesan Error Dinamis
        Pesan error hanya akan ditampilkan jika validasi gagal, memberikan umpan balik langsung kepada pengguna tanpa perlu memuat ulang halaman.

4. Styling dengan Bootstrap dan CSS
    -Bootstrap
        Bootstrap digunakan untuk membuat formulir terlihat lebih modern dan responsif.
    -CSS Kustom
        Class text-danger digunakan untuk menampilkan pesan error dengan warna merah. Secara default, elemen dengan class ini disembunyikan menggunakan CSS.

5. Pengiriman Data ke Server
Data dari formulir dikirim ke server melalui metode POST ke URL yang ditentukan di atribut action. Server akan memproses data dan memberikan respon (sukses atau error).


# **Penjelasan index ------------->>>>>>**

## Fitur Utama

1. Autentikasi Pengguna:
    -Sistem mengharuskan pengguna login sebelum dapat mengakses halaman utama.
    -Sesi digunakan untuk menjaga status autentikasi pengguna.

2. Manajemen Data Mahasiswa:
    -Tambah data mahasiswa (NIM, nama, prodi, tanggal lahir, tempat tinggal, keahlian).
    -Edit dan hapus data mahasiswa melalui modal interaktif.

3. Mode Gelap (Dark Mode):
    -Mode tampilan gelap dengan pengaturan yang disimpan dalam cookie.

4. Desain Responsif:
    -Menggunakan framework Bootstrap untuk memastikan tampilan dapat menyesuaikan berbagai perangkat.

## Struktur dari index nya
Struktur File

1. File Utama
    -index.php: Halaman utama untuk melihat dan mengelola data mahasiswa.
    -server.php: Mengelola logika backend seperti autentikasi, CRUD data mahasiswa, dan logout.

2. Aset Tambahan
    -styles.css: File CSS untuk styling tambahan.
    -harian.html: Halaman tambahan yang dapat diakses melalui tombol navigasi.
    -Bootstrap: Diimpor dari CDN untuk styling dan komponen interaktif.

# **Penjelasan Koneksi------------>>>>>**
1. Fitur Utama
    -Membuka koneksi ke database secara otomatis menggunakan constructor.
    -Mengelola koneksi database dengan metode untuk menutup koneksi.
    -Menjalankan query secara modular menggunakan metode yang mendukung parameterisasi untuk keamanan (mencegah SQL Injection).
    -Mengambil data hasil query dalam bentuk semua baris (fetchAll) atau satu baris (fetchOne).

# **Penjelasan Server ----->>>>>**
## Fitur Utama
1. Register dan Login  
   - Registrasi pengguna dengan hashing kata sandi menggunakan `password_hash`.
   - Login aman dengan verifikasi kata sandi menggunakan `password_verify`.

2. Pengelolaan Data Mahasiswa 
   - Tambah, edit, dan hapus data mahasiswa.
   - Tampilkan daftar mahasiswa dalam database.

3. Keamanan
   - Menggunakan parameterisasi query untuk mencegah SQL Injection.
   - Menyimpan sesi dengan informasi tambahan seperti IP dan agen peramban.

## Struktur Kode
### `koneksi.php`
Berisi class `Koneksi` yang menangani koneksi ke database.

### `functions.php`
Berisi fungsi-fungsi utama:
- **`registerUser($username, $email, $password)`**  
  Mendaftarkan pengguna baru ke database.
- **`loginUser($username, $password)`**  
  Memverifikasi pengguna dan memulai sesi.
- **`getMahasiswa()`**  
  Mengambil semua data mahasiswa dari tabel `tblMahasiswa`.
- **`addMahasiswa($nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian)`**  
  Menambahkan data mahasiswa baru.
- **`editMahasiswa($id, $nim, $nama, $prodi, $tanggal_lahir, $tempat_tinggal, $keahlian)`**  
  Mengedit data mahasiswa berdasarkan ID.
- **`deleteMahasiswa($id)`**  
  Menghapus data mahasiswa berdasarkan ID.
- **`uploadGambar($gambar)`** *(opsional)*  
  Mengunggah file gambar (belum diimplementasikan).

## Cara Penggunaan
### 1. Konfigurasi Database
- Pastikan server database MySQL aktif.
- Buat database dengan nama yang sesuai (`railway` dalam contoh ini).
- Import struktur tabel `users` dan `tblMahasiswa`.

### 2. Menyesuaikan Kredensial
Edit file `koneksi.php` untuk menyesuaikan:

### 3. Jalankan Aplikasi
- Gunakan browser untuk mengakses file PHP melalui server lokal (misalnya, http://localhost/namalokalhostnya).
- Gunakan halaman register.php untuk registrasi atau login.php untuk masuk.

### 4. Pengelolaan Mahasiswa
- Gunakan fitur tambah, edit, atau hapus data mahasiswa melalui antarmuka yang telah disediakan.

# Selesai ****