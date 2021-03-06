<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\PhoneService;

class UserController extends Controller
{
    private $userService;
    private $phoneService;

    public function __construct(UserService $userService, PhoneService $phoneService)
    {
        $this->userService = $userService;
        $this->phoneService = $phoneService;
    }

    // ****************************************
    //         MODULO DE ESTUDANTE
    // ****************************************

    public function student()
    {
        return view('user.student.home');
    }

    public function showStudent($id)
    {
        return view('user.student.show', ['id' => $id]);
    }

    public function findStudent() 
    {
        $id = $_GET['id'];
        $response = $this->userService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function storeStudent(Request $request)
    {
        $data = [
            'id_company' => auth()->user()->id_company,
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

        if($response['status'] == 'success'){
            if($request->phones){
                if(count($request->phones) > 0){

                    foreach ($request->phones as $number) {
                        $data = [
                            'id_user' => $response['data']->id,
                            'number' => $number 
                        ];
    
                        $this->phoneService->store($data);
                    }
        
                }
            }
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function listStudent() 
    {

        $response = $this->userService->list([4]);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function searchStudent() 
    {
        $search = $_GET['search'];
        $response = $this->userService->search([4], $search);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function updateStudent(Request $request) 
    {

        $data = [
            'id' => trim($request->id),
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
            'group' => 4,
        ];

        $response = $this->userService->update($data);

        if($response['status'] == 'success'){
            
            $this->phoneService->removeByCliente($request->id);

            if($request->phones){
                if(count($request->phones) > 0){

                    foreach ($request->phones as $number) {
                        $data = [
                            'id_user' => $request->id,
                            'number' => $number 
                        ];
    
                        $this->phoneService->store($data);
                    }
        
                }
            }
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    // ****************************************
    //         MODULO DE RESPONS??VEIS
    // ****************************************

    public function responsible()
    {
        return view('user.responsible.home');
    }

    public function storeResponsible(Request $request)
    {
        $data = [
            'id_company' => auth()->user()->id_company,
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
            'group' => 5,
        ];

        $response = $this->userService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function listResponsible() 
    {

        $response = $this->userService->list([5]);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function updateResponsible(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
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
            'group' => 5,
        ];

        $response = $this->userService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    // ****************************************
    //         MODULO DE FUNCION??RIOS
    // ****************************************

    public function employee()
    {
        return view('user.employee.home');
    }

    public function storeEmployee(Request $request)
    {
        $data = [
            'id_company' => auth()->user()->id_company,
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
            'group' => trim($request->group),
        ];
        
        $response = $this->userService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function listEmployee() 
    {

        $response = $this->userService->list([2,3]);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    public function updateEmployee(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
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
            'group' => trim($request->group),
        ];

        $response = $this->userService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    // ****************************************
    //                 GERAL
    // ****************************************

    public function destroy(Request $request) 
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $response = $this->userService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);    
    }

    // ****************************************
    //               MODULO ROOT
    // ****************************************

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

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
