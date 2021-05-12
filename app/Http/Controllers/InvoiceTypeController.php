<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceTypeService;

class InvoiceTypeController extends Controller
{
    private $invoiceTypeService;

    public function __construct(InvoiceTypeService $invoiceTypeService)
    {
        $this->invoiceTypeService = $invoiceTypeService;
    }

    public function index()
    {
        return view('invoice_type.home');
    }
    
    public function store(Request $request) 
    {
        $data = [
            'name' => trim($request->name),
            'status' => "A",
        ];

        $response = $this->invoiceTypeService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {       
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name)
        ];

        $response = $this->invoiceTypeService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $response = $this->invoiceTypeService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {
        $response = $this->invoiceTypeService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
