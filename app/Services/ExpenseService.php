<?php

namespace App\Services;

use App\Models\Expense;
use DB;
use Exception;

class expenseService
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

    public function list()
    {
        $response = [];

        try{
            $return = Expense::where('id_company', auth()->user()->id_company)
                            ->where('status', '!=', 'D')
                            ->orderByDesc('due_date')
                            ->get();

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}