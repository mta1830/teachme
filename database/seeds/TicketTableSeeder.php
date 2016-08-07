<?php

use TeachMe\Entities\Ticket;
use Faker\Generator;

class TicketTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new Ticket();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
      'title' => $faker->sentence(),
      'status' => $faker->randomElement(['open', 'open', 'closed']),
      'user_id' => $this->getRandom('User')->id,
      'ticket_category_id' => $this->getRandom('TicketCategory')->id,
      #Caso de creación de datos de claves foráneas por medio de un método de creación de la entidad relacionada
      #
      #'user_id' => $this->createFrom('UserTableSeeder')->id,
    ];
    }
}
