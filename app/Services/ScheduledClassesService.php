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
                        ->where('courts.id_company', auth()->user()->id_company)
                        ->where('scheduled_classes.status', 'A')
                        ->select('scheduled_classes.*', 'courts.name as court_name')
                        ->orderBy('scheduled_classes.week_day')
                        ->get();

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}