<?php

namespace TeachMe\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use TeachMe\Entities\Ticket;
//use TeachMe\Entities\TicketVote;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function tickets()
    {
      return $this->hasMany(Ticket::class);
    }

    public function voted()
    {
      return $this->belongsToMany(Ticket::class,'ticket_votes')->withTimestamps();
    }

    public function hasVoted(Ticket $ticket)
    {
      return $this->voted()->where('ticket_id', $ticket->id)->count();

      //Método creando la consulta desde aquí
      //return TicketVote::where(['user_id' => $this->id, 'ticket_id' => $ticket->id])->count()>=1;
    }

    public function vote(Ticket $ticket)
    {
      if($this->hasVoted($ticket)) return false;

      $this->voted()->attach($ticket);
      return true;
    }

    public function unvote(Ticket $ticket)
    {
      $this->voted()->detach($ticket);
    }
}
