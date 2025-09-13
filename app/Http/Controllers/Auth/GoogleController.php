<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user(); // no stateless()

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(24)),
                    'email_verified_at' => now(), // Mark email as verified
                ]);
            } else {
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->save();
                }
            }

            Auth::login($user);

            if (Auth::check()) {
                return redirect()->intended('/dashboard');
            }

            return redirect('/login')->withErrors(['error' => 'Failed to login user.']);
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Failed to authenticate: ' . $e->getMessage()]);
        }
    }


}
