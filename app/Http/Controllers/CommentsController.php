<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Repositories\TicketRepository;
use TeachMe\Repositories\CommentRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller {

	private $commentRepository;
	private $ticketRepository;

	public function __construct(CommentRepository $commentRepository, TicketRepository $ticketRepository)
	{
		$this->commentRepository = $commentRepository;
		$this->ticketRepository = $ticketRepository;
	}

	public function submit($id, Request $request)
	{
		$this->validate($request, [
			'comment' => 'required|max:250',
			'link'    => 'url'
		]);

		//Con el fillable se boquea las entradas de datos adicionales de los atributos, sólo son utilizados los referentes al objeto
		//Otra opción puede ser:
		//$comment = new TicketComment($request->only(['comment','link']));

		// Creación de comentario
		//$comment = new TicketComment($request->all());

		$ticket = $this->ticketRepository->findOrFail($id);

		// Aplicando el patrón repositorio
		$this->commentRepository->create($ticket, currentUser(), $request->get('comment'), $request->get('link'));

		//Podemos podemos pasar el usuario autenticado a través de Guard $auth y hacer:
		//$comment->user_id = $auth->id();
		//$comment->user_id = currentUser()->id;

		//$ticket = Ticket::findOrFail($id);


		session()->flash('success','Tu comentario fue guardado satisfactoriamente');
		return Redirect()->back();

	}

}
