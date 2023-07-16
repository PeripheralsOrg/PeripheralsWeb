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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    public function handleGoogleCallback(Request $request)
    {

        $user = Socialite::driver('google')->stateless()->user();

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
                'feedback' => 1

            ]);

            $request->session()->regenerate();
            $request->session()->put('user', $newUser);

            Auth::login($newUser);
            return redirect()->route('client-homepage');
        }
        return redirect()->back()->withErrors('Ocorreu um erro ao se logar');
    }


    public function handleLinkedinCallback(Request $request)
    {

        $user = Socialite::driver('linkedin')->stateless()->user();

        $finduser = User::where('linkedin_id', $user->id)->first();

        // Foto de perfil
        $profilePicture = $user->user['profilePicture']['displayImage~']['elements'][0]['identifiers'][0]['identifier'];

        if ($finduser) {

            Auth::login($finduser);

            $request->session()->regenerate();
            $request->session()->put('user', $finduser);

            return redirect()->route('client-homepage');
        } else {
            $newUser = User::updateOrCreate(['email' => $user->getEmail()], [
                'name' => $user->user['firstName']['localized']['pt_BR'],
                'last_name' => $user->user['lastName']['localized']['pt_BR'],
                'linkedin_id' => $user->id,
                'profile_photo_path' => $profilePicture,
                'password' => Hash::make('123456dummy'),
                'feedback' => 1
            ]);

            $request->session()->regenerate();
            $request->session()->put('user', $newUser);

            Auth::login($newUser);

            return redirect()->route('client-homepage');
        }
        return redirect()->back()->withErrors('Ocorreu um erro ao se logar');
    }
}
