<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'id_company' => 1,
                'name' => 'João Filipi',
                'email' => 'jf.britto@hotmail.com',
                'password' => '$2y$10$MERsmHSH/CSZE73uJP4UauxslHssbmmFRdW9yePX0oSABX98HPFny',
                'group' => 1,
                'status' => 'A',
                'birth' => NULL,
                'rg' => NULL,
                'cpf' => NULL,
                'civil_status' => NULL,
                'profession' => NULL,
                'address' => NULL,
                'address_number' => NULL,
                'complement' => NULL,
                'city' => NULL,
                'neighborhood' => NULL,
                'uf' => NULL,
                'zip_code' => NULL,
                'start_date' => NULL,
                'health_plan' => NULL,
                'how_met' => NULL,
                'created_at' => '2021-04-13 23:38:51',
                'updated_at' => '2021-04-13 23:38:51',
            ),
            1 => 
            array (
                'id' => 2,
                'id_company' => 1,
                'name' => 'CIntia Closs',
                'email' => 'cintia_closs@gmail.com',
                'password' => '$2y$10$eyotOnegT5/r9Ld1o0bYQe74RMyCeLxQv96jRicXJEba629jaOMp2',
                'group' => 4,
                'status' => 'A',
                'birth' => '1998-04-24',
                'rg' => '2348923984',
                'cpf' => '234.234.234-23',
                'civil_status' => 'Solteiro',
                'profession' => 'Médica',
                'address' => 'Av. Gov. Carlos Lindemberg',
                'address_number' => '1121',
                'complement' => 'Casa',
                'city' => 'Jerônimo Monteiro',
                'neighborhood' => 'Vila Britto',
                'uf' => 'ES',
                'zip_code' => '29550-000',
                'start_date' => '2021-04-13',
                'health_plan' => 'Não',
                'how_met' => 'Placa',
                'created_at' => '2021-04-13 23:41:54',
                'updated_at' => '2021-04-13 23:41:54',
            ),
            2 => 
            array (
                'id' => 3,
                'id_company' => 1,
                'name' => 'Guilherme de Freitas',
                'email' => 'guilherme@gmail.com',
                'password' => '$2y$10$eWf3l4xoIBzbA/YsCH9rleijDf6tSV.jTrZvjiB4wdrEFogGYOXlK',
                'group' => 4,
                'status' => 'A',
                'birth' => '2000-10-23',
                'rg' => '248534958',
                'cpf' => '213.497.263-49',
                'civil_status' => 'Solteiro',
                'profession' => 'Programador',
                'address' => 'Centro',
                'address_number' => '3423',
                'complement' => 'Casa',
                'city' => 'Ibatiba',
                'neighborhood' => 'Centro',
                'uf' => 'ES',
                'zip_code' => '29395-000',
                'start_date' => '2021-04-13',
                'health_plan' => 'Unimed',
                'how_met' => 'Indicacao',
                'created_at' => '2021-04-13 23:55:28',
                'updated_at' => '2021-04-13 23:55:28',
            ),
        ));
    }
}
