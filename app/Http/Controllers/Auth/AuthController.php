<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     */
    public function handleProviderCallback()
    {
        if (Auth::check())
        {
            Redirect::to('/');
        }

        try{
            $googleUser = Socialite::driver('google')->user();
        }
        catch(Exception $e){
            return $e->getMessage();
        }

        $allowedEmailDomains = config('auth.email.allowed_email_domains');
        if(count($allowedEmailDomains) > 0){
            var_dump($allowedEmailDomains);
            dd();
            $emailDomain = explode('@', $googleUser->email);
            $emailDomain = $emailDomain[1];
            if(!in_array($emailDomain, $allowedEmailDomains)){
                return redirect()->guest('login')->with(['error_message'=>"Your email's domain is not allowed."]);
            }
        }
        $user = User::where('google_id', '=', $googleUser->id)->first();

        if($user){
            //Update user info
            $isChanged = false;
            if($user->name != $googleUser->name){
                $user->name = $googleUser->name;
                $isChanged = true;
            }
            if($isChanged){
                try{
                    $user->save();
                }catch(Exception $e){

                }
            }

            Auth::login($user);
            return Redirect::to('/');
        }
        else{
            $user = new User();
            $user->name = $googleUser->name;
            $user->email = $googleUser->email;
            $user->google_id = $googleUser->id;
            $password = Str::random(16);
            $user->password = bcrypt($password);
            try{
                $user->save();
                Auth::login($user);
            }
            catch(Exception $e){
                return $e->getMessage();
            }
            return Redirect::to('/');
        }
    }
}
