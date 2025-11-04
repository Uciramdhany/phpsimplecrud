<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-trx.php';
// Membuat objek dari class Mahasiswa
$trx = new Trx();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataTrx = [
    'id' => $_POST['id'],
    'kode' => $_POST['kode'],
    'tgl' => $_POST['tgl'],
    'pelanggan' => $_POST['pelanggan'],
    'qty' => $_POST['qty'],
    'harga' => $_POST['harga'],
    'metode' => $_POST['metode'],
    'buah' => $_POST['buah'],
    'status' => $_POST['status']
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $trx->inputTrx($dataTrx);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>