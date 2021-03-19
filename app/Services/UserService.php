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

}