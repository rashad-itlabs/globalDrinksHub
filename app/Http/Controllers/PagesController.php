<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function store(Request $request)
    {
        if($request->from_component==2){
            if($request->page_from_component==1){
                $description = 'Contact';
            }elseif($request->page_from_component==2){
                $description = 'Sitemap';
            }else{
                $description = $request->description;
            }
        }else{
            $description = $request->description;
        }
        $create = new Pages();
        $create->title = $request->title;
        $create->slug = $request->slug;
        $create->meta_title = $request->meta_title;
        $create->meta_description = $request->meta_description;
        $create->description = $description;
        $create->page_from_component = ($request->from_component==1? 1:2);
        $create->admin_id = 1;
        $create->save();

        return redirect(backpack_url('pages'));
    }

    public function update(Request $request)
    {
        if($request->from_component==2){
            if($request->page_from_component==1){
                $description = 'Contact';
            }elseif($request->page_from_component==2){
                $description = 'Sitemap';
            }else{
                $description = $request->description;
            }
        }else{
            $description = $request->description;
        }
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'description' => $description,
            'page_from_component' => ($request->from_component==1? 1:2)

        ];

        Pages::where('id',$request->id)->update($data);
        return back();
    }
}
