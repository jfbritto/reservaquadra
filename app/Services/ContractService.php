<?php

namespace App\Services;

use App\Models\Contract;
use DB;
use Exception;

class ContractService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Contract::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    // public function update(array $data)
    // {
    //     $response = [];

    //     try{

    //         DB::beginTransaction();

    //         $result = DB::table('users')
    //                     ->where('id', $data['id'])
    //                     ->update(['name' => $data['name'],
    //                             'email' => $data['email']]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $result];

    //     }catch(Exception $e){
    //         DB::rollBack();
    //         $response = ['status' => 'error', 'data' => $e->getMessage()];
    //     }

    //     return $response;
    // }

    public function destroy(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('contracts')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status'],
                            'cancel_date' => $data['cancel_date'],
                            'id_user_canceled' => $data['id_user_canceled']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function renew(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('contracts')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list($id_student)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select con.*, pla.months, pla.age_range, pla.day_period, pla.lessons_per_week, pla.name as plan_name, (select count(*) from invoices where id_contract=con.id and status = 'A') as faturas_abertas
                                            from contracts con 
                                                join plans pla on pla.id=con.id_plan 
                                            where con.id_user = ".$id_student." and con.status = 'A'
                                            order by con.status, con.start_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function find($id)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from contracts where id = ".$id.""));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}