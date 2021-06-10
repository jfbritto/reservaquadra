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

        $teacher = trim($request->id_teacher)==""?null:trim($request->id_teacher);
        $date_remarked = trim($request->date_remarked)==""?null:trim($request->date_remarked);
        $id_scheduled_classes_result_remarked = trim($request->id_scheduled_classes_result_remarked)==""?null:trim($request->id_scheduled_classes_result_remarked);

        $data = [
            'id_scheduled_classes' => trim($request->id_scheduled_classes),
            'status' => 'A',
            'result' => trim($request->result),
            'id_teacher' => $teacher,
            'observation' => trim($request->observation),
            'date' => trim($request->date),
            'date_remarked' => $date_remarked,
            'id_scheduled_classes_result_remarked' => $id_scheduled_classes_result_remarked,
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
