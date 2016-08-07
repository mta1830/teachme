<?php

use TeachMe\Entities\TicketLike;
use Faker\Generator;

class TicketLikeTableSeeder extends BaseSeeder
{
    protected $total = 1400;

    public function getModel()
    {
        return new TicketLike();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
      'user_id' => $this->getRandom('User')->id,
      'ticket_id' => $this->getRandom('Ticket')->id,
    ];
    }
}
