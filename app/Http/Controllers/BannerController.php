<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Banners;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\SourceBrandsModel;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $list = Banners::all();
        return view('ui.banner.index',compact('list'));
    }

    public function edit($id)
    {
        $list = Banners::find($id);
        $brands = Brands::all();
        $category = Categories::all();
        $source = SourceBrandsModel::join('brands','banner_source_brands.brand_id','=','brands.id')->join('banners','banner_source_brands.banner_id','=','banners.id')->where('banners.id',$id)->get();
        return view('ui.banner.edit',compact('list','brands','source','category'));
    }
}
