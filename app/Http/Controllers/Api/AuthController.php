<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Str;

use Socialite;

class AuthController extends Controller
{

    use SendsPasswordResetEmails;


    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => ['required', 'string','confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);
        $token = auth()->user()->auth_user_get_token();

        return response()->json([
            'user' => $user,
            'token'=>$token,
            'message' => 'Registration successful'
        ], 200);
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => [ 'required' ,'email' ],
            'password' => [ 'required' ],
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = auth()->user();
            $token = auth()->user()->auth_user_get_token();
            return response()->json([
                'user' => $user,
                'token'=>$token,
                'message' => 'Login successful'
            ], 200);
        }        

        return response()->json([
            'errors' => [
                'failed' => ['Authentication Failed']
            ]
        ],422);

    }

    public function socialLogin(Request $request)
    {

        $provider = $request->provider ?? '';

        try {

            $social_user = Socialite::driver($provider)->stateless()->user();

            $oauth_id = $social_user->id ?? 0;
            $oauth_type = $provider;

            $user = User::where(['oauth_id' => $oauth_id])->first();

            if( !$user )
            {
                return response()->json([
                    'errors' => [
                        'email' => ['Social login failed.']
                    ]
                ],422);
            }
        
            Auth::login($user);
            
            $token = auth()->user()->auth_user_get_token();
            return response()->json([
                'user' => $user,
                'token'=>$token,
                'message' => 'Login successful'
            ], 200);
        
        }catch(\Exception $e) {
            return response()->json([
                    'errors' => [
                        'email' => ['Social login failed.']
                    ]
                ],422);
        }
    }

    public function socialRegister(Request $request)
    {
        $provider = $request->provider ?? '';

        try {

            $social_user = Socialite::driver($provider)->stateless()->user();

            $oauth_id = $social_user->id ?? 0;
            $oauth_type = $provider;

            $user = User::where(['oauth_id' => $oauth_id])->first();
           
            if( !$user )
            {
                $user = User::create([
                    'name' => $social_user->name ?? $social_user->nickname ?? $social_user->id ,
                    'email' => $social_user->email,
                    'password' => Hash::make('password'),
                    'oauth_id' => $oauth_id,
                    'oauth_type' => $oauth_type,
                ]);
            }

            Auth::login($user);
            $token = auth()->user()->auth_user_get_token();
            
            return response()->json([
                'user' => $user,
                'token'=>$token,
                'message' => 'Registration successful'
            ], 200);
        
        }catch(\Exception $e) {
            return response()->json([
                    'errors' => [
                        'email' => [$e->getMessage()]
                    ]
                ],422);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful'], 200);
    }


    

    public function sendResetLinkEmail(Request $request)
    {

        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url('/').'/reset-password/'.$token.'?email='.$user->email;
        });


        $this->validateEmail($request);

        $user = User::where([ 'email' => $request->email ])->first();

        if($user->is_admin || $user->is_superadmin )
        {
            return response()->json([
                'errors' => [
                    'email' => ["We can't find a user with that email address."]
                ]
            ],422);
        }


        $response = $this->broker()->sendResetLink(
          $this->credentials($request));
        return $response == Password::RESET_LINK_SENT
        ? $this->sendResetLinkResponse($request, $response)
        : $this->sendResetLinkFailedResponse($request, $response);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => ['required','email','exists:users'],
            'password' =>  ['required', 'string','confirmed']
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );
        
        return ( $status === Password::PASSWORD_RESET ) ? 
        response()->json(['message' => 'Password updated successfully'], 200) :
        response()->json([
            'errors' => [
                'password' => [__($status)]
            ]
        ],422);
    }

    
}
