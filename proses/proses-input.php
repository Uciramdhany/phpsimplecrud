<?php
include_once '../config/class-trx.php';
$trx = new Trx();

$data = [
    'kode' => $_POST['kode'],
    'tgl' => $_POST['tgl'],
    'id_pelanggan' => $_POST['id_pelanggan'],
    'id_buah' => $_POST['id_buah'],
    'qty' => $_POST['qty'],
    'harga' => $_POST['harga'],
    'metode' => $_POST['metode'],
    'status' => $_POST['status']
];

$result = $trx->inputTrx($data);

if($result){
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    header("Location: ../data-input.php?status=failed");
}
