<?php

use TeachMe\Entities\TicketVote;
use Faker\Factory as Faker;
use Faker\Generator;

class TicketVoteTableSeeder extends BaseSeeder
{
  public function getModel()
  {
    return new TicketVote();
  }

  public function getDummyData(Generator $faker, array $customValues = array())
  {
    return [
      'user_id' => $this->getRandom('User')->id,
      'ticket_id' => $this->getRandom('Ticket')->id,
    ];
  }

  public function run()
  {
    $this->createMultiple(500);
  }
}
