<?php

use Illuminate\Database\Seeder;
use \App\Course;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'name' => 'Desenvolvimento de Sistemas',
        ]);
        Course::create([
            'name' => 'Logística',
        ]);
    }
}
