<?php 

include_once 'config/class-master.php';
include_once 'config/class-trx.php';
$master = new MasterData();
$trx = new Trx();
// Mengambil daftar program studi, provinsi, dan status mahasiswa
$buahList = $master->getBuah();
// Mengambil daftar provinsi
$pelangganList = $master->getPelanggan();
// Mengambil daftar status mahasiswa
$statusList = $master->getStatus();
// Mengambil data mahasiswa yang akan diedit berdasarkan id dari parameter GET
$dataTrx = $trx->getUpdateTrx($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data transaksi. Silakan coba lagi.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; ?>

			<?php include 'template/sidebar.php'; ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Edit Transaksi</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Formulir Transaksi</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
                                    <form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataTrx['id']; ?>">
                                            <div class="mb-3">
                                                <label for="nim" class="form-label">Identifikasi Transaksi (ID)</label>
                                                <input type="number" class="form-control" id="id" name="id" placeholder="Masukkan ID Transaksi" value="<?php echo $dataTrx['id']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Kode Transaksi</label>
                                                <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan Kode Transaksi" value="<?php echo $dataTrx['kode']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="prodi" class="form-label">Data Buah</label>
                                                <select class="form-select" id="databuah" name="databuah" required>
                                                    <option value="" selected disabled>Pilih Buah</option>
                                                    <?php 
                                                    // Iterasi daftar program studi dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($buahList as $buah){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedBuah = "";
                                                        // Mengecek apakah program studi saat ini sesuai dengan data mahasiswa
                                                        if($dataTrx['buah'] == $buah['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedBuah = "selected";
                                                        }
                                                        // Menampilkan opsi program studi dengan penanda yang sesuai
                                                        echo '<option value="'.$buah['id'].'" '.$selectedBuah.'>'.$buah['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Tanggal</label>
                                                <textarea class="form-control" id="tanggal" name="tanggal" rows="3" placeholder="Masukkan Tanggal Transaksi" required><?php echo $dataTrx['tanggal']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pelanggan" class="form-label">Pelanggan</label>
                                                <select class="form-select" id="pelanggan" name="pelanggan" required>
                                                    <option value="" selected disabled>Pilih Pelanggan</option>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($pelangganList as $pelanggan){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedPelanggan = "";
                                                        // Mengecek apakah pelanggan saat ini sesuai dengan data mahasiswa
                                                        if($dataTrx['pelanggan'] == $pelanggan['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedPelanggan = "selected";
                                                        }
                                                        // Menampilkan opsi provinsi dengan penanda yang sesuai
                                                        echo '<option value="'.$pelanggan['id'].'" '.$selectedPelanggan.'>'.$pelanggan['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="qty" class="form-label">quantity</label>
                                                <input type="qty" class="form-control" id="qty" name="qty" placeholder="Masukkan qty Valid dan Benar" value="<?php echo $dataTrx['qty']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="satuan" class="form-label">Harga Satuan</label>
                                                <input type="satuan" class="form-control" id="satuan" name="satuan" placeholder="Masukkan Harga Satuan" value="<?php echo $dataTrx['satuan']; ?>" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status mahasiswa dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($statusList as $status){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedStatus = "";
                                                        // Mengecek apakah status saat ini sesuai dengan data mahasiswa
                                                        if($dataTrx['status'] == $status['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedStatus = "selected";
                                                        }
                                                        // Menampilkan opsi status dengan penanda yang sesuai
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; ?>

		</div>
		
		<?php include 'template/script.php'; ?>

	</body>
</html>