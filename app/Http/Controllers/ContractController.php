<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContractService;
use App\Services\InvoiceService;

class ContractController extends Controller
{
    private $contractService;
    private $invoiceService;

    public function __construct(ContractService $contractService, InvoiceService $invoiceService)
    {
        $this->contractService = $contractService;
        $this->invoiceService = $invoiceService;
    }
    
    public function store(Request $request) 
    {
        // CASO SEJA ENVIADO O ID DO PLANO ANTIGO, O PLANO SERÁ RENOVADO
        if($request->id_contract_renew){
            $data = [
                'id' => trim($request->id_contract_renew),
                'status' => "R",
            ];

            $response = $this->contractService->renew($data);
        }

        $price_formated = str_replace(".", "", trim($request->price_per_month));
        $price_formated = str_replace(",", ".", $price_formated);

        $expiration_day = str_pad(trim($request->expiration_day) , 2 , '0' , STR_PAD_LEFT);

        $data = [
            'id_plan' => trim($request->id_plan),
            'id_user' => trim($request->id_user),
            'start_date' => trim($request->start_date),
            'expiration_day' => $expiration_day,
            'status' => "A",
            'price_per_month' => $price_formated
        ];        

        $response = $this->contractService->store($data);

        if($response['status'] == 'success'){
            
            for ($i=0; $i < 6; $i++) {
                
                $due_date = date('Y-m-'.$expiration_day.'', strtotime("+ ".$i." months"));
                
                $data = [
                    'id_user' => trim($request->id_user),
                    'id_contract' => trim($response['data']->id),
                    'due_date' => $due_date,
                    'price' => trim($price_formated),
                    'generate_date' => date('Y-m-d H:i:s'),
                    'id_user_generated' => auth()->user()->id,
                    'id_type' => 1,
                    'status' => "A"
                ];    

                $response2 = $this->invoiceService->store($data);
            }
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
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

    //     $response = $this->contractService->update($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'cancel_date' => date('Y-m-d H:i:s'),
            'id_user_canceled' => auth()->user()->id,
            'status' => 'C'
        ];

        $response = $this->contractService->destroy($data);
        
        if($response['status'] == 'success'){

            $pendent_invoices = $this->invoiceService->listAllOpenByContract($request->id);
    
            if($pendent_invoices['data']){
                foreach ($pendent_invoices['data'] as $invoice) {
                    
                    $data = [
                        'id' => trim($invoice->id),
                        'cancel_date' => date('Y-m-d H:i:s'),
                        'id_user_canceled' => auth()->user()->id,
                        'status' => "C"
                    ];
    
                    $this->invoiceService->cancel($data);
    
                }
            }
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function list($id_student) 
    {

        $response = $this->contractService->list($id_student);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
}
