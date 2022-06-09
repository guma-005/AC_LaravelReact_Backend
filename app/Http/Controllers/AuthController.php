<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string'
        ]);
        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);
        $token=$user->createToken('myspptoken')->plainTextToken;
       
        $response=['user'=>$user, 'token'=>$token, 'status'=>200];
        return response($response,200);
    }

    public function login(Request $request){
        $fields = $request->validate([             
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
         //check email
         $user = User::where('email',$fields['email'])->first();
         // check password
         if(!$user || !Hash::check($fields['password'], $user->password)){
             return response(['message'=>'bad credentials', 'status'=>400], 400);
         }
        $token=$user->createToken('myspptoken')->plainTextToken;
       
        $response=['user'=>$user, 'token'=>$token, 'status'=>200];
        return response($response,200);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return ['message'=>'logged out'];

    }
}
