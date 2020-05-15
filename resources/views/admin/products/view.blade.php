@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.products.modals.create')
	@include('admin.products.modals.delete')

	<div class="container pt-64 pb-64">
		<div id="display_row" class="row justify-content-center">

		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		/* ------------------------ *\
		|  View JQuery               |
		|----------------------------|
		|  1. Global variables       |
		|  2. Helper functions       |
		|  3. Button bindings        |
		|  4. Dynamic bindings       |
		|  5. Document load          |
		\* ------------------------ */

		/* --------------------- *\
		|  1. Global variables    |
		\* --------------------- */

		let _token = '{{ csrf_token() }}';
		let products = Array();

		/* --------------------- *\
		|  2. Helper functions    |
		\* --------------------- */

		function renderEmpty() {
			let render_html = `
				<div class="col-lg-7 col-md-8 col-sm-10 col-12">
					<div class="shadow-box">
						<h4 class="text-center">No Products Found</h4>
						<p class="text-center">Click below to create your first product.</p>
						<button type="button" class="btn btn-sm btn-primary centered new_product">Create New Product</button>
					</div>
				</div>
			`;

			$('#display_row').html(render_html);
		}

		function renderTable() {
			let render_html = `
				<div class="col-12">
					<div style="overflow: auto;">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Title</th>
									<th>Description</th>
									<th>Price</th>
									<th>Cover Image</th>
									<th></th>
								</tr>
							</thead>
							<tbody>`;

			products.forEach((product) => {
				render_html += `
					<tr>
						<td style="vertical-align: middle;">${product.title}</td>
						<td style="vertical-align: middle;">${product.description}</td>
						<td style="vertical-align: middle;">$${product.price.toFixed(2)}</td>
						<td style="vertical-align: middle;"><img style="width: 100px; height: auto;" src="${product.cover_image}" /></td>
						<td style="vertical-align: middle;">
							<button type="button" data-id="${product.id}" class="btn btn-sm btn-danger m-1 delete_product" style="float: right;">Delete</button>
							<a href="{{ url('/products/file/download') }}/${product.id}" class="btn btn-sm btn-info m-1" style="float: right;">Download File</a>
						</td>
					</tr>
				`;
			});

			render_html +=	`</tbody>
						</table>
					</div>
				</div>

				<div class="col-12 mt-32">
					<button type="button" class="btn btn-sm btn-primary centered new_product">Create New Product</button>
				</div>
			`;

			$('#display_row').html(render_html);
		}

		function renderHTML() {
			if (products.length > 0) {
				renderTable();
			} else {
				renderEmpty();
			}
		}

		function fetchData() {
			$.ajax({
				url: '/api/products/get',
				type: 'GET',
				success: function(response) {
					products = response.products;
					renderHTML();
				} 
			});
		}

		/* --------------------- *\
		|  3. Button Bindings     |
		\* --------------------- */

		$('.create').on('click', function() {
			$('#create_error').hide();
			$(this).attr('disabled', true);

			let title = $('#create_title').val();
			let description = $('#create_description').val();
			let price = $('#create_price').val();
			let cover_image = $('#create_cover_image').prop('files')[0];
			let file = $('#create_file').prop('files')[0];

			if ((title == "") || (price == "") || (cover_image == undefined) || (file == undefined)) {
				$('#create_error').show();
				$(this).attr('disabled', false);
			} else {
				var formData = new FormData();
				formData.append('title', title);
				formData.append('description', description);
				formData.append('price', price);
				formData.append('cover_image', cover_image);
				formData.append('file', file);

				$.ajaxSetup({
					headers: {
						'X-CSRF-Token': _token
					}
				});

				$.ajax({
					url: '/api/products/create',
					type: 'POST',
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					success: function(response) {
						if (response.success == true) {
							$('#create_product_modal').modal('hide');
							fetchData();
							$('.create').attr('disabled', false);
						}
					}
				});
			}
		});

		$('.delete').on('click', function() {
			$(this).attr('disabled', true);

			$.ajax({
				url: '/api/products/delete',
				type: 'DELETE',
				data: {
					_token: _token,
					product_id: $('#delete_id').val()
				},
				success: function(response) {
					if (response.success == true) {
						$(this).attr('disabled', false);
						$('#delete_product_modal').modal('hide');
						fetchData();
					}
				}
			});
		});

		/* --------------------- *\
		|  4. Dynamic Bindings    |
		\* --------------------- */

		$(document).on('click', '.new_product', function() {
			$('#create_product_modal').modal('show');
		});

		$(document).on('click', '.delete_product', function() {
			let product_id = $(this).data('id');
			$('#delete_id').val(product_id);
			$('#delete_product_modal').modal('show');
		});

		/* --------------------- *\
		|  5. Document Load       |
		\* --------------------- */

		$(document).ready(function() {
			fetchData();
		});
	</script>
@endsection