<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store()
    {
        $stores = Store::where('admin_id',1)->get();
        return view('store.index',compact('stores'));
    }

    public function update(Request $request)
    {
        
        //dd($request->wp);
        if($request->hasFile('heade_logo')){
            $file = $request->file('heade_logo');
            $extension = $file->getClientOriginalName();
            $file->move('upload',$extension);
            Store::find(1)->update([
                'name'=>$request->name,
                'image'=>$extension,
                'slug'=>$request->slug,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'whatsapp_btn'=>($request->wp==null?0:1),
                'whatsapp_number'=>$request->whatsapp_number,
                'whatsapp_default_msg'=>$request->whatsapp_default_msg
            ]);
        }else{
            Store::find(1)->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'whatsapp_btn'=>($request->wp==null?0:1),
                'whatsapp_number'=>$request->whatsapp_number,
                'whatsapp_default_msg'=>$request->whatsapp_default_msg
            ]);
        }
        
        return back()->with('success','Information updated successfully');
    }
}
