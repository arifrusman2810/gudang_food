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
							<input type="hidden" id="id_rack" name="id_rack" value="">
							<label class="col-sm-4 col-form-label">Area Gudang</label>
							<div class="col-sm-8">
								<select name="id_area_gudang" id="id_area_gudang" class="form-control" required>
									<option value="">-- Pilih Area Gudang --</option>
									<?php foreach ($area_gudang as $area): ?>
										<option value="<?= $area->id_area_gudang; ?>">
											<?= $area->nama_area; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">Nama Rack</label>
							<div class="col-sm-8">
								<input type="text" id="nama_rack" name="nama_rack" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 col-form-label">No Rack</label>
							<div class="col-sm-8">
								<input type="text" id="no_rack" name="no_rack" class="form-control" required>
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
	// JSON data yang di-passing dari PHP
	var rackData = <?= $rack_json; ?>;

	// Set value untuk id_area_gudang
	$('#id_area_gudang').val(rackData.id_area_gudang);

	// Set value untuk nama_rack dan no_rack
	$('#nama_rack').val(rackData.nama_rack);
	$('#no_rack').val(rackData.no_rack);
});
</script>



<select name="id_area_gudang" id="" class="form-control" required>
	<option value="">-- Pilih area gudang --</option>
	<?php foreach($area_gudang as $area): ?>
		<option value="<?= $area->id_area_gudang; ?>">
			<?= $area->nama_area; ?>
		</option>
	<?php endforeach; ?>
</select>


<script>
$(document).ready(function(){
	$('.edit-rack').on('click', function(){
		var idRack = $(this).data('id');
		
		$.ajax({
			url: '<?= site_url('master/master_rack/get_rack')?>',
			type: 'POST',
			data: {id_rack: idRack},
			dataType: 'json',
			success: function(response) {
				// Isi form modal dengan data dari response
				$('#modal-edit #id_rack').val(response.id_rack);
				$('#modal-edit select[name="id_area_gudang"]').val(response.id_area_gudang);
				$('#modal-edit input[name="nama_rack"]').val(response.nama_rack);
				
				// Asumsikan response.no_rack adalah array
				// Isi nilai No Rack pertama
				$('#modal-edit #no-rack-container2 input[name="no_rack[]"]').first().val(response.no_rack[0]);
				
				// Hapus input No Rack tambahan yang mungkin ada sebelumnya
				$('#modal-edit .no-rack-item:not(:first)').remove();
				
				// Tambahkan input No Rack lainnya jika ada lebih dari satu
				for (var i = 1; i < response.no_rack.length; i++) {
					var newRackInput = `
						<div class="form-group row no-rack-item">
							<label for="no_rack" class="col-sm-3 col-form-label">No Rack</label>
							<div class="col-sm-7">
								<input type="number" name="no_rack[]" class="form-control" value="${response.no_rack[i]}" required>
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-danger btn-remove-rack">
									<i class="fas fa-trash-alt"></i>
								</button>
							</div>
						</div>
					`;
					$('#no-rack-container2').append(newRackInput);
				}

				// Buka modal setelah data diisi
				$('#modal-edit').modal('show');
			}
		});

	});

	// Event listener untuk tombol tambah
	$('#btn-add-rack2').on('click', function() {
		var newRackInput = `
			<div class="form-group row no-rack-item">
				<label for="no_rack" class="col-sm-3 col-form-label">No Rack</label>
				<div class="col-sm-7">
					<input type="number" name="no_rack[]" class="form-control" required>
				</div>
				<div class="col-sm-2">
					<button type="button" class="btn btn-danger btn-remove-rack">
						<i class="fas fa-trash-alt"></i>
					</button>
				</div>
			</div>
		`;
		$('#no-rack-container2').append(newRackInput);
	});

	// Event listener untuk tombol delete
	$(document).on('click', '.btn-remove-rack', function() {
		$(this).closest('.no-rack-item').remove();
	});
});
</script>




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
					// $('#modal-edit input[name="id_area_gudang"]').val(response.id_area_gudang);
					$('#modal-edit select[name="id_area_gudang"]').val(response.id_area_gudang);
					$('#modal-edit input[name="nama_rack"]').val(response.nama_rack);
					$('#modal-edit input[name="no_rack"]').val(response.no_rack);
					// Buka modal setelah data diisi
					$('#modal-edit').modal('show');
				}
			});

	});
	});
</script>




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
							<select name="id_departement" id="" class="form-control" required>
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
						<tr>
							<th>Nama Barang</th>
							<th>Qty</th>
							<th>Stock</th>
							<th>Action</th>
						</tr>
					</table>

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
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	document.getElementById('addItemBtn').addEventListener('click', function() {
		const table = document.getElementById('itemsTable');
		const newRow = document.createElement('tr');

		newRow.innerHTML = `
				<td>
						<select name="barang[]" class="form-control">
								<option value="">Pilih</option>
								<option value="1">Barang 1</option>
								<option value="2">Barang 2</option>
								<option value="3">Barang 3</option>
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

		// Add event listener to the remove button
		newRow.querySelector('.btn-remove-item').addEventListener('click', function() {
				this.closest('tr').remove();
		});
	});
</script>


<script>
	$(document).ready(function() {
		$('#id_area_gudang').change(function() {
				var id_area_gudang = $(this).val();
				if (id_area_gudang) {
						$.ajax({
							url: '<?= site_url('transaksi/permintaan/get_barang_by_area')?>',
							type: 'GET',
							data: { id_area_gudang: id_area_gudang },
							success: function(response) {
									$('#barang').empty();
									$('#barang').append('<option value="">Pilih Barang</option>');

									$.each(JSON.parse(response), function(key, value) {
											$('#barang').append('<option value="' + value.id + '">' + value.nama_barang + '</option>');
									});
								}
						});
				} else {
						$('#barang').empty();
						$('#barang').append('<option value="">Pilih Barang</option>');
				}
		});
	});
</script>



<script>
	document.getElementById('addItemBtn').addEventListener('click', function() {
    const table = document.getElementById('itemsTable');
    const noteAndSubmit = document.getElementById('noteAndSubmit');
    
    // Cek apakah tabel sudah memiliki header
    if (table.rows.length === 0) {
			const headerRow = document.createElement('tr');
			headerRow.innerHTML = `
				<th>Nama Barang</th>
				<th>Qty</th>
				<th>Stock</th>
				<th>Action</th>
			`;
			table.appendChild(headerRow);
    }

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
			<td>
				<select name="barang[]" class="form-control">
					<option value="">Pilih</option>
					<option value="1">Barang 1</option>
					<option value="2">Barang 2</option>
					<option value="3">Barang 3</option>
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

    // Tampilkan tabel dan form note + tombol simpan
    table.classList.remove('d-none');
    noteAndSubmit.classList.remove('d-none');

    // Tambahkan event listener ke tombol remove
    newRow.querySelector('.btn-remove-item').addEventListener('click', function() {
			this.closest('tr').remove();

			// Jika tabel kosong, sembunyikan header dan form
			if (table.rows.length === 1) {
				table.classList.add('d-none');
				table.deleteRow(0);
				noteAndSubmit.classList.add('d-none');
			}
    });
	});
</script>


<script>
	document.getElementById('addItemBtn').addEventListener('click', function() {
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
            <th>Nama Barang</th>
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

        table.classList.remove('d-none');
        noteAndSubmit.classList.remove('d-none');

        // Tambahkan event listener untuk mengisi stok secara otomatis
        newRow.querySelector('select[name="barang[]"]').addEventListener('change', function() {
            const selectedBarangId = this.value;
            const stockInput = this.closest('tr').querySelector('input[name="stock[]"]');

            if (selectedBarangId) {
                $.ajax({
                    url: '<?= site_url('transaksi/permintaan_barang/get_stock_by_barang') ?>',
                    type: 'GET',
                    data: { id_barang: selectedBarangId },
                    success: function(response) {
                        const data = JSON.parse(response);
                        stockInput.value = data.stock; // Isi stok berdasarkan response
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
            <th>Nama Barang</th>
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


<?php 

function tambah(){  

		// $data['roles'] = $this->Role_model->get_roles();
		// var_dump($data['roles']);
		
		$this->form_validation->set_rules('nama_pengguna', 'Nama Pengguna', 'trim|is_unique[user.nama_pengguna]',
			[
				'trim'      => 'Input dengan benar',
				'is_unique' => '%s Sudah ada!!!.'
			]
		);
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim',
			[
				'required' => 'Nama Lengkap harus diisi.'
			]
		);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]',
			[
				'required' => 'Password harus diisi.',
				'min_length' => 'Password minimal 6 karakter.'
			]
		);
		$this->form_validation->set_rules('hakakses', 'Hak Akses', 'required',
			[
				'required' => 'Hak Akses harus dipilih.'
			]
		);
	
		if ($this->form_validation->run() == false) {
			$output['status'] = 201;
			$output['message'] = validation_errors(); 
			echo json_encode($output);
		} else {
			$data = [
				'id_pengguna'   => $this->input->post('id_pengguna'),
				'nama_pengguna' => $this->input->post('nama_pengguna'), 
				'nama_lengkap'  => $this->input->post('nama_lengkap'), 
				'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'status'        => $this->input->post('status'),
				'hak_akses'     => $this->input->post('hakakses')
			];
	
			try {
				$this->db->insert('user', $data);
				$output['status'] = 200;
				$output['message'] = 'Data berhasil ditambahkan';
			} catch (Exception $e) {
				$output['status'] = 500;
				$output['message'] = 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage();
			}
			echo json_encode($output);
		}
	}

	?>


<!-- script untuk edit -->
<script>
	$(document).ready(function(){
		$('.edit-pengguna').on('click', function(){
			var idPengguna = $(this).data('id');
			// alert(idPengguna);
		
			$.ajax({
				url: '<?= site_url('master/pengguna/get_pengguna')?>',
				type: 'POST',
				data: {id_pengguna: idPengguna},
				dataType: 'json',
				success: function(response) {
					console.log(response);
					// alert('Data diterima');
					// Isi form modal dengan data dari response
					$('#modal-edit-user #id_pengguna').val(response.id_pengguna);
					$('#modal-edit-user #nama_pengguna').val(response.nama_pengguna);
					$('#modal-edit-user #nama_lengkap').val(response.nama_lengkap);
					$('#modal-edit-user #password').val(response.password);
					$('#modal-edit-user select[name="id_role"]').val(response.id_role);
					$('#modal-edit-user select[name="id_departement"]').val(response.id_departement);
					$('#modal-edit-user select[name="id_atasan"]').val(response.id_atasan);
					
					$('#modal-edit-user').modal('show');
				}
			});

		});

	});
</script>



<script>
	$(document).ready(function(){
		// Fungsi untuk menampilkan atau menyembunyikan dropdown Atasan
		function toggleAtasanDropdown(id_role) {
			if (id_role == 3) { // Jika role ID 3 - User Request
				$('#dropdown-atasan').show();
				$('#id_atasan').attr('required', true); // Menambahkan atribut required jika ditampilkan
			} else {
				$('#dropdown-atasan').hide();
				$('#id_atasan').removeAttr('required'); // Menghapus atribut required jika disembunyikan
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
					
					// Panggil fungsi untuk menyesuaikan dropdown Atasan
					toggleAtasanDropdown(response.id_role);
					
					// Tampilkan modal edit
					$('#modal-edit-user').modal('show');
				}
			});

		});

		// Ketika role diubah oleh pengguna
		$('#id_role').change(function(){
			var selectedRole = $(this).val();
			toggleAtasanDropdown(selectedRole);
		});
	});
</script>

<script>
	$(document).ready(function(){
		// Fungsi untuk menampilkan atau menyembunyikan dropdown Atasan
		function toggleAtasanDropdown(id_role, id_atasan) {
			if (id_role == 3 && id_atasan) { // Jika role ID 3 - User Request dan memiliki atasan
				$('#dropdown-atasan').show();
				$('#id_atasan').attr('required', true); // Menambahkan atribut required jika ditampilkan
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
	});
</script>






