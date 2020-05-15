<div class="modal fade" id="delete_product_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Product</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="delete_id" />
					<p>Are you sure you want to delete this product?</p>
				</div>
				<div class="modal-footer">
					<p class="red" id="delete_error" style="display: none;">Please fill out all fields.</p>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger delete">Delete</button>
				</div>
			</div>
		</form>
	</div>
</div>