<?php

namespace App\Services;

use App\Models\Reservations;
use DB;
use Exception;

class ReservationService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Reservations::create($data);

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
            $return = DB::select( DB::raw(" select 
                                                res.*, avd.week_day, avd.price, avd.start_time, avd.end_time 
                                            from reservations res 
                                                join available_dates avd on avd.id=res.id_available_date
                                                join courts cou on cou.id=avd.id_court and cou.id_company = '".auth()->user()->id_company."'
                                            order by 
                                                res.status desc, res.reservation_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listOpen()
    {
        $response = [];

        try{
            $return = DB::select( DB::raw(" select 
                                                res.*, avd.week_day, avd.price, avd.start_time, avd.end_time 
                                            from reservations res 
                                                join available_dates avd on avd.id=res.id_available_date
                                                join courts cou on cou.id=avd.id_court and cou.id_company = '".auth()->user()->id_company."'
                                            where res.status = 'P'
                                            order by 
                                                res.status desc, res.reservation_date"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function changeStatus(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $reservation = DB::table('reservations')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $reservation];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}