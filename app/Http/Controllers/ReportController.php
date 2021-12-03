<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    private $reportService;

    private $mes_desc = [
        '1' => 'Janeiro',
        '2' => 'Fevereiro',
        '3' => 'Março',
        '4' => 'Abril',
        '5' => 'Maio',
        '6' => 'Junho',
        '7' => 'Julho',
        '8' => 'Agosto',
        '9' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro',
    ];

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        return view('report.home');
    }

    public function entry() 
    {
        $response = $this->reportService->entry();

        if($response['status'] == 'success'){

            $array = [];
            foreach ($response['data'] as $key => $value) {
                $array['mesano'][] = $this->mes_desc[$value->mes]." de ".$value->ano;
                $array['total'][] = floatVal($value->total);
                $array['cores'][] = "rgb(25,135,84)";
                $array['coresborda'][] = "rgb(25,135,84)";
            }

            // $array['mesano'] = implode(",", $array['mesano']);
            // $array['total'] = implode(",", $array['total']);

            return response()->json(['status'=>'success', 'data'=>$array], 200);
        }

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function expense() 
    {
        $response = $this->reportService->expense();

        if($response['status'] == 'success'){

            $array = [];
            foreach ($response['data'] as $key => $value) {
                $array['mesano'][] = $this->mes_desc[$value->mes]." de ".$value->ano;
                $array['total'][] = floatVal($value->total);
                $array['cores'][] = "rgb(220,53,69)";
                $array['coresborda'][] = "rgb(220,53,69)";
            }

            // $array['mesano'] = implode(",", $array['mesano']);
            // $array['total'] = implode(",", $array['total']);

            return response()->json(['status'=>'success', 'data'=>$array], 200);
        }

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }
    
}
