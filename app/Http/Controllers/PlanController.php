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
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $annual_contract = 0;
        if($request->months >= 12)
            $annual_contract = 1;

        $price_formated_price_march = 0;
        $price_formated_price_april = 0;
        $price_formated_price_may = 0;
        $price_formated_price_june = 0;
        $price_formated_price_july = 0;
        $price_formated_price_august = 0;
        $price_formated_price_september = 0;
        $price_formated_price_october = 0;
        $price_formated_price_november = 0;
        $price_formated_price_december = 0;

        if($annual_contract == 1){
            if($request->price_march != ""){
                $price_formated_price_march = str_replace(".", "", trim($request->price_march));
                $price_formated_price_march = str_replace(",", ".", $price_formated_price_march);
            }
            if($request->price_april != ""){
                $price_formated_price_april = str_replace(".", "", trim($request->price_april));
                $price_formated_price_april = str_replace(",", ".", $price_formated_price_april);
            }
            if($request->price_may != ""){
                $price_formated_price_may = str_replace(".", "", trim($request->price_may));
                $price_formated_price_may = str_replace(",", ".", $price_formated_price_may);
            }
            if($request->price_june != ""){
                $price_formated_price_june = str_replace(".", "", trim($request->price_june));
                $price_formated_price_june = str_replace(",", ".", $price_formated_price_june);
            }
            if($request->price_july != ""){
                $price_formated_price_july = str_replace(".", "", trim($request->price_july));
                $price_formated_price_july = str_replace(",", ".", $price_formated_price_july);
            }
            if($request->price_august != ""){
                $price_formated_price_august = str_replace(".", "", trim($request->price_august));
                $price_formated_price_august = str_replace(",", ".", $price_formated_price_august);
            }
            if($request->price_september != ""){
                $price_formated_price_september = str_replace(".", "", trim($request->price_september));
                $price_formated_price_september = str_replace(",", ".", $price_formated_price_september);
            }
            if($request->price_october != ""){
                $price_formated_price_october = str_replace(".", "", trim($request->price_october));
                $price_formated_price_october = str_replace(",", ".", $price_formated_price_october);
            }
            if($request->price_november != ""){
                $price_formated_price_november = str_replace(".", "", trim($request->price_november));
                $price_formated_price_november = str_replace(",", ".", $price_formated_price_november);
            }
            if($request->price_december != ""){
                $price_formated_price_december = str_replace(".", "", trim($request->price_december));
                $price_formated_price_december = str_replace(",", ".", $price_formated_price_december);
            }
        }

        $data = [
            'id_company' => auth()->user()->id_company,
            'name' => trim($request->name),
            'age_range' => trim($request->age_range),
            'day_period' => trim($request->day_period),
            'lessons_per_week' => trim($request->lessons_per_week),
            'annual_contract' => $annual_contract,
            'months' => trim($request->months),
            'price' => $price_formated,
            'price_march' => $price_formated_price_march,
            'price_april' => $price_formated_price_april,
            'price_may' => $price_formated_price_may,
            'price_june' => $price_formated_price_june,
            'price_july' => $price_formated_price_july,
            'price_august' => $price_formated_price_august,
            'price_september' => $price_formated_price_september,
            'price_october' => $price_formated_price_october,
            'price_november' => $price_formated_price_november,
            'price_december' => $price_formated_price_december,
            'status' => "A"
        ];




        $response = $this->planService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function update(Request $request) 
    {
        $price_formated = str_replace(".", "", trim($request->price));
        $price_formated = str_replace(",", ".", $price_formated);

        $annual_contract = 0;
        if($request->months >= 12)
            $annual_contract = 1;
        
        $price_formated_price_march = 0;
        $price_formated_price_april = 0;
        $price_formated_price_may = 0;
        $price_formated_price_june = 0;
        $price_formated_price_july = 0;
        $price_formated_price_august = 0;
        $price_formated_price_september = 0;
        $price_formated_price_october = 0;
        $price_formated_price_november = 0;
        $price_formated_price_december = 0;

        if($annual_contract == 1){
            if($request->price_march != ""){
                $price_formated_price_march = str_replace(".", "", trim($request->price_march));
                $price_formated_price_march = str_replace(",", ".", $price_formated_price_march);
            }
            if($request->price_april != ""){
                $price_formated_price_april = str_replace(".", "", trim($request->price_april));
                $price_formated_price_april = str_replace(",", ".", $price_formated_price_april);
            }
            if($request->price_may != ""){
                $price_formated_price_may = str_replace(".", "", trim($request->price_may));
                $price_formated_price_may = str_replace(",", ".", $price_formated_price_may);
            }
            if($request->price_june != ""){
                $price_formated_price_june = str_replace(".", "", trim($request->price_june));
                $price_formated_price_june = str_replace(",", ".", $price_formated_price_june);
            }
            if($request->price_july != ""){
                $price_formated_price_july = str_replace(".", "", trim($request->price_july));
                $price_formated_price_july = str_replace(",", ".", $price_formated_price_july);
            }
            if($request->price_august != ""){
                $price_formated_price_august = str_replace(".", "", trim($request->price_august));
                $price_formated_price_august = str_replace(",", ".", $price_formated_price_august);
            }
            if($request->price_september != ""){
                $price_formated_price_september = str_replace(".", "", trim($request->price_september));
                $price_formated_price_september = str_replace(",", ".", $price_formated_price_september);
            }
            if($request->price_october != ""){
                $price_formated_price_october = str_replace(".", "", trim($request->price_october));
                $price_formated_price_october = str_replace(",", ".", $price_formated_price_october);
            }
            if($request->price_november != ""){
                $price_formated_price_november = str_replace(".", "", trim($request->price_november));
                $price_formated_price_november = str_replace(",", ".", $price_formated_price_november);
            }
            if($request->price_december != ""){
                $price_formated_price_december = str_replace(".", "", trim($request->price_december));
                $price_formated_price_december = str_replace(",", ".", $price_formated_price_december);
            }
        }

        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'age_range' => trim($request->age_range),
            'day_period' => trim($request->day_period),
            'lessons_per_week' => trim($request->lessons_per_week),
            'annual_contract' => $annual_contract,
            'months' => trim($request->months),
            'price' => $price_formated,
            'price_march' => $price_formated_price_march,
            'price_april' => $price_formated_price_april,
            'price_may' => $price_formated_price_may,
            'price_june' => $price_formated_price_june,
            'price_july' => $price_formated_price_july,
            'price_august' => $price_formated_price_august,
            'price_september' => $price_formated_price_september,
            'price_october' => $price_formated_price_october,
            'price_november' => $price_formated_price_november,
            'price_december' => $price_formated_price_december,
        ];

        $response = $this->planService->update($data);

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

        $response = $this->planService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
    public function list() 
    {

        $response = $this->planService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
