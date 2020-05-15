<?php

namespace App\Http\Controllers;

use App\Ticket;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    
	/* ---------------------------- *\
	|  Feature Controller            |
	|--------------------------------|
	|  1. CRUD Functions             |
	|  2. Get Functions              |
	|  3. View Functions             |
	|  4. Helper Functions           |
	\* ---------------------------- */

	/* --------------------- *\
	|  1. CRUD Functions      |
	\* --------------------- */

	public function create(Request $data) {
		$ticket = new Ticket;
		$ticket->subject = $data->subject;
		$ticket->email = $data->email;
		$ticket->description = $data->description;
		$ticket->is_guest = $data->is_guest;

		if ($data->is_guest == 0) {
			$ticket->user_id = $data->user_id;
		}

		$ticket->save();

		return response()->json([
			'success' => true,
			'ticket' => $ticket->toArray()
		], 200);
	}

	public function read() {
		if (isset($_GET['ticket_id'])) {
			return response()->json([
				'success' => true,
				'ticket' => Ticket::find($_GET['ticket_id'])->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify a ticket id.'
			], 200);
		}
	}

	public function update(Request $data) {
		$ticket = Ticket::find($data->ticket_id);

		if (isset($data->status)) {
			$ticket->status = $data->status;
		}

		$ticket->save();

		return response()->json([
			'success' => true,
			'ticket' => $ticket->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$ticket = Ticket::find($data->ticket_id);
		$ticket->status = 0;
		$ticket->save();

		return response()->json([
			'success' => true
		], 200);
	}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get() {
		return response()->json([
			'success' => true,
			'tickets' => Ticket::where('status', '!=', 0)->get()->toArray()
		], 200);
	}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	public function admin_view() {
		return view('admin.tickets.view')->with('header', 'Support Tickets');
	}

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

	public function complete(Request $data) {
		$ticket = Ticket::find($data->ticket_id);
		$ticket->status = 2;
		$ticket->save();

		return response()->json([
			'success' => true
		], 200);
	}

}
