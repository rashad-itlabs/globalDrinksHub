<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\CardModel;
use App\Models\Products;
use Auth;

class VendorController extends Controller {

    public function index()
    {
        // $email = Auth::user()->email;
        // $password = Auth::user()->password;
        // $vendor = Admins::where('email',$email)->firstOrFail();
        // if($vendor){
        //     Auth::attempt(['email'=>$email,'password'=>$password]);
            
             return redirect('https://globaldrinkshub.com/panel/dashboard');
        // }else{
        //     echo 'Xeta';
        // }
        
    }

}