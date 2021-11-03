<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InterestService;

class InterestController extends Controller
{
    private $interestService;

    public function __construct(InterestService $interestService)
    {
        $this->interestService = $interestService;
    }

    public function index()
    {
        return view('interest.home');
    }
    
    public function store(Request $request) 
    {
        $year = trim($request->year)==""?null:trim($request->year);

        $data = [
            'id_company' => auth()->user()->id_company,
            'name' => trim($request->name),
            'phone1' => trim($request->phone1),
            'phone2' => trim($request->phone2),
            'objective' => trim($request->objective),
            'age' => trim($request->age),
            'sun' => trim($request->sun),
            'sun_period' => trim($request->sun_period),
            'mon' => trim($request->mon),
            'mon_period' => trim($request->mon_period),
            'tue' => trim($request->tue),
            'tue_period' => trim($request->tue_period),
            'wed' => trim($request->wed),
            'wed_period' => trim($request->wed_period),
            'thu' => trim($request->thu),
            'thu_period' => trim($request->thu_period),
            'fri' => trim($request->fri),
            'fri_period' => trim($request->fri_period),
            'sat' => trim($request->sat),
            'sat_period' => trim($request->sat_period),
            'all_days' => trim($request->all_days),
            'all_days_period' => trim($request->all_days_period),
            'status' => "A",
        ];

        $response = $this->interestService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {       

        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'phone1' => trim($request->phone1),
            'phone2' => trim($request->phone2),
            'objective' => trim($request->objective),
            'age' => trim($request->age),
            'sun' => trim($request->sun),
            'sun_period' => trim($request->sun_period),
            'mon' => trim($request->mon),
            'mon_period' => trim($request->mon_period),
            'tue' => trim($request->tue),
            'tue_period' => trim($request->tue_period),
            'wed' => trim($request->wed),
            'wed_period' => trim($request->wed_period),
            'thu' => trim($request->thu),
            'thu_period' => trim($request->thu_period),
            'fri' => trim($request->fri),
            'fri_period' => trim($request->fri_period),
            'sat' => trim($request->sat),
            'sat_period' => trim($request->sat_period),
            'all_days' => trim($request->all_days),
            'all_days_period' => trim($request->all_days_period),
        ];

        $response = $this->interestService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function updateStatus(Request $request) 
    {       

        $data = [
            'id' => trim($request->id),
            'status' => trim($request->status),
            'observation' => trim($request->observation),
        ];

        $response = $this->interestService->updateStatus($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function markAvaliation(Request $request) 
    {       

        $data = [
            'id' => trim($request->id),
            'status' => 'MA',
            'avaliation_date' => trim($request->avaliation_date),
        ];

        $response = $this->interestService->markAvaliation($data);

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

        $response = $this->interestService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {

        $response = $this->interestService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
