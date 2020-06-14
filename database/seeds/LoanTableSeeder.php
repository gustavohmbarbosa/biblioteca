<?php

use Illuminate\Database\Seeder;

class LoanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Loan::class, 50)->create();
        /*factory(\App\Loan::class, 50)->create()->each(function($loan){
            $loan->reader()->create(factory(\App\Reader::class)->make());
        });*/

    }
}
