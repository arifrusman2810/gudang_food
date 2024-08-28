      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      	<!-- Content Header (Page header) -->
      	<section class="content-header">
      		<div class="container-fluid">
      			<div class="row mb-2">
      				<div class="col-sm-6">
      					<h1>Kelola Departement</h1>
      				</div>
      			</div>
      		</div><!-- /.container-fluid -->
      	</section>

      	<!-- Main content -->
      	<section class="content">
		  <a href="<?= base_url('master/pengguna/tambah')?>" data-toggle="modal"
      						data-target="#modal-tambah" class="btn btn-primary">
      						<i class="fas fa-plus"></i> Tambah</a>
							  <div id="table-container">
    <table id="department-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Departement</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (is_array($departments) && !empty($departments)) {
                $no = 1; 
                foreach($departments as $d): 
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= isset($d['nama_departement']) ? $d['nama_departement'] : 'N/A'; ?></td>
                    <td>
                        <button data-toggle="modal" data-target="#modal-edit-user" class="edit-pengguna btn btn-primary">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            <?php 
                endforeach; 
            } else {
            ?>
                <tr>
                    <td colspan="3">Data tidak tersedia</td>
                </tr>
            <?php 
            } 
            ?>
        </tbody>
    </table>
</div>
      	</section>
      </div>

      <div class="modal fade" id="modal-tambah">
      	<div class="modal-dialog">
      		<div class="modal-content">
      			<div class="modal-header">
      				<h4 class="modal-title">Tambah Departement</h4>
      				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>
      			<div class="modal-body">
      				<form action="javascript:void(0)" id="tambah_pengguna" data-url="<?=base_url('Departement/tambah')?>" method="POST">
      					<div class="card-body">
					
      						<div class="form-group row">
      							<label for="inputPassword" class="col-sm-6 col-form-label">Nama Departement</label>
      							<div class="col-sm-6">
      								<input type="text" name="nama_Departement" class="form-control"
      									id="exampleInputEmail1" placeholder="Nama Departement">
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
</script>