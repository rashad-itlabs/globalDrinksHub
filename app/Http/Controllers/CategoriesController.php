<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $cats = Categories::where('parent',0)->get();
        $subcats = Categories::where('parent','!=',0)->get();
        return view('categories.index',compact('cats','subcats'));
    }

    public function add_new()
    {
        $cats = Categories::where('parent',0)->get();
        return view('categories.create',compact('cats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
       // dd($request->all());
       if($request->hasFile('file')){
        $file = $request->file('file');
        $original_name = $file->getClientOriginalName();
        $file->move('uploads/',$original_name);
        $imageFile = $original_name;
       }else{
        $imageFile = 'thumb-default-image.webp';
       }
       $create = new Categories();
       $create->title = $request->title;
       $create->slug = $request->slug;
       $create->image = $imageFile;
       $create->meta_title = $request->meta_title;
       $create->meta_description = $request->meta_description;
       $create->status = $request->status;
       $create->featured = $request->featured;
       $create->in_footer = $request->in_footer;
       $create->parent=($request->sub_cat_id?$request->sub_cat_id:0);
       $create->admin_id = 1;
       $create->save();
       return back()->with('success','The information has been added');
    }

    public function updateCategories(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $original_name = $file->getClientOriginalName();
            $file->move('uploads/',$original_name);
            $data = [
                'title'=> $request->title,
                'slug' =>$request->slug,
                'image' => $original_name,
                'meta_title'=>$request->meta_title,
                'meta_description' => $request->meta_description,
                'status' =>$request->status,
                'featured' => $request->featured,
                'in_footer' =>$request->in_footer,
                'parent' => ($request->sub_cat_id?$request->sub_cat_id:0),
                'admin_id' => 1
            ];
        }else{
            $data = [
                'title'=> $request->title,
                'slug' =>$request->slug,
                'meta_title'=>$request->meta_title,
                'meta_description' => $request->meta_description,
                'status' =>$request->status,
                'featured' => $request->featured,
                'in_footer' =>$request->in_footer,
                'parent' => ($request->sub_cat_id?$request->sub_cat_id:0),
                'admin_id' => 1
            ];
        }
        
        Categories::where('id',$request->id)->update($data);
        return back()->with('success','The information has been updated');
    }

    public function edit($id)
    {
        $alls = Categories::find($id);
        $cats = Categories::where('parent',0)->get();
        return view('categories.edit',compact('alls','cats'));
    }
    public function delete($id)
    {
        Categories::find($id)->delete();
        Categories::where('parent',$id)->delete();
        return back()->with('success','The information has been deleted');
    }
}
