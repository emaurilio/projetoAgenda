<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function provider ($provider) 
    {
        return Socialite::driver($provider)->redirect();
    }

    public function providerCallback($provider){

        $providerUser = Socialite::driver($provider)->user();
        $user = User::firstOrCreate(['email' => $providerUser->getEmail()],[
        'name' => $providerUser->getName() ?? $providerUser->getNickname(),
        'provider_id' => $providerUser->getId(),
        'provider'=> $provider
        ]);
        
        Auth::login($user);

        return to_route('contacts.index')->with("mensagem.sucesso", "Login realizado com sucesso");
    }
}
