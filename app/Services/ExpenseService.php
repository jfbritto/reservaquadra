<?php

namespace App\Services;

use App\Models\Expense;
use DB;
use Exception;

class ExpenseService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Expense::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    // public function update(array $data)
    // {
    //     $response = [];

    //     try{

    //         DB::beginTransaction();

    //         $result = DB::table('expenses')
    //                     ->where('id', $data['id'])
    //                     ->update(['id_company' => $data['id_company'],
    //                               'generate_date' => $data['generate_date'],
    //                               'id_user_generated' => $data['id_user_generated'],
    //                               'due_date' => $data['due_date'],
    //                               'status' => $data['status'],
    //                               'price' => $data['price'],
    //                               'id_cost_center' => $data['id_cost_center'],
    //                               'id_cost_center_subtype' => $data['id_cost_center_subtype'],
    //                               'observation' => $data['observation'],
    //                               ]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $result];

    //     }catch(Exception $e){
    //         DB::rollBack();
    //         $response = ['status' => 'error', 'data' => $e->getMessage()];
    //     }

    //     return $response;
    // }

    public function pay(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('expenses')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status'],
                                 'paid_date' => $data['paid_date'],
                                 'id_user_paid' => $data['id_user_paid']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function destroy(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('expenses')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list($date_ini, $date_end)
    {
        $response = [];

        try{

            $date_ini = date('Y-m-d 00:00:00', strtotime($date_ini));
            $date_fim = date('Y-m-d 23:59:59', strtotime($date_end));

            $return = DB::select( DB::raw(" select 
                                                exp.*, coc.name as name_cost_center, ccs.name as name_cost_center_subtype, DATE_ADD(exp.due_date, INTERVAL 1 MONTH) as next_month, ccs.name as subtype_name
                                            from expenses exp 
                                                join cost_centers coc on coc.id=exp.id_cost_center
                                                join cost_center_subtypes ccs on ccs.id=exp.id_cost_center_subtype
                                            where 
                                                exp.id_company = '".auth()->user()->id_company."' and
                                                exp.status != 'D' and
                                                exp.due_date between '".$date_ini."' and '".$date_fim."' 
                                            order by 
                                                exp.id_cost_center, exp.id_cost_center_subtype, exp.status desc"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}