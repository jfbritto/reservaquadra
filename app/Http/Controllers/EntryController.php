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
        $date = $_GET['date'];

        if(count(explode('-', $date)) == 2)
            $date = $date.'-01';

        $response = $this->invoiceService->listReceivedByMonth($date);
        $response2 = $this->invoiceReceiptService->listReceivedByMonth($date);

        $resp['response'] = $response['data'];
        $resp['response2'] = $response2['data'];

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$resp], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

}
