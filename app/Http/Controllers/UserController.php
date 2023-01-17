<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function SignUp(Request $request){
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $hashed=Hash::make($password);

        if(!User::where('email',$email)->exists()){
            try {
                $user= new User;
                $user->name=$name;
                $user->email=$email;
                $user->password=$hashed;
                $user->save();
                return response()->json('User created successfully',200);
            }
            catch (\Throwable $err){
                return response()->json($err->getMessage(),400);
            }
        }
        else{
            return response()->json('User already exists!',400);
        }
    }

    public function LogIn(Request $request){
        $email=$request->email;
        $password=$request->password;
        $user = User::where('email', '=', $email)->first();
        if(Hash::check($password, $user->password)) {
            return response()->json(['status'=>'true','message'=>'Successfully logged in']);
        } else {
            return response()->json(['status'=>'false', 'message'=>'Wrong credentials']);
        }
    }
}
