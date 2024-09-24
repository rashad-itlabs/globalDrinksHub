<?php

namespace App\Http\Controllers;

use App\Models\Customscripts;
use Illuminate\Http\Request;

class CustomsController extends Controller
{
    public function index()
    {
        $list = Customscripts::all();
        return view('ui.customs.index',compact('list'));
    }
}
