<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Products;
use Illuminate\Http\Request;
use DB;

class BrandsController extends Controller
{
    public function create(Request $request)
    {
        //dd($request->all());
        if($request->hasFile('file')){
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $file->move('uploads/', 'brand-'.time().$originalName);
            $fileName = 'brand-'.time().$originalName;
        }else{
            $fileName = 'default-image.webp';
        }
        $create = new Brands();
        $create->title = $request->title;
        $create->image = $fileName;
        $create->slug = $request->slug;
        $create->featured = $request->featured;
        $create->status = $request->status;
        $create->admin_id=1;
        $create->save();


        $images=array();

        if($filespr=$request->file('images')){
            foreach($filespr as $file){
                $name=$file->getClientOriginalName();
                $file->move('uploads',$name);
                $images[]=$name;
            }
        }
        for ($i=0; $i < count($request->pr_name); $i++) {
            DB::table('products_name')->insert([
                'brand_id' => $create->id,
                'pr_name' => $request->pr_name[$i],
                'pr_image' => $images[$i]
            ]);
         }

        return redirect(backpack_url('brands'))->with('success','The information has been added');
    }

    public function saveNewPrName(Request $request)
    {
        echo $request->pr_name;
    }

    public function edit($id)
    {
        $list = Brands::find($id);
        $listProdName = DB::table('products_name')->where('brand_id',$id)->get();
        return view('brands.edit',compact('list','listProdName'));
    }

    public function autouploadImage(Request $request)
    {
        echo 'The information has been uptaded';
        $file = $request->file('images');
        $originalName = $file->getClientOriginalName();
        $file->move('uploads', $originalName);


            DB::table('products_name')
            ->where('id',$request->brid)
            ->update([
                'pr_image' => $originalName
            ]);
            
    }

    public function update(Request $request)
    {
        error_reporting(0);
        
        if($request->hasFile('file')){
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $file->move('uploads/', 'brand-'.time().$originalName);
            $fileName = 'brand-'.time().$originalName;
            $data = [
               'title' => $request->title,
               'image' => $fileName,
               'slug' => $request->slug,
               'featured' => $request->featured,
               'status' => $request->status 
            ];

            $create = Brands::where('id',$request->id)->update($data);
            // if($request->pr_name !=''){
            //     for ($i=0; $i < count($request->pr_name); $i++) {
            //         DB::table('products_name')
            //         ->where('id',$request->brid[$i])
            //         ->update([
            //             'pr_name' => $request->pr_name[$i],
            //         ]);
            //     }
            // }
            return redirect(backpack_url('brands'))->with('success','The information has been added');
        }else{
            $data = [
                'title' => $request->title,
                'slug' => $request->slug,
                'featured' => $request->featured,
                'status' => $request->status 
             ];
             $create = Brands::where('id',$request->id)->update($data);

             
             //dd(count($request->pr_name));
             //if($request->pr_name !=''){
                
                   // dd($request->brid);
                    DB::transaction(function() use($request){
                        $images=array();
                        if($request->brid!=''){
                            for ($pr=0; $pr < count($request->brid); $pr++) { 
                                Products::where('title',$request->old_pr_name_edit[$pr])->update([
                                    'title'=>$request->pr_name_edit[$pr]
                                ]);
                            }
                        }
                        

                        if($filespr=$request->file('images')){
                            foreach($filespr as $file){
                                $name=$file->getClientOriginalName();
                                $file->move('uploads',$name);
                                $images[]=$name;
                            }
                        }
                        if($request->pr_name==''){
                            //dd($request->brid);
                            if($request->pr_name_edit!=''){
                                for ($i=0; $i < count($request->pr_name_edit); $i++) {
                                    DB::table('products_name')
                                    ->where('id',$request->brid[$i])
                                    ->update([
                                        'brand_id' =>$request->id,
                                        'pr_name' => $request->pr_name_edit[$i],
                                    ]);
                                }
                            }
                        }else{
                            for ($i=0; $i < count($request->pr_name); $i++) {
                                DB::table('products_name')
                                ->insert([
                                    'brand_id' =>$request->id,
                                    'pr_name' => $request->pr_name[$i],
                                    'pr_image' => $images[$i]
                                ]);
                            }
                        }
                        

                    });
                
            //}
            
            return redirect()->back()->with('success','The information has been added');
        }
        
    }


    public function addOnly(Request $request)
    {
        //echo $request->br_id;
        echo 'The information has been uploaded';
        // $file = $request->file('images');
        // $originalName = $file->getClientOriginalName();
        // $file->move('uploads', $originalName);

        $images=array();

        if($filespr=$request->file('images')){
            foreach($filespr as $file){
                $name=$file->getClientOriginalName();
                $file->move('uploads',$name);
                $images[]=$name;
            }
        }
        for ($i=0; $i < count($request->pr_name); $i++) {
            DB::table('products_name')->insert([
                'brand_id' => $request->br_id,
                'pr_name' => $request->pr_name[$i],
                'pr_image' => $images[$i]
            ]);
         }
            // DB::table('products_name')
            // ->insert([
            //     'brand_id'=>$request->br_id,
            //     'pr_name' => $request->in_value,
            //     'pr_image' => $originalName
            // ]);
    }

    public function remove_prod_name(Request $request)
    {
        echo 'The product name ('.$request->title.') has been deleted';
        DB::table('products_name')->where('id',$request->prod_id)->delete();
    }

}
