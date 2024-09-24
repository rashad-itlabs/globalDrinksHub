<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {

 
        // if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
        //     //dd(Auth::check());
        //    return redirect('https://globaldrinkshub.com/panel/dashboard');
        // }else{
            
        // }
 
        
    }
}
