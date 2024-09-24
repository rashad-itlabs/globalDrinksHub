<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutUsController extends Controller
{
    public function edit(Request $request)
    {
        About::where('id',1)->update(['about'=>$request->about]);
        return redirect(backpack_url('about'));
    }
}
