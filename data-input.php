<?php 

include_once 'config/class-master.php';
$master = new MasterData();
// Mengambil daftar program studi, provinsi, dan status mahasiswa
$buahList = $master->getBuah();
// Mengambil daftar provinsi
$pelangganList = $master->getPelanggan();
// Mengambil daftar status mahasiswa
$metodeList = $master->getMetodePembayaran();
$statusList = $master->getStatusTrx();

// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
    // Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal menambahkan data Transaksi. Silakan coba lagi.');</script>";
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
								<h3 class="mb-0">Input Transaksi</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Input Data</li>
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
                                    <form action="proses/proses-input.php" method="POST">
									    <div class="card-body">
                                            <div class="mb-3">
                                                <label for="kode" class="form-label">Kode Transaksi</label>
                                                <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan Kode Transaksi" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="buah" class="form-label">Data Buah</label>
                                                <select class="form-select" id="buah" name="id_buah" required>
                                                    <option value="" selected disabled>Pilih Buah</option>
                                                    <?php foreach ($buahList as $buah){
                                                    echo '<option value="'.$buah['id'].'">'.$buah['nama'].'</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tgl" class="form-label">Tanggal Transaksi</label>
                                                <input type="date" class="form-control" id="tgl" name="tgl" 
                                                    value="<?php echo date('Y-m-d'); ?>" required>
                                            </div>
                                            <select class="form-select" id="pelanggan" name="id_pelanggan" required>
                                                <option value="" selected disabled>Pilih Pelanggan</option>
                                                <?php foreach ($pelangganList as $pelanggan){
                                                echo '<option value="'.$pelanggan['id'].'">'.$pelanggan['nama'].'</option>';
                                                } ?>
                                            </select>
                                             <div class="mb-3">
                                                <label for="qty" class="form-label">Total Quantity</label>
                                                <textarea class="form-control" id="qty" name="qty" rows="3" placeholder="Masukkan Total Qty" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Total Harga</label>
                                                <input type="harga" class="form-control" id="harga" name="harga" placeholder="Masukkan Total Harga" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="metode" class="form-label">Metode Bayar</label>
                                                <select class="form-select" id="metode" name="metode" required>
                                                    <option value="" selected disabled>Pilih Metode Bayar</option>
                                                    <?php 
                                                    $metodeList = $master->getMetodePembayaran();
                                                    // Iterasi daftar status mahasiswa dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($metodeList as $metode){
                                                    echo '<option value="'.$metode['id'].'">'.$metode['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status Transaksi</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status Transaksi</option>
                                                    <?php 
                                                    $statusList = $master->getStatusTrx();
                                                    // Iterasi daftar status mahasiswa dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($statusList as $status){
                                                        echo '<option value="'.$status['id'].'">'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
                                            <button type="submit" class="btn btn-primary float-end">Submit</button>
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