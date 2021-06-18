<?php

namespace App\Services;

use App\Models\ScheduledClasses;
use DB;
use Exception;

class ScheduledClassesService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = ScheduledClasses::create($data);

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

    //         $return = DB::table('scheduled_classes')
    //                     ->where('id', $data['id'])
    //                     ->update(['name' => $data['name'],
    //                             'city' => $data['city'],
    //                             'neighborhood' => $data['neighborhood'],
    //                             'reference' => $data['reference'],
    //                             'description' => $data['description']]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $return];

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

            $return = DB::table('scheduled_classes')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $return];

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
            $return = DB::select( DB::raw("select scc.*, crt.name as court_name 
                                           from scheduled_classes scc join courts crt on crt.id=scc.id_court 
                                           where scc.status = 'A' and crt.status = 'A' and scc.id_user = ".$id." 
                                           order by scc.week_day, scc.start_time"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listAll()
    {
        $response = [];

        try{

            $return = DB::table('scheduled_classes')
                        ->join('courts', 'courts.id', '=', 'scheduled_classes.id_court')
                        ->join('users', 'users.id', '=', 'scheduled_classes.id_user')
                        ->where('courts.id_company', auth()->user()->id_company)
                        ->where('scheduled_classes.status', 'A')
                        ->select('scheduled_classes.*', 'courts.name as court_name', 'users.name as user_name')
                        ->orderBy('scheduled_classes.week_day')
                        ->get();

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listAllToday()
    {
        $response = [];

        try{

            $return = DB::table('scheduled_classes')
                        ->join('courts', 'courts.id', '=', 'scheduled_classes.id_court')
                        ->where('courts.id_company', auth()->user()->id_company)
                        ->where('scheduled_classes.status', 'A')
                        ->where('scheduled_classes.week_day', date('N'))
                        ->select('scheduled_classes.*', 'courts.name as court_name')
                        ->orderBy('scheduled_classes.week_day')
                        ->get();

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listAllByDate($date)
    {
        $response = [];

        try{

            $return = DB::select( DB::raw("select 
                                                scc.*, crt.name as court_name, usr.name as user_name, scr.result as result
                                            from 
                                                scheduled_classes scc 
                                                join courts crt on crt.id=scc.id_court 
                                                join users usr on usr.id= scc.id_user
                                                left join scheduled_classes_results scr on scr.id_scheduled_classes= scc.id and scr.date = '".$date."'
                                            where 
                                                crt.id_company = ".auth()->user()->id_company." and
                                                scc.status = 'A' and 
                                                scc.week_day = ".date('N', strtotime($date))."
                                            order by scc.week_day, scc.start_time"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listRemarkedAllByDate($date)
    {
        $response = [];

        try{

            $return = DB::select( DB::raw("SELECT 
                                                scc.*, crt.name as court_name, usr.name as user_name, scr.id as id_origin, scr.result as result, scr_res.result as result_rm, scr.start_time_remarked, scr.end_time_remarked
                                            FROM 
                                                scheduled_classes_results scr
                                                JOIN scheduled_classes scc ON scr.id_scheduled_classes=scc.id
                                                JOIN courts crt ON crt.id=scc.id_court 
                                                JOIN users usr ON usr.id= scc.id_user
                                                LEFT JOIN scheduled_classes_results scr_res on scr_res.id_scheduled_classes_result_remarked=scr.id
                                            WHERE
                                                crt.id_company =  ".auth()->user()->id_company." AND
                                                scc.status = 'A' and 
                                                scr.date_remarked = '".$date."'
                                            ORDER BY 
                                                scc.week_day, scc.start_time;
                                            "));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}