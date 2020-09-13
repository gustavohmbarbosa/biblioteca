<?php

use Illuminate\Database\Seeder;

class AuthorBookTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    factory(\App\AuthorBook::class, 50)->create();
  }
}
