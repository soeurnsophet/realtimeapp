<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Socialite;

class OAuthController extends Controller
{
    public function OAuthRedirect(Request $request)
    {
        $request->validate([
            'callback_url' => ['required', 'url'],
        ]);

        return Socialite::driver($request->provider)
            ->with([
                'state' => base64_encode($request->callback_url),
            ])
            ->stateless()
            ->redirect();

    }
    public function OAuthCallback(Request $request)
    {
        $callback_url = base64_decode($request->query('state', ''));
        try {
            //code...
            $socialUser = Socialite::driver($request->provider)->stateless()->user();
        } catch (\Throwable $th) {
            //throw $th;
            return redirect($callback_url . "?error=" . urlencode($th->getMessage()));
        }

        if (!filter_var($callback_url, FILTER_VALIDATE_URL)) {
            return response(['message' => 'Invalid callback url.'], 400);
        }

        $user = User::firstOrCreate(
            [
                'email' => $socialUser->getEmail()
            ]
            ,
            [
                'name' => $socialUser->getName(),
            ]
        );

        $user->save();

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        $token = $user->createToken("oauth-token", ["exchange-token"], now()->addMinutes(1))->plainTextToken;

        return redirect($callback_url . "?token=" . urlencode($token));

    }

    function OAuthExchangeToken(Request $request)
    {
        $user = $request->user();

        if (!$user->currentAccessToken()->can('exchange-token')) {
            return response(['message' => 'Invalid token.'], 403);
        }

        $user->currentAccessToken()->delete();
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'message' => 'User signed in.',
            'user' => $user,
            'token' => $token
        ], 200);
    }
}
