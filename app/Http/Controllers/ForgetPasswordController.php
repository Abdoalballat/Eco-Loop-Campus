<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\otp_mail;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Contracts\Service\Attribute\Required;

class ForgetPasswordController extends Controller
{
    public function forget_page()
    {
        return view('auth.forgot-password');
    }
    public function show_verify_otp_page(Request $request)
    {
        if(!$request->has('email')||empty($request->email)){
            
        return redirect()->route('forget_page')->with('Failed', 'Please enter your email first.');

            }
            return view('auth.verify-otp');
    }
    public function send_otp(Request $request)
{
    $validated_email = $request->validate([
        'email' => 'string|required|email'
    ]);

    $email = login::where('email', $validated_email['email'])->first();

    if (!$email) {
        return redirect()->route('forget_page')->with('error', 'wrong email');
    }

    $throttleKey = 'send-otp' . $request->ip();
    if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        return back()->with('Failed', 'Try Again After 2 Minuts')->with('retry_after', $seconds);
    }
    RateLimiter::hit($throttleKey, 60);

    $otp = rand(111111, 999999);
    $otp_expires_at = Carbon::now()->addMinutes(10);
    
    $email->update([
        'otp' => $otp,
        'otp_expires_at' => $otp_expires_at
    ]);

    Mail::to($email->email)->send(new otp_mail($otp));

    return redirect()->route('show_verify_otp_page', ['email' => $email->email])->with('success', 'Otp has been sent');
}
    public function verify_otp(Request $request)
    {
        $validated_data = $request->validate([
            'email'=>'required|string',
            'otp'=>'required',
            ]);
            // dd($validated_data);
            $throttleKey ='verify-otp'. $request->email;
            if(RateLimiter::tooManyAttempts($throttleKey,2))
                {
                    $seconds=RateLimiter::availableIn($throttleKey);
                    return back()->with('Failed','Try Again After 3 Minuts')->with('retry_after', $seconds);
                }
        $user =login::where('email',$validated_data['email'])->firstOrFail();
        if(!$user)
            {
                return redirect()->route('forget_page')->with('error','Un Authraiezed');
            }
        if($validated_data['otp'] != $user->otp)
            {
                RateLimiter::hit($throttleKey,60);
                return back()->withErrors('wrong otp');
            }
            RateLimiter::clear($throttleKey);
            
        if(Carbon::now()->greaterThan($user->otp_expires_at))
            {
                return redirect()->route('forget_page')->with('error','Otp Expierd');
            }
        else
        {
            session(['reset_password_session'=>$user->email]);
            return redirect()->route('show_reset_pass');

        }
        }

        public function reset_pass(request $request)
        {
            $session =session('reset_password_session');
            if(!$session)
            {
            return redirect()->route('login')->with('error','Un Authraiezed');
            }
            $credentails =$request->validate([
                'password'=>'required|string|min:8|confirmed'
            ]);
            $user =login::where('email',$session)->firstOrFail();
            if(!$user)
            {
            return redirect()->route('login')->with('error','Un Authraiezed');
            }
            else{
                $user->update([
                    'password'=>Hash::make($credentails['password']),
                    'otp'=> null,
                    'otp_expires_at'=> null,
                ]);
                session()->forget('reset_password_session');
                return redirect()->route('login')->with('success','Password Reset Has Been Successfully');
            }
        }
        public function show_reset_pass()
        {
            if(!session('reset_password_session'))
                {
                    return redirect()->route('login')->with('error','Un Authraiezed');
                }
            else
                return view('auth.reset-password');
        }
        
}
