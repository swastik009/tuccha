<?php

namespace App\Http\Controllers;

use App\Notifications\SignUpActivate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function register(Request $request)
    {



        \request()->validate([
            'name' => 'required|min:3',
            'email' =>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60)
        ]);

       // $thisUser = User::where('email',$request->email);

        $token = $user->createToken('tuccha')->accessToken;
        $user->notify(new SignUpActivate($user));
        return response()->json(['token' => $token,'user'=>$user], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('tuucha')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function SignUpActivate($token){
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return $user;
    }


    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}