<?php

namespace App\Http\Controllers\Auth;

use App\Events\NewUserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function googleCallback()
    {


        try {
            $googleUser = Socialite::driver('google')->user();


            if (!(str_ends_with($googleUser->getEmail(), '@diu.edu.bd')) && !(str_ends_with($googleUser->getEmail(), '@s.diu.edu.bd'))) {
                return redirect()->route('home')->with('error', 'You are not allowed to login. Only DIU students are allowed to login.');
            }


            $user = User::where('email', $googleUser->getEmail())->orWhere('google_id', $googleUser->getId())->withTrashed()->first();
            if (!$user) {


                $password = Str::random(10);
                $new_user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt($password),
                ]);

                Auth::login($new_user);
                if ($googleUser['verified_email']) {
                    $new_user->markEmailAsVerified();
                }

                return redirect()->route('home')->with('success', 'You are now logged in!');
            } else {
                if ($user->deleted_at) {
                    $user->restore();
                }
                // Update google_id if not set
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
                Auth::login($user);
                //                $user->update(['token' => $googleUser->token]);
                if ($googleUser['verified_email']) {
                    $user->markEmailAsVerified();
                }
                return redirect()->intended(route('home'))->with('success', 'You are now logged in!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('home')->with('error', 'There was an error while logging in: ' . $th->getMessage());
        }
    }
}