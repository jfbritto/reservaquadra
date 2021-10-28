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

    public function listReceivedByMonth($date)
    {
        $response = [];

        try{

            $date_ini = date('Y-m-01 00:00:00', strtotime($date));
            $date_fim = date('Y-m-t 23:59:59', strtotime($date));

            $return = DB::select( DB::raw("select 
                                                invr.*, usr.name as cliente, pmt.name as payment_method, pms.name as payment_method_subtype, (select count(*) from invoice_receipts where id_invoice=invr.id_invoice) as total_parcelas,
                                                (select count(*) from invoice_receipts where id_invoice=invr.id_invoice and EXTRACT(YEAR_MONTH FROM billing_date) <= EXTRACT(YEAR_MONTH FROM invr.billing_date)) as parcela_paga, inv.fiscal_note
                                            from 
                                                invoice_receipts invr
                                                join invoices inv on inv.id=invr.id_invoice
                                                join users usr on usr.id=inv.id_user
                                                join payment_methods pmt on inv.id_payment_method=pmt.id
                                                join payment_method_subtypes pms on inv.id_payment_method_subtype=pms.id
                                                join payment_method_subtype_conditions pmsc on inv.id_payment_method_subtype_condition=pmsc.id
                                            where
                                                usr.id_company = ".auth()->user()->id_company." and 
                                                inv.status = 'R' and 
                                                invr.billing_date between '".$date_ini."' and '".$date_fim."' 
                                            order by
                                                invr.billing_date;
                                            "));


            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}