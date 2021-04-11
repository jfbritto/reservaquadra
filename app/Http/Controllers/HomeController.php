<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\ReservationService;
use App\Services\ScheduledClassesService;
use App\Services\InvoiceService;

class HomeController extends Controller
{
    private $userService;
    private $reservationService;
    private $scheduledClassesService;
    private $invoiceService;

    public function __construct(UserService $userService, ReservationService $reservationService, ScheduledClassesService $scheduledClassesService, InvoiceService $invoiceService)
    {
        $this->userService = $userService;
        $this->reservationService = $reservationService;
        $this->scheduledClassesService = $scheduledClassesService;
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {

        // dd(phpinfo());
        // dd(date('d/m/Y H:i:s'));

        return view('home.home');
    }

    public function all() 
    {

        $response_alunos = $this->userService->list([4]);
        $response_reservations = $this->reservationService->listOpen();
        $response_scheduledClasses = $this->scheduledClassesService->listAllToday();
        $response_debts = $this->invoiceService->listAllOverdueBills();

        $data = ['students' => count($response_alunos['data']), 
                'reservations' => count($response_reservations['data']), 
                'scheduledClasses' => count($response_scheduledClasses['data']), 
                'debts' => count($response_debts['data'])];

        if($data)
            return response()->json(['status'=>'success', 'data'=>$data, 201]);

        return response()->json(['status'=>'error', 'message'=>$data, 201]);    
    }
}
