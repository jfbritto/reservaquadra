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
                                'id_payment_method' => $data['id_payment_method'],
                                'id_payment_method_subtype' => $data['id_payment_method_subtype'],
                                'id_payment_method_subtype_condition' => $data['id_payment_method_subtype_condition'],
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

    public function getById($id_invoice)
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

    public function listNextOpen($id_student)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select inv.*, ity.name as invoice_type from invoices inv join invoice_types ity on ity.id=inv.id_type where inv.id_user = ".$id_student." and inv.status = 'A' order by inv.due_date limit 1"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listFarMoreOpen($id_student)
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

    public function listAllOpenByContract($id_contract)
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

    public function listAllOverdueBills()
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from invoices inv join contracts con on con.id=inv.id_contract where inv.status = 'A' and inv.due_date < now() order by due_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listReceivedByMonth($date)
    {
        $response = [];

        try{

            $date_ini = date('Y-m-01 00:00:00', strtotime($date));
            $date_fim = date('Y-m-t 23:59:59', strtotime($date));

            $return = DB::select( DB::raw("select 
                                                inv.*, usr.name as cliente, pmt.name as payment_method, pms.name as payment_method_subtype
                                            from
                                                invoices inv 
                                                join users usr on usr.id=inv.id_user
                                                join payment_methods pmt on inv.id_payment_method=pmt.id
                                                join payment_method_subtypes pms on inv.id_payment_method_subtype=pms.id
                                                join payment_method_subtype_conditions pmsc on inv.id_payment_method_subtype_condition=pmsc.id
                                            where 
                                                usr.id_company = ".auth()->user()->id_company." and 
                                                inv.status = 'R' and 
                                                inv.paid_date between '".$date_ini."' and '".$date_fim."' 
                                            order by 
                                                inv.due_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}