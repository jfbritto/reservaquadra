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

        $data = [
            'id_company' => auth()->user()->id_company,
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
    
    // public function update(Request $request) 
    // {
    //     $price_formated = str_replace(".", "", trim($request->price));
    //     $price_formated = str_replace(",", ".", $price_formated);

    //     $annual_contract = 0;
    //     if($request->months >= 12)
    //         $annual_contract = 1;
        
    //     $data = [
    //         'id' => trim($request->id),
    //         'name' => trim($request->name),
    //         'age_range' => trim($request->age_range),
    //         'day_period' => trim($request->day_period),
    //         'lessons_per_week' => trim($request->lessons_per_week),
    //         'annual_contract' => $annual_contract,
    //         'months' => trim($request->months),
    //         'price' => $price_formated,
    //     ];

    //     $response = $this->expenseService->update($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 200);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    // }
    
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
        $date = $_GET['date'];

        $response = $this->expenseService->list($date);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
