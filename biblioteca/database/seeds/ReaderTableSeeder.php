<?php

use Illuminate\Database\Seeder;

class ReaderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Reader::class, 50)->create();
    }
}
