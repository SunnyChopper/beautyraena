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

		String.prototype.splice = function(idx, rem, str) {
    		return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
		};

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
		|  3. Static Bindings     |
		\* --------------------- */

		$('input[name=cardNumber]').on('keyup', function() {
			let cardInput = $(this).val();

			if (cardInput.length >= 20) {
				cardInput = cardInput.slice(0, -1);
				$(this).val(cardInput);
			} else {
				if ((cardInput.length % 5 == 0) && (cardInput.length != 0)) {
					cardInput = cardInput.splice((cardInput.length - 1), 0, " ");
					$(this).val(cardInput);
				}
			}
		});

		$('input[name=cvvNumber]').on('keyup', function() {
			let cvvInput = $(this).val();

			if (cvvInput.length >= 4) {
				cvvInput = cvvInput.slice(0, -1);
				$(this).val(cvvInput);
			}
		});

		$('.purchase').on('click', function() {
			$(this).attr('disabled', true);

			let cardNumber = $('input[name=cardNumber]').val();
			let cvvNumber = $('input[name=cvvNumber]').val();
			let ccExpiryMonth = $('select[name=ccExpiryMonth]').val();
			let ccExpiryYear = $('select[name=ccExpiryYear]').val();
			let firstName = $('input[name=first_name]').val();
			let lastName = $('input[name=last_name]').val();
			let email = $('input[name=email]').val();
			let product_id = $('input[name=product_id]').val();

			console.log(ccExpiryMonth);

			$.ajax({
				url: '{{ url('/shop/payments/submit') }}',
				type: 'POST',
				data: {
					_token,
					cardNumber,
					cvvNumber,
					ccExpiryMonth,
					ccExpiryYear,
					email,
					product_id
				},
				success: function(data) {
					console.log(data);
					if (data.success == true) {
						window.location.replace("{{ url('/shop/download/') }}/" + data.order.customer_id);
					}
				}
			});
		});

		$('.purchase_button').on('click', function() {
			$('#purchase_product_title').html(product.title);
			$('#purchase_product_id').val(product.id);
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