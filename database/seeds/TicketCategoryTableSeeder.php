<?php

use TeachMe\Entities\TicketCategory;
use Faker\Generator;

class TicketCategoryTableSeeder extends BaseSeeder
{
    protected $total = 8;

    public function getModel()
    {
        return new TicketCategory();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
      'name' => $faker->unique()->jobTitle,
    ];
    }
}
