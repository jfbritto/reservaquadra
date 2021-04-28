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
    
    public function receive(Request $request) 
    {
        if($request->discount){
            $discount_formated = str_replace(".", "", trim($request->discount));
            $discount_formated = str_replace(",", ".", $discount_formated);
        }else{
            $discount_formated = 0;
        }

        if($request->paid_price){
            $paid_price_formated = str_replace(".", "", trim($request->paid_price));
            $paid_price_formated = str_replace(",", ".", $paid_price_formated);
        }else{
            $paid_price_formated = 0;
        }

        $data = [
            'id' => trim($request->id),
            'discount' => $discount_formated,
            'paid_price' => $paid_price_formated,
            'paid_date' => date('Y-m-d H:i:s'),
            'id_user_received' => auth()->user()->id,
            'status' => "R",
        ];

        $response = $this->invoiceService->receive($data);

        if($response['status'] == 'success'){

            $response2 = $this->invoiceService->getById($request->id);

            $response3 = $this->invoiceService->listFarMoreOpen($response2['data']->id_user);

            if($response3['status'] == 'success'){

                $due_date = date("Y-m-d", strtotime("+1 month", strtotime($response3['data']->due_date)));

                $data2 = [
                    'id_user' => trim($response3['data']->id_user),
                    'id_contract' => trim($response3['data']->id_contract),
                    'due_date' => $due_date,
                    'price' => trim($response3['data']->price),
                    'generate_date' => date('Y-m-d H:i:s'),
                    'id_user_generated' => auth()->user()->id,
                    'id_type' => 1,
                    'status' => "A"
                ];    
        
                $response4 = $this->invoiceService->store($data2);
            }

        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    // public function destroy(Request $request) 
    // {
    //     $data = [
    //         'id' => trim($request->id),
    //         'status' => 'D'
    //     ];

    //     $response = $this->invoiceService->destroy($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    public function listNextOpen($id_student) 
    {

        $response = $this->invoiceService->listNextOpen($id_student);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function listReceivedByMonth() 
    {
        $date = date('Y-m-d');

        $response = $this->invoiceService->listReceivedByMonth($date);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
