<?php 

// Silakan lihat komentar di file data-input.php untuk penjelasan kode ini, karena struktur dan logikanya serupa.
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal menambahkan data buah. Silakan coba lagi.');</script>";
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
								<h3 class="mb-0">Input Data Buah</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Input Data Buah</li>
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
										<h3 class="card-title">Formulir Buah</h3>
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
                                    <form action="proses/proses-databuah.php?aksi=inputdatabuah" method="POST">
									    <div class="card-body">
                                            <div class="mb-3">
                                                <label for="id" class="form-label">ID Buah</label>
												<input type="text" class="form-control" id="id" name="id" placeholder="Masukkan ID Buah"
    											value="<?php echo $dataBuah['id'] ?? ''; ?>" required>
                                            </div>
											<div class="mb-3">
												<label for="nama" class="form-label">Nama Buah</label>
												<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Buah" required>
											</div>
											<div class="mb-3">
												<label for="jenis" class="form-label">Jenis Buah</label>
												<input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukkan Jenis buah" required>
											</div>
											<div class="mb-3">
												<label for="stok" class="form-label">Stok</label>
												<input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan Stok Buah" required>
											</div>
											<div class="mb-3">
												<label for="harga" class="form-label">Harga</label>
												<input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Buah" required>
											</div>
											<div class="mb-3">
    											<label for="satuan" class="form-label">Satuan</label>
    											<input type="text" class="form-control" id="satuan" name="satuan" placeholder="Masukkan Satuan Buah"
        										value="<?php echo $dataBuah['satuan'] ?? ''; ?>" required>
											</div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='master-buah-list.php'">Batal</button>
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