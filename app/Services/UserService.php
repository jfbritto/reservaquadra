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
                                  'email' => $data['email'],
                                  'birth' => $data['birth'],
                                  'cpf' => $data['cpf'],
                                  'rg' => $data['rg'],
                                  'civil_status' => $data['civil_status'],
                                  'profession' => $data['profession'],
                                  'zip_code' => $data['zip_code'],
                                  'uf' => $data['uf'],
                                  'city' => $data['city'],
                                  'neighborhood' => $data['neighborhood'],
                                  'address' => $data['address'],
                                  'address_number' => $data['address_number'],
                                  'complement' => $data['complement'],
                                  'start_date' => $data['start_date'],
                                  'health_plan' => $data['health_plan'],
                                  'how_met' => $data['how_met'],
                                  'group' => $data['group'],
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

            $result = DB::table('users')
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

    public function changeStatus(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('users')
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

    public function list($group)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select usr.*, TIMESTAMPDIFF(YEAR, birth, CURDATE()) AS age from users usr where usr.status IN ('A','I') and usr.group in (".implode(',',$group).") order by usr.status, usr.name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function listTotal($group)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select sum(status = 'A') as ativos, sum(status = 'I') as inativos from users usr where usr.status IN ('A','I') and usr.group in (".implode(',',$group).")"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function find($id)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select usr.* from users usr where id = ".$id.""));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function search($group, $search)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("select usr.*, TIMESTAMPDIFF(YEAR, birth, CURDATE()) AS age from users usr where usr.status in ('A','I') and usr.group in (".implode(',',$group).") and name like '%".$search."%' order by usr.status, usr.name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

}