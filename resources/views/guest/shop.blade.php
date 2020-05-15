@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		@if(count($products) > 0)
		<div class="row">
			@foreach($products as $product)
			<div class="col-lg-4 col-md-4 col-sm-6 col-12">
				<a href="{{ url('/shop/products/' . $product->id) }}" style="text-decoration: none;">
					<div class="image-box">
						<div class="image-box-image">
							<img src="{{ $product->cover_image }}" class="regular-image-100 centered" />
						</div>
						<div class="image-box-info">
							<h5 class="text-center mb-2">{{ $product->title }}</h5>
							<p class="text-center mb-0">${{ sprintf("%.2f", $product->price) }}</p>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
		@else
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-9 col-sm-11 col-12">
				<div class="shadow-box">
					<h3 class="text-center">No Products</h3>
					<p class="text-center mb-0">There are no products in the shop. If you're an admin, click <a href="{{ url('/admin') }}">here</a> to login to add a new product.</p>
				</div>
			</div>
		</div>
		@endif
	</div>
@endsection