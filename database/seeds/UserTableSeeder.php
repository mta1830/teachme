<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
  public function run()
  {
    $this->createAdmin();
    $this->createUser(10);
  }

  private function createAdmin()
  {
    User::create([
      'name' => 'Miguel Torres',
      'email' => 'mta1830@gmail.com',
      'password' => bcrypt('admin'),
      'role' => 'admin',
    ]);
  }

  private function createUser($total)
  {
    $faker = Faker::create();

    for ($i=0; $i < $total; $i++) {
      User::create([
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt('12345'),
        'role' => 'user',
      ]);
    }
  }
}
