<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        try {


            $user =  User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
            ]);
            // create token for user after register
            $token = $user->createToken($request->device_name);

            return [UserResource::make($user),'token' => $token->plainTextToken];

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function login(LoginRequest $request)
    { 
        // check email
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;


        // another way 

        // if (\Auth::attempt($request->only('email', 'password'))) {
        //     $token = \Auth::user()->createToken('ios');
        //     return [
        //         'user' => \Auth::user(),
        //         'token' => $token->plainTextToken
        //     ];
        // }
    }
}
