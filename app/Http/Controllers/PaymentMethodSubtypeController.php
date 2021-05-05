<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentMethodSubtypeService;

class PaymentMethodSubtypeController extends Controller
{
    private $paymentMethodSubtypeService;

    public function __construct(PaymentMethodSubtypeService $paymentMethodSubtypeService)
    {
        $this->paymentMethodSubtypeService = $paymentMethodSubtypeService;
    }
    
    public function store(Request $request) 
    {

        $data = [
            'id_payment_method' => trim($request->id_payment_method),
            'name' => trim($request->name),
        ];

        $response = $this->paymentMethodSubtypeService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {
        
        $data = [
            'id' => trim($request->id),
            'id_payment_method' => trim($request->id_payment_method),
            'name' => trim($request->name),
        ];

        $response = $this->paymentMethodSubtypeService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    // public function destroy(Request $request) 
    // {
    //     $data = [
    //         'id' => trim($request->id),
    //         'status' => 'D'
    //     ];

    //     $response = $this->paymentMethodSubtypeService->destroy($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 200);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    // }
    
    public function list() 
    {
        $id_payment_method = $_GET['id_payment_method'];

        $response = $this->paymentMethodSubtypeService->list($id_payment_method);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
