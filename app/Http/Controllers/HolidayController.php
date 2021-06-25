<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HolidayService;

class HolidayController extends Controller
{
    private $holidayService;

    public function __construct(HolidayService $holidayService)
    {
        $this->holidayService = $holidayService;
    }

    public function index()
    {
        return view('holiday.home');
    }
    
    public function store(Request $request) 
    {
        $year = trim($request->year)==""?null:trim($request->year);

        $data = [
            'id_company' => auth()->user()->id_company,
            'name' => trim($request->name),
            'day' => trim($request->day),
            'month' => trim($request->month),
            'year' => $year,
            'status' => "A",
        ];

        $response = $this->holidayService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {       
        $year = trim($request->year)==""?null:trim($request->year);

        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'day' => trim($request->day),
            'month' => trim($request->month),
            'year' => $year,
        ];

        $response = $this->holidayService->update($data);

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

        $response = $this->holidayService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {

        $response = $this->holidayService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
