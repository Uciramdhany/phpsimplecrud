<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputpelanggan'){
    // Mengambil data pelanggan dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataPelanggan = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama'],
        'no_hp' => $_POST['no_hp'],
        'email' => $_POST['email']
    ];
    // Memanggil method inputProvinsi untuk memasukkan data provinsi dengan parameter array $dataProvinsi
    $input = $master->inputPelanggan($_POST);
    
    if($input){
        header("Location: ../master-pelanggan-list.php?status=inputsuccess");
    } else {
        header("Location: ../master-pelanggan-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatepelanggan'){
    // Mengambil data pelanggan dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataPelanggan = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama'],
        'no_hp' => $_POST['no_hp'],
        'email' => $_POST['email']
    ];
    // Memanggil method updatePelanggan untuk mengupdate data pelanggan dengan parameter array $dataPelanggan
    $update = $master->updatePelanggan($dataPelanggan);
    if($update){
        header("Location: ../master-pelanggan-list.php?status=editsuccess");
    } else {
        header("Location: ../master-pelanggan-edit.php?id=".$dataPelanggan['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletepelanggan'){
    // Mengambil id provinsi dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteProvinsi untuk menghapus data provinsi berdasarkan id
    $delete = $master->deletePelanggan($id);
    if($delete){
        header("Location: ../master-pelanggan-list.php?status=deletesuccess");
    } else {
        header("Location: ../master-pelanggan-list.php?status=deletefailed");
    }
}

?>