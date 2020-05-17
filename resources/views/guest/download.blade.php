@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-128 pb-128">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-12 col-12">
				<div class="shadow-box">
					<h5 class="text-center">Thank you for purchasing {{ $product->title }}</h5>
					<p class="text-center">You can download your product below by clicking the button.</p>
					<a href="{{ url('/shop/product/download/' . $order->customer_id) }}" class="btn btn-primary centered">Download Now</a>
				</div>
			</div>
		</div>
	</div>
@endsection