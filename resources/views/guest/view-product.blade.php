@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('guest.modals.purchase')

	<div class="container pt-64 pb-64">
		<div class="row" style="display: flex;">
			<div class="col-lg-4 col-md-4 col-sm-12 col-12" style="margin: auto;">
				<img src="{{ $product->cover_image }}" class="regular-image-100" />
			</div>

			<div class="col-lg-8 col-md-8 col-sm-12 col-12" style="margin: auto;">
				<h3 class="mb-0">{{ $product->title }}</h3>
				<p class="mb-0"><small>Digital Download</small></p>
				<hr />
				<p>{{ $product->description }}</p>
				<button type="button" class="btn btn-primary purchase_button">Purchase for ${{ sprintf("%.2f", $product->price) }}</button>
			</div>
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
		let product = Array();

		/* --------------------- *\
		|  2. Helper functions    |
		\* --------------------- */

		function fetchData() {
			$.ajax({
				url: '/api/products/read?product_id=' + {{ $product->id }},
				type: 'GET',
				success: function(response) {
					if (response.success == true) {
						product = response.product;
					}
				}
			});
		}

		/* --------------------- *\
		|  3. Button Bindings     |
		\* --------------------- */

		$('.purchase_button').on('click', function() {
			$('#purchase_product_title').html(product.title);
			$('#purchase_product_modal').modal('show');
		});

		/* --------------------- *\
		|  4. Dynamic Bindings    |
		\* --------------------- */

		/* --------------------- *\
		|  5. Document Load       |
		\* --------------------- */

		$(document).ready(function() {
			fetchData();
		});
	</script>
@endsection