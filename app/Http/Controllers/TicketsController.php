<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

use TeachMe\Repositories\TicketRepository;

class TicketsController extends Controller {

	private $ticketRepository;

	public	function __construct(TicketRepository $ticketRepository)
	{
		$this->ticketRepository = $ticketRepository;
	}

	public function latest()
	{
		//Trea todas los ticket ordenados por fecha
		//$tickets = Ticket::orderBy('created_at','DESC')->get();

		//Hace lo mismo que arriba pero incluye la paginación


		$tickets = $this->ticketRepository->paginateLatest();

		// $tickets = Ticket::orderBy('created_at','DESC')->with('author')->paginate(10);

		return view('tickets.list', compact('tickets'));
	}

	public function popular()
	{
		return view('tickets.list');
	}

	public function open()
	{
		$tickets = $this->ticketRepository->paginateOpen();

		return view('tickets.list', compact('tickets'));
	}

	public function closed()
	{
		$tickets = $this->ticketRepository->paginateClosed();;

		return view('tickets.list', compact('tickets'));
	}

	public function details($id)
	{
		$ticket = $this->ticketRepository->FindOrFail($id);;

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
