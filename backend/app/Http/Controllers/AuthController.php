<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Models\User;
use Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401);
        }

        $user = Auth::user();
        if (!$user->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                'email' => ['Please verify your email address.']
            ]);
        }
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function verify(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'message' => 'User verified',
            'user' => $user,
        ]);
    }

    public function regiter(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'callback_url' => ['required', 'url'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->sendEmailVerificationNotification($request->callback_url);

        Event::dispatch(new UserRegistered($user));

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,

        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successful',
        ]);
    }

    public function verifyEmail(Request $request)
    {

        $id = $request->route('id');
        $user = User::find($id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        return response()->json([
            'message' => 'Email verified successfully',
        ]);
    }

    public function sendVerificationEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'callback_url' => ['required', 'url'],
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified',
            ]);
        }

        $user->sendEmailVerificationNotification($request->callback_url);

        return response()->json([
            'message' => 'Verification email sent',
            'user' => $user,
        ]);
    }
}
