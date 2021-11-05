<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DebtService;
use App\Services\UserService;
use App\Services\ContractService;
use App\Services\InvoiceService;

class DebtController extends Controller
{
    private $debtService;

    public function __construct(DebtService $debtService, UserService $userService, ContractService $contractService, InvoiceService $invoiceService)
    {
        $this->debtService = $debtService;
        $this->userService = $userService;
        $this->contractService = $contractService;
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        return view('interest.home');
    }
    
    public function store(Request $request) 
    {
        // formata o valor recebido
        if($request->price){
            $price_formated = str_replace(".", "", trim($request->price));
            $price_formated = str_replace(",", ".", $price_formated);
        }else{
            $price_formated = 0;
        }

        $data = [
            'id_company' => auth()->user()->id_company,
            'id_user' => trim($request->id_user),
            'price' => $price_formated,
            'observation' => trim($request->observation),
            'status' => "A",
        ];

        $response = $this->debtService->store($data);

        if($request->inactivate_user == 1){

            // inativando aluno
            $data2 = [
                'id' => trim($request->id_user),
                'status' => "I"
            ];
    
            $this->userService->changeStatus($data2);
         
            // cancelando contrato
            $contratos = $this->contractService->list($request->id_user);

            if ($contratos['data']) {
                foreach ($contratos['data'] as $contract) {

                    $data = [
                        'id' => trim($contract->id),
                        'cancel_date' => date('Y-m-d H:i:s'),
                        'id_user_canceled' => auth()->user()->id,
                        'status' => 'C'
                    ];
            
                    $response2 = $this->contractService->destroy($data);
                    
                    if($response2['status'] == 'success'){
            
                        $pendent_invoices = $this->invoiceService->listAllOpenByContract($contract->id);
                        
                        // concelando faturas
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


                }
            }


        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    // public function update(Request $request) 
    // {       

    //     $data = [
    //         'id' => trim($request->id),
    //         'name' => trim($request->name),
    //         'phone1' => trim($request->phone1),
    //         'phone2' => trim($request->phone2),
    //         'objective' => trim($request->objective),
    //         'age' => trim($request->age),
    //         'sun' => trim($request->sun),
    //         'sun_period' => trim($request->sun_period),
    //         'mon' => trim($request->mon),
    //         'mon_period' => trim($request->mon_period),
    //         'tue' => trim($request->tue),
    //         'tue_period' => trim($request->tue_period),
    //         'wed' => trim($request->wed),
    //         'wed_period' => trim($request->wed_period),
    //         'thu' => trim($request->thu),
    //         'thu_period' => trim($request->thu_period),
    //         'fri' => trim($request->fri),
    //         'fri_period' => trim($request->fri_period),
    //         'sat' => trim($request->sat),
    //         'sat_period' => trim($request->sat_period),
    //         'all_days' => trim($request->all_days),
    //         'all_days_period' => trim($request->all_days_period),
    //     ];

    //     $response = $this->debtService->update($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 200);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    // }
    
    public function receive(Request $request) 
    {       

        $data = [
            'id' => trim($request->id),
            'status' => 'R'
        ];

        $response = $this->debtService->receive($data);

        if($response['status'] == 'success'){

            $data = [
                'id_user' => trim($request->id_user),
                'price' => trim($request->price),
                'generate_date' => date('Y-m-d'),
                'id_user_generated' => auth()->user()->id,
                'due_date' => date('Y-m-d'),
                'id_type' => 2,
                'status' => "A",
            ];        
    
            $response2 = $this->invoiceService->store($data);
        }

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

        $response = $this->debtService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {
        $id_user = $_GET['id_user'];

        $response = $this->debtService->list($id_user);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
