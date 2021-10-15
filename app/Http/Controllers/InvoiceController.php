<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Services\ContractService;
use App\Services\InvoiceReceiptService;
use App\Services\PaymentMethodSubtypeConditionService;

class InvoiceController extends Controller
{
    private $invoiceService;
    private $contractService;
    private $invoiceReceiptService;

    public function __construct(InvoiceService $invoiceService, ContractService $contractService, InvoiceReceiptService $invoiceReceiptService, PaymentMethodSubtypeConditionService $paymentMethodSubtypeConditionService)
    {
        $this->invoiceService = $invoiceService;
        $this->contractService = $contractService;
        $this->invoiceReceiptService = $invoiceReceiptService;
        $this->paymentMethodSubtypeConditionService = $paymentMethodSubtypeConditionService;
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
            'id_payment_method_subtype_condition' => trim($request->id_payment_method_subtype_condition),
        ];

        // efetua o recebimento retornando o boleto recebido
        $response = $this->invoiceService->receive($data);

        // verifica se deu tudo certo
        if($response['status'] == 'success'){

            // busca a fatura pelo id
            $invoice_obj = $this->invoiceService->getById($request->id);


            $next_date = date('Y-m-d H:i:s');
            // busca o parcelamento pelo id
            $pmsc_obj = $this->paymentMethodSubtypeConditionService->getById($request->id_payment_method_subtype_condition);

            if($pmsc_obj['data']->is_flat == 0){
                
                // cria o registro da data esperada para o faturamento dessa fatura paga
                for ($i=0; $i < $pmsc_obj['data']->parcel; $i++) {
                    
                    $val_parcel = $invoice_obj['data']->paid_price/$pmsc_obj['data']->parcel;
                    
                    $tax = ($pmsc_obj['data']->percentage_tax/100)*$val_parcel;

                    $final_value = $val_parcel - $tax;

                    $next_date = date('Y-m-d H:i:s', strtotime($next_date." + ".$pmsc_obj['data']->days_for_payment." days"));

                    $data_invoice_receipt = [
                        'id_invoice' => $invoice_obj['data']->id,
                        'billing_date' => $next_date,
                        'status' => "R",
                        'price' => $final_value,
                        'tax' => $tax
                    ];
        
                    $this->invoiceReceiptService->store($data_invoice_receipt);
                }

            }else{

                $final_value = ($invoice_obj['data']->paid_price) - ($pmsc_obj['data']->flat_tax);

                $final_value = $final_value/$pmsc_obj['data']->parcel;

                $next_date = date('Y-m-d H:i:s', strtotime($next_date." + ".$pmsc_obj['data']->days_for_payment." days"));

                $data_invoice_receipt = [
                    'id_invoice' => $invoice_obj['data']->id,
                    'billing_date' => $next_date,
                    'status' => "R",
                    'price' => $final_value,
                    'price' => $pmsc_obj['data']->flat_tax
                ];
    
                $this->invoiceReceiptService->store($data_invoice_receipt);

            }


            // verifica se a fatura é de um contrato que precisa de nova geração de fatura
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
                    
                    // adiciona a data de vencimento após a ultima data encontrada
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
    
    public function listReceivedsByStudent($id_student) 
    {

        $response = $this->invoiceService->listReceivedsByStudent($id_student);

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
