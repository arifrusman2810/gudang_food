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
