<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function getBuah(){
        $query = "SELECT * FROM tb_buah";
        $result = $this->conn->query($query);
        $buah = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $buah[] = [
                    'id' => $row['id_buah'],
                    'nama' => $row['nama_buah'],
                    'jenis' => $row['jenis_buah'],
                    'stok' => $row['stok'],
                    'harga' => $row['harga'],
                    'satuan' => $row['satuan']
                ];
            }
        }
        return $buah;
    }

    // Method untuk mendapatkan daftar pelanggan
    public function getPelanggan(){
        $query = "SELECT * FROM tb_pelanggan";
        $result = $this->conn->query($query);
        $pelanggan = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $pelanggan[] = [
                    'id' => $row['id_pelanggan'],
                    'nama' => $row['nama_pelanggan'],
                    'no' => $row['no_hp'],
                    'alm' => $row['alamat'],
                    'eml' => $row['email']
                ];
            }
        }
        return $pelanggan;
    }

    // Method untuk mendapatkan daftar status mahasiswa menggunakan array statis
    public function getMetodePembayaran(){
    return [
        ['id' => 1, 'nama' => 'Cash'],
        ['id' => 2, 'nama' => 'QRIS'],
        ['id' => 3, 'nama' => 'Transfer']
    ];
    }

    public function getStatusTrx(){
    return [
        ['id' => 1, 'nama' => 'Batal'],
        ['id' => 2, 'nama' => 'Pending'],
        ['id' => 3, 'nama' => 'Selesai']
    ];
}


    // Method untuk input data program studi
    public function inputBuah($dataBuah){
        $idBuah = $dataBuah['id'];
        $namaBuah = $dataBuah['nama'];
        $jenisBuah = $dataBuah['jenis'];
        $stok = $dataBuah['stok'];
        $harga = $dataBuah['harga'];
        $satuan = $dataBuah['satuan'];
        $query = "INSERT INTO tb_buah (id_buah, nama_buah, jenis_buah, stok, harga, satuan) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ssssss", $idBuah, $namaBuah, $jenisBuah, $stok, $harga, $satuan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdateBuah($id){
        $query = "SELECT * FROM tb_buah WHERE id_buah = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $buah = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $buah = [
                'id' => $row['id_buah'],
                'nama' => $row['nama_buah'],
                'jenis' => $row['jenis_buah'],
                'stok' => $row['stok'],
                'harga' => $row['harga'],
                'satuan' => $row['satuan']
            ];
        }
        $stmt->close();
        return $buah;
    }

    // Method untuk mengedit data program studi
    public function updateBuah($data){
        $idBuah = $data['id'];
        $namaBuah = $data['nama'];
        $jenisBuah = $data['jenis'];
        $stokBuah = $data['stok'];
        $hargaBuah = $data['harga'];
        $satuanBuah = $data['satuan'];
        $query = "UPDATE tb_buah SET nama_buah = ? WHERE id_buah = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaBuah, $idBuah);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data program studi
    public function deleteBuah($id){
        $query = "DELETE FROM tb_buah WHERE id_buah = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data pelanggan
    public function inputPelanggan($data){
        $namaPelanggan = $data['nama'];
        $query = "INSERT INTO tb_pelanggan (nama_pelanggan) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaPelanggan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdatePelanggan($id){
        $query = "SELECT * FROM tb_pelanggan WHERE id_pelanggan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pelanggan = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $pelanggan = [
                'id' => $row['id_pelanggan'],
                'nama' => $row['nama_pelanggan'],
                'no' => $row['no_hp'],
                'alm' => $row['alamat'],
                'eml' => $row['email']
            ];
        }
        $stmt->close();
        return $pelanggan;
    }

    // Method untuk mengedit data pelanggan
    public function updatePelanggan($data){
        $idPelanggan = $data['id'];
        $namaPelanggan = $data['nama'];
        $nohpPelanggan = $data['no_hp'];
        $alamatPelanggan = $data['alamat'];
        $emailPelanggan = $data['email'];
        $query = "UPDATE tb_pelanggan SET nama_pelanggan = ? WHERE id_pelanggan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaPelanggan, $idPelanggan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data pelanggan
    public function deletePelanggan($id){
        $query = "DELETE FROM tb_pelanggan WHERE id_pelanggan = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>