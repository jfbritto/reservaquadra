<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('plans')->delete();
        
        \DB::table('plans')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_company' => 1,
                'name' => '',
                'months' => 6,
                'age_range' => 3,
                'day_period' => 1,
                'lessons_per_week' => 2,
                'annual_contract' => 0,
                'price' => '200.00',
                'status' => 'A',
                'created_at' => '2021-04-13 23:40:13',
                'updated_at' => '2021-04-13 23:40:13',
            ),
            1 => 
            array (
                'id' => 2,
                'id_company' => 1,
                'name' => '',
                'months' => 13,
                'age_range' => 1,
                'day_period' => 2,
                'lessons_per_week' => 2,
                'annual_contract' => 1,
                'price' => '3600.00',
                'status' => 'A',
                'created_at' => '2021-04-14 00:09:50',
                'updated_at' => '2021-04-14 00:09:50',
            ),
        ));
    }
}
