<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentMethodService;

class PaymentMethodController extends Controller
{
    private $paymentMethodService;

    public function __construct(PaymentMethodService $paymentMethodService)
    {
        $this->paymentMethodService = $paymentMethodService;
    }

    public function index()
    {
        return view('payment_method.home');
    }
    
    public function store(Request $request) 
    {

        $data = [
            'name' => trim($request->name),
        ];

        $response = $this->paymentMethodService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {
        
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
        ];

        $response = $this->paymentMethodService->update($data);

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

    //     $response = $this->paymentMethodService->destroy($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 200);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    // }
    
    public function list() 
    {

        $response = $this->paymentMethodService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
