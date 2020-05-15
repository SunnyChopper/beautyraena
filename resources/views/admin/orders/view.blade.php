@extends('layouts.app')

@section('content')
	@include('layouts.banner')

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
		let orders = Array();

		/* --------------------- *\
		|  2. Helper functions    |
		\* --------------------- */

		function renderEmpty() {
			let render_html = `
				<div class="col-lg-7 col-md-8 col-sm-10 col-12">
					<div class="shadow-box">
						<h4 class="text-center">No Orders Found</h4>
						<p class="text-center mb-0">No orders were found in the system.</p>
					</div>
				</div>
			`;

			$('#display_row').html(render_html);
		}

		function renderHTML() {
			if (orders.length > 0) {

			} else {
				renderEmpty();
			}
		}

		function fetchData() {
			$.ajax({
				url: '/api/orders/get',
				type: 'GET',
				success: function(response) {
					orders = response.orders;
					renderHTML();
				} 
			});
		}

		/* --------------------- *\
		|  3. Button Bindings     |
		\* --------------------- */

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