<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('companies')->delete();
        
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ViniTennis',
                'responsible' => 'Vinicius',
                'phone' => '(27) 98813-3808',
                'status' => 'A',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
