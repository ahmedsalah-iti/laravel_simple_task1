<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|min:3|max:50',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|confirmed'
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'msg'=>'account created successfuly',
            'user'=>$user,
            'token'=>$token
        ],201);
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:8'
        ]);
        if (Auth::attempt($request->only('email','password'))){
            $user = User::where('email',$request->email)->firstOrFail();
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json(['msg'=>'logged-in successfuly','user'=>$user,'token'=>$token]);
        }else{
            return response()->json(['msg'=>'invalid email or password'],401);
        }
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['msg'=>'logged-out successfuly'],204);
    }
}
