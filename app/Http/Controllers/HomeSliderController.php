<?php

namespace App\Http\Controllers;

use App\Models\Homeslider;
use App\Models\Banners;
use App\Models\Brands;
use App\Models\Categories;
use App\Models\SourceBrandsModel;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function index()
    {
        $slider = Homeslider::where('type',1)->get();
        $sliderRight = Homeslider::where('type','!=',1)->orderBy('type','ASC')->get();
       // dd($slider);
        return view('ui.homeslider',compact('slider','sliderRight'));
    }

    public function editPage($id)
    {
        $list = Homeslider::find($id);
        $brands = Brands::all();
        $category = Categories::all();
        $source = SourceBrandsModel::join('brands','banner_source_brands.brand_id','=','brands.id')->join('banners','banner_source_brands.banner_id','=','banners.id')->where('banners.id',$id)->get();
        return view('ui.slider.edit',compact('list','brands','source','category'));
    }

    public function add(Request $request)
    {
        $file = $request->file('file');
        $extension = $file->getClientOriginalName();
        $file->move('uploads',$extension);
        $slider = new Homeslider();
        $slider->type=1;
        $slider->admin_id=1;
        $slider->status=1;
        $slider->image=$extension;
        $slider->save();
    }
}
