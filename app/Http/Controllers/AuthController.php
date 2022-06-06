<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $r){
        $fields=$r->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);

        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token=$user->createToken('myapptoken')->plainTextToken;

        $reponse=[
            'user'=>$user,
            'token'=>$token
        ];

        //return reponse($reponse,201);
        return response()->json($reponse, 200);
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return [
            'message'=>'logged out'
        ];
    }

    public function login(Request $r){
        $fields=$r->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        $user=User::where('email',$fields['email'])->first();

        if(!$user || !Hash::check($fields['password'],$user->password)){
            return reponse([
                'message'=>'Bad Creds'
            ],401);
        }

        $token=$user->createToken('myapptoken')->plainTextToken;

        $reponse=[
            'user'=>$user,
            'token'=>$token
        ];

        //return reponse($reponse,201);
        return response()->json($reponse, 200);
    }

}
