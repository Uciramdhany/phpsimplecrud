<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Trx extends Database {

    // Method untuk input data mahasiswa
    public function inputTrx($data){
        // Mengambil data dari parameter $data
        $id      = $data['id'];
        $kode     = $data['kode'];
        $tgl    = $data['tgl'];
        $pelanggan   = $data['pelanggan'];
        $qty = $data['qty'];
        $harga     = $data['harga'];
        $metode   = $data['metode'];
        $buah   = $data['buah'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_mahasiswa (id_trx, kode_trx, tgl_trx, pelanggan, total_qty, total_harga, metode_bayar, buah, status_trx) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssssss", $id, $kode, $tgl, $pelanggan, $qty, $harga, $metode, $buah, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data mahasiswa
    public function getAllTrx(){
        // Menyiapkan query SQL untuk mengambil data mahasiswa beserta prodi dan provinsi
        $query = "SELECT t.id_trx, t.kode_trx, t.tgl_trx, p.nama_pelanggan, 
                 t.total_qty, t.total_harga, t.metode_bayar, b.nama_buah, t.status_trx 
          FROM tb_trx AS t
          JOIN tb_buah AS b ON t.id_buah = b.id_buah
          JOIN tb_pelanggan AS p ON t.id_pelanggan = p.id_pelanggan";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $trx = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $trx[] = [
                    'id' => $row['id_trx'],
                    'kode' => $row['kode_trx'],
                    'tgl' => $row['tgl_trx'],
                    'pelanggan' => $row['nama_pelanggan'],
                    'qty' => $row['total_qty'],
                    'harga' => $row['total_harga'],
                    'metode' => $row['metode_bayar'],
                    'buah' => $row['nama_buah'],
                    'status' => $row['status_trx']
                ];
            }
        }
        // Mengembalikan array data mahasiswa
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
            $data = [
                'id' => $row['id_trx'],
                'kode' => $row['kode_trx'],
                'tgl' => $row['tgl_trx'],
                'pelanggan' => $row['nama_pelanggan'],
                'qty' => $row['total_qty'],
                'harga' => $row['total_harga'],
                'metode' => $row['metode_bayar'],
                'buah' => $row['nama_buah'],
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
        $pelanggan   = $data['pelanggan'];
        $qty = $data['qty'];
        $harga     = $data['harga'];
        $metode   = $data['metode'];
        $buah   = $data['buah'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_trx SET id_trx = ?, kode_trx = ?, tgl_trx = ?, pelanggan = ?, total_qty = ?, harga_satuan = ?, total_harga = ?, metode_bayar = ?, buah = ?, status_trx = ? WHERE id_trx = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssssssi", $id, $kode, $tgl, $pelanggan, $qty, $harga, $metode, $buah, $status);
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
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_trx, kode_trx, tgl_trx, nama_pelanggan, total_qty, total_harga, metode_bayar, nama_buah, status_mhs 
                  FROM tb_trx
                  JOIN tb_buah ON buah = kode_buah
                  JOIN tb_pelanggan ON pelanggan = id_pelanggan
                  WHERE id_trx LIKE ? OR kode_trx LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $mahasiswa = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data mahasiswa dalam array
                $trx[] = [
                    'id' => $row['id_trx'],
                    'kode' => $row['kode_trx'],
                    'tgl' => $row['tgl_trx'],
                    'pelanggan' => $row['nama_pelanggan'],
                    'qty' => $row['total_qty'],
                    'harga' => $row['total_harga'],
                    'metode' => $row['metode_bayar'],
                    'buah' => $row['nama_buah'],
                    'status' => $row['status_trx']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $trx;
    }

}

?>