<?php

use Illuminate\Database\Seeder;

class CourtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('courts')->delete();
        
        \DB::table('courts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_company' => 1,
                'name' => 'Quadra Aberta',
                'city' => 'Vila Velha',
                'neighborhood' => 'Centro',
                'reference' => 'Perto do posto',
                'description' => 'Quadra linda demais',
                'status' => 'A',
                'created_at' => '2021-04-13 23:39:56',
                'updated_at' => '2021-04-13 23:39:56',
            ),
        ));
    }
}
