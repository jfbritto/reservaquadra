<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Services\InvoiceReceiptService;
class EntryController extends Controller
{
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService, InvoiceReceiptService $invoiceReceiptService)
    {
        $this->invoiceService = $invoiceService;
        $this->invoiceReceiptService = $invoiceReceiptService;
    }

    public function index()
    {
        return view('entry.home');
    }

    public function list() 
    {
        $date_ini = $_GET['date_ini'];
        $date_end = $_GET['date_end'];

        if(count(explode('-', $date_ini)) == 2)
            $date_ini = $date_ini.'-01';

        if(count(explode('-', $date_end)) == 2)
            $date_end = $date_end.'-01';

        $response = $this->invoiceService->listReceivedByMonth($date_ini, $date_end);
        $response2 = $this->invoiceReceiptService->listReceivedByMonth($date_ini, $date_end);

        $resp['response'] = $response['data'];
        $resp['response2'] = $response2['data'];

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$resp], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

}
