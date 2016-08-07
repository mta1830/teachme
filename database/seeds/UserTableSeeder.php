<?php

use TeachMe\Entities\User;
use Faker\Factory as Faker;
use Faker\Generator;

class UserTableSeeder extends BaseSeeder
{
  public function getModel()
  {
    return new User();
  }

  public function getDummyData(Generator $faker, array $customValues = array())
  {
    return [
      'name' => $faker->name,
      'email' => $faker->unique()->email,
      'password' => bcrypt('12345'),
      'role' => 'user',
    ];
  }

  public function run()
  {
    $this->createAdmin();
    $this->createMultiple(10);
  }

  private function createAdmin()
  {
    $this->create([
      'name' => 'Miguel Torres',
      'email' => 'mta1830@gmail.com',
      'password' => bcrypt('admin'),
      'role' => 'admin',
    ]);
  }
}
