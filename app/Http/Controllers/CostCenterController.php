<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CostCenterService;

class CostCenterController extends Controller
{
    private $costCenterService;

    public function __construct(CostCenterService $costCenterService)
    {
        $this->costCenterService = $costCenterService;
    }

    public function index()
    {
        return view('cost_center.home');
    }
    
    public function store(Request $request) 
    {
        $data = [
            'id_company' => auth()->user()->id_company,
            'name' => trim($request->name),
            'status' => "A",
        ];

        $response = $this->costCenterService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {       
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name)
        ];

        $response = $this->costCenterService->update($data);

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

        $response = $this->costCenterService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {

        $response = $this->costCenterService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
