<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;

use Illuminate\Http\Request;

class TicketController extends Controller {

	public function latest()
	{
		//Trea todas los ticket ordenados por fecha
		//$tickets = Ticket::orderBy('created_at','DESC')->get();

		//Hace lo mismo que arriba pero incluye la paginación
		$tickets = Ticket::orderBy('created_at','DESC')->paginate(10);

		return view('tickets.list', compact('tickets'));
	}

	public function popular()
	{
		return view('tickets.list');
	}

	public function open()
	{
		$tickets = Ticket::where('status','open')
											->orderBy('created_at','DESC')
											->paginate(10);

		return view('tickets.list', compact('tickets'));
	}

	public function closed()
	{
		$tickets = Ticket::where('status','closed')
											->orderBy('created_at','DESC')
											->paginate(10);

		return view('tickets.list', compact('tickets'));
	}

	public function details($id)
	{
		$ticket = Ticket::findOrFail($id);

		//Para hacer un JOIN SQL desde laravel debemos
		//$comments = TicketComment::select('ticket_comments.*','users.name')
		//	->join('users','ticket_comments.user_id','=','users.id')
		//	->where('ticket_id',$id)
		//	->orderBy('created_at','DESC')
		//	->get();
		//Forma básica del ticket sin información del usuario
		//$comments = TicketComment::where('ticket_id',$id)->orderBy('created_at','DESC')->get();
		return view('tickets.details',compact('ticket','comments'));
	}

}
