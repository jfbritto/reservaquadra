<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentMethodSubtypeConditionService;

class PaymentMethodSubtypeConditionController extends Controller
{
    private $paymentMethodSubtypeConditionService;

    public function __construct(PaymentMethodSubtypeConditionService $paymentMethodSubtypeConditionService)
    {
        $this->paymentMethodSubtypeConditionService = $paymentMethodSubtypeConditionService;
    }
    
    public function store(Request $request) 
    {

        $id_payment_method = $request->id_payment_method;
        $parcel = $request->parcel;

        $is_flat = $request->is_flat;
        
        if($is_flat == 1){
            $price_formated = str_replace(".", "", trim($request->flat_tax));
            $price_formated = str_replace(",", ".", $price_formated);
            $flat_tax = $price_formated;
            $percentage_tax = 0;
        }else{
            $price_formated = str_replace(".", "", trim($request->percentage_tax));
            $price_formated = str_replace(",", ".", $price_formated);
            $percentage_tax = $price_formated;
            $flat_tax = 0;
        }

        $days_for_payment = $request->days_for_payment;

        $data = [
            'id_payment_method_subtype' => trim($id_payment_method),
            'parcel' => trim($parcel),
            'is_flat' => trim($is_flat),
            'flat_tax' => trim($flat_tax),
            'percentage_tax' => trim($percentage_tax),
            'days_for_payment' => trim($days_for_payment)
        ];

        $response = $this->paymentMethodSubtypeConditionService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {
        $id_payment_method_subtype = $_GET['id_payment_method_subtype'];

        $response = $this->paymentMethodSubtypeConditionService->list($id_payment_method_subtype);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
