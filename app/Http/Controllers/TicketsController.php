<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

class TicketsController extends Controller {

	protected function selectTicketsList()
	{
		return Ticket::selectRaw(
								'tickets.*, '
								.'(SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id) AS num_comments,'
								.'(SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id) AS num_votes'
							);
	}

	public function latest()
	{
		//Trea todas los ticket ordenados por fecha
		//$tickets = Ticket::orderBy('created_at','DESC')->get();

		//Hace lo mismo que arriba pero incluye la paginación


		$tickets = $this->selectTicketsList()
								->orderBy('created_at','DESC')
								->with('author')
								->paginate(10);

		// $tickets = Ticket::orderBy('created_at','DESC')->with('author')->paginate(10);

		return view('tickets.list', compact('tickets'));
	}

	public function popular()
	{
		return view('tickets.list');
	}

	public function open()
	{
		$tickets = $this->selectTicketsList()
								->where('status','open')
								->orderBy('created_at','DESC')
								->paginate(10);

		return view('tickets.list', compact('tickets'));
	}

	public function closed()
	{
		$tickets = $this->selectTicketsList()
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
		return view('tickets.details',compact('ticket'));
	}

	public function create()
	{
		return view('tickets.create');
	}

	public function store(Request $request, Guard $auth)
	{
		$this->validate($request, [
			'title' => 'required|max:120'
		]);

		// Método a través de las relaciones declaradas con laravel
		$ticket = $auth->user()->tickets()->create([
				'title'              => $request->get('title'),
				'status'             => 'open',
				'ticket_category_id' => 1
		]);

		//método largo no usando procedimiento de laravel
		// $ticket = new Ticket();
		// $ticket->title = $request->get('title');
		// $ticket->status = 'open';
		// $ticket->user_id = $auth->user()->id;
		// $ticket->save();

		return Redirect::route('tickets.details',$ticket->id);

		// Para mostrar los datos:
		// dd($request->all());
	}

}
