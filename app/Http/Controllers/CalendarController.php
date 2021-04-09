<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScheduledClassesService;
class CalendarController extends Controller
{
    private $scheduledClassesService;

    public function __construct(ScheduledClassesService $scheduledClassesService)
    {
        $this->scheduledClassesService = $scheduledClassesService;
    }

    public function index() 
    {
        return view('calendar.home');
    }

    public function load() 
    {
        $classes = $this->scheduledClassesService->listAll();

        foreach ($classes['data'] as $class) {
            $response['data']['classes'][] = $class->week_day;     
        }

        $response['status'] = true;

        //pega o primeiro dia do mes
        $response['data']['dia1'] = date('w', strtotime(date('Y-m-d')));

        //pega quantas linhas terá o calendário
        $response['data']['linhas'] = 4;

        //negativa o primeiro dia do calendário para calcular
        $response['data']['dia1'] = -$response['data']['dia1'];

        //calcula qual será o primeiro dia do calendário
        $response['data']['data_inicio'] = date('Y-m-d', strtotime($response['data']['dia1'].' days', strtotime(date('Y-m-d'))));

        //calcula qual será o ultimo dia do calendário
        $response['data']['data_fim'] = date('Y-m-d', strtotime('+31 days', strtotime(date('Y-m-d'))));


        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}
