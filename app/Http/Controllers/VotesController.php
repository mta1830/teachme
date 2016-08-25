<?php namespace TeachMe\Http\Controllers;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Entities\Ticket;
use TeachMe\Repositories\VoteRepository;
use TeachMe\Repositories\TicketRepository;

use Illuminate\Http\Request;

class VotesController extends Controller {

	private $ticketRepository;
	private $voteRepository;

	public function __construct(TicketRepository $ticketRepository, VoteRepository $voteRepository)
	{
		$this->ticketRepository = $ticketRepository;
		$this->voteRepository = $voteRepository;
	}

	public function submit($id)
	{
		//$ticket = Ticket::findOrFail($id);

		$ticket = $this->ticketRepository->findOrFail($id);
		$this->voteRepository->vote(currentUser(), $ticket);

		return redirect()->back();
	}

	public function destroy($id)
	{
		$ticket = $this->ticketRepository->findOrFail($id);
		$this->voteRepository->unvote(currentUser(), $ticket);

		return redirect()->back();
	}

}
