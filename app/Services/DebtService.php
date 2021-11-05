<?php

namespace App\Services;

use App\Models\Debt;
use DB;
use Exception;

class DebtService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Debt::create($data);

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

    //         $result = DB::table('debts')
    //                     ->where('id', $data['id'])
    //                     ->update(['name' => $data['name'],
    //                               'phone1' => $data['phone1'],
    //                               'phone2' => $data['phone2'],
    //                               'objective' => $data['objective'],
    //                               'age' => $data['age'],
    //                               'sun' => $data['sun'],
    //                               'sun_period' => $data['sun_period'],
    //                               'mon' => $data['mon'],
    //                               'mon_period' => $data['mon_period'],
    //                               'tue' => $data['tue'],
    //                               'tue_period' => $data['tue_period'],
    //                               'wed' => $data['wed'],
    //                               'wed_period' => $data['wed_period'],
    //                               'thu' => $data['thu'],
    //                               'thu_period' => $data['thu_period'],
    //                               'fri' => $data['fri'],
    //                               'fri_period' => $data['fri_period'],
    //                               'sat' => $data['sat'],
    //                               'sat_period' => $data['sat_period'],
    //                               'all_days' => $data['all_days'],
    //                               'all_days_period' => $data['all_days_period'],
    //                               ]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $result];

    //     }catch(Exception $e){
    //         DB::rollBack();
    //         $response = ['status' => 'error', 'data' => $e->getMessage()];
    //     }

    //     return $response;
    // }

    public function receive(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('debts')
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

    public function destroy(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('debts')
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

    public function list($id_user)
    {
        $response = [];

        try{
            $return = Debt::where('id_company', auth()->user()->id_company)->where('id_user', $id_user)
                            ->where('status', '!=', 'R')
                            ->where('status', '!=', 'C')
                            // ->orderBy('month')
                            // ->orderBy('day')
                            ->get();

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}