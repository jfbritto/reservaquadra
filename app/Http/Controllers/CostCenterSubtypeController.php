<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CostCenterSubtypeService;

class CostCenterSubtypeController extends Controller
{
    private $costCenterSubtypeService;

    public function __construct(CostCenterSubtypeService $costCenterSubtypeService)
    {
        $this->costCenterSubtypeService = $costCenterSubtypeService;
    }

    public function index()
    {
        return view('cost_center.home');
    }
    
    public function store(Request $request) 
    {
        $data = [
            'id_cost_center' => trim($request->id_cost_center),
            'name' => trim($request->name),
            'status' => "A",
        ];

        $response = $this->costCenterSubtypeService->store($data);

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

        $response = $this->costCenterSubtypeService->update($data);

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

        $response = $this->costCenterSubtypeService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {
        $id_cost_center = $_GET['id_cost_center'];

        $response = $this->costCenterSubtypeService->list($id_cost_center);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
