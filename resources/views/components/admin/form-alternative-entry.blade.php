<div class="modal fade rounded-0" id="add_alternative" tabindex='-1' role='dialog' aria-labelledby='myExtraLargeModalLabel' aria-hidden='true' data-backdrop='static' data-keyboard='false'>
	<div class="modal-dialog modal-md rounded-0">
		<!-- konten modal-->
		<div class="modal-content rounded-0">
			<!-- heading modal -->
			<div class="modal-header text-white bg-primary-custom rounded-0" id="alertMessage">
				<h4 class="modal-title medium text-white"><label id="vehicle_add_title">Tambah Alternatif</label></h4>
				<button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>

			<!-- body modal -->
			<div class="modal-body">
				<div class="row pt-4">
					<div class="col">
                        <div class="form-group row">
                            <label for="alternative" class="col-sm-2 col-form-label">Name</label>
							<div class="col">
								<input type="text" class="form-control" id="alternative" value="">
								<div class='invalid-feedback' id='alternativeError'></div>
								<div class='valid-feedback'></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<input id="alternative_id" type="hidden" name="" value='0'>
			<!-- footer modal -->
			<div class="modal-footer">
				<button class="btn btn-primary-custom text-white" type="button" id="addAlternative" >Simpan</button>
				<button class="btn btn-primary-custom text-white" type="button" id="cancelAlternative" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>
