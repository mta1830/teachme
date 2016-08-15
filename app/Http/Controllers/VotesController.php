<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;

use Illuminate\Http\Request;

class VotesController extends Controller {

	public function submit($id)
	{
		$ticket = Ticket::findOrFail($id);
		currentuser()->vote($ticket);

		return redirect()->back();
	}

	public function destroy($id)
	{
		$ticket = Ticket::findOrFail($id);
		currentuser()->unvote($ticket);

		return redirect()->back();
	}

}
