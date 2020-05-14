<div class="modal fade" id="create_product_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Create New Product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-lg-8 col-md-8 col-sm-10 col-12">
							<label class="mb-0">Title<span class="red">*</span>:</label>
							<input type="text" class="form-control" placeholder="My Amazing E-Book" id="create_title" />
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<label class="mb-0">Description:</label>
							<textarea class="form-control" id="create_description" placeholder="This is the best e-book in the world..." rows="5"></textarea>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label class="mb-0">Price<span class="red">*</span>:</label>
							<input type="number" class="form-control" id="create_price" placeholder="9.99" min="0.00" step="0.01" />
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label class="mb-0">Image<span class="red">*</span>:</label>
							<input type="file" id="create_cover_image" />
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label class="mb-0">File<span class="red">*</span>:</label>
							<input type="file" id="create_file" />
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success create">Create</button>
				</div>
			</div>
		</form>
	</div>
</div>