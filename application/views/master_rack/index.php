<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Kelola Rack</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<a href="<?= base_url('master/pengguna/tambah')?>" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary mb-2">
			<i class="fas fa-plus"></i> Tambah Rack
		</a>
		<div id="table-container">
			<table id="department-table" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Area Gudang</th>
						<th>Nama Rack</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					foreach($rack as $data):
					?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $data->area_rack; ?></td>
						<td><?= $data->kode_rack; ?></td>
						<td>
							<button data-toggle="modal" data-target="#modal-edit" class="edit-rack btn btn-primary" data-id="<?= $data->id_rack; ?>">
								<i class="fas fa-edit"></i>
							</button>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</section>
</div>

<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Rack</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('master/master_rack/tambah')?>" method="POST">
					<div class="card-body">
			
					<div class="form-group row">
							<label for="area_rack" class="col-sm-3 col-form-label">Area Rack</label>
							<div class="col-sm-9">
								<input type="text" name="area_rack" class="form-control" id="area_rack" placeholder="Kaleng" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="kode_rack" class="col-sm-3 col-form-label">Kode Rack </label>
							<div class="col-sm-9">
								<input type="text" name="kode_rack" class="form-control" id="kode_rack" placeholder="A.54" required>
							</div>
							
						</div>
						<div class="form-group row">
							<label for="no_rack" class="col-sm-3 col-form-label">No Rack</label>
							<div class="col-sm-9">
								<input type="number" name="no_rack" class="form-control" id="no_rack" placeholder="No rack..." required>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-12 text-right">
								<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
									<i class="fas fa-plus"></i> Add jenis Rack
								</button>
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

<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Data Rack</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('master/master_rack/edit')?>" method="post">
					<div class="card-body">
				
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Area Rack</label>
							<div class="col-sm-8">
								<input type="hidden" id="id_rack" name="id_rack" value="">
								<input type="text" name="area_rack" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Kode Rack</label>
							<div class="col-sm-8">
								<input type="text" name="kode_rack" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">No Rack</label>
							<div class="col-sm-8">
								<input type="text" name="no_rack" class="form-control" required>
							</div>
						</div>
						
						<div class="form-group float-right pt-5">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary ml-2">Update</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /.modal -->


<script>
	// Mengambil id_rack
	$(document).ready(function(){
    $('.edit-rack').on('click', function(){
			var idRack = $(this).data('id');
			// alert(idRack);
			// $('#modal-edit #id_rack').val(idRack);

			$.ajax({
				url: '<?= site_url('master/master_rack/get_rack')?>',
				type: 'POST',
				data: {id_rack: idRack},
				dataType: 'json',
				success: function(response) {
					// Isi form modal dengan data dari response
					$('#modal-edit #id_rack').val(response.id_rack);
					$('#modal-edit input[name="area_rack"]').val(response.area_rack);
					$('#modal-edit input[name="kode_rack"]').val(response.kode_rack);
					$('#modal-edit input[name="no_rack"]').val(response.no_rack);
					// Buka modal setelah data diisi
					$('#modal-edit').modal('show');
				}
			});

    });
	});
</script>
	  
		
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
</script>