<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<style>
			.btn-white {
				background-color: white;
				color: black;
			}

			.btn-blue {
				background-color: blue;
				color: white;
			}

			.view-content {
				margin-top: 20px;
			}

		</style>

		<div class="row">
			<div class="col-md-12 d-flex justify-content-end">
				<a href="#" id="btn1" class="btn btn-white mr-2" onclick="toggleView('view1', this)">Bahan Penolong</a>

				<a href="#" id="btn2" class="btn btn-white" onclick="toggleView('view2', this)">Gudang Mekanik</a>
					
				<a href="#" id="btn3" class="btn btn-white mr-2" onclick="toggleView('view3', this)">Sticker</a>

				<a href="#" id="btn4" class="btn btn-white" onclick="toggleView('view4', this)">Plastik</a>

				<a href="#" id="btn5" class="btn btn-white mr-2" onclick="toggleView('view5', this)">Kardus</a>

				<a href="#" id="btn6" class="btn btn-white" onclick="toggleView('view6', this)">Titipan</a>

				<a href="#" id="btn7" class="btn btn-white" onclick="toggleView('view7', this)">ATK</a>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Kelola Master Barang</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<a href="<?= base_url('master/pengguna/tambah')?>" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary mb-2">
			<i class="fas fa-plus"></i> Tambah Barang
		</a>

		<div id="table-container">
			<table id="department-table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Stock</th>
						<th>Satuan</th>
						<th>Gudang</th>
						<th>Rack</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if(is_array($barang) && !empty($barang)){
						$no = 1;
						foreach($barang as $data):
					?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->kode_barang; ?></td>
								<td><?= $data->nama_barang; ?></td>
								<td><?= $data->stock; ?></td>
								<td><?= $data->satuan; ?></td>
								<td><?= $data->jenis_gudang; ?> - <?= $data->nama_area; ?></td>
								<td><?= $data->nama_rack; ?> - <?= $data->no_rack; ?></td>
								<td>
									<button data-toggle="modal" data-target="#modal-edit" class="edit-barang btn btn-primary" data-id="<?= $data->id_barang; ?>">
										<i class="fas fa-edit"></i>
									</button>
								</td>
							</tr>

						<?php endforeach;?>
					<?php }
						else{ ?>
							<tr>
								<td colspan="7">Data tidak tersedia</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</div>

<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('master/master_barang/tambah') ?>" id="tambah_barang"  method="POST">
					<div class="card-body">
			
						<div class="form-group row">
							<label for="kode_barang" class="col-sm-3 col-form-label">Kode Barang</label>
							<div class="col-sm-9">
								<input type="text" name="kode_barang" class="form-control" id="kode_barang" placeholder="B0001" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
							<div class="col-sm-9">
								<input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="" required>
							</div>
						</div>

				
						<div class="form-group row">
							<label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
							<div class="col-sm-9">
								<select name="id_rack" id="lokasi" class="form-control" required>
									<option value="">-- Pilih Lokasi --</option>
									<?php foreach($lokasi as $data): ?>
										<option value="<?= $data->id_rack ?>">
											<?= $data->jenis_gudang; ?> - 
											<?= $data->nama_area; ?> | 
											<?= $data->nama_rack; ?> - 
											<?= $data->no_rack; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						
						<div class="form-group row">
							<label for="stock" class="col-sm-3 col-form-label">Stock</label>
							<div class="col-sm-9">
								<input type="number" name="stock" class="form-control" id="stock" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="satuan" class="col-sm-3 col-form-label">Satuan</label>
							<div class="col-sm-9">
								<select name="id_satuan" id="satuan" class="form-control" required>
									<option value="">-- Pilih Satuan --</option>
									<?php foreach($satuan as $data): ?>
										<option value="<?= $data->id_satuan ?>"><?= $data->satuan; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
			
						<div class="form-group float-right pt-5">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary ml-2">Simpan</button>
						</div>
					</div>
				</form>
			</div>

		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-edit-user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Departement</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="javascript:void(0)" id="edit-pengguna" data-url="<?=base_url('Departement/edit')?>" method="post">
					<div class="card-body">
				
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-4 col-form-label">Nama Departement</label>
							<div class="col-sm-8">
								<input type="text" name="nama_Departement" class="form-control"
								>
							</div>
						</div>
						
						<div class="form-group float-right pt-5">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary ml-2">Simpan</button>
						</div>
					</div>
				</form>
			</div>

		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
	function makeTableResponsive() {
		const tableContainer = document.getElementById('table-container');
		const table = document.getElementById('department-table');

		// Remove existing responsive wrapper if present
		const existingWrapper = document.querySelector('.table-responsive');
		if (existingWrapper) {
			while (existingWrapper.firstChild) {
				tableContainer.appendChild(existingWrapper.firstChild);
			}
			existingWrapper.remove();
		}

		// Add responsive wrapper based on screen width
		if (window.innerWidth < 768) {
			const responsiveDiv = document.createElement('div');
			responsiveDiv.classList.add('table-responsive');
			tableContainer.appendChild(responsiveDiv);
			responsiveDiv.appendChild(table);
		}
	}

	// Run on load
	makeTableResponsive();

	// Run on window resize
	window.addEventListener('resize', makeTableResponsive);

	function toggleView(viewId, clickedButton) {
	// Hapus kelas 'btn-blue' dari semua tombol
	var buttons = document.querySelectorAll('.btn');
	buttons.forEach(function(button) {
		button.classList.remove('btn-blue');
		button.classList.add('btn-white');
	});

	// Tambahkan kelas 'btn-blue' ke tombol yang diklik
	clickedButton.classList.remove('btn-white');
	clickedButton.classList.add('btn-blue');

	// Sembunyikan semua view-content
	var views = document.querySelectorAll('.view-content');
	views.forEach(function(view) {
		view.style.display = 'none';
	});

</script>