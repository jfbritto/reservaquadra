<?php

namespace App\Services;

use App\Models\ScheduledClassesResult;
use DB;
use Exception;

class ScheduledClassesResultService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = ScheduledClassesResult::create($data);

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
            $return = DB::select( DB::raw("select 
                                                scc.*, crt.name as court_name, usr.name as user_name, scr.status as status, scr.date
                                            from 
                                                scheduled_classes_results scr
                                                join scheduled_classes scc on scr.id_scheduled_classes= scc.id
                                                join courts crt on crt.id=scc.id_court 
                                                join users usr on usr.id= scc.id_user
                                            where 
                                                crt.id_company = ".auth()->user()->id_company." and
                                                usr.id = ".$id."
                                            order by scr.date desc"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}