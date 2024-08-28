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
