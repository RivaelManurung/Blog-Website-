<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Register (API)
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:225|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Registration Failed',
                'errors'  => $validator->errors()
            ]);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Registration successfully',
            'user'    => $user
        ]);
    }

    // Login (API)
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|string|email|max:225',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Login Failed',
                'errors'  => $validator->errors()
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Login Failed',
                'errors'  => ['email' => ['The provided credentials are incorrect.']]
            ]);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Login Successful',
            'user'    => $user,
        ]);
    }

    // Redirect ke Google/Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Callback dari Google/Facebook
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name'     => $socialUser->getName(),
                    'password' => bcrypt(Str::random(16)), // random password
                ]
            );

            // Login ke session Laravel
            auth()->login($user);

            // Redirect ke dashboard
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login gagal: ' . $e->getMessage());
        }
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout');
    }
}
