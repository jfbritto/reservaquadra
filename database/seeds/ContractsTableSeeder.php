<?php

use Illuminate\Database\Seeder;

class ContractsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('contracts')->delete();
        
        \DB::table('contracts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_plan' => 1,
                'id_user' => 2,
                'start_date' => '2021-04-13',
                'end_date' => NULL,
                'expiration_day' => '05',
                'status' => 'A',
                'price_per_month' => '200.00',
                'cancel_date' => NULL,
                'id_user_canceled' => NULL,
                'created_at' => '2021-04-13 23:47:46',
                'updated_at' => '2021-04-13 23:47:46',
            ),
        ));
    }
}
