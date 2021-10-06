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

        $data = [
            'id_payment_method_subtype' => trim($request->id_payment_method)
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
