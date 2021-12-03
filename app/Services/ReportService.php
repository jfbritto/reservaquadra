<?php

namespace App\Services;

use DB;
use Exception;

class ReportService
{
    public function entry()
    {
        $response = [];

        try{
            $return = DB::select( DB::raw(" SELECT 
                                                extract(month from inv.due_date) as mes, 
                                                extract(year from inv.due_date) as ano, 
                                                sum(inv.price) as total,
                                                concat(extract(month from inv.due_date), '/', extract(year from inv.due_date)) as mesano
                                            FROM 
                                                invoices inv
                                                join users usr on inv.id_user=usr.id
                                            WHERE
                                                inv.status in ('A', 'R')
                                                and usr.id_company = ".auth()->user()->id_company."
                                            GROUP BY
                                                extract(month from inv.due_date), extract(year from inv.due_date)
                                            ORDER BY
                                                inv.due_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function expense()
    {
        $response = [];

        try{
            $return = DB::select( DB::raw(" SELECT 
                                                extract(month from exp.due_date) as mes, 
                                                extract(year from exp.due_date) as ano, 
                                                sum(exp.price) as total,
                                                concat(extract(month from exp.due_date), '/', extract(year from exp.due_date)) as mesano
                                            FROM 
                                                expenses exp
                                            WHERE
                                                exp.status in ('P', 'R')
                                                and exp.id_company = ".auth()->user()->id_company."
                                            GROUP BY
                                                extract(month from exp.due_date), extract(year from exp.due_date)
                                            ORDER BY
                                                exp.due_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}