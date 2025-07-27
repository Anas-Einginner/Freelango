<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\VerfiyEmailNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //indexLogin method to show the login form
    public function indexLogin(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.login', compact('guard'));
    }

    //login method to handle the login request
    public function login(Request $request)
    {
        $guard = $request->route('guard');
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard($guard)->attempt($data, $request->filled('remember'))) {

            return redirect()->route("{$guard}.dashboard");
        }
        return redirect()->back();
    }

    
    
    function indexRegister()
    {
        $guard = request()->route('guard');
        return view('auth.register', compact('guard'));
    }
    /**
     
    * Register a new user.
     
    */
    function register(Request $request)
    {
     
    $guard = request()->route('guard');
    $provider = config("auth.guards.$guard.provider");
    $modalClass = config("auth.providers.$provider.model");
    // make the .png name for the id card with user and id card
    $nameIdCardWithUser = 'id_cards_with_user' . time() . '_' . rand() . '.' . $request->file('imageIdCardWithUser')->getClientOriginalExtension();
    $nameIdCard = 'id_card_' . time() . '_' . rand() . '.' . $request->file('imageIdCard')->getClientOriginalExtension();
    $token =Str::random(); 
    $user = $modalClass::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'bio' => $request->bio,
            // // 'experience' => $request->experience,
            // 'skills' =>  $request->skills,
            'verification_token'=>$token,
            'verification_token_send_at'=>now(),
            // 'email_verified_at',
            // 'image_id_card' => $request->file('imageIdCard')
            // ->storeAs(
            //     'id_cards',
            //     $nameIdCard,
            //     'public'),
            // 'image_id_card_with_user' => $request->file('imageIdCardWithUser')
            // ->storeAs(
            //     'id_cards_with_user',
            //     $nameIdCardWithUser,
            //     'public'),
        ]);
        
        $user->notify(new VerfiyEmailNotification($token,$guard));

        return 'تم ارسال رابط التحقق من البريد الإلكتروني بنجاح';
    }
    

    function dashboard()
    {
        $guard = request()->route('guard');
        return view($guard . '.index');
        
    }

















































































}
