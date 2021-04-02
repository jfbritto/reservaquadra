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
        $data = [
            'id_company' => 1,
            'name' => trim($request->name),
            'months' => trim($request->months),
            'status' => "A"
        ];

        $response = $this->planService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function update(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'months' => trim($request->months),
        ];

        $response = $this->planService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    // public function destroy(Request $request) 
    // {
    //     $data = [
    //         'id' => trim($request->id),
    //         'status' => 'D'
    //     ];

    //     $response = $this->planService->destroy($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    public function list() 
    {

        $response = $this->planService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
}
