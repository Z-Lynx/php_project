<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    use HttpResponses;

    public function info(Request $request)
    {
        if (!$request->header('Authorization')) {
            return $this->errorResponse('Unauthorized', 401);
        }
        return $this->successResponse($request->user(), 'message', 200);
    }
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->errorResponse('Invalid login details', 401);
        }
        $user = User::where('email', $request->email)->firstOrFail();

        return $this->successResponse([
            'user' => $user,
            'token' => $user->createToken('API TOKEN OF ' . $user->name)->plainTextToken,
        ], 'message', 200);
    }
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->successResponse([
            'user' => $user,
            'token' => $user->createToken('API TOKEN OF ' . $user->name)->plainTextToken,
        ], 'message', 200);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        return $this->successResponse('', 'Log Out Success', 200);
    }
    public function forget_password()
    {
        return $this->successResponse('', 'message', 200);
    }
}
