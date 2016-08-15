<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller {

	public function submit($id, Request $request)
	{
		$this->validate($request, [
			'comment' => 'required|max:250',
			'link'    => 'url'
		]);

		//Con el fillable se boquea las entradas de datos adicionales de los atributos, sólo son utilizados los referentes al objeto
		//Otra opción puede ser:
		//$comment = new TicketComment($request->only(['comment','link']));
		$comment = new TicketComment($request->all());

		//Podemos podemos pasar el usuario autenticado a través de Guard $auth y hacer:
		//$comment->user_id = $auth->id();
		$comment->user_id = currentUser()->id;

		$ticket = Ticket::findOrFail($id);
		$ticket->comments()->save($comment);

		session()->flash('success','Tu comentario fue guardado satisfactoriamente');
		return Redirect()->back();

	}

}
