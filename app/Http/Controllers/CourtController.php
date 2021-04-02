<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourtService;

class CourtController extends Controller
{
    private $courtService;

    public function __construct(CourtService $courtService)
    {
        $this->courtService = $courtService;
    }

    public function index() 
    {
        return view('court.home');
    }
    
    public function store(Request $request) 
    {
        $data = [
            'id_company' => 1,
            'name' => trim($request->name),
            'city' => trim($request->city),
            'neighborhood' => trim($request->neighborhood),
            'reference' => trim($request->reference),
            'description' => trim($request->description)
        ];

        $response = $this->courtService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function update(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'city' => trim($request->city),
            'neighborhood' => trim($request->neighborhood),
            'reference' => trim($request->reference),
            'description' => trim($request->description)
        ];

        $response = $this->courtService->update($data);

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

        $response = $this->courtService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function list() 
    {

        $response = $this->courtService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
}
