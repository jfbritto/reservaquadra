<?php

namespace App\Services;

use App\Models\Plan;
use DB;
use Exception;

class PlanService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Plan::create($data);

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

            $result = DB::table('plans')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name'],
                                  'age_range' => $data['age_range'],
                                  'day_period' => $data['day_period'],
                                  'lessons_per_week' => $data['lessons_per_week'],
                                  'annual_contract' => $data['annual_contract'],
                                  'months' => $data['months'],
                                  'price' => $data['price'],
                                  'price_march' => $data['price_march'],
                                  'price_april' => $data['price_april'],
                                  'price_may' => $data['price_may'],
                                  'price_june' => $data['price_june'],
                                  'price_july' => $data['price_july'],
                                  'price_august' => $data['price_august'],
                                  'price_september' => $data['price_september'],
                                  'price_october' => $data['price_october'],
                                  'price_november' => $data['price_november'],
                                  'price_december' => $data['price_december'],
                                  ]);

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

            $result = DB::table('plans')
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
            $return = Plan::where('id_company', auth()->user()->id_company)
                            ->where('status', 'A')
                            ->orderByDesc('age_range')
                            ->orderBy('day_period')
                            ->orderBy('lessons_per_week')
                            ->orderBy('months')
                            ->get();

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}