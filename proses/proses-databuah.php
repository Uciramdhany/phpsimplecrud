<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputdatabuah'){
    $dataBuah = [
        'id' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'stok' => $_POST['stok'],
        'harga' => $_POST['harga'],
        'satuan' => $_POST['satuan']
    ];

    $input = $master->inputBuah($dataBuah);
    if($input){
        header("Location: ../master-buah-list.php?status=inputsuccess");
    } else {
        header("Location: ../master-buah-input.php?status=failed");
    }
}elseif($_GET['aksi'] == 'updatedatabuah'){
    $dataBuah = [
        'id' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'stok' => $_POST['stok'],
        'harga' => $_POST['harga'],
        'satuan' => $_POST['satuan']
    ];

    $update = $master->updateBuah($dataBuah);
    if($update){
        header("Location: ../master-buah-list.php?status=editsuccess");
    } else {
        header("Location: ../master-buah-edit.php?id=".$dataBuah['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletebuah'){
    $id = $_GET['id'];
    $delete = $master->deleteBuah($id);
    if($delete){
        header("Location: ../master-buah-list.php?status=deletesuccess");
    } else {
        header("Location: ../master-buah-list.php?status=deletefailed");
    }
}

?>