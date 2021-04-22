<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReservationService;
use App\Services\CourtService;
use App\Services\AvailableDateService;

class ExternalController extends Controller
{
    private $reservationService;
    private $courtService;
    private $availableDateService;

    public function __construct(ReservationService $reservationService, CourtService $courtService, AvailableDateService $availableDateService)
    {
        $this->reservationService = $reservationService;
        $this->courtService = $courtService;
        $this->availableDateService = $availableDateService;
    }

    public function index()
    {
        return view('external.reservation');
    }

    public function store(Request $request) 
    {

        $data = [
            'name_reserved' => trim($request->name_reserved),
            'phone_reserved' => trim($request->phone_reserved),
            'id_available_date' => trim($request->id_available_date),
            'reservation_date' => trim($request->reservation_date),
            'status' => "P",
        ];

        $response = $this->reservationService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function listCourts() 
    {

        $response = $this->courtService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function listWeekDays($id) 
    {

        $response = $this->availableDateService->list($id);

        
        // pega os dias da semana disponiveis para a quadra selecionada
        $wd = [];
        foreach ((array)$response['data'] as $item) {
            if(!in_array($item->week_day,$wd))
                $wd[] = $item->week_day;
        }

        // monta o array com os dias da semana disponiveis por data, dia e disponibilidade
        $days_available = []; 
        for ($i=0; $i < 16; $i++) { 
            $day = date('Y-m-d', strtotime("+".$i."day"));

            // verifica se o dia da sema está disponivel
            if(in_array( date('N', strtotime($day)) ,$wd)){
                $days_available[] = ['day' => $day, 'week_day' => date('N', strtotime($day)), 'available' => 1];
            }else{
                $days_available[] = ['day' => $day, 'week_day' => date('N', strtotime($day)), 'available' => 0];
            }
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$days_available], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function listAvailableDayTimes($id, $week_day, $day) 
    {

        $response = $this->availableDateService->listDayTimes($id, $week_day, $day);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
}
