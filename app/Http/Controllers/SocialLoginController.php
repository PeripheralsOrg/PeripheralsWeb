<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class SocialLoginController extends Controller
{

    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleTwitterCallback(Request $request)
    {
        try {

            $user = Socialite::driver('twitter-oauth-2')->user();

            $finduser = User::where('twitter_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                $request->session()->regenerate();
                $request->session()->put('user', $finduser);

                return redirect()->route('client-homepage');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->name,
                    'last_name' => $user->nickname,
                    'twitter_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                $request->session()->regenerate();
                $request->session()->put('user', $newUser);

                Auth::login($newUser);

                return redirect()->route('client-homepage');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function handleGoogleCallback(Request $request)
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                $request->session()->regenerate();
                $request->session()->put('user', $finduser);

                return redirect()->route('client-homepage');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->user['given_name'],
                    'last_name' => $user->user['family_name'],
                    'google_id' => $user->id,
                    'profile_photo_path' => $user->user['picture'],
                    'password' => Hash::make('123456dummy'),
                ]);

                $request->session()->regenerate();
                $request->session()->put('user', $newUser);

                Auth::login($newUser);

                return redirect()->route('client-homepage');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function handleLinkedinCallback(Request $request)
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                $request->session()->regenerate();
                $request->session()->put('user', $finduser);

                return redirect()->route('client-homepage');
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email], [
                    'name' => $user->user['given_name'],
                    'last_name' => $user->user['family_name'],
                    'google_id' => $user->id,
                    'profile_photo_path' => $user->user['picture'],
                    'password' => Hash::make('123456dummy'),
                ]);

                $request->session()->regenerate();
                $request->session()->put('user', $newUser);

                Auth::login($newUser);

                return redirect()->route('client-homepage');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
