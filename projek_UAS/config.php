<?php
$host = "localhost";
$username = "root";
$password = ""; // sesuaikan dengan password MySQL Anda
$database = "db_penjualan";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Mengecek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
echo "Koneksi berhasil";
?>