<?php

use TeachMe\Entities\TicketComment;
use Faker\Factory as Faker;
use Faker\Generator;

class TicketCommentTableSeeder extends BaseSeeder
{
  public function getModel()
  {
    return new TicketComment();
  }

  public function getDummyData(Generator $faker, array $customValues = array())
  {
    return [
      'user_id' => $this->getRandom('User')->id,
      'ticket_id' => $this->getRandom('Ticket')->id,
      'comment' => $faker->text(150),
    ];
  }

  public function run()
  {
    $this->createMultiple(200);
  }
}
