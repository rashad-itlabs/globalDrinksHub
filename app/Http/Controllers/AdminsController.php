<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifiedMail;
use Carbon\Carbon;
use App\Exports\UsersListExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminsController extends Controller
{

    public function export_user()
    {
        return Excel::download(new UsersListExport, 'admins-vendors-'.date('Y-m-d').'.xlsx');
    }


    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'phone'=>'required',
            'email'=>'required|email|unique:admins,email',
            'password'=>'required|min:5',
        ]);
        // try {
            $create = new Admins();
            $create->name = $request->name;
            $create->username = $request->username;
            $create->email = $request->email;
            $create->phone = $request->phone;
            $create->password = Hash::make($request->password);
            $create->active = $request->acive;
            $create->verified = $request->verified;
            $create->viewed = 1;
            $create->role_id = $request->role_id;
            $create->save();
            
        // } catch (\Illuminate\Database\QueryException $th) {
        //     return back()->with('error',$th);
        // }

        return redirect(backpack_url('admins'));
    }

    public function update_admin(Request $request)
    {
        date_default_timezone_set('Asia/Baku');
        Admins::where('id',$request->admin_id)->update([
            'name'=>$request->name,
            'username'=>$request->username,
            'phone'=> $request->phone,
            'email'=>$request->email,
            'active'=>$request->active,
            'verified'=>$request->verified,
            'email_verified_at'=>Carbon::now(),
            'role_id'=>$request->role_id
        ]);

        // $data = [
        //     'id'=>$request->admin_id,
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'url'=> asset('verifying_account?_token='.$request->_token.'&account='.$request->admin_id)
        // ];

        // if($request->verified !=0){
        //     Mail::to($request->email)->send(new VerifiedMail($data));
        // }

        if($request->ch_password==1)
        {
            Admins::where('id',$request->admin_id)->update([
                'password'=>Hash::make($request->new_password)
            ]);
        }

        return back()->with('success','The information has been successfully updated');
    }

    public function verifying(Request $request)
    {
        Admins::where('id',$request->account)->update([
            'viewed' => 1,
        ]);
        return redirect(asset(''))->with('success','You have confirmed your email address');
    }

    public function profile_settings()
    {
        return view('profile.profile');
    }

    // public function admin_login()
    // {
    //     dd();
    // }
}
