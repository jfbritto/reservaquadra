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

    public function receive(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('invoices')
                        ->where('id', $data['id'])
                        ->update(['discount' => $data['discount'],
                                'paid_price' => $data['paid_price'],
                                'paid_date' => $data['paid_date'],
                                'id_user_received' => $data['id_user_received'],
                                'status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function cancel(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('invoices')
                        ->where('id', $data['id'])
                        ->update(['cancel_date' => $data['cancel_date'],
                                'id_user_canceled' => $data['id_user_canceled'],
                                'status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    // public function destroy(array $data)
    // {
    //     $response = [];

    //     try{

    //         DB::beginTransaction();

    //         $result = DB::table('users')
    //                     ->where('id', $data['id'])
    //                     ->update(['status' => $data['status']]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $result];

    //     }catch(Exception $e){
    //         DB::rollBack();
    //         $response = ['status' => 'error', 'data' => $e->getMessage()];
    //     }

    //     return $response;
    // }

    public function get_by_id($id_invoice)
    {
        $response = [];

        try{
            $return = Invoice::find($id_invoice);

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list_next_open($id_student)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from invoices where id_user = ".$id_student." and status = 'A' order by due_date limit 1"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list_far_more_open($id_student)
    {
        $response = [];

        try{
            $return = Invoice::where('id_user', $id_student)->where('status', 'A')->orderByDesc('due_date')->first();

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list_all_open_by_contract($id_contract)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from invoices where id_contract = ".$id_contract." and status = 'A' order by due_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}