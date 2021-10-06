<?php

namespace App\Services;

use App\Models\PaymentMethodSubtypeCondition;
use DB;
use Exception;

class PaymentMethodSubtypeConditionService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = PaymentMethodSubtypeCondition::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function getById($id)
    {
        $response = [];

        try{
            $return = PaymentMethodSubtypeCondition::find($id);

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list($id_payment_method_subtype)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select * from payment_method_subtype_conditions where id_payment_method_subtype = '".$id_payment_method_subtype."' order by parcel"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}