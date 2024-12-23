Nama    : Muklis Mustaqim
Nim     : 122140115
UAS     : Pemrograman Website RA


Apa saja yang sudah dikerjakan untuk UAS Pemrograman Website RA ini,

1. Membuat fitur Register dengan menggunakan php dan javascript
2. Membuat fitur Login dengan menggunakan php dan javascript
3. Membuat index atau halaman utama dengan berisikan form untuk memasukkan data
4. Membuat server untuk menghubungkan action di semua tempat yaitu di bagian register, login dan tentunya pada index
5. Membuat koneksi sebagai tempat nantinya melakukan hosting pada website railway
6. Menambahkan fitur CSS untuk register, login dan index

<!-- Penjelasan -->Penjelasan

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


2. Pada fitur Register saya juga menggunakan php dan javascript seperti bootstrap
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

a. Elemen Dasar

Form login terdiri dari elemen input untuk username dan password serta tombol submit. Elemen ini dilengkapi dengan validasi dan pesan error dinamis.

Input Fields:Menggunakan elemen input untuk menerima data pengguna.

Pesan Error:Elemen div dengan class text-danger digunakan untuk menampilkan pesan error jika validasi gagal
