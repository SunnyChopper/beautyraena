@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-8 col-sm-10 col-12">
				<h4 class="mb-3">Recently Joined Users</h4>
				@if(count($users) > 0)
				<ul class="list-group">
					@foreach($users as $user)
					<li class="list-group-item">
						<h5 class="mb-0">{{ $user->first_name }} {{ $user->last_name }}</h5>
						<p class="mb-0">Email: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
						<p class="mb-0"><small>Joined {{ Carbon\Carbon::parse($user->created_at)->format('M jS, Y') }}</small></p>
					</li>
					@endforeach
				</ul>
				@endif

				<h4 class="mt-64">Recent Products</h4>
				@if(count($products) > 0)
				@else
					<div class="empty-box">
						<h5 class="text-center mb-0">No Products Found</h5>
						<p class="text-center mb-0"><small>Go to the <a href="{{ url('/admin/products') }}">Products</a> page to manage your products.</small></p>
					</div>
				@endif

				<h4 class="mt-64">Recent Orders</h4>
				@if(count($orders) > 0)
				@else
					<div class="empty-box">
						<p class="text-center mb-0"><small>No orders were found in the system.</small></p>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection