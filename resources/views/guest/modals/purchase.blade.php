<div class="modal fade" id="purchase_product_modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="payment_form" method="POST" action="{{ url('/shop/payment/submit') }}">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Purchase <span id="purchase_product_title"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					{{ csrf_field() }}
					<input type="hidden" id="purchase_product_id" name="product_id" />
					<div class="form-group row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label>First Name:</label>
							<input type="text" name="first_name" class="form-control" placeholder="John" required />
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-16-mobile">
							<label>Last Name:</label>
							<input type="text" name="last_name" class="form-control" placeholder="Doe" required />
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-16-mobile">
							<label>Email:</label>
							<input type="email" name="email" class="form-control" placeholder="john@johndoe.com" required />
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-7 col-md-8 col-sm-12 col-12">
							<label>Card Number:</label>
							<input type="text" name="cardNumber" class="form-control" placeholder="4242 4242 4242 4242" required />
						</div>
					</div>

					<div class="form-group row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label>CVC:</label>
							<input type="text" name="cvvNumber" class="form-control" placeholder="123" required />
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label>Expiry Month:</label>
							<select form="payment_form" name="ccExpiryMonth" class="form-control">
								<option value="01">01 - Jan</option>
								<option value="02">02 - Feb</option>
								<option value="03">03 - Mar</option>
								<option value="04">04 - Apr</option>
								<option value="05">05 - May</option>
								<option value="06">06 - Jun</option>
								<option value="07">07 - Jul</option>
								<option value="08">08 - Aug</option>
								<option value="09">09 - Sep</option>
								<option value="10">10 - Oct</option>
								<option value="11">11 - Nov</option>
								<option value="12">12 - Dec</option>
							</select>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-12 col-12">
							<label>Expiry Year:</label>
							<select form="payment_form" name="ccExpiryYear" class="form-control">
								<option value="2020">2020</option>
								<option value="2021">2021</option>
								<option value="2022">2022</option>
								<option value="2023">2023</option>
								<option value="2024">2024</option>
								<option value="2025">2025</option>
								<option value="2026">2026</option>
								<option value="2027">2027</option>
								<option value="2028">2028</option>
								<option value="2029">2029</option>
								<option value="2030">2030</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<p class="red" id="payment_error" style="display: none;">Please fill out all fields.</p>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success purchase">Download</button>
				</div>
			</div>
		</form>
	</div>
</div>