<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Rules\PhoneNumber;
use Illuminate\Support\Str;
use Hash;

class AuthController extends Controller
{
    public $successStatus = 200;
    public $errorStatus = 401;

    public function register(Request $request) {
        $validator = Validator::make($request->all(),
        [ 
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'phone' => ['required', 'unique:users,phone', new PhoneNumber, 'min:10', 'max:15'],
            'email' => 'required|email|unique:users,email',
            'date_of_birth' => 'filled|date',
            'gender' => 'filled',
            'password' => 'required|min:6',  
        ],
        [
            "first_name.required" => "First name is required",
            "last_name.required" => "Last name is required",
            "phone.required" => "Mobile number is required",
            "phone.unique" => "Mobile number should be unique",
            "email.required" => "Email is required",
            "email.email" => "Email is invalid",
            "email.unique" => "Email should be unique",
            "date_of_birth.filled" => "Date of Birth is optional",
            "gender.filled" => "Gender is optional",
            "password.required" => "Password is required",
        ]);

        if ($validator->fails()) {          
            return response()->json(['message' => $validator->errors()], $this->errorStatus);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        return response()->json(
        [
            'data' => $user,
            'status' => $this->successStatus,
        ], $this->successStatus);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(),
        [
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ],
        [
            "email.required" => "Email is required",
            "email.email" => "Email is invalid",
            "email.exists" => "Email not found",
            "password.required" => "Password is required",
        ]);

        if ($validator->fails()) {          
            return response()->json(
            [
                'message' => 'Invalid Data',
                'errors' => $validator->errors(),
            ], $this->errorStatus);
        }

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('propertyName')->accessToken; 
            return response()->json($success, $this->successStatus); 
        } else { 
            return response()->json(['message' => 'Unauthorized'], $this->errorStatus);
        } 
    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['data' => $user], $this->successStatus); 
    }

    public function logout()
    {   
        Auth::logout();
    }
} 

