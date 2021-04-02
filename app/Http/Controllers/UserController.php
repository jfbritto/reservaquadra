<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;

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

    public function show_student($id)
    {
        return view('user.student.show', ['id' => $id]);
    }

    public function find_student() 
    {
        $id = $_GET['id'];
        $response = $this->userService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);    
    }

    //adicionar user
    public function store_student(Request $request)
    {
        $data = [
            'id_company' => 1,
            'name' => trim($request->name),
            'email' => trim($request->email),
            'birth' => trim($request->birth),
            'cpf' => trim($request->cpf),
            'rg' => trim($request->rg),
            'civil_status' => trim($request->civil_status),
            'profession' => trim($request->profession),
            'zip_code' => trim($request->zip_code),
            'uf' => trim($request->uf),
            'city' => trim($request->city),
            'neighborhood' => trim($request->neighborhood),
            'address' => trim($request->address),
            'address_number' => trim($request->address_number),
            'complement' => trim($request->complement),
            'start_date' => trim($request->start_date),
            'health_plan' => trim($request->health_plan),
            'how_met' => trim($request->how_met),
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
            'status' => 'D'
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
