@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-128 pb-128">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-9 col-sm-10 col-12">
				<div class="shadow-box">
					<form method="POST" action="{{ url('/admin/login') }}">
						{{ csrf_field() }}

						<div class="form-group">
							<label class="mb-0" for="email">Email:</label>
							<input type="email" class="form-control" placeholder="admin@beautyraena.com" name="email" required />
						</div>

						<div class="form-group mt-32">
							<label class="mb-0" for="password">Password:</label>
							<input type="password" class="form-control" placeholder="•••••••" name="password" required />
						</div>

						@if(session()->has('error'))
						<div class="form-group mt-16">
							<p class="red text-center">{{ session()->get('error') }}</p>
						</div>
						@endif

						<div class="form-group mt-32">
							<input type="submit" class="btn btn-primary centered" value="Login" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection