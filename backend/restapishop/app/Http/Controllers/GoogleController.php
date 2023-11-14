<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    use HttpResponses;

    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function callback()
    {
        $githubUser = Socialite::driver('google')->stateless()->user();
        dd($githubUser);
        
        $avatarUrl = $githubUser->getAvatar();

        $contents = file_get_contents($avatarUrl);
        $fileName = $githubUser->getId() . '.jpg';
        Storage::disk('public')->put($fileName, $contents);

        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email === null ? $githubUser->nickname : $githubUser->email,
            'avatar' => $fileName,
            'auth_type' => 'github',
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(10)),
        ]);

        $token = $user->createToken('Token GitHub: ' . $user->name)->plainTextToken;

        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $token,
        ], 'message', 200);
    }

}
