<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Attributes;
use App\Models\AttributeValuesModel;
use App\Models\Brands;
use App\Models\Admins;
use App\Models\Categories;
use App\Models\InventoryAttributes;
use App\Models\Products;
use App\Models\CardModel;
use App\Models\Raiting;
use App\Models\ProductImagesModel;
use App\Models\ProductCategory;
use App\Models\ProductsCollection;
use App\Models\FlashsalesProducts;
use App\Models\UpdateInventories;
use App\Helpers\AlphabetHelper;
use App\Mail\RejectMessage;
use Illuminate\Http\Request;
use DB;
use App\Exports\ProductListExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{

    public function export_product()
    {
        // return view('exports.listProduct',[
        //     'prods' => Products::all(),
        //     'categories' => Categories::all(),
        //     'brands' => Brands::all(),
        //     'attributes' => Attributes::all(),
        //     'keysType' => AttributeValuesModel::all(),
        //     'keys' => AttributeValuesModel::join('inventory_attributes','attribute_values.id','=','inventory_attributes.attribute_value_id')
        //     ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        //     ->get(),
        // ]);
       return Excel::download(new ProductListExport, 'productList-'.date('Y-m-d').'.xlsx');
    }

    public function list(Request $request)
    {
        //dd(backpack_user()->id);
        $users = Admins::all();
        $brands = Brands::all();
        $categories = Categories::where('parent',0)->get();
        $products = Products::leftJoin('brands','products.brand_id','=','brands.id')
        ->leftJoin('tax_rules','products.tax_rule_id','=','tax_rules.id')
        ->leftJoin('product_categories','products.id','=','product_categories.product_id')
        ->leftJoin('categories','product_categories.category_id','=','categories.id')
        ->leftJoin('admins','products.admin_id','=','admins.id')
        ->select('admins.*','categories.*','categories.title as ctTitle','product_categories.*','products.*','products.id as proID','brands.*','brands.title as brandName','products.title as proName','products.status as proStatus','tax_rules.title as ruleName','products.image as proImage')
        ->orderBy('products.id','DESC')
        ->when(backpack_user()->id !=1, function($query){
            return $query->where('products.admin_id',backpack_user()->id);
        })
        ->when($request->status != null, function($query) use ($request){
            return $query->where('products.status',$request->status);
        })
        ->when($request->admin_id != null, function($query) use ($request){
            return $query->where('products.admin_id',$request->admin_id);
        })
        ->when($request->cats_id != null, function($query) use ($request){
            return $query->where('products.category_id',$request->cats_id);
        })
        ->when($request->sub_cats_id != null, function($query) use ($request){
            return $query->where('products.subcategory_id',$request->sub_cats_id);
        })
        ->when($request->brand_id != null, function($query) use ($request){
            return $query->where('products.brand_id',$request->brand_id);
        })
        ->get();
        return view('products.list',compact('products','brands','users','categories'));
    }

    public function store()
    {
        $categories = Categories::where('parent',0)->get();
        $brands = Brands::all();
        $decode = json_decode($brands);
        $collection = collect($decode);
        $sorted = $collection->sortBy('title', SORT_NATURAL); // Brend adlarini aliba sirasi ile duzmek ucun;
        $brandList = $sorted->values()->all(); // Brend adlarini aliba sirasi ile duzmek ucun;

        $attributes = Attributes::all();
        $keys = AttributeValuesModel::all();
        return view('products.create',compact('categories','brands','keys','attributes','brandList'));
    }

    public function multi_edit()
    {
        $products = Products::all();
        $categories = Categories::all();
        $brands = Brands::all();
        $attributes = Attributes::all();
        $keys = AttributeValuesModel::all();
        $inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->join('attributes','attribute_values.attribute_id','=','attributes.id')
        ->select(
            'attribute_values.id as attrId',
            'attribute_values.title as attrTitle',
            'attributes.title as attrtitle',
        )
        ->get();
        
        $dList=[];
        foreach ($inventories as $value) {
            $dList[$value->attrtitle][] = [
                'name'=>$value->attrTitle,
                'attr_id'=>$value->attrId,
            ];
        } 
        return view('products.multiedit',compact('categories','brands','keys','attributes','products','inventories','dList'));
    }

    public function edit($id)
    {
        $prodID = $id;
        $products = Products::find($id);
        $categories = Categories::all();
        $brands = Brands::all();
        $attributes = Attributes::all();
        $keys = AttributeValuesModel::all();

        $inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->join('attributes','attribute_values.attribute_id','=','attributes.id')
        ->select(
            'attribute_values.id as attrId',
            'attribute_values.title as attrTitle',
            'attributes.title as attrtitle'
        )
        ->where('updated_inventories.product_id',$id)
        ->get();
        
        $dList=[];
        foreach ($inventories as $value) {
            $dList[$value->attrtitle][] = [
                'name'=>$value->attrTitle,
                'attr_id'=>$value->attrId,
            ];
        }      
       
       return view('products.edit',compact('categories','brands','keys','attributes','products','inventories','prodID','dList'));
    }

    public function load_primary_categories()
    {
        $prim = Categories::where('parent',$_GET['catid'])->get();
        $datalist=[];
        echo '<option value="">Select Sub Categories</option>';
        foreach ($prim as $key) {
            echo '<option  value="'.$key->id.'">'.$key->title.'</option>';
        }
        
    }

    public function jsonProdName(Request $request)
    {
        $brid = $request->brandID;
        $listProdName = DB::table('products_name')->where('brand_id',$brid)->get();
        echo '<option>Select name</option>';
        foreach ($listProdName as $items) {
            echo '<option vallue="'.$items->pr_name.'">'.$items->pr_name.'</option>';
        }
    }

    public function jsonProdImage(Request $request)
    {
        $brid = $request->brandID;
        $listProdImage = DB::table('products_name')->where('pr_name',$brid)->get();
        $datalist=[];
        foreach ($listProdImage as $item) {
            $datalist[] = [
                'image'=>$item->pr_image
            ];
        }
        echo json_encode($datalist);
    }

    public function jsonProdNameEdit(Request $request)
    {
        sleep(1);
        $brid = $request->brandID;
        $listProdName = DB::table('products_name')->where('brand_id',$brid)->get();
        echo '<option>Select name</option>';
        foreach ($listProdName as $items) {
            if($items->pr_name==$request->prodName){
                echo '<option selected vallue="'.$items->pr_name.'">'.$items->pr_name.'</option>';
            }else{
                echo '<option vallue="'.$items->pr_name.'">'.$items->pr_name.'</option>';
            }
            
        }
    }

    public function create_product(Request $request)
    {
        

        // BU HISSEDE PRODUCTS IMAGE SEKILLER GETMELIDIR

        
            // $file = $request->file('image');
            // $extension = $file->getClientOriginalName();
            // $file->move('uploads',$extension);
            if($request->brand_id ==''){
                $request->validate([
                    'title'         => 'required',
                    'brand_name'    => 'required',
                    'purchased'     => 'required',
                    'category_id'   => 'required',
                    'attr_id.0'       => 'required',
                    'keys_quan'     => 'required'
                ],[
                    'title.required' => 'Please enter product name',
                    'purchased.required' => 'Please enter product price',
                    'attr_id.0.required' => 'Attributes must be added',
                    'keys_quan.required' => 'Case Type must be added',
                    'brand_name.required'=> 'Brand name must be added'
                ]
            
                );
            }else{
                $request->validate([
                    'title'         => 'required',
                    'brand_id'      => 'required',
                    'purchased'     => 'required',
                    'category_id'   => 'required',
                    'attr_id.0'       => 'required',
                    'keys_quan'     => 'required'
                ],[
                    'title.required' => 'Please enter product name',
                    'purchased.required' => 'Please enter product price',
                    'attr_id.0.required' => 'Attributes must be added',
                    'keys_quan.required' => 'Case Type must be added',
                    'brand_name.required'=> 'Brand name must be added'
                ]
            
                );
            }
            

            $create = new Products();
            $create->title = $request->title;
            $create->slug = $request->slug;
            $create->purchased = $request->purchased;
            $create->offered = $request->purchased;
            $create->deposit = $request->deposit;
            $create->selling = 0;
            $create->offered = $request->offered;
            $create->category_id = $request->category_id;
            $create->subcategory_id = $request->subcategory_id;
            $create->delivery_time_min = ($request->onflow==1 ? null: $request->delivery_time_min);
            $create->delivery_time_max = ($request->onflow==1 ? null: $request->delivery_time_max);
            $create->unit = $request->unit;
            $create->badge = $request->badge;
            $create->overview = $request->overview;
            $create->description = $request->description;
            $create->max_keys_quan = $request->max_quan;
            $create->status = (backpack_user()->id==1 ? 1:2);
            $create->brand_id = $request->brand_id;
            $create->meta_title = $request->meta_title;
            $create->meta_description = $request->meta_description;
            $create->keys_type = $request->keys_quan;
            $create->admin_fee = $request->admin_fee;
            $create->total_price_for_case = $request->total_for_case;
            $create->total_price = $request->total_price;
            $create->attributes = json_encode($request->attr_id);
            $create->image = ($request->image_title !=''? $request->image_title:'default-image.webp');
            $create->admin_id = backpack_user()->id;
            if($request->empty_values!=''){
                $create->empty_product_name = '1';
                $create->empty_brand_id = '1';
                $create->request_brand_name = $request->brand_name;
            }
            $create->save();


            // add product images

            $addImages = new ProductImagesModel();
            $addImages->product_id = $create->id;
            $addImages->image = ($request->image_title !=''? $request->image_title:'default-image.webp');
            $addImages->admin_id = backpack_user()->id;
            $addImages->save();

        

        

        // add update_inventories
        $addUpdateInvent = new UpdateInventories();
        $addUpdateInvent->product_id = $create->id;
        $addUpdateInvent->quantity = $request->keys_quan;
        $addUpdateInvent->price = $request->purchased;
        $addUpdateInvent->save();

        

        // add inventory_attributes
        $count = count($request->attr_id);
        for ($i=0; $i < $count; $i++) { 

            DB::table('inventory_attributes')->insert([
                'inventory_id'=>$addUpdateInvent->id,
                'attribute_value_id'=>$_POST['attr_id'][$i],
            ]);
            
        }
       
        return redirect(route('products'))->with('success','Product successfully added');
    }

    // Rejected Products

    public function reject_product(Request $request)
    {
        $ll = Products::join('admins','products.admin_id','=','admins.id')->find($request->transaction_id);
        $data = [
            'text' => $request->message
        ];
        Products::where('id',$request->transaction_id)->update([
            'status'=>7
        ]);
        Mail::to($ll->email)->send(new RejectMessage($data));
        return back()->with('succcess','');
    }

    // Product updates

    public function update_product(Request $request)
    {
        try {
            Products::where('id',$request->pro_id)->update([
                'title' =>$request->title,
                'slug' =>$request->slug,
                'purchased'=>$request->purchased,
                'offered'=>$request->purchased,
                'deposit'=>$request->deposit,
                'selling'=>$request->selling,
                'offered'=>$request->offered,
                'subcategory_id'=>$request->subcategory_id,
                'category_id'=>$request->category_id,
                'delivery_time_min'=>$request->delivery_time_min,
                'delivery_time_max'=>$request->delivery_time_max,
                'unit'=>$request->unit,
                'badge'=>$request->badge,
                'overview'=>$request->overview,
                'description'=>$request->description,
                'max_keys_quan'=> $request->max_quan,
                'status'=>(backpack_user()->role_id==1 ? $request->status:2),
                'brand_id'=>$request->brand_id,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'keys_type'=>$request->keys_quan,
                'admin_fee'=> $request->admin_fee,
                'total_price_for_case'=> $request->total_for_case,
                'total_price'=> $request->total_price,
                'image'=> $request->image_title
            ]);
            
            
            // add update_inventories
            DB::transaction(function() use ($request){
                $inv = UpdateInventories::where('product_id',$request->pro_id)->get();
                //dd($request->pro_id);
                try {
                    InventoryAttributes::where('inventory_id',$inv[0]->id)->delete();
                    UpdateInventories::where('product_id',$request->pro_id)->delete();
                } catch (\Throwable $th) {
                    //throw $th;
                }

            });

            $addUpdateInvent = new UpdateInventories();
            $addUpdateInvent->product_id = $request->pro_id;
            $addUpdateInvent->quantity = $request->keys_quan;
            $addUpdateInvent->price = $request->purchased;
            $addUpdateInvent->save();

            // add inventory_attributes
            $count = count($request->attr_id);
            for ($i=0; $i < $count; $i++) { 

                InventoryAttributes::insert([
                    'inventory_id'=>$addUpdateInvent->id,
                    'attribute_value_id'=>$_POST['attr_id'][$i],
                ]);
                
            }

            return redirect()->back()->with('success','Product successfully updated');
        } catch (\Throwable $th) {
             return back()->with('error','There are unselected sections');
        }

    }

    public function update_multi(Request $request)
    {
       // dd($request->pro_id);
        Products::where('id',$request->pro_id)->update([
            'title' =>$request->title,
            'slug' =>$request->slug,
            'purchased'=>$request->purchased,
            'offered'=>$request->purchased,
            'deposit'=>$request->deposit,
            'selling'=>$request->selling,
            'offered'=>$request->offered,
            'category_id'=>$request->category_id,
            'delivery_time_min'=>$request->delivery_time_min,
            'delivery_time_max'=>$request->delivery_time_max,
            'unit'=>$request->unit,
            'badge'=>$request->badge,
            'overview'=>$request->overview,
            'description'=>$request->description,
            'max_keys_quan'=> $request->max_quan,
            'status'=>$request->status,
            'brand_id'=>$request->brand_id,
            'meta_title'=>$request->meta_title,
            'meta_description'=>$request->meta_description,
            'keys_type'=>$request->keys_quan,
            'admin_id' => backpack_user()->id
        ]);

        // add update_inventories
        DB::transaction(function() use ($request){
            $inv = UpdateInventories::where('product_id',$request->pro_id)->get();
            InventoryAttributes::where('inventory_id',$inv[0]->id)->delete();
            UpdateInventories::where('product_id',$request->pro_id)->delete();


            $addUpdateInvent = new UpdateInventories();
            $addUpdateInvent->product_id = $request->pro_id;
            $addUpdateInvent->quantity = $request->keys_quan;
            $addUpdateInvent->price = $request->purchased;
            $addUpdateInvent->save();

            // add inventory_attributes
            $count = count($request->attr_id);
            for ($i=0; $i < $count; $i++) { 

                InventoryAttributes::insert([
                    'inventory_id'=>$addUpdateInvent->id,
                    'attribute_value_id'=>$_POST['attr_id'][$i],
                ]);
                
            }

        });

        
        return redirect()->back()->with('success','Product successfully updated');
    }

    public function action_products(Request $request)
    {
        
        if($request->action=='Save'){
            // multi updates
            for ($i=0; $i < count($request->multy); $i++) { 
                Products::whereIn('id',$request->pro_id[$i])->update([
                    'title' =>$request->title,
                    'slug' =>$request->slug,
                    'purchased'=>$request->purchased,
                    'offered'=>$request->purchased,
                    'deposit'=>$request->deposit,
                    'selling'=>$request->selling,
                    'offered'=>$request->offered,
                    'category_id'=>$request->category_id,
                    'delivery_time_min'=>$request->delivery_time_min,
                    'delivery_time_max'=>$request->delivery_time_max,
                    'unit'=>$request->unit,
                    'badge'=>$request->badge,
                    'overview'=>$request->overview,
                    'description'=>$request->description,
                    'max_keys_quan'=> $request->max_quan,
                    'status'=>$request->status,
                    'brand_id'=>$request->brand_id,
                    'meta_title'=>$request->meta_title,
                    'meta_description'=>$request->meta_description,
                    'keys_type'=>$request->keys_quan,
                    'admin_id' => backpack_user()->id
                ]);
        
                // add update_inventories
                DB::transaction(function() use ($request){
                    $inv = UpdateInventories::whereIn('product_id',$request->pro_id)->get();
                    InventoryAttributes::whereIn('inventory_id',$inv[$i]->id)->delete();
                    UpdateInventories::whereIn('product_id',$request->pro_id)->delete();
        
                });
        
                $addUpdateInvent = new UpdateInventories();
                $addUpdateInvent->product_id = $request->pro_id;
                $addUpdateInvent->quantity = $request->keys_quan;
                $addUpdateInvent->price = $request->purchased;
                $addUpdateInvent->save();
        
                // add inventory_attributes
                $count = count($request->attr_id);
                for ($i=0; $i < $count; $i++) { 
        
                    InventoryAttributes::insert([
                        'inventory_id'=>$addUpdateInvent->id,
                        'attribute_value_id'=>$_POST['attr_id'][$i],
                    ]);
                    
                }
        
                return redirect()->back()->with('success','Product successfully updated');

            }


        }elseif($request->action=="Delete"){
            DB::transaction(function() use ($request){

                     $inv = UpdateInventories::whereIn('product_id', $request->multy)->get();
                     for ($i=0; $i < count($request->multy); $i++) { 
                        DB::table('inventory_attributes')->whereIn('inventory_id',[$inv[$i]->id])->delete();
                     }
                     UpdateInventories::whereIn('product_id',$request->multy)->delete();
                     DB::table('product_langs')->whereIn('product_id',$request->multy)->delete();
                     DB::table('collection_with_products')->whereIn('product_id',$request->multy)->delete();
                     DB::table('rating_reviews')->whereIn('product_id',$request->multy)->delete();
                     DB::table('product_categories')->whereIn('product_id',$request->multy)->delete();
                     DB::table('product_images')->whereIn('product_id',$request->multy)->delete();
                     Products::whereIn('id',$request->multy)->delete();
               
             });
             return redirect()->back()->with('success','Product successfully deleted ('.count($request->multy).') products');
        }elseif($request->action=="One save"){
            // one to one updates
            dd($request->pro_id);
            Products::where('id',$request->pro_id)->update([
                'title' =>$request->title,
                'slug' =>$request->slug,
                'purchased'=>$request->purchased,
                'offered'=>$request->purchased,
                'deposit'=>$request->deposit,
                'selling'=>$request->selling,
                'offered'=>$request->offered,
                'category_id'=>$request->category_id,
                'delivery_time_min'=>$request->delivery_time_min,
                'delivery_time_max'=>$request->delivery_time_max,
                'unit'=>$request->unit,
                'badge'=>$request->badge,
                'overview'=>$request->overview,
                'description'=>$request->description,
                'max_keys_quan'=> $request->max_quan,
                'status'=>$request->status,
                'brand_id'=>$request->brand_id,
                'meta_title'=>$request->meta_title,
                'meta_description'=>$request->meta_description,
                'keys_type'=>$request->keys_quan,
                'admin_id' => backpack_user()->id
            ]);
    
            // add update_inventories
            DB::transaction(function() use ($request){
                $inv = UpdateInventories::where('product_id',$request->pro_id)->get();
                InventoryAttributes::where('inventory_id',$inv[0]->id)->delete();
                UpdateInventories::where('product_id',$request->pro_id)->delete();
    
            });
    
            $addUpdateInvent = new UpdateInventories();
            $addUpdateInvent->product_id = $request->pro_id;
            $addUpdateInvent->quantity = $request->keys_quan;
            $addUpdateInvent->price = $request->purchased;
            $addUpdateInvent->save();
    
            // add inventory_attributes
            $count = count($request->attr_id);
            for ($i=0; $i < $count; $i++) { 
    
                InventoryAttributes::insert([
                    'inventory_id'=>$addUpdateInvent->id,
                    'attribute_value_id'=>$_POST['attr_id'][$i],
                ]);
                
            }
    
          //  return redirect()->back()->with('success','Product successfully updated');
        }
    }

    public function remove_products($id)
    {
        DB::transaction(function() use ($id){
           // try {
                $inv = UpdateInventories::where('product_id', $id)->get();
                CardModel::where('product_id',$id)->delete();
                ProductCategory::where('product_id',$id)->delete();
                DB::table('inventory_attributes')->where('inventory_id',$inv[0]->id)->delete();
                UpdateInventories::where('product_id',$id)->delete();
                DB::table('collection_with_products')->where('product_id',$id)->delete();
                Raiting::where('product_id',$id)->delete();
                ProductImagesModel::where('product_id',$id)->delete();
                FlashsalesProducts::where('product_id',$id)->delete();
                FlashsalesProducts::where('product_id',$id)->delete();
                
                Products::where('id',$id)->delete();
                
          //  } catch (\Throwable $th) {
                //throw $th;
         //   }
          //  return redirect()->back()->with('error','This product cannot be removed for certain reasons');
          
        });
        return redirect()->back()->with('success','Product successfully deleted');
        
    }
}
