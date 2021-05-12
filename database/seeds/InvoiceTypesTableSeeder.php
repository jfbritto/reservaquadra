<?php

use Illuminate\Database\Seeder;

class InvoiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('invoice_types')->delete();
        
        \DB::table('invoice_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Aulas',
                'status' => 'A',
                'created_at' => '2021-05-11 20:48:22',
                'updated_at' => '2021-05-11 20:48:22',
            ),
        ));

    }
}
