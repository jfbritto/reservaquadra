<?php

use Illuminate\Database\Seeder;

class ScheduledClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('scheduled_classes')->delete();
        
        \DB::table('scheduled_classes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_court' => 1,
                'id_user' => 2,
                'week_day' => '3',
                'start_time' => '12:00',
                'end_time' => '13:00',
                'status' => 'A',
                'created_at' => '2021-04-13 23:48:06',
                'updated_at' => '2021-04-13 23:48:06',
            ),
        ));
    }
}
