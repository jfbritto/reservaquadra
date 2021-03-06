<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Services\ContractService;

class InvoiceController extends Controller
{
    private $invoiceService;
    private $contractService;

    public function __construct(InvoiceService $invoiceService, ContractService $contractService)
    {
        $this->invoiceService = $invoiceService;
        $this->contractService = $contractService;
    }
    
    public function store(Request $request) 
    {
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $data = [
            'id_user' => trim($request->id_user),
            'price' => $price_formated,
            'generate_date' => date('Y-m-d'),
            'id_user_generated' => auth()->user()->id,
            'due_date' => trim($request->due_date),
            'id_type' => trim($request->id_type),
            'status' => "A",
        ];        

        $response = $this->invoiceService->store($data);

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

    //     $response = $this->invoiceService->update($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    public function receive(Request $request) 
    {
        // formata o desconto
        if($request->discount){
            $discount_formated = str_replace(".", "", trim($request->discount));
            $discount_formated = str_replace(",", ".", $discount_formated);
        }else{
            $discount_formated = 0;
        }

        // formata o valor recebido
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
            'id_payment_method' => trim($request->id_payment_method),
            'id_payment_method_subtype' => trim($request->id_payment_method_subtype),
        ];

        // efetua o recebimento retornando o boleto recebido
        $response = $this->invoiceService->receive($data);

        // verifica se deu tudo certo
        if($response['status'] == 'success'){

            // busca a fatura pelo id
            $invoice_obj = $this->invoiceService->getById($request->id);

            // verifica se a fatura ?? de um contrato que precisa de nova gera????o de fatura
            $generate_invoice = false;
            if($invoice_obj['data']->id_contract){
                $contract_obj = $this->contractService->find($invoice_obj['data']->id_contract);

                if($contract_obj['data'][0]->parcel == null)
                    $generate_invoice = true;
            }

            // caso seja...
            if($generate_invoice){

                // busca a fatura aberta mais distante
                $invoice_far_obj = $this->invoiceService->listFarMoreOpen($invoice_obj['data']->id_user);
                
                // verifica se ela existe
                if($invoice_far_obj['status'] == 'success'){
                    
                    // adiciona a data de vencimento ap??s a ultima data encontrada
                    $due_date = date("Y-m-d", strtotime("+1 month", strtotime($invoice_far_obj['data']->due_date)));
    
                    $data2 = [
                        'id_user' => trim($invoice_far_obj['data']->id_user),
                        'id_contract' => trim($invoice_far_obj['data']->id_contract),
                        'due_date' => $due_date,
                        'price' => trim($invoice_far_obj['data']->price),
                        'generate_date' => date('Y-m-d H:i:s'),
                        'id_user_generated' => auth()->user()->id,
                        'id_type' => 1,
                        'status' => "A"
                    ];    
                    
                    // e gera a fatura
                    $this->invoiceService->store($data2);
                }

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
        $date = $_GET['date'];

        $response = $this->invoiceService->listReceivedByMonth($date);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
