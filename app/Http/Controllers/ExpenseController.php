<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExpenseService;

class ExpenseController extends Controller
{
    private $expenseService;

    public function __construct(ExpenseService $expenseService)
    {
        $this->expenseService = $expenseService;
    }

    public function index()
    {
        return view('expense.home');
    }
    
    public function store(Request $request) 
    {
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $provider = $request->id_provider!=""?$request->id_provider:null;

        $data = [
            'id_company' => auth()->user()->id_company,
            'id_provider' => $provider,
            'generate_date' => date("Y-m-d H:i:s"),
            'id_user_generated' => auth()->user()->id,
            'due_date' => trim($request->due_date),
            'status' => "P",
            'price' => trim($price_formated),
            // 'paid_date' => trim($request->paid_date),
            // 'id_user_paid' => trim($request->id_user_paid),
            'id_cost_center' => trim($request->id_cost_center),
            'id_cost_center_subtype' => trim($request->id_cost_center_subtype),
            'observation' => trim($request->observation),
            // 'nfe' => trim($request->nfe),
        ];

        $response = $this->expenseService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $provider = $request->id_provider!=""?$request->id_provider:null;
        
        $data = [
            'id' => trim($request->id),
            'id_provider' => $provider,
            'due_date' => trim($request->due_date),
            'price' => trim($price_formated),
            'id_cost_center' => trim($request->id_cost_center),
            'id_cost_center_subtype' => trim($request->id_cost_center_subtype),
            'observation' => trim($request->observation),
        ];

        $response = $this->expenseService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function pay(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'paid_date' => date('Y-m-d H:i:s'),
            'id_user_paid' => auth()->user()->id,
            'status' => 'R'
        ];

        $response = $this->expenseService->pay($data);

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

        $response = $this->expenseService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {
        $date_ini = $_GET['date_ini'];
        $date_end = $_GET['date_end'];
        $provider_search = $_GET['provider_search'];
        $cost_center_search = $_GET['cost_center_search'];

        $response = $this->expenseService->list($date_ini, $date_end, $provider_search, $cost_center_search);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
