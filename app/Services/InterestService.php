<?php

namespace App\Services;

use App\Models\Interest;
use DB;
use Exception;

class InterestService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Interest::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function update(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('interests')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name'],
                                  'phone1' => $data['phone1'],
                                  'phone2' => $data['phone2'],
                                  'objective' => $data['objective'],
                                  'age' => $data['age'],
                                  'sun' => $data['sun'],
                                  'sun_period' => $data['sun_period'],
                                  'mon' => $data['mon'],
                                  'mon_period' => $data['mon_period'],
                                  'tue' => $data['tue'],
                                  'tue_period' => $data['tue_period'],
                                  'wed' => $data['wed'],
                                  'wed_period' => $data['wed_period'],
                                  'thu' => $data['thu'],
                                  'thu_period' => $data['thu_period'],
                                  'fri' => $data['fri'],
                                  'fri_period' => $data['fri_period'],
                                  'sat' => $data['sat'],
                                  'sat_period' => $data['sat_period'],
                                  'all_days' => $data['all_days'],
                                  'all_days_period' => $data['all_days_period'],
                                  ]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function updateStatus(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('interests')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status'],
                                  'observation' => $data['observation']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function markAvaliation(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('interests')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status'],
                                  'avaliation_date' => $data['avaliation_date']]);

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

            $result = DB::table('interests')
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
            $return = Interest::where('id_company', auth()->user()->id_company)
                            ->where('status', '!=', 'D')
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