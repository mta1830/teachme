<?php

namespace TeachMe\Entities;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'status','ticket_category_id'];

    public function author()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
      return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
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
