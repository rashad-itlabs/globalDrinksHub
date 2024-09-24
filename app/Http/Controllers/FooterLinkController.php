<?php

namespace App\Http\Controllers;

use App\Models\Footerlinks;
use App\Models\Pages;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
    public function list()
    {
        $pages = Pages::all();
        $services = Footerlinks::where('type',1)->get();
        $aboutes = Footerlinks::where('type',2)->get();
        return view('ui.footer.list',compact('pages','aboutes','services'));
    }
}
