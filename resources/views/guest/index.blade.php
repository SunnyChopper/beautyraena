@extends('layouts.app')

@section('content')
	@include('layouts.main-banner')

	<div class="background-row set-bg" data-bg="https://www.brides.com/thmb/-AbbvKHVo62l6dfkWs2VZK5BNlg=/2121x1414/filters:fill(auto,1)/GettyImages-1138664963-3974d963ede84e9c9592cb25cfb94815.jpg">
		<div class="overlay">
			<div class="container pt-64 pb-64">
				<div class="row justify-content-center" style="padding: 0px 12px;">
					<div class="col-lg-8 col-md-9 col-sm-10 col-12" style="background-color: #f0f0f0; padding: 24px; border-radius: 8px;">
						<h2 class="text-center mb-1">Shop</h2>
						<p class="mb-0 text-center">Check out my newest products.</p>

						@if(count($products) > 0)

						@else
							<p class="mt-2 mb-0 text-center"><small>No products found in the shop. If you are an admin, <a href="{{ url('/admin') }}">login</a> to add a new product.</small></p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="background-row set-bg" data-bg="https://i.ytimg.com/vi/A_zvvbDOEY4/maxresdefault.jpg">
		<div class="overlay">
			<div class="container pt-64 pb-64">
				<div class="row justify-content-center" style="padding: 0px 12px;">
					<div class="col-lg-10 col-md-9 col-sm-10 col-12" style="background-color: #f0f0f0; padding: 24px; border-radius: 8px;">
						<h2 class="text-center mb-1">Reviews</h2>
						<p class="mb-0 text-center">How I'm helping others build their businesses</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
