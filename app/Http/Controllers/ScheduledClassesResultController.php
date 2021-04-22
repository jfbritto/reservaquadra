<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScheduledClassesResultService;

class ScheduledClassesResultController extends Controller
{
    private $scheduledClassesResultService;

    public function __construct(ScheduledClassesResultService $scheduledClassesResultService)
    {
        $this->scheduledClassesResultService = $scheduledClassesResultService;
    }
    
    public function store(Request $request) 
    {

        $data = [
            'id_scheduled_classes' => trim($request->id),
            'status' => "P",
            'date' => trim($request->date),
            'observation' => "Aula realizada",
        ];

        $response = $this->scheduledClassesResultService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $response = $this->scheduledClassesResultService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function list($id) 
    {

        $response = $this->scheduledClassesResultService->list($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
}