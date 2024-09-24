<?php

namespace App\Http\Controllers;

use App\Models\Sitefeatues;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function index()
    {
        $features = Sitefeatues::all();
        return view('ui.sitefeatures.index',compact('features'));
    }
}
