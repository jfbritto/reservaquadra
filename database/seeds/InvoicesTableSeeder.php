<?php

use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('invoices')->delete();
        
        \DB::table('invoices')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_user' => 2,
                'id_contract' => 1,
                'generate_date' => '2021-04-13 23:47:46',
                'id_user_generated' => 1,
                'status' => 'A',
                'due_date' => '2021-04-05',
                'price' => '200.00',
                'discount' => NULL,
                'paid_price' => NULL,
                'paid_date' => NULL,
                'id_user_received' => NULL,
                'cancel_date' => NULL,
                'id_user_canceled' => NULL,
                'id_type' => 1,
                'created_at' => '2021-04-13 23:47:46',
                'updated_at' => '2021-04-13 23:47:46',
            ),
            1 => 
            array (
                'id' => 2,
                'id_user' => 2,
                'id_contract' => 1,
                'generate_date' => '2021-04-13 23:47:46',
                'id_user_generated' => 1,
                'status' => 'A',
                'due_date' => '2021-05-05',
                'price' => '200.00',
                'discount' => NULL,
                'paid_price' => NULL,
                'paid_date' => NULL,
                'id_user_received' => NULL,
                'cancel_date' => NULL,
                'id_user_canceled' => NULL,
                'id_type' => 1,
                'created_at' => '2021-04-13 23:47:46',
                'updated_at' => '2021-04-13 23:47:46',
            ),
            2 => 
            array (
                'id' => 3,
                'id_user' => 2,
                'id_contract' => 1,
                'generate_date' => '2021-04-13 23:47:46',
                'id_user_generated' => 1,
                'status' => 'A',
                'due_date' => '2021-06-05',
                'price' => '200.00',
                'discount' => NULL,
                'paid_price' => NULL,
                'paid_date' => NULL,
                'id_user_received' => NULL,
                'cancel_date' => NULL,
                'id_user_canceled' => NULL,
                'id_type' => 1,
                'created_at' => '2021-04-13 23:47:46',
                'updated_at' => '2021-04-13 23:47:46',
            ),
            3 => 
            array (
                'id' => 4,
                'id_user' => 2,
                'id_contract' => 1,
                'generate_date' => '2021-04-13 23:47:46',
                'id_user_generated' => 1,
                'status' => 'A',
                'due_date' => '2021-07-05',
                'price' => '200.00',
                'discount' => NULL,
                'paid_price' => NULL,
                'paid_date' => NULL,
                'id_user_received' => NULL,
                'cancel_date' => NULL,
                'id_user_canceled' => NULL,
                'id_type' => 1,
                'created_at' => '2021-04-13 23:47:46',
                'updated_at' => '2021-04-13 23:47:46',
            ),
            4 => 
            array (
                'id' => 5,
                'id_user' => 2,
                'id_contract' => 1,
                'generate_date' => '2021-04-13 23:47:46',
                'id_user_generated' => 1,
                'status' => 'A',
                'due_date' => '2021-08-05',
                'price' => '200.00',
                'discount' => NULL,
                'paid_price' => NULL,
                'paid_date' => NULL,
                'id_user_received' => NULL,
                'cancel_date' => NULL,
                'id_user_canceled' => NULL,
                'id_type' => 1,
                'created_at' => '2021-04-13 23:47:46',
                'updated_at' => '2021-04-13 23:47:46',
            ),
            5 => 
            array (
                'id' => 6,
                'id_user' => 2,
                'id_contract' => 1,
                'generate_date' => '2021-04-13 23:47:46',
                'id_user_generated' => 1,
                'status' => 'A',
                'due_date' => '2021-09-05',
                'price' => '200.00',
                'discount' => NULL,
                'paid_price' => NULL,
                'paid_date' => NULL,
                'id_user_received' => NULL,
                'cancel_date' => NULL,
                'id_user_canceled' => NULL,
                'id_type' => 1,
                'created_at' => '2021-04-13 23:47:46',
                'updated_at' => '2021-04-13 23:47:46',
            ),
        ));
    }
}
