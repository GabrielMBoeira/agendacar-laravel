<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider() {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback() {
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }

    public function redirectToProviderGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle() {
        $user = Socialite::driver('google')->user();
        dd($user);
    }
}
