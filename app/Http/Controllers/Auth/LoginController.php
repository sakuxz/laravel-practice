<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Config;
use Socialite;
use App;
use Auth;
use Validator;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToProvider($provider)
    {
        if ($provider === 'facebook') {
            // 如果權限要求失敗 (如 email 不同意提供)，下次進入 route 時還會再進入 fb 權限認證頁
            return Socialite::driver($provider)->with(['auth_type' => 'rerequest'])->redirect();
        } else {
            return Socialite::driver($provider)->redirect();
        }
    }

    public function handleProviderCallback($provider, Request $request)
    {
        // dd($request->all());
        $social_user = Socialite::driver($provider)->user();

        $validator = Validator::make(
            [
                'name' => $social_user->name, 
                'email' => $social_user->email, 
            ],
            [
                'name' => 'required|string',
                'email' => 'required|email',
            ],
            [
                'email.required' => '請同意 email 的使用權',
            ]
        );

        if ($validator->fails()) {
            // return redirect()->route('login')->withErrors($validator);
            return redirect()->route('login')->withErrors(['social_login_err'  => $validator->messages()->first()]);
        }

        $login_user = null;
        try {
            $login_user = $this->findOrCreateUser($social_user, $provider);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('login')->withErrors(['social_login_err' => $provider . ' login failed!']);
        }
        Auth::login($login_user);
        return redirect()->route('home');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->getEmail())->where('provider', $provider)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'avatar' => $user->avatar,
        ]);
    }
}
