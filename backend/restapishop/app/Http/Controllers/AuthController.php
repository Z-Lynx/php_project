<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    use HttpResponses;

    public function info(Request $request)
    {
        if (!$request->header('Authorization')) {
            return $this->errorResponse('Unauthorized', 401);
        }
        return $this->successResponse(new UserResource($request->user()), 'message', 200);
    }

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->errorResponse('Invalid login details', 401);
        }
        $user = User::where('email', $request->email)->firstOrFail();

        return $this->successResponse([
            'user' => new UserResource($request->user()),
            'token' => $user->createToken('Token Auth: ' . $user->name)->plainTextToken,
        ], 'Login successful', 200);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        $user->sendEmailVerificationNotification();

        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $user->createToken('API TOKEN OF ' . $user->name)->plainTextToken,
        ], 'Register successful', 200);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->successResponse('', 'LogOut Success', 200);
    }

    public function forgot_password(ForgetPasswordRequest $request)
    {
        $request->validated();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? $this->successResponse('', 'Send Reset Password Success', 200)
            : $this->errorResponse('Send Reset Password Fail', 400);
    }

    public function reset_password(ResetPasswordRequest $request)
    {
        $request->validated();
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? $this->successResponse('', 'Update Password Success', 200)
            : $this->errorResponse('Update Password Fail', 400);
    }

    public function getImage($filename)
    {
        $publicPath = "public/{$filename}";

        if (Storage::exists($publicPath)) {
            $file = Storage::get($publicPath);
            $mime = Storage::mimeType($publicPath);

            return response($file)->header('Content-Type', $mime);
        }

        $directories = Storage::directories('public');

        foreach ($directories as $directory) {
            $path = $directory . '/' . $filename;

            if (Storage::exists($path)) {
                $file = Storage::get($path);
                $mime = Storage::mimeType($path);

                return response($file)->header('Content-Type', $mime);
            }
        }

        return $this->errorResponse('NOT FOUND', 404);
    }

}
