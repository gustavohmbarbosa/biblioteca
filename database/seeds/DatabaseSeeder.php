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
        $this->call(UsersTableSeeder::class);
        $this->call(ReaderTableSeeder::class);
        $this->call(LoanTableSeeder::class);
        $this->call(BooksTableSeeder::class);
    }
}
