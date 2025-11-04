<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-trx.php';
// Membuat objek dari class Mahasiswa
$trx = new Trx();
// Mengambil data mahasiswa dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataTrx = [
    'id' => $_POST['id'],
    'kode' => $_POST['kode'],
    'tgl' => $_POST['tgl'],
    'id_pelanggan' => $_POST['pelanggan'],
    'qty' => $_POST['qty'],
    'harga' => $_POST['harga'],
    'metode' => $_POST['metode'],
    'id_buah' => $_POST['buah']
    'status' => $_POST['status']
];
// Memanggil method editMahasiswa untuk mengupdate data mahasiswa dengan parameter array $dataMahasiswa
$edit = $trx->editTrx($dataTrx);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id mahasiswa
    header("Location: ../data-edit.php?id=".$dataTrx['id']."&status=failed");
}

?>