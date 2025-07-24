<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $guard = $request->route('guard'); 
        return view('auth.login', compact('guard'));
    }

    public function login(Request $request)
    {
        $guard = $request->route('guard'); 
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard($guard)->attempt($data , $request->filled('remember'))) {
        
        return redirect()->route("{$guard}.dashboard");
    }
        return redirect()->back();

        // if (!auth($guard)->attempt($data)) {
        //     return response()->json(['error' => 'Invalid credentials'], 401);
        // }

        // return redirect()->route("{$guard}.dashboard"); 
    }
    
}