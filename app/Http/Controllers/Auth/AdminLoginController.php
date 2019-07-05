<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Admin;
class AdminLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function login(){

        return view('auth\adminLogin');

    }

    public function loginSubmit(){



        \request()->validate([
            'email' => 'required|email',
            'password'=> 'required'
        ]);

        $credentials = [
            'email' => \request('email'),
            'password' => \request('password'),
        ];

        //dd($credentials);

        if(Auth::guard('admin')->attempt($credentials,\request('remember'))){
            return redirect()->intended('admin');
        }

        return redirect()->back()->withInput(\request(['email', 'remember']));

    }
    //
}
