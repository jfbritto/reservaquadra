<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;

class InvoiceController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    
    // public function store(Request $request) 
    // {
    //     $end_date = date("Y-m-d", strtotime("+ ".$request->months." months"));

    //     $price_formated = str_replace(".", "", trim($request->price_per_month));
    //     $price_formated = str_replace(",", ".", $price_formated);

    //     $data = [
    //         'id_plan' => trim($request->id_plan),
    //         'id_user' => trim($request->id_user),
    //         'start_date' => trim($request->start_date),
    //         'end_date' => $end_date,
    //         'expiration_day' => trim($request->expiration_day),
    //         'status' => "A",
    //         'price_per_month' => $price_formated
    //     ];        

    //     $response = $this->invoiceService->store($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    // public function update(Request $request) 
    // {
    //     $data = [
    //         'id' => trim($request->id),
    //         'name' => trim($request->name),
    //         'city' => trim($request->city),
    //         'neighborhood' => trim($request->neighborhood),
    //         'reference' => trim($request->reference),
    //         'description' => trim($request->description)
    //     ];

    //     $response = $this->invoiceService->update($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    // public function destroy(Request $request) 
    // {
    //     $data = [
    //         'id' => trim($request->id),
    //         'active' => 0
    //     ];

    //     $response = $this->invoiceService->destroy($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    public function list($id_student) 
    {

        $response = $this->invoiceService->list($id_student);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
}
