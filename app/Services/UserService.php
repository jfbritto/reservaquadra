<?php

namespace App\Services;

use App\Models\User;
use DB;
use Exception;

class UserService
{
    public function store(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = User::create($data);

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

            $result = DB::table('users')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name'],
                                'email' => $data['email']]);

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

            $result = DB::table('users')
                        ->where('id', $data['id'])
                        ->update(['active' => $data['active']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list($group)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select usr.* from users usr where usr.active = 1 and usr.group in (".implode(',',$group).") order by usr.name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}