<?php

class BreedsTableSeeder extends Seeder {
  public function run(){
    DB::table('breeds')->insert(array(
      array('name'=>"Domestic"),
      array('name'=>"Persian"),
      array('name'=>"Siamese"),
      array('name'=>"Abyssinian"),
    ));
  }
}


?>