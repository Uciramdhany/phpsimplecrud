<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar program studi
    public function getProdi(){
        $query = "SELECT * FROM tb_prodi";
        $result = $this->conn->query($query);
        $prodi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $prodi[] = [
                    'id' => $row['kode_prodi'],
                    'nama' => $row['nama_prodi']
                ];
            }
        }
        return $prodi;
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
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Aktif'],
            ['id' => 2, 'nama' => 'Tidak Aktif'],
            ['id' => 3, 'nama' => 'Cuti'],
            ['id' => 4, 'nama' => 'Lulus']
        ];
    }

    // Method untuk input data program studi
    public function inputProdi($data){
        $kodeProdi = $data['kode'];
        $namaProdi = $data['nama'];
        $query = "INSERT INTO tb_prodi (kode_prodi, nama_prodi) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeProdi, $namaProdi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data program studi berdasarkan kode
    public function getUpdateProdi($id){
        $query = "SELECT * FROM tb_prodi WHERE kode_prodi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $prodi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $prodi = [
                'id' => $row['kode_prodi'],
                'nama' => $row['nama_prodi']
            ];
        }
        $stmt->close();
        return $prodi;
    }

    // Method untuk mengedit data program studi
    public function updateProdi($data){
        $kodeProdi = $data['kode'];
        $namaProdi = $data['nama'];
        $query = "UPDATE tb_prodi SET nama_prodi = ? WHERE kode_prodi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaProdi, $kodeProdi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data program studi
    public function deleteProdi($id){
        $query = "DELETE FROM tb_prodi WHERE kode_prodi = ?";
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