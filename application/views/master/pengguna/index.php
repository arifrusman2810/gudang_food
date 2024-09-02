<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Kelola Pengguna</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<div class="card-header">
					<a href="" data-toggle="modal"
						data-target="#modal-tambah" class="btn btn-primary btn-tambah-pengguna">
						<i class="fas fa-plus"></i> Tambah</a>
				</div>
				<div class="card-body table-responsive">
					<table id="table_kelola_pengguna" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pengguna</th>
								<th>Role</th>
								<th>Departement</th>
								<th data-orderable="false">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							foreach($user as $data):
							?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data->nama_pengguna; ?></td>
								<td><?= $data->nama_role; ?></td>
								<td><?= $data->nama_departement; ?></td>
								<td>
									<button data-toggle="modal"
										data-target="#modal-edit-user"  <?= $this->session->userdata('username') == $data->nama_pengguna ? 'disabled' : '' ?> data-id="<?= $data->id_pengguna;?>" class="edit-pengguna btn btn-primary">
										<i class="fas fa-edit"></i>
									</button>

									<button <?= $this->session->userdata('username') == $data->nama_pengguna ? 'disabled' : '' ?> class="delete-user btn btn-danger">
										<i class="fas fa-trash-alt"></i>
									</button>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</section>
</div>

<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Pengguna</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="" action="<?= site_url('master/pengguna/tambah') ?>" method="POST">
					<div class="card-body">
						<div class="form-group row">
							<!-- <label for="inputPassword" class="col-sm-4 col-form-label">ID Pengguna</label> -->
							<div class="col-sm-8">
								<input readonly type="hidden" name="id_pengguna" value="<?= $auto_kode ?>" class="form-control"
								>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-4 col-form-label">Nama Pengguna</label>
							<div class="col-sm-8">
								<input type="username" name="nama_pengguna" class="form-control"
									id="" placeholder="Nama Pengguna" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_lengkap" class="col-sm-4 col-form-label">Nama Lengkap</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" name="nama_lengkap" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-4 col-form-label">Password</label>
							<div class="col-sm-8">
								<input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="id_role" class="col-sm-4 col-form-label">Role</label>
							<div class="col-sm-8">
								<select class="form-control" id="id_role" name="id_role" required>
									<option disabled selected value="">-- Pilih Role --</option>
									<?php foreach ($roles as $role): ?>
										<option value="<?= $role->id_role ?>">
											<?= $role->nama_role ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="id_departement" class="col-sm-4 col-form-label">Departement</label>
							<div class="col-sm-8">
								<select class="form-control" id="id_departement" name="id_departement" required>
									<option disabled selected value="">-- Pilih departement --</option>
									<?php foreach ($departements as $departement): ?>
										<option value="<?= $departement->id_department ?>"><?= $departement->nama_departement ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="id_atasan" class="col-sm-4 col-form-label">Atasan</label>
							<div class="col-sm-8">
								<select class="form-control" id="id_atasan" name="id_atasan">
									<option disabled selected value="">-- Pilih Atasan --</option>
									<?php foreach ($atasan as $data): ?>
										<option value="<?= $data->id_pengguna ?>"><?= $data->nama_lengkap ?>(<?= $data->nama_departement; ?>)</option>
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
	</div>
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-edit-user">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Edit Pengguna</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('master/pengguna/edit')?>" id="" method="post">
					<div class="card-body">
						<div class="form-group row">
							<div class="col-sm-8">
								<input readonly type="hidden" id="id_pengguna" name="id_pengguna" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_pengguna" class="col-sm-4 col-form-label">Nama Pengguna</label>
							<div class="col-sm-8">
								<input type="text" id="nama_pengguna" name="nama_pengguna" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_lengkap" class="col-sm-4 col-form-label">Nama Lengkap</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-4 col-form-label">Password</label>
							<div class="col-sm-8">
								<input type="hidden" id="password" name="password" class="form-control">
								<input type="password" id="password_baru" name="password_baru" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-4 col-form-label">Role</label>
							<div class="col-sm-8">
								<select class="form-control" id="id_role" name="id_role">
									<option disabled value="">Pilih</option>
									<?php foreach ($roles as $role): ?>
										<option value="<?= $role->id_role ?>"><?= $role->nama_role ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="id_departement" class="col-sm-4 col-form-label">Departement</label>
							<div class="col-sm-8">
								<select class="form-control" id="id_departemen" name="id_departement">
									<option disabled value="">Pilih</option>
									<?php foreach ($departements as $departement): ?>
										<option value="<?= $departement->id_department ?>"><?= $departement->nama_departement ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="form-group row" id="dropdown-atasan">
							<label for="id_atasan" class="col-sm-4 col-form-label">Atasan</label>
							<div class="col-sm-8">
								<select class="form-control" name="id_atasan">
									<option disabled value="">-- Pilih Atasan --</option>
									<?php foreach ($atasan as $data): ?>
										<option value="<?= $data->id_pengguna ?>"><?= $data->nama_lengkap ?> (<?= $data->nama_departement; ?>)</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<div class="form-group row" id="dropdown-gudang">
							<label for="id_area_gudang" class="col-sm-4 col-form-label">Area gudang</label>
							<div class="col-sm-8">
								<select class="form-control" name="id_area_gudang">
									<option disabled value="">-- Pilih Area Gudang --</option>
									<?php foreach ($gudang as $data): ?>
										<option value="<?= $data->id_area_gudang ?>">
											<?= $data->jenis_gudang ?> (<?= $data->nama_area; ?>)
										</option>
									<?php endforeach; ?>
								</select>
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


<script>
	$(document).ready(function() {
		$('#id_role').change(function() {
			var roleId = $(this).val();
			if (roleId == 3) {
				$('#id_atasan').closest('.form-group').show();
			} else {
				$('#id_atasan').closest('.form-group').hide();
				$('#id_atasan').html('<option disabled selected value="">-- Pilih Atasan --</option>'); // Reset dropdown atasan
			}
		});
	
		$('#id_departement').change(function() {
			var departmentId = $(this).val();
			var roleId = $('#id_role').val();

			if (roleId == 3 && departmentId != '') {
				$.ajax({
					url: '<?= site_url('master/pengguna/getAtasanByDepartement') ?>',
					type: 'POST',
					data: {id_departement: departmentId},
					success: function(response) {
						$('#id_atasan').html(response);
					}
				});
			}
		});

		// Inisialisasi: Sembunyikan dropdown atasan saat halaman dimuat
		if ($('#id_role').val() != 3) {
			$('#id_atasan').closest('.form-group').hide();
		}
	});
</script>


<script>
	$(document).ready(function(){
		// Fungsi untuk menampilkan atau menyembunyikan dropdown Atasan
		function toggleAtasanDropdown(id_role, id_atasan) {
			if (id_role == 3 && id_atasan) { // Jika role ID 3 - User Request dan memiliki atasan
				$('#dropdown-atasan').show();
				$('#id_atasan').attr('required', true); // Menambahkan atribut required jika ditampilkan

				$('#dropdown-gudang').hide();
				$('#id_area_gudang').removeAttr('required');
				$('#id_area_gudang').val('');
			} else {
				$('#dropdown-atasan').hide();
				$('#id_atasan').removeAttr('required'); // Menghapus atribut required jika disembunyikan
				$('#id_atasan').val(''); // Menghapus nilai dropdown Atasan

			}
		}

		// Ketika tombol edit-pengguna diklik
		$('.edit-pengguna').on('click', function(){
			var idPengguna = $(this).data('id');
		
			$.ajax({
				url: '<?= site_url('master/pengguna/get_pengguna')?>',
				type: 'POST',
				data: {id_pengguna: idPengguna},
				dataType: 'json',
				success: function(response) {
					console.log(response);
					
					// Isi form modal dengan data dari response
					$('#modal-edit-user #id_pengguna').val(response.id_pengguna);
					$('#modal-edit-user #nama_pengguna').val(response.nama_pengguna);
					$('#modal-edit-user #nama_lengkap').val(response.nama_lengkap);
					$('#modal-edit-user #password').val(response.password);
					$('#modal-edit-user select[name="id_role"]').val(response.id_role);
					$('#modal-edit-user select[name="id_departement"]').val(response.id_departement);
					$('#modal-edit-user select[name="id_atasan"]').val(response.id_atasan);
					$('#modal-edit-user select[name="id_area_gudang"]').val(response.id_area_gudang);
					
					// Panggil fungsi untuk menyesuaikan dropdown Atasan
					toggleAtasanDropdown(response.id_role, response.id_atasan);
					
					// Tampilkan modal edit
					$('#modal-edit-user').modal('show');
				}
			});

		});

		// Ketika role diubah oleh pengguna
		$('#modal-edit-user').on('change', '#id_role', function(){
			var selectedRole = $(this).val();
			// Panggil toggleAtasanDropdown dengan nilai atasan kosong karena user belum memilih atasan baru
			toggleAtasanDropdown(selectedRole, $('#id_atasan').val());
		});

		// Sebelum form dikirim, pastikan untuk menghapus id_atasan jika role bukan 3
		$('#modal-edit-user form').on('submit', function(e) {
			var selectedRole = $('#id_role').val();
			if (selectedRole != 3) {
				$('#id_atasan').remove();
				$('#modal-edit-user select[name="id_atasan"]').remove();
			}
		});
	});
</script>







