@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container pt-64 pb-64">
		<div class="row justify-content-center">
			<div class="col-lg-9 col-md-10 col-sm-11 col-12">
				<div class="shadow-box">
					<h4>Have a Question?</h4>
					<p>Fill out the form below and I will get back to you as soon as possible.</p>

					<div id="display_row">
						@if(Auth::guest())
						<input type="hidden" id="is_guest" value="1" />
						@else
						<input type="hidden" id="is_guest" value="1" />
						<input type="hidden" id="user_id" value="{{ Auth::user()->id }}" />
						@endif

						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
								<label class="mb-1">Subject:</label>
								<input type="text" class="form-control" id="subject" placeholder="Your Subject Here" required />
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-16-mobile">
								<label class="mb-1">Email:</label>
								<input type="email" class="form-control" id="email" placeholder="your@email.com" required />
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<label class="mb-1">Message:</label>
								<textarea id="message" class="form-control" placeholder="Your Message Here" rows="5"></textarea>
							</div>
						</div>

						<div id='error' class="form-group row" style='display: none;'>
							<div class="col-12">
								<p class="text-center red">Please fill out all required fields.</p>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-12">
								<button type="button" class="btn btn-primary centered submit">Submit Message</button>
							</div>
						</div>
					</div>
				</div>
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

		/* --------------------- *\
		|  2. Helper functions    |
		\* --------------------- */

		const verify = () => {
			const subject = $('#subject').val();
			const email = $('#email').val();
			const message = $('#message').val();

			let verified = true;

			if (subject == '') {
				verified = false;
				$('#subject').css('border', '1px solid red');
				$('#error').show();
			}

			if (email == '') {
				verified = false;
				$('#email').css('border', '1px solid red');
				$('#error').show();
			}

			if (message == '') {
				verified = false;
				$('#message').css('border', '1px solid red');
				$('#error').show();
			}

			return verified;
		};

		function renderThankYou() {
			let render_html = `
				<div class="row pt-32 pb-32">
					<div class="col-12">
						<p class="green text-center mb-0">Your message has been successfully submitted...</p>
					</div>
				</div>
			`;

			$('#display_row').html(render_html);
		}

		/* --------------------- *\
		|  3. Static Bindings     |
		\* --------------------- */

		$('#subject').on('keypress', function() {
			if ($(this).css('border') == '1px solid rgb(255, 0, 0)') {
				$(this).css('border', '1px solid #CBA93F');
			}
		});

		$('#email').on('keypress', function() {
			if ($(this).css('border') == '1px solid rgb(255, 0, 0)') {
				$(this).css('border', '1px solid #CBA93F');
			}
		});

		$('#message').on('keypress', function() {
			if ($(this).css('border') == '1px solid rgb(255, 0, 0)') {
				$(this).css('border', '1px solid #CBA93F');
			}
		});

		$('.submit').on('click', function() {
			$('#error').hide();
			if (verify() == true) {
				$(this).attr('disabled', true);

				const dataArray = {
					_token: _token,
					subject: $('#subject').val(),
					email: $('#email').val(),
					description: $('#message').val(),
					is_guest: $('#is_guest').val()
				};

				if ($('#is_guest').val() == 0) {
					dataArray.user_id = $('#user_id').val();
				}

				$.ajax({
					url: '/contact/submit',
					type: 'POST',
					data: dataArray,
					success: function(response) {
						if (response.success == true) {
							renderThankYou();
						}
					}
				});
			}
		});

		/* --------------------- *\
		|  4. Dynamic Bindings    |
		\* --------------------- */

		/* --------------------- *\
		|  5. Document Load       |
		\* --------------------- */

		$(document).ready(function() {
			
		});
	</script>
@endsection