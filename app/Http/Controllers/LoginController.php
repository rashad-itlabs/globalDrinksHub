<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPasswordMail;
use App\Mail\VerifiedMail;
use Hash;
use DB;


class LoginController extends Controller{




    public function create(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:admins',
            'first_name' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'terms' =>'required',
            'password'=>'min:5|required_with:re_password|same:re_password',
            're_password'=>'required|min:5'
        ]);



        $create = new Admins();
        $create->name= $request->first_name;
        $create->username = $request->username;
        $create->phone = $request->phone;
        $create->email = $request->email;
        $create->company_name = $request->company_name;
        $create->password =Hash::make($request->password);
        $create->role_id=2;
        $create->active=0;
        $create->verified=0;
        $create->save();

        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1])) {
        //     return redirect(asset(''));
        // }else{
        //     echo 'xeta';
        // }
        $data = [
            'name' => $request->username,
            'email'=> $request->email,
            'url'=> asset('verifying_account?_token='.$request->_token.'&account='.$create->id)
        ];
        Mail::to($request->email)->send(new VerifiedMail($data));

        return redirect(route('success_page'))->with('oneway','success');
    }

    public function successPage()
    {
        return view('frontend.reg_success');
    }

    public function signin(Request $request)
    {
        if($request->email=='admin@global.com'){
            return back()->with('error','Email or Password is incorrect');
        }else{
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                if(Auth::user()->email_verified_at==null){
                    Auth::logout();
                    return back()->with('error','Your account has not yet been approved by the moderator. Please wait for verification - it may take several days.');
                }else{
                    if($request->back_url){
                        return redirect($request->back_url);
                    }else{
                        return redirect(asset(''));
                    }
                }
            }else{
                return back()->with('error','Email or Password is incorrect');
            }
        }
        
    }

    public function checkMail(Request $request)
    {
        sleep(2);
        $username = Admins::where('email',$request->email)->get();
        $check__mail = Admins::where('email',$request->email)->count();
        
        if($check__mail > 0){
            $data = [
                'username' => $username[0]->name,
                'url'=> asset('reset_password?token='.$request->_token.'&email='.$request->email)
            ];
            Mail::to($request->email)
            ->send(new ForgetPasswordMail($data));
            DB::table('forget_password')->insert(['token'=>$request->_token]);
            return response()->json([
                'status' => 200,
                'msg'=> 'The link to reset your password has been sent to your email address.',
            ]);
        }else{
            return response()->json([
                'status'=> 400,
                'msg'=> 'This email address is not registered in the system',
            ]);
        }
        
    }

    public function resetPassword(Request $request)
    {
        $token = DB::table('forget_password')->where('token',$request->token)->get();
        $user = Admins::where('email',$request->email)->get();
        $userid = $user[0]->id;
        if($request->token == @$token[0]->token){
            return view('mail.reset',compact('token','userid'));
        }else{
            return redirect(asset(''));
        }
    }

    public function resetPass(Request $request)
    {
        $request->validate([
            'password'=>'min:5|required_with:re_password|same:re_password',
            're_password'=>'required|min:5'
        ]);

        Admins::where('id',$request->userid)
        ->update([
            'password'=>Hash::make($request->password)
        ]);

        return redirect(route('login'));

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */

    public function logout()
    {
        Auth::logout();
        return redirect(asset(''));
    }
   








}
