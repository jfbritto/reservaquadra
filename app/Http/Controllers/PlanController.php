<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlanService;

class PlanController extends Controller
{
    private $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    public function index()
    {
        return view('plan.home');
    }
    
    public function store(Request $request) 
    {
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $annual_contract = 0;
        if($request->months == 12)
            $annual_contract = 1;

        $data = [
            'id_company' => auth()->user()->id_company,
            'name' => trim($request->name),
            'age_range' => trim($request->age_range),
            'day_period' => trim($request->day_period),
            'lessons_per_week' => trim($request->lessons_per_week),
            'annual_contract' => $annual_contract,
            'months' => trim($request->months),
            'price' => $price_formated,
            'status' => "A"
        ];

        $response = $this->planService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function update(Request $request) 
    {
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $annual_contract = 0;
        if($request->months == 12)
            $annual_contract = 1;
        
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'age_range' => trim($request->age_range),
            'day_period' => trim($request->day_period),
            'lessons_per_week' => trim($request->lessons_per_week),
            'annual_contract' => $annual_contract,
            'months' => trim($request->months),
            'price' => $price_formated,
        ];

        $response = $this->planService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $response = $this->planService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function list() 
    {

        $response = $this->planService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
}
