<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use function PHPSTORM_META\type;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        // return 'email';
        /*$value = request()->input('identify');

        $field = filter_var($value,FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        if($field != 'email' && $field != 'mobile') {
            $field = 'name';
        }

        request()->merge([$field =>$value]);

        return $field;*/

        //return 'name';

        $value = request()->input('identify'); // ahmed.emam.dev@gmail  or 293293923293
        $field = filter_var($value, FILTER_SANITIZE_STRING) ? 'name' : 'mobile';
        if($field != 'name' && $field != 'mobile') {
            return 'email';
        }
        request()->merge([$field =>$value ]);
        return  $field;
    }
}
