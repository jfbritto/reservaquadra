<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    public function index()
    {        
        return view('authenticate.login');
    }

    public function register()
    {        
        return view('authenticate.register');
    }

    public function login(Request $request)
    {
        $credentials = array('email' => $request->email, 'password' => $request->password);

        if(auth()->attempt($credentials)){

            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false, 'mensagem' => 'Usuário ou senha incorretos']);
    }
    
    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect('/');
    }
}
