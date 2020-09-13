<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      UsersTableSeeder::class,
      CourseTableSeeder::class,
      ReaderTableSeeder::class,
      CompanyTableSeeder::class,
      BooksTableSeeder::class,
      AuthorTableSeeder::class,
      AuthorBookTableSeeder::class
    ]);
  }
}
