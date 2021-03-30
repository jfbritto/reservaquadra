<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function student()
    {
        return view('user.student.home');
    }

    //adicionar user
    public function store_student(Request $request)
    {
        $data = [
            'id_company' => 1,
            'name' => trim($request->name),
            'email' => trim($request->email) ,
            'password' => bcrypt(trim(123456)),
            'group' => 4,
        ];

        $response = $this->userService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function list_student() 
    {

        $response = $this->userService->list([4]);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }

    public function update_student(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'email' => trim($request->email)
        ];

        $response = $this->userService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }






    public function employee()
    {
        return view('user.employee.home');
    }

    //adicionar user
    public function store_employee(Request $request)
    {
        $data = [
            'id_company' => 1,
            'name' => trim($request->name),
            'email' => trim($request->email) ,
            'password' => bcrypt(trim(123456)),
            'group' => trim($request->group),
        ];

        $response = $this->userService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }

    public function list_employee() 
    {

        $response = $this->userService->list([2,3]);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }

    public function update_employee(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'email' => trim($request->email)
        ];

        $response = $this->userService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }








    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'active' => 0
        ];

        $response = $this->userService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }




    //adicionar user
    public function store(Request $request)
    {
        $data = [
            'id_company' => 1,
            'name' => trim($request->name),
            'email' => trim($request->email) ,
            'password' => bcrypt(trim($request->password)),
            'group' => 1,
        ];

        $response = $this->userService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}
