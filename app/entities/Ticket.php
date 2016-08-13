<?php

namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function author()
    {
      return $this->belongsTo(User::class);
    }

    public function comments()
    {
      return $this->hasMany(TicketComment::class);
    }

    public function getOpenAttribute()
    {
      return $this->status == 'open';
    }

    public function voters()
    {
      //tiene y pertenece a muchos
      return $this->belongsToMany(User::class,'ticket_votes');
    }
}
