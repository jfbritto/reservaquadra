<?php

use Illuminate\Database\Seeder;

class PaymentMethodSubtypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('payment_method_subtypes')->delete();
        
        \DB::table('payment_method_subtypes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_payment_method' => 1,
                'name' => 'Dinheiro',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'id_payment_method' => 1,
                'name' => 'PicPay',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'id_payment_method' => 2,
                'name' => 'Mastercard',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'id_payment_method' => 2,
                'name' => 'Visa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'id_payment_method' => 2,
                'name' => 'Elo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'id_payment_method' => 2,
                'name' => 'Amex',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'id_payment_method' => 3,
                'name' => 'Visa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'id_payment_method' => 3,
                'name' => 'Maestro',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'id_payment_method' => 3,
                'name' => 'Elo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'id_payment_method' => 4,
                'name' => 'Cheque',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'id_payment_method' => 5,
                'name' => 'Mastercard',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'id_payment_method' => 5,
                'name' => 'Visa',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'id_payment_method' => 5,
                'name' => 'Elo',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'id_payment_method' => 5,
                'name' => 'Amex',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'id_payment_method' => 6,
                'name' => 'Boleto',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}
