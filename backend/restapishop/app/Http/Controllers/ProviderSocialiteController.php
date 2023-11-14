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
        $avatarUrl = $providerUser->getAvatar();

        $contents = file_get_contents($avatarUrl);
        $fileName = $providerUser->getId() . '.jpg';
        Storage::disk('public')->put($fileName, $contents);

        $user = User::updateOrCreate([
            $provider . '_id' => $providerUser->id,
        ], [
            'name' => $providerUser->name,
            'email' => $providerUser->email === null ? $providerUser->nickname : $providerUser->email,
            'avatar' => $fileName,
            'auth_type' => $provider,
            $provider . '_token' => $providerUser->token,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(10)),
        ]);
        $token = $user->createToken('Token ' . $provider . ': ' . $user->name)->plainTextToken;

        return $this->successResponse([
            'user' => new UserResource($user),
            'token' => $token,
        ], 'message', 200);
    }

}
