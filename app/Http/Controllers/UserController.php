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

    //adicionar user
    public function store(Request $request)
    {

        // $find_user = User::where('email', $request->email)->first();

        // if($find_user)
        //     return response()->json(['status'=>'error', 'message'=>'Visshh! Parece que alguém já está usando esse email :('], 201);
            
        // $url = Str::kebab(trim($request->name));

        // $user = DB::select( DB::raw("select * from users where url_name = '".$url."'"));

        // if(count($user) > 0)
        //     return response()->json(['status'=>'error', 'message'=>'A URL "'.$url.'" já pertence à outro usuário! Tente colocar outro nome!'], 201);


        $data = [
            'id_company' => 1,
            'name' => trim($request->name),
            'email' => trim($request->email) ,
            'password' => bcrypt(trim($request->password)),
            'group' => 1,
        ];

        $response = $this->userService->store($data);

        // $credentials = array('email' => $request->email, 'password' => $request->password);
        // auth()->attempt($credentials);

        // $msg = $request->name." acabou de se cadastrar!";
        // file_get_contents('https://api.telegram.org/bot1366316005:AAHoexLlhQeRJ5OJEAWPF_dj1dmaSUb1iEc/sendMessage?chat_id=-1001312472436&text='.$msg.'');

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 201);
    }
}
