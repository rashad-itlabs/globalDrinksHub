<?php

namespace App\Http\Controllers;

use App\Models\Collections;
use App\Models\ProductsCollection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $listCollection = ProductsCollection::all();
        return view('collections.index',compact('listCollection'));
    }
}
