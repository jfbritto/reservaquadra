<?php

namespace App\Services;

use App\Models\Plan;
use DB;
use Exception;

class PlanService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Plan::create($data);

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

    // public function destroy(array $data)
    // {
    //     $response = [];

    //     try{

    //         DB::beginTransaction();

    //         $result = DB::table('users')
    //                     ->where('id', $data['id'])
    //                     ->update(['active' => $data['active']]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $result];

    //     }catch(Exception $e){
    //         DB::rollBack();
    //         $response = ['status' => 'error', 'data' => $e->getMessage()];
    //     }

    //     return $response;
    // }

    public function list()
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from plans where status = 'A' and id_company = '1' order by months"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}