<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailVerificaionController extends Controller
{
    function verify(Request $request, $guard)
    {
        $token = $request->query('token');
        $guard = request()->route('guard');
        $provider = config("auth.guards.$guard.provider");
        $modalClass = config("auth.providers.$provider.model");
        $user = $modalClass::where('verification_token', $token)->first();
        $sendAt = Carbon::parse($user->verification_token_send_at);
        if(Carbon::now()->diffInHours($sendAt) > 24){
            return 'انتهت صلاحية رابط التحقق من البريد الإلكتروني';
        }

        
        $user->update([
            'verification_token' => null,
            'verification_token_send_at'=>null,
            'email_verified_at' => now(),
        ]);
        return 'تمت التحقق من البريد بنجاح';
    }
}
