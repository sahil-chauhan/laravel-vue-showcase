<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthSocialite extends Controller
{
    public function github_redirect_login(Request $request)
    {
        $request->session()->put('github_action', 'login');
        return $github_redirect_url = Socialite::driver('github')->redirect();
    }

    public function github_redirect_register(Request $request)
    {
        $request->session()->put('github_action', 'register');
        return $github_redirect_url = Socialite::driver('github')->redirect();
    }

    public function github_callback(Request $request)
    {
        $authType = $request->session()->get('github_action');

        try {

            $user = Socialite::driver('github')->user();

            if( $authType == 'login')
            {
                $output = $this->perform_gihub_login($user);
                if( !$output )
                {
                    return redirect()->route('login')->with('failed','Authentication Failed');
                }
            }

            $output = $this->perform_gihub_register($user);
            if( !$output )
            {
                return redirect()->route('register')->with('failed','Registration Failed');
            }

            return redirect('/');

        }
        catch(\Exception $e) {

            $error_msg = $request->get('error_description') ?? 'Unknown Error';

            if( $authType == 'login')
            {
                return redirect()->route('login')->with('failed',$error_msg);
            }

            return redirect()->route('register')->with('failed',$error_msg);
        }        
    }

    public function perform_gihub_login($githubUser)
    {
        $user = User::where('email', $githubUser->email)->first();
        
        if($user) 
        {
            Auth::login($user);
            return true;
        }
        return false;
    }

    public function perform_gihub_register($githubUser)
    {

        $user = User::where('email', $githubUser->email)->first();

        if(!$user) 
        {
            $user = User::create([
                'name' => $githubUser->name ?? $githubUser->nickname ?? $githubUser->id ,
                'email' => $githubUser->email,
                'password' => Hash::make('password')
            ]);

            Auth::login($user);

            return true;
        }        
        return false;
    }

}
