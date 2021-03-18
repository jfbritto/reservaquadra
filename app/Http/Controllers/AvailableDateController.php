<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AvailableDateService;

class AvailableDateController extends Controller
{
    private $availableDateService;

    public function __construct(AvailableDateService $availableDateService)
    {
        $this->availableDateService = $availableDateService;
    }

    public function store(Request $request) 
    {
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $data = [
            'id_company' => 1,
            'id_court' => trim($request->id_court),
            'week_day' => trim($request->week_day),
            'start_time' => trim($request->start_time),
            'end_time' => trim($request->end_time),
            'price' => $price_formated
        ];

        $response = $this->availableDateService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }

    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'active' => 0
        ];

        $response = $this->availableDateService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
    
    public function list($id) 
    {

        $response = $this->availableDateService->list($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }
}
