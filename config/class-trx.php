<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Trx extends Database {

    // Method untuk input data mahasiswa
public function inputTrx($data){
    $kode   = $data['kode'];
    $tgl    = $data['tgl']; 
    $id_pelanggan = $data['id_pelanggan'];
    $id_buah = $data['id_buah'];
    $qty    = $data['qty'];
    $harga  = $data['harga'];
    $metode = $data['metode'];
    $status = $data['status'];

    $query = "INSERT INTO tb_trx (kode_trx, tgl_trx, id_pelanggan, id_buah, total_qty, total_harga, metode_bayar, status_trx)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssiiidss", $kode, $tgl, $id_pelanggan, $id_buah, $qty, $harga, $metode, $status);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

    // Method untuk mengambil semua data mahasiswa
    public function getAllTrx(){
    $query = "SELECT t.id_trx, t.kode_trx, t.tgl_trx, t.id_pelanggan, t.id_buah, t.total_qty, t.total_harga, t.metode_bayar, t.status_trx,
                     b.nama_buah, p.nama_pelanggan
              FROM tb_trx AS t
              JOIN tb_buah AS b ON t.id_buah = b.id_buah
              JOIN tb_pelanggan AS p ON t.id_pelanggan = p.id_pelanggan";

    $result = $this->conn->query($query);
    $trx = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $trx[] = [
                'id' => $row['id_trx'],
                'kode' => $row['kode_trx'],
                'tgl_trx' => $row['tgl_trx'],
                'qty' => $row['total_qty'],
                'harga' => $row['total_harga'],
                'metode' => $row['metode_bayar'],
                'status' => $row['status_trx'],
                'id_buah' => $row['id_buah'],
                'id_pelanggan' => $row['id_pelanggan'],
                'nama_buah' => $row['nama_buah'],
                'nama_pelanggan' => $row['nama_pelanggan']
            ];
        }
    }
    return $trx;
    }


    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateTrx($id){
        // Menyiapkan query SQL untuk mengambil data mahasiswa berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_trx WHERE id_trx = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data mahasiswa  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $dataTrx = [
                'id' => $row['id_trx'],
                'kode' => $row['kode_trx'],
                'tgl' => $row['tgl_trx'],
                'id_pelanggan' => $row['id_pelanggan'],
                'qty' => $row['total_qty'],
                'harga' => $row['total_harga'],
                'metode' => $row['metode_bayar'],
                'id_buah' => $row['id_buah'],
                'status' => $row['status_trx']
            ];
        }
        $stmt->close();
        // Mengembalikan data mahasiswa
        return $data;
    }

    // Method untuk mengedit data mahasiswa
    public function editTrx($data){
        // Mengambil data dari parameter $data
        $id      = $data['id'];
        $kode     = $data['kode'];
        $tgl    = $data['tgl'];
        $id_pelanggan   = $data['id_pelanggan'];
        $qty = $data['qty'];
        $harga     = $data['harga'];
        $metode   = $data['metode'];
        $id_buah   = $data['id_buah'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_trx SET id_trx = ?, kode_trx = ?, tgl_trx = ?, id_pelanggan = ?, total_qty = ?, harga_satuan = ?, total_harga = ?, metode_bayar = ?, id_buah = ?, status_trx = ? WHERE id_trx = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssssssi", $id, $kode, $tgl, $id_pelanggan, $qty, $harga, $metode, $id_buah, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data mahasiswa
    public function deleteTrx($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_trx WHERE id_trx = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
public function searchTrx($kataKunci){
    $likeQuery = "%".$kataKunci."%";

    $query = "SELECT t.id_trx, t.kode_trx, t.tgl_trx, t.id_pelanggan, t.total_qty, t.total_harga, t.metode_bayar, 
                     t.id_buah, t.status_trx, b.nama_buah, p.nama_pelanggan
              FROM tb_trx AS t
              JOIN tb_buah AS b ON t.id_buah = b.id_buah
              JOIN tb_pelanggan AS p ON t.id_pelanggan = p.id_pelanggan
              WHERE t.id_trx LIKE ? OR t.kode_trx LIKE ?";

    $stmt = $this->conn->prepare($query);
    if(!$stmt){
        return [];
    }

    $stmt->bind_param("ss", $likeQuery, $likeQuery);
    $stmt->execute();
    $result = $stmt->get_result();

    $trx = [];
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $trx[] = [
                'id' => $row['id_trx'],
                'kode' => $row['kode_trx'],
                'tgl' => $row['tgl_trx'],
                'id_pelanggan' => $row['id_pelanggan'],
                'qty' => $row['total_qty'],
                'harga' => $row['total_harga'],
                'metode' => $row['metode_bayar'],
                'id_buah' => $row['id_buah'],
                'status' => $row['status_trx'],
                'nama_buah' => $row['nama_buah'],        // <--- tambahkan ini
                'nama_pelanggan' => $row['nama_pelanggan'] // <--- tambahkan ini
            ];
        }
    }
    $stmt->close();

    return $trx;
}

}

?>