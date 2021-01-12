<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{
    public function redirect($service) {
        return Socialite::driver($service)->redirect(); // it is don't for facebook only but for all
    }

    public function callback($service,$Request,$request) {
        $user = Socialite::with($service) -> user();
        //$user = Socialite::driver($service) ->stateless()-> user();
        return response() -> json($user);
    }
}
