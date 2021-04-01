<?php

namespace App\Services;

use App\Models\Invoice;
use DB;
use Exception;

class InvoiceService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Invoice::create($data);

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

    public function list($id_student)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from invoices where id_user = ".$id_student." order by due_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}