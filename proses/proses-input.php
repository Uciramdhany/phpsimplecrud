<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-trx.php';
// Membuat objek dari class Mahasiswa
$trx = new Trx();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataTrx = [
    'nim' => $_POST['nim'],
    'nama' => $_POST['nama'],
    'buah' => $_POST['buah'],
    'alamat' => $_POST['alamat'],
    'pelanggan' => $_POST['pelanggan'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
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