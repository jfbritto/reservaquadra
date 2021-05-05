<?php

namespace App\Services;

use App\Models\PaymentMethod;
use DB;
use Exception;

class PaymentMethodService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = PaymentMethod::create($data);

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

            $payment_methods = DB::table('payment_methods')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $payment_methods];

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

    //         $payment_methods = DB::table('payment_methods')
    //                     ->where('id', $data['id'])
    //                     ->update(['status' => $data['status']]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $payment_methods];

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
            $return = DB::select( DB::raw("select * from payment_methods order by name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}