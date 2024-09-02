<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Permintaan Barang</h1>
				</div>
			</div>
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
					<a href="#" id="btn1" class="btn btn-white mr-2" onclick="toggleView('view1', this)">
						Penerbitan Resi
					</a>

					<a href="#" id="btn2" class="btn btn-white" onclick="toggleView('view2', this)">
						Penerbitan SSPP
					</a>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<a href="<?= base_url('master/pengguna/tambah')?>" data-toggle="modal"
			data-target="#modal-tambah" class="btn btn-success mb-2">
			<i class="fas fa-plus"></i> Tambah Permintaan Barang
		</a>

		<div id="table-container">

			<table id="department-table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>No Resi</th>
						<th>Departement</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if(is_array($permintaan_barang) && !empty($permintaan_barang)){
						$no = 1;
						foreach($permintaan_barang as $data):
					?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $data->nomor_resi; ?></td>
							<td><?= $data->nama_departement; ?></td>
							<td><?= $data->status; ?></td>
							<td>
								<button data-toggle="modal" data-target="#modal-edit" class="edit-permintaan btn btn-primary" data-id="<?= $data->id_permintaan_barang; ?>">
									<i class="fas fa-eye"></i>
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

<div class="modal fade-lg" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form Permintaan Barang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('transaksi/permintaan_barang/tambah') ?>" method="POST">
					<div class="form-group row">
						<label for="inputResi" class="col-sm-3 col-form-label">Nomor Resi</label>
						<div class="col-sm-9">
							<input type="text" name="nomor_resi" class="form-control" id="inputResi" placeholder="36282822" required>
						</div>
					</div>

					<div class="form-group row">
						<label for="departement" class="col-sm-3 col-form-label">Departement</label>
						<div class="col-sm-9">
							<input type="hidden" name="id_departement" value="<?= $this->session->userdata('id_departement'); ?>">
							<input type="text" name="departement" class="form-control" id="departement" value="<?= $this->session->userdata('nama_departement'); ?>" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputed_by" class="col-sm-3 col-form-label">Pemohon</label>
						<div class="col-sm-9">
							<input type="text" name="inputed_by" class="form-control" id="inputed_by" value="<?= $this->session->userdata('name'); ?>" readonly>
						</div>
					</div>

					<div class="form-group row">
						<label for="id_departement" class="col-sm-3 col-form-label">Area Gudang</label>
						<div class="col-sm-9">
							<select name="id_area_gudang" id="id_area_gudang" class="form-control" required>
								<option value="">-- Pilih Area Gudang --</option>
								<?php foreach($gudang as $data): ?>
									<option value="<?= $data->id_area_gudang ?>"><?= $data->nama_area; ?> (<?= $data->jenis_gudang; ?>)</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-sm-12 text-right">
							<button type="button" id="addItemBtn" class="btn btn-primary">
								<i class="fas fa-plus"></i> Add
							</button>
						</div>
					</div>

					<table class="table" id="itemsTable">
						<!-- <tr>
							<th>Nama Barang</th>
							<th>Qty</th>
							<th>Stock</th>
							<th>Action</th>
						</tr> -->
					</table>

					<div id="noteAndSubmit" class="d-none">
						<div class="form-group row">
							<label for="note" class="col-sm-2 col-form-label">Note</label>
							<div class="col-sm-10">
								<input type="text" name="note" class="form-control" id="note" placeholder="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-sm-12 text-left">
								<button type="submit" class="btn btn-primary">
									Simpan
								</button>
							</div>
						</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center w-100">Permintaan Pengambilan Barang</h4>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> -->
			</div>
			<div class="modal-body">
				<form action="<?= site_url('transaksi/permintaan_barang/approve') ?>" method="post">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<table>
									<tbody>
										<tr>
											<td>Nomor Resi</td>
											<td>&nbsp;:&nbsp;</td>
											<td id="nomor_resi"></td>
										</tr>
										<tr>
											<td>User Request</td>
											<td>&nbsp;:&nbsp;</td>
											<td id="inputed_by"></td>
										</tr>
										<tr>
											<td>Departement</td>
											<td>&nbsp;:&nbsp;</td>
											<td id="nama_departement"></td>
										</tr>
										<tr>
											<td>Tgl Permintaan</td>
											<td>&nbsp;:&nbsp;</td>
											<td id="waktu_input"></td>
										</tr>
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;:&nbsp;</td>
											<td id="note">asdasdasd</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="col-md-6">
								<table>
									<tbody>
										<tr>
											<td>Diapprove oleh</td>
											<td>&nbsp;:&nbsp;</td>
											<td id="approved_by"></td>
										</tr>
										<tr>
											<td>Tgl Approve</td>
											<td>&nbsp;:&nbsp;</td>
											<td id="waktu_approve"></td>
										</tr>
									</tbody>
								</table>

							</div>
						</div>

						<hr>
						<table class="table">
							<thead>
								<tr>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Qty</th>
									<th>Area Gudang</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>X</td>
									<td>X</td>
									<td>X</td>
									<td>X</td>
								</tr>
							</tbody>
						</table>

						<!-- <div class="row">
							<div class="col-md-6">
								<div class="form-group row">
									<input type="hidden" id="id_permintaan_barang" name="id_permintaan barang" class="form-control">
									<label for="approve" class="col-sm-5 col-form-label">Approve</label>
									<div class="col-sm-7">
										<select name="approve" id="approve" class="form-control" required>
											<option value="">-- Aksi --</option>
											<option value="1">Approve</option>
											<option value="0">Reject</option>
										</select>
									</div>
								</div>
							</div>
						</div> -->
						<div class="form-group float-right pt-5">
							<input type="hidden" id="id_permintaan_barang" name="id_permintaan_barang" class="form-control">
							<input type="hidden" id="approved_by" name="approved_by" class="form-control">
							<input type="hidden" id="gudang_by" name="gudang_by" class="form-control">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit" name="reject" value="1" class="btn btn-danger ml-2">Reject</button>
							<button type="submit" name="approve" value="1" class="btn btn-primary ml-2">Approve</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /.modal -->

<script>
	$(document).ready(function(){
		$('.edit-permintaan').on('click', function(){
			var idPermintaan = $(this).data('id');
			// alert(idPermintaan);
			$.ajax({
				url: '<?= site_url('transaksi/permintaan_barang/get_permintaan')?>',
				type: 'POST',
				data: {id_permintaan_barang: idPermintaan},
				dataType: 'json',
				success: function(response) {
					console.log(response);
					// alert('Berhasil');
					// Isi form modal dengan data dari response
					$('#modal-edit #id_permintaan_barang').val(response.id_permintaan_barang);
					$('#modal-edit #approved_by').val(response.approved_by);
					$('#modal-edit #gudang_by').val(response.gudang_by);
					$('#modal-edit #nomor_resi').text(response.nomor_resi);
          $('#modal-edit #waktu_input').text(response.waktu_input); // Untuk elemen <td>
          $('#modal-edit #waktu_approve').text(response.waktu_approve);
          $('#modal-edit #approved_by').text(response.approved_by);
					$('#modal-edit #note').text(response.note);
					$('#modal-edit #inputed_by').text(response.inputed_by);
					$('#modal-edit #nama_departement').text(response.nama_departement);

					// Bersihkan tabel sebelum diisi dengan data baru
					$('#modal-edit .table tbody').empty();

					// Iterasi detail permintaan dan tambahkan ke tabel
					$.each(response.details, function(index, detail) {
						var row = '<tr>' +
							'<td>' + detail.kode_barang + '</td>' +
							'<td>' + detail.nama_barang + '</td>' +
							'<td>' + detail.qty + '</td>' +
							'<td>' + detail.jenis_gudang + '(' + detail.nama_area + ') </td>' +
							'</tr>';
						$('#modal-edit .table tbody').append(row);
					});

					// Buka modal setelah data diisi
					$('#modal-edit').modal('show');
				}
			});
		});
	});
</script>


<script>
	document.getElementById('addItemBtn').addEventListener('click', function() {
    console.log("Tombol Add diklik"); // Log untuk cek apakah tombol diklik
    const table = document.getElementById('itemsTable');
    const noteAndSubmit = document.getElementById('noteAndSubmit');
    const idAreaGudang = document.getElementById('id_area_gudang').value;

    if (!idAreaGudang) {
        alert("Pilih area gudang terlebih dahulu!");
        return;
    }

    if (table.rows.length === 0) {
			const headerRow = document.createElement('tr');
			headerRow.innerHTML = `
				<th width="35%">Nama Barang</th>
				<th>Qty</th>
				<th>Stock</th>
				<th>Action</th>
			`;
			table.appendChild(headerRow);
    }

    fetchBarangOptions(idAreaGudang, function(optionsHTML) {
			const newRow = document.createElement('tr');
			newRow.innerHTML = `
				<td>
					<select name="barang[]" class="form-control" required>
						${optionsHTML}
					</select>
				</td>
				<td>
					<input type="number" name="qty[]" class="form-control" required>
				</td>
				<td>
					<input type="text" name="stock[]" class="form-control" readonly>
				</td>
				<td>
					<button type="button" class="btn btn-danger btn-remove-item">
						<i class="fas fa-trash"></i>
					</button>
				</td>
			`;

			table.appendChild(newRow);
			console.log("Baris baru ditambahkan"); // Log untuk cek apakah baris ditambahkan

			table.classList.remove('d-none');
			noteAndSubmit.classList.remove('d-none');

			// Event listener untuk mengisi stok otomatis
			const barangSelect = newRow.querySelector('select[name="barang[]"]');
			const stockInput = newRow.querySelector('input[name="stock[]"]');

			barangSelect.addEventListener('change', function() {
				const selectedBarangId = this.value;

				if (selectedBarangId) {
						$.ajax({
								url: '<?= site_url('transaksi/permintaan_barang/get_stock_by_barang') ?>',
								type: 'GET',
								data: { id_barang: selectedBarangId },
								success: function(response) {
										const data = JSON.parse(response);
										stockInput.value = data.stock; // Isi stok berdasarkan respons
								},
								error: function(xhr, status, error) {
										console.error("AJAX Error:", status, error);
										stockInput.value = ''; // Kosongkan jika terjadi error
								}
						});
				} else {
					stockInput.value = ''; // Kosongkan jika barang tidak dipilih
				}
			});

			newRow.querySelector('.btn-remove-item').addEventListener('click', function() {
				this.closest('tr').remove();

				if (table.rows.length === 1) {
					table.classList.add('d-none');
					table.deleteRow(0);
					noteAndSubmit.classList.add('d-none');
				}
			});
    });
	});

function fetchBarangOptions(id_area_gudang, callback) {
    console.log("Fetching barang options for id_area_gudang:", id_area_gudang); // Log untuk cek pengambilan data
    $.ajax({
			url: '<?= site_url('transaksi/permintaan_barang/get_barang_by_area') ?>',
			type: 'GET',
			data: { id_area_gudang: id_area_gudang },
			success: function(response) {
				console.log("Response received:", response); // Log untuk cek respons
				const barangOptions = JSON.parse(response);
				let optionsHTML = '<option value="">Pilih Barang</option>';

				$.each(barangOptions, function(key, value) {
					optionsHTML += '<option value="' + value.id_barang + '">' + value.nama_barang + '</option>';
				});

				callback(optionsHTML);
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error:", status, error); // Log jika terjadi error
			}
    });
	}

</script>


<!-- <script>
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
	function toggleButton(clickedButton) {
		// Remove the 'btn-blue' class from all buttons
		var buttons = document.querySelectorAll('.btn');
		buttons.forEach(function(button) {
			button.classList.remove('btn-blue');
			button.classList.add('btn-white');
		});

		// Add the 'btn-blue' class to the clicked button
		clickedButton.classList.remove('btn-white');
		clickedButton.classList.add('btn-blue');
	}

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

		// Tampilkan view yang dipilih
		document.getElementById(viewId).style.display = 'block';
	}

	$(document).ready(function() {
		$('#selectGudang').select2({
			placeholder: "Pilih Area Gudang",
			allowClear: true
		});
	});

</script> -->


