<?php
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Faker\Generator;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseSeeder extends Seeder
{
  protected static $pool = array();

  protected function createMultiple($total, array $customValues = array())
  {
    for ($i=0; $i < $total; $i++) {
      $this->create($customValues);
    }
  }

  abstract function getModel();
  abstract function getDummyData(Generator $faker, array $customValues = array());

  protected function create(array $customValues = array())
  {
    $values = $this->getDummyData(Faker::create(), $customValues);

    $values = array_merge($values, $customValues);

    return $this->addToPool($this->getModel()->create($values));

    //Caso de creación de datos de claves foráneas por medio de un método de creación de la entidad relacionada
    //
    //return $this->getModel()->create($values);
  }

  protected function getRandom($model)
  {
    if ( ! $this->collectionExist($model)) {
      throw new Exception("The model collection does not exist");
    }

    return static::$pool[$model]->random();
  }

  private function addToPool($entity)
  {
    //Cual es la clase a la que pertenece este objeto, pero trae el nombre completo del namespace por ejemplo: TeachMe\Entities\class
    //$class = get_class($entity);

    $reflection = new ReflectionClass($entity);
    $class = $reflection->getShortName();

    if ( ! $this->collectionExist($class)) {
      static::$pool[$class] = new Collection;
    }

    static::$pool[$class]->add($entity);

    return $entity;
  }

  private function collectionExist($class)
  {
    return isset (static::$pool[$class]);
  }

  //Caso de creación de datos de claves foráneas por medio de un método de creación de la entidad relacionada
  //
  // protected function createFrom($seeder, array $customValues = array())
  // {
  //   $seeder = new $seeder;
  //   return $seeder->create($customValues);
  // }
}