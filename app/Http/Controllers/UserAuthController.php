<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserAuthController extends Controller
{
    public function login(Request $req){
        $user = User::where('email', $req->email)->first();

        if(!$user || !Hash::check($req->password, $user->password)){
            return response()->json(['message'=>'Invalid credentials'], 400);
        }

        return response()->json([
            'token'=>$user->createToken('remember_token')->plainTextToken,
        ]);
    }

    public function profile(Request $req){
        return response()->json($req->user());
    }

    public function register(Request $req){
        $validator = Validator::make($req->all(),[
            'username'     => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|string|email|unique:users,email',
            'phonenumber'  => 'required|string|max:255',
            'password'     => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $user = \App\Models\User::create([
            'username'        => $req->name,
            'first_name'      => $req->first_name,
            'last_name'       => $req->last_name,
            'phonenumber'      => $req->phonenumber,
            'email'           => $req->email,
            'password'        => bcrypt($req->password),
        ]);

        return response()->json([
            'message'    => 'User registered successfully.',
            'token'      => $user->createToken('remember_token')->plainTextToken,
        ], 201);
    }

    public function logout(Request $req){
        $user = $req->user();

        if($user && $user->currentAccessToken()){
            $user->currentAccessToken()->delete();
            return response()->json(['message'=>'Logged out successfully.']);
        }

        return response()->json(['message'=>'Not authenticated'], 401);
    }
}
