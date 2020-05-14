@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-128 pb-128">
		<div class="row justify-content-center">
			<div class="col-lg-8 col-md-9 col-sm-10 col-12">
				<div class="shadow-box">
					<form method="POST" action="{{ url('/admin/register') }}">
						{{ csrf_field() }}

						<div class="form-group row">
							<div class="col-12">
								<h4>Register Admin Account</h4>
								<p>Fields with <span class="red">*</span> are required.</p>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label class="mb-0">First Name:</label>
								<input type="text" name="first_name" placeholder="John" class="form-control" required />
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label class="mb-0">Last Name:</label>
								<input type="text" name="last_name" placeholder="Appleseed" class="form-control" />
							</div>
						</div>

						<div class="form-group mt-32 row">
							<div class="col-12">
								<label class="mb-0">Email:</label>
								<input type="email" name="email" placeholder="john@apple.com" class="form-control" required />
							</div>
						</div>

						<div class="form-group mt-32 row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label class="mb-0">Password:</label>
								<input type="password" name="password" placeholder="•••••••" class="form-control" required />
								<p id="password_feedback" class="red mb-0" style="display: none;"><small>Password must be at least 6 characters.</small></p>
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label class="mb-0">Confirm Password:</label>
								<input type="password" name="confirm_password" placeholder="•••••••" class="form-control" required />
							</div>
						</div>

						<div class="form-group mt-32 row">
							<div class="col-12">
								<button type="submit" class="register btn btn-primary centered">Register</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script type="text/javascript">
		const disableSubmit = () => {
			$('.register').removeClass('btn-primary');
			$('.register').addClass('btn-disabled');
			$('.register').attr('disabled', true);
		};

		const enableSubmit = () => {
			$('.register').addClass('btn-primary');
			$('.register').removeClass('btn-disabled');
			$('.register').attr('disabled', false);
		};

		const passwordFieldsError = () => {
			$('input[name=password]').css('border', '1px solid red');
			$('input[name=confirm_password]').css('border', '1px solid red');
		};

		const passwordFieldsSuccess = () => {
			$('input[name=password]').css('border', '1px solid green');
			$('input[name=confirm_password]').css('border', '1px solid green');
		};

		const passwordFieldsDefault = () => {
			$('input[name=password]').css('border', '1px solid #CBA93F');
			$('input[name=confirm_password]').css('border', '1px solid #CBA93F');
		};

		const checkPasswords = () => {
			let password = $('input[name=password]').val();
			let confirm_password = $('input[name=confirm_password]').val();

			if (password != confirm_password) {
				disableSubmit();
				passwordFieldsError();
			} else {
				if (password != "") {
					passwordFieldsSuccess();
				} else {
					passwordFieldsDefault();
				}

				enableSubmit();
			}
		};

		$('input[name=password]').on('change', function() {
			if ($(this).val().length > 6) {
				checkPasswords();
				$('#password_feedback').hide();
			} else if ($(this).val().length > 0) {
				$('#password_feedback').show();
				disableSubmit();
			} else {
				$('#password_feedback').hide();
				enableSubmit();
			}
		});

		$('input[name=confirm_password]').on('change', function() {
			if ($(this).val().length > 6) {
				checkPasswords();
				$('#password_feedback').hide();
			} else if ($(this).val().length > 0) {
				$('#password_feedback').show();
				disableSubmit();
			} else {
				$('#password_feedback').hide();
				enableSubmit();
			}
		});
	</script>
@endsection