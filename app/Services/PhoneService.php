<?php

namespace App\Services;

use App\Models\Phone;
use DB;
use Exception;

class PhoneService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = Phone::create($data);

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

    //         $phones = DB::table('phones')
    //                     ->where('id', $data['id'])
    //                     ->update(['name' => $data['name'],
    //                             'city' => $data['city'],
    //                             'neighborhood' => $data['neighborhood'],
    //                             'reference' => $data['reference'],
    //                             'description' => $data['description']]);

    //         DB::commit();

    //         $response = ['status' => 'success', 'data' => $phones];

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

            $phones = DB::table('phones')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $phones];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function removeByCliente($id_user)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $phones = DB::table('phones')->where('id_user', $id_user)->delete();

            DB::commit();

            $response = ['status' => 'success', 'data' => $phones];

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
            $return = DB::select( DB::raw("select * from phones where status = 'A' and id_user = '".$id_user."' order by id desc"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}