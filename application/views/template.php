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



