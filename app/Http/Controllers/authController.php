<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Hash;

class authController extends Controller
{

    
    public function register(Request $request){

        //validacion de los datos
         $rules =[
            'full-name' => 'required',
            'phone' => ['required', 'numeric', 'regex:/^[0-9]+$/'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'company-name' => 'required',
            'company-type' => 'required'
         ];
  
         $validator = \Validator::make($request->input(),$rules);
         if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
         }

        //alta del usuario
       $user = new User();
       $user->{'full-name'} = $request->input('full-name');
       $user->{'phone'} = $request->input('phone');
       $user->{'email'} = $request->input('email');
       $user->{'password'} = Hash::make($request->input('password'));
       $user->{'company-name'} = $request->input('company-name');
       $user->{'company-type'} = $request->input('company-type');
       $user->save();

       return response()->json([
        'status' => true,
        'message' => 'user created',
        'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);

       

        //respuesta
            // return response()->json([
            //     "message" => "metodo register ok"
            // ]);
       

        // return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request){
        $rules =[
            'email'=>'required|string|email|max:100',
            'password'=>'required|string'

        ];
        $validator = \Validator::make($request->input(),$rules);
        if($validator->fails()){
           return response()->json([
               'status' => false,
               'errors' => $validator->errors()->all()
           ],400);
        }
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
            'status'=> false,
            'errors'=>['Unauthorized']
            ],401);

        }
        $user=User::where('email', $request->email)->first();
        return response()->json([
            'status'=>true,
            'message'=> 'user logged',
            'data'=> $user,
            'token'=>$user->createToken('API TOKEN')->plainTextToken
        ],200);

    }

    public function userProfile(Request $request){

    }

    public function logout (Request $request){

        $user = Auth::user();
        $user->tokens()->delete();

        return response()->json([
            'status'=>true,
            'message'=> 'user logged out',
        ],200); 

    }


   



}
