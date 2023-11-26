<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class ProviderSocialiteController extends Controller
{
    use HttpResponses;

    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }
    public function callback($provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = User::updateOrCreate([
            $provider . '_id' => $providerUser->id,
        ], [
            'name' => $providerUser->name,
            'email' => $providerUser->email === null ? $providerUser->nickname : $providerUser->email,
            'avatar' => $providerUser->getAvatar(),
            'auth_type' => $provider,
            $provider . '_token' => $providerUser->token,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(10)),
            'is_admin' => false,
        ]);
        $token = $user->createToken('Token ' . $provider . ': ' . $user->name)->plainTextToken;

        return view('callback', [
            'response' => [
                'user' => new UserResource($user),
                'token' => $token,
            ],
        ]);
    }

}
