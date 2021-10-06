<?php

namespace App\Services;

use App\Models\InvoiceReceipt;
use DB;
use Exception;

class InvoiceReceiptService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = InvoiceReceipt::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}