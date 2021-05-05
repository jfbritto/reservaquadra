<?php

namespace App\Services;

use App\Models\PaymentMethodSubtype;
use DB;
use Exception;

class PaymentMethodSubtypeService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = PaymentMethodSubtype::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function update(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $payment_method_subtypes = DB::table('payment_method_subtypes')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name'], 'id_payment_method' => $data['id_payment_method']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $payment_method_subtypes];

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

    //         $payment_method_subtypes = DB::table('payment_method_subtypes')
    //                     ->where('id', $data['id'])
    //                     ->update(['status' => $data['status']]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $payment_method_subtypes];

    //     }catch(Exception $e){
    //         DB::rollBack();
    //         $response = ['status' => 'error', 'data' => $e->getMessage()];
    //     }

    //     return $response;
    // }

    public function list($id_payment_method)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from payment_method_subtypes where id_payment_method = '".$id_payment_method."' order by name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}