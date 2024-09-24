<?php

namespace App\Http\Controllers;

use App\Models\Langs;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Sitesettings;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Sitesettings::all();
        return view('ui.settings.index',compact('settings'));
    }

    public function settings()
    {
        $settings = Setting::find(1);
        $langs = Langs::all();
        $mailConfig = Config::get('mail');
        //dd($mailConfig);
        return view('ui.settings.site_settings',compact('settings','langs','mailConfig'));
    }

    public function edit_langs($id)
    {
        $list = Language::find($id);
        return view('ui.settings.edit_language',compact('list'));
    }

    public function update_currency(Request $request)
    {
        $data = [
            'currency'=>$request->currency,
            'currency_position'=>$request->currency_position,
            'decimal_format'=>$request->decimal_format
        ];
        Setting::where('id',1)->update($data);
        return back()->with('success','Information has been renewed');
    }

    public function update_address(Request $request)
    {
        $data = [
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address_1'=>$request->address_1,
            'address_2'=>$request->address_2,
            'city'=>$request->city,
            'state'=>$request->state,
            'zip'=>$request->zip,
            'country'=>$request->country,
        ];
        Setting::where('id',1)->update($data);
        return back()->with('success','Information has been renewed');
    }

    public function update_language(Request $request)
    {
        $data = [
            'name'=>$request->name,
            'code'=>$request->code,
            'direction'=>$request->direction,
            'default'=>($request->default=='on'?1:0),
            'status'=>$request->status
        ];
        Language::where('id',$request->id)->update($data);
        return back()->with('success','Information has been renewed');
    }
    
    public function delete_language($id)
    {
        Language::find($id)->delete();
        return back()->with('success','Information has been renewed');
    }

    public function updatesmtp(Request $request)
    {
        $data = [
            'host' => $request->input('mail_host'),
            'port' => $request->input('mail_port'),
            'username' => $request->input('mail_username'),
            'password' => $request->input('mail_password'),
            'encryption' => $request->input('mail_encryption'),
            'address' => $request->input('from_addresses'),
        ];

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        // Update mail values
        $str = preg_replace('/MAIL_HOST=.*/', "MAIL_HOST={$data['host']}", $str);
        $str = preg_replace('/MAIL_PORT=.*/', "MAIL_PORT={$data['port']}", $str);
        $str = preg_replace('/MAIL_USERNAME=.*/', "MAIL_USERNAME={$data['username']}", $str);
        $str = preg_replace('/MAIL_PASSWORD=.*/', "MAIL_PASSWORD={$data['password']}", $str);
        $str = preg_replace('/MAIL_ENCRYPTION=.*/', "MAIL_ENCRYPTION={$data['encryption']}", $str);
        $str = preg_replace('/MAIL_FROM_ADDRESS=.*/', "MAIL_FROM_ADDRESS={$data['address']}", $str);

        file_put_contents($envFile, $str);

        return redirect()->back();
    }

    public function save_update(Request $request)
    {
        echo json_encode($request->phones,true);
        ContactUs::where('id',1)->update([
            'phone'=>json_encode($request->phones,true),
            'email'=>json_encode($request->emails,true),
            'address'=>$request->address
        ]);

        return back()->with('success','Information has been changed');
    }
}
