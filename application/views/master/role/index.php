      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      	<!-- Content Header (Page header) -->
      	<section class="content-header">
      		<div class="container-fluid">
      			<div class="row mb-2">
      				<div class="col-sm-6">
      					<h1>Kelola Role</h1>
      				</div>
      			</div>
      		</div><!-- /.container-fluid -->
      	</section>

      	<!-- Main content -->
      	<section class="content">
      		<div class="container-fluid">
      			<div class="card">
      				<div class="card-header">
      					<a href="<?= base_url('master/pengguna/tambah')?>" data-toggle="modal"
      						data-target="#modal-tambah" class="btn btn-primary btn-tambah-pengguna">
      						<i class="fas fa-plus"></i> Tambah</a>
      				</div>
      				<div class="card-body table-responsive">
      					<table id="table_kelola_pengguna" class="table table-bordered table-striped">
      						<thead>
      							<tr>
      								<th>No</th>
      								<th>Nama Role</th>
      								<th data-orderable="false">Action</th>
      							</tr>
      						</thead>
      						<tbody>
      							<?php 
								 	$no = 1; 
								  foreach($role as $u): ?>
      							<tr>
									
      								<td><?=$no?></td>
      								<td><?= $u['nama_role'];?></td>                  
                  </td>
      								<td>
      									<button data-toggle="modal"
      										data-target="#modal-edit-role" data-id="<?= $u['id_role'];?>" class="edit-pengguna btn btn-primary">
      										<i class="fas fa-edit"></i>
      									</button>
      									<button 
										  data-id="<?= $u['id_role'];?>" data-nama="<?= $u['id_role'];?>"
      										class="delete-role btn btn-danger">
      										<i class="fas fa-trash-alt"></i>
      									</button>
      								</td>
      							</tr>
      							<?php 
									$no++;
								endforeach; ?>
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
      				<h4 class="modal-title">Tambah Role</h4>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">
      				<form id="tambah_pengguna" data-url="<?=base_url('master/role/tambah')?>" method="POST">
      					<div class="card-body">
						  <!-- <div class="form-group row"> -->
      							<!-- <label for="inputPassword" class="col-sm-4 col-form-label">ID Pengguna</label> -->
      							<!-- <div class="col-sm-8">
      								<input readonly type="hidden" name="id_rp" value="<?= $auto_kode ?>" class="form-control"
      								>
      							</div> -->
      						<!-- </div> -->
      						<div class="form-group row">
      							<label for="inputPassword" class="col-sm-4 col-form-label">Nama Role</label>
      							<div class="col-sm-8">
      								<input type="text" name="nama_role" class="form-control"
      									id="exampleInputEmail1" placeholder="Nama Role">
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

      <div class="modal fade" id="modal-edit-role">
      	<div class="modal-dialog">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h4 class="modal-title">Edit Pengguna</h4>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">
      				<form action="javascript:void(0)" id="edit-pengguna" data-url="<?=base_url('master/pengguna/edit')?>" method="post">
      					<div class="card-body">
						  	<div class="form-group row">
      							<!-- <label for="inputPassword" class="col-sm-4 col-form-label">ID Pengguna</label> -->
      							<div class="col-sm-8">
      								<input readonly type="hidden" name="id_pengguna" class="form-control"
      									>
      							</div>
      						</div>
      						<div class="form-group row">
      							<label for="inputPassword" class="col-sm-4 col-form-label">Nama Pengguna</label>
      							<div class="col-sm-8">
      								<input type="text" name="nama_pengguna" class="form-control"
      								>
      							</div>
      						</div>
      						<div class="form-group row">
      							<label for="inputPassword" class="col-sm-4 col-form-label">Nama Lengkap</label>
      							<div class="col-sm-8">
      								<input type="text" class="form-control"
      								 name="nama_lengkap">
      							</div>
      						</div>
							<div class="form-group row">
      							<label for="inputPassword" class="col-sm-4 col-form-label">Password</label>
      							<div class="col-sm-8">
      								<input type="password" name="password" class="form-control"
      								>
      							</div>
      						</div>
							<div class="form-group row">
      							<label for="exampleInputEmail1" class="col-sm-4 col-form-label">Role</label>
      							<div class="col-sm-8">
									<select class="form-control" id="satuan" name="id_role">
										<option disabled value="">Pilih</option>
										<?php foreach ($roles as $role): ?>
											<option value="<?= $role['id_role'] ?>"><?= $role['nama_role'] ?></option>
										<?php endforeach; ?>
									</select>
      							</div>
      						</div>
      						<div class="form-group row">
      							<label for="exampleInputEmail1" class="col-sm-4 col-form-label">Departement</label>
      							<div class="col-sm-8">
									<select class="form-control" id="satuan" name="id_departement">
										<option disabled value="">Pilih</option>
										<?php foreach ($departements as $departement): ?>
											<option value="<?= $departement['id_department'] ?>"><?= $departement['nama_departement'] ?></option>
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

<script>
 
</script>
