<?php

namespace App\Services;

use App\Models\AvailableDates;
use DB;
use Exception;

class AvailableDateService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = AvailableDates::create($data);

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

            $courts = DB::table('available_dates')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $courts];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list($id)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select avd.*, crt.name as court_name 
                                           from available_dates avd join courts crt on crt.id=avd.id_court 
                                           where avd.status = 'A' and crt.status = 'A' and avd.id_court = ".$id." 
                                           order by avd.week_day, avd.start_time"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listDayTimes($id, $week_day, $day)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select avd.*, crt.name as court_name, res.id as reserved, res.status
                                           from 
                                                available_dates avd 
                                                join courts crt on crt.id=avd.id_court 
                                                left join reservations res on res.id_available_date=avd.id and res.reservation_date = '".$day." '
                                           where avd.status = 'A' and crt.status = 'A' and avd.id_court = ".$id." and avd.week_day = ".$week_day." 
                                           order by avd.week_day, avd.start_time"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}