@extends('layouts.app')

@section('content')
	@include('layouts.banner')
	@include('admin.tickets.modals.complete')

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
		let tickets = Array();

		/* --------------------- *\
		|  2. Helper functions    |
		\* --------------------- */

		function renderEmpty() {
			let render_html = `
				<div class="col-lg-7 col-md-8 col-sm-10 col-12">
					<div class="shadow-box">
						<h4 class="text-center">No Tickets Found</h4>
						<p class="text-center mb-0">No tickets were found in the system.</p>
					</div>
				</div>
			`;

			$('#display_row').html(render_html);
		}

		function renderTable() {
			let render_html = `
				<div class="col-12">
					<div style="overflow: auto;">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Subject</th>
									<th>Email</th>
									<th>Message</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>`;

			tickets.forEach((ticket) => {
				var status_string = "";
				var show_buttons_html = ``;
				if (ticket.status == 1) {
					status_string = "Active";
					show_buttons_html = `
						<button data-id="${ticket.id}" type="button" class="btn btn-sm btn-success m-1 mark_complete" style="float: right;">Mark as Complete</button>
						<a href="mailto:${ticket.email}" class="btn btn-sm btn-info m-1" style="float: right;">Respond</a>
					`;
				} else if (ticket.status == 2) {
					status_string = "Completed";
				}

				render_html += `
					<tr>
						<td style="vertical-align: middle;">${ticket.subject}</td>
						<td style="vertical-align: middle;">${ticket.email}</td>
						<td style="vertical-align: middle;">${ticket.description}</td>
						<td style="vertical-align: middle;">${status_string}</td>
						<td style="vertical-align: middle;">
							${show_buttons_html}
						</td>
					</tr>
				`;
			});

			render_html	+= `</tbody>
						</table>
					</div>
				</div>
			`;

			$('#display_row').html(render_html);
		}

		function renderHTML() {
			if (tickets.length > 0) {
				renderTable();
			} else {
				renderEmpty();
			}
		}

		function fetchData() {
			$.ajax({
				url: '/api/tickets/get',
				type: 'GET',
				success: function(response) {
					tickets = response.tickets;
					renderHTML();
				} 
			});
		}

		/* --------------------- *\
		|  3. Button Bindings     |
		\* --------------------- */

		$('.complete').on('click', function() {
			$(this).attr('disabled', true);

			$.ajax({
				url: '/api/tickets/complete',
				type: 'POST',
				data: {
					_token: _token,
					ticket_id: $('#complete_id').val()
				},
				success: function(response) {
					if (response.success == true) {
						$('.complete').attr('disabled', false);
						$('#complete_ticket_modal').modal('hide');
						fetchData();
					}
				}
			});
		});

		/* --------------------- *\
		|  4. Dynamic Bindings    |
		\* --------------------- */

		$(document).on('click', '.mark_complete', function() {
			let id = $(this).data('id');
			$('#complete_id').val(id);
			$('#complete_ticket_modal').modal('show');
		});

		/* --------------------- *\
		|  5. Document Load       |
		\* --------------------- */

		$(document).ready(function() {
			fetchData();
		});
	</script>
@endsection