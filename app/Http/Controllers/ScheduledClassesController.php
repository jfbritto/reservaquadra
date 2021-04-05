<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScheduledClassesService;

class ScheduledClassesController extends Controller
{
    private $scheduledClassesService;

    public function __construct(ScheduledClassesService $scheduledClassesService)
    {
        $this->scheduledClassesService = $scheduledClassesService;
    }

    public function index() 
    {
        return view('scheduled_classes.home');
    }
    
    public function store(Request $request) 
    {

        if($request->week_day < 8){

            $data = [
                'id_user' => trim($request->id_user),
                'id_court' => trim($request->id_court),
                'week_day' => trim($request->week_day),
                'start_time' => trim($request->start_time),
                'end_time' => trim($request->end_time),
                'status' => "A"
            ];

            $response = $this->scheduledClassesService->store($data);

        }else{

            if($request->week_day == 8){

                for ($i=1; $i < 8; $i++) { 
                    $data = [
                        'id_user' => trim($request->id_user),
                        'id_court' => trim($request->id_court),
                        'week_day' => $i,
                        'start_time' => trim($request->start_time),
                        'end_time' => trim($request->end_time),
                        'status' => "A"
                    ];
            
                    $response = $this->scheduledClassesService->store($data);
                }
                
            }else{
                
                for ($i=1; $i < 6; $i++) { 
                    $data = [
                        'id_user' => trim($request->id_user),
                        'id_court' => trim($request->id_court),
                        'week_day' => $i,
                        'start_time' => trim($request->start_time),
                        'end_time' => trim($request->end_time),
                        'status' => "A"
                    ];
            
                    $response = $this->scheduledClassesService->store($data);
                }

            }

        }

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

    //     $response = $this->scheduledClassesService->update($data);

    //     if($response['status'] == 'success')
    //         return response()->json(['status'=>'success'], 201);

    //     return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    // }
    
    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $response = $this->scheduledClassesService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function list($id) 
    {

        $response = $this->scheduledClassesService->list($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
}
