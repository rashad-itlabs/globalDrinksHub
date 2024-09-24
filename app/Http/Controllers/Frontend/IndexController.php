<?php 
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Homeslider;
use App\Models\Products;
use App\Models\Brands;
use App\Models\About;
use App\Models\Orders;
use App\Models\Categories;
use App\Models\ContactUs;
use App\Models\ProductCategory;
use App\Models\Attributes;
use App\Models\SubscriptionEmails;
use App\Models\AttributeValuesModel;
use DB;
use Auth;
use Carbon\Carbon as BaseCarbon;

class IndexController extends Controller{



    public function index()
    {
        $all = Products::where('unit','!=',0)->where('status',1)->get();
        $slider = Homeslider::where('type',1)->get();
        $sliderRight = Homeslider::where('type','!=',1)->get();

        $attribute = DB::table('attributes')->get();
        $attributeValues = DB::table('attribute_values')->get();
        $attribute_inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->select(
            'attribute_values.attribute_id as attrId',
            'attribute_values.title as attrTitle',
            'updated_inventories.*'
        )
        ->get();

        foreach($attribute as $atr){
            foreach($attribute_inventories as $in){
                if($atr->id == $in->attrId){
                    $dataDelivery = $in->attrTitle;
                }
            }
        }
        

        // $text = "27.02.2024 1500 USD(666,811 KZT)";


        // preg_match('/(\d+(?:\.\d+)?) USD/', $text, $matches);
        // $usd_amount = isset($matches[1]) ? floatval($matches[1]) : null;


        // preg_match('/(\d+(?:,\d+)?) KZT/', $text, $matches);
        // $kzt_amount = isset($matches[1]) ? str_replace(',', '', $matches[1]) : null;

        // echo "USD Amount: " . $usd_amount . " USD\n";
        // echo "KZT Amount: " . $kzt_amount . " KZT\n";

      return view('index',compact('all','slider','sliderRight','attribute','attribute_inventories','dataDelivery'));
    }

    public function buy()
    {
        $categoryName = Categories::all();
        $dataId = [];
        $dataselect = [];
        $productCount = Products::count();
        $brandList=[];
        $all = Products::all();
        $countBrandInProducts = ProductCategory::join('products','product_categories.product_id','=','products.id')->groupBy('products.brand_id')->get();
        foreach ($countBrandInProducts as $key) {
            $brandList[] = $key->brand_id;
        }
        

        $categories = Categories::where('parent',0)->get();
        $subcategories = Categories::all();
        $list = Brands::all();
        $attributes = Attributes::all();
        $attributesValue = AttributeValuesModel::all();
        return view('frontend.buy',compact('brandList','attributesValue','attributes','list','all','categories','subcategories','dataselect','categoryName','productCount'));
    }

    public function sell_route()
    {
        return redirect(backpack_url('create_product'));
    }

    public function addSubs(Request $request)
    {
        date_default_timezone_set('Asia/Baku');
        $request->validate([
            'subs_email'=> 'required|email|unique:subscription_emails'
        ]);

        SubscriptionEmails::insert(
            [
                'email'=>$request->subs_email,
                'created_at'=> BaseCarbon::now(),
                'updated_at'=> BaseCarbon::now(),
            ]
        );

        return back()->with('success', 'You have been subscripted');
    }

    public function track_order()
    {
        return redirect(asset('/panel/orders'));
    }

    public function product_page($id)
    {
        $info = Products::join('brands','products.brand_id','=','brands.id')
        ->select('products.*','brands.*','products.title as proTitle','products.id as proID')->find($id);
        $cats = Products::all();
        $images = DB::table('product_images')->where('product_id',$id)->get();
        $reservationStatus = Orders::where('product_id',$id)->pluck('status')->first();
        //dd($reservationStatus);
        $attribute = DB::table('attributes')->get();
        $categories = Categories::join('products','categories.id','=','products.category_id')
        ->select('categories.title as catTitle')
        ->where('products.id',$id)->get();
        $upInventories = DB::table('updated_inventories')->where('product_id',$id)->get();
        
        $attribute_inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->select(
            'attribute_values.attribute_id as attrId',
            'attribute_values.title as attrTitle',
            'updated_inventories.*'
        )
        ->where('updated_inventories.product_id',$id)
        ->groupBy('attribute_values.id')
        ->get();

        $attribute__inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->select(
            'attribute_values.attribute_id as attrId',
            'attribute_values.title as attrTitle',
            'updated_inventories.*'
        )
        ->get();

        $attributeValues = DB::table('attribute_values')->get();

        foreach($attribute as $atr){
            foreach($attribute_inventories as $in){
                if($atr->id == $in->attrId){
                    $dataDelivery = $in->attrTitle;
                }
            }
        }
       
       
       
        return view('frontend.product_detail',compact('categories','attribute__inventories','upInventories','attributeValues','dataDelivery','info','images','cats','attribute','attribute_inventories','reservationStatus'));
    }

    public function categories($id)
    {
        $categoryName = Categories::find($id);
        $dataId = [];
        $dataselect = [];
        //dd($id);
        $productCount = ProductCategory::join('products','product_categories.product_id','=','products.id')->where('product_categories.category_id',$id)->count();
        $product_Count = Products::where('category_id',$id)->where('status',1)->count();
        $brandList=[];
        if($_GET){
            
            $count = count($_GET['attr_id']);
            for ($i=0; $i < $count; $i++) { 
                $dataId[] = $_GET['attr_id'][$i];
                $dataselect[$_GET['attr_id'][$i]] = $_GET['attr_id'][$i];            
            }
            $productID=[];
            $all = DB::table('attribute_values')
            ->join('inventory_attributes','attribute_values.id','=','inventory_attributes.attribute_value_id')
            ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
            ->join('products','updated_inventories.product_id','=','products.id')
            ->whereIn('attribute_values.id', $dataId)
            ->get();

            foreach ($all as $items) {
                $productID[] = $items->id;
            }
            $from = ['[',']'];
            $to=['',''];
            $ids = json_encode($productID);
            $countBrandInProducts = Products::join('brands','products.brand_id','=','brands.id')->whereIn('products.id',$productID)->groupBy('brands.id')
            ->select('brands.id as brandID')
            ->get();
            foreach ($countBrandInProducts as $key) {
                $brandList[] = $key->brandID;
            }

            
        }else{
            $productID=[];
            $all = Products::where('category_id',$id)->where('status',1)->get();
            foreach ($all as $items) {
                $productID[] = $items->id;
            }
            $from = ['[',']'];
            $to=['',''];
            $ids = json_encode($productID);
            $countBrandInProducts = Products::join('brands','products.brand_id','=','brands.id')->whereIn('products.id',$productID)->groupBy('brands.id')
            ->select('brands.id as brandID')
            ->get();
            foreach ($countBrandInProducts as $key) {
                $brandList[] = $key->brandID;
            }
            // dd($brandList);
            // count($brandList);
            // echo json_encode($productID);
        }
        
       // $productAttributes = Products::where('category_id',$id)->groupBy('attributes')->get();

        

        $categories = Categories::where('parent',0)->get();
        $subcategories = Categories::where('id',$id)->get();
        $list = Brands::all();
        $attributes = Attributes::all();
        $attributesValue = AttributeValuesModel::all();
        $id = $id;

        $attribute = DB::table('attributes')->get();
        $attributeValues = DB::table('attribute_values')->get();
        $attribute_inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->select(
            'attribute_values.attribute_id as attrId',
            'attribute_values.title as attrTitle',
            'updated_inventories.*'
        )
        ->get();

        foreach($attribute as $atr){
            foreach($attribute_inventories as $in){
                if($atr->id == $in->attrId){
                    $dataDelivery = $in->attrTitle;
                }
            }
        }
       // dd($brandList);
      
        // $login = 'cinema';
        // $sender = 'Cine MCard';
        // $pass = "cinema2019ez";
        // $sms_text = 'Salam';
        // $sms = "994556691248";

        // $key = md5(md5($pass) . $login . $sms_text . $sms . $sender);
        // $send_sms = file_get_contents('http://apps.lsim.az/quicksms/v1/smssender?login='.$login.'&msisdn='.$sms.'&text='.$sms_text.'&sender='.$sender.'&key='.$key);

        
       return view('frontend.category_page',compact('attribute_inventories','dataDelivery','attribute','brandList','product_Count','attributesValue','attributes','list','all','categories','subcategories','id','dataselect','categoryName','productCount'));
    }

    public function brands()
    {
        $list = Brands::where('status',1)->get();
        $attribute = DB::table('attributes')->get();
        $attributeValues = DB::table('attribute_values')->get();
        $attribute_inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->select(
            'attribute_values.attribute_id as attrId',
            'attribute_values.title as attrTitle',
            'updated_inventories.*'
        )
        ->get();

        foreach($attribute as $atr){
            foreach($attribute_inventories as $in){
                if($atr->id == $in->attrId){
                    $dataDelivery = $in->attrTitle;
                }
            }
        }
        return view('frontend.brand',compact('list','attribute','attribute_inventories','dataDelivery','attributeValues'));
    }

    public function brandlist($id)
    {
        error_reporting(0);
        $dataId = [];
        $dataselect = [];
        if($_GET){
            
            $countBrand = count($_GET['brand_id']);
            for ($i=0; $i < $countBrand; $i++) { 
                $dataId[] = $_GET['brand_id'][$i];
                $dataselect[$_GET['brand_id'][$i]] = $_GET['brand_id'][$i];            
            }
            
            if($_GET['attr_id']==''){
                $countAttr = 0;
            }else{
                $countAttr = count($_GET['attr_id']);
            }
            
            for ($a=0; $a < $countAttr; $a++) { 
                $dataId[] = $_GET['attr_id'][$a];
                $dataselect[$_GET['attr_id'][$a]] = $_GET['attr_id'][$a];            
            }
            if($countAttr > 0){
                $all = DB::table('attribute_values')
                ->join('inventory_attributes','attribute_values.id','=','inventory_attributes.attribute_value_id')
                ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
                ->join('products','updated_inventories.product_id','=','products.id')
                ->where('products.status',1)
                ->whereIn('attribute_values.id', $dataId)
                ->get();
            }else{
                $all = Products::whereIn('brand_id',$dataId)->where('status',1)->get();
                
                
            }
            $list = Brands::whereIn('id',$dataId)->get();
            $brCount = Products::whereIn('brand_id',$dataId)->count();
           // 
        }else{
            $all = Products::where('brand_id',$id)->where('status',1)->get();
            $list = Brands::where('id',$id)->get();
            $brCount = Products::where('brand_id',$id)->count();
        }
        
        $attribute = DB::table('attributes')->get();
        $attributeValues = DB::table('attribute_values')->get();
        $attribute_inventories = DB::table('inventory_attributes')
        ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
        ->join('attribute_values','inventory_attributes.attribute_value_id','=','attribute_values.id')
        ->select(
            'attribute_values.attribute_id as attrId',
            'attribute_values.title as attrTitle',
            'updated_inventories.*'
        )
        ->get();

        foreach($attribute as $atr){
            foreach($attribute_inventories as $in){
                if($atr->id == $in->attrId){
                    $dataDelivery = $in->attrTitle;
                }
            }
        }
        
        $id = $id;
        $attributes = Attributes::all();
        $attributesValue = AttributeValuesModel::all();
        return view('frontend.brand_list',compact('brCount','attributesValue','attributes','all','list','id','dataId','dataselect','attribute','attribute_inventories','dataDelivery','attributeValues'));
    }

    public function faq()
    {
        return view('frontend.faq');
    }

    public function help()
    {
        return view('frontend.help');
    }

    public function products()
    {
        return view('frontend.discover_products');
    }

    public function contact()
    {
        $contact = ContactUs::find(1);
        $emails = $contact->email;
        $phones = $contact->phone;
        $emails = json_decode($emails, true);
        $phones = json_decode($phones, true);
        return view('frontend.contact',compact('emails','phones','contact'));
    }

    public function about()
    {
        $about = About::find(1);
        return view('frontend.about_us',compact('about'));
    }

    public function login_page()
    {
        if(Auth::check()){
            return redirect(asset(''));
        }else{
            return view('frontend.login_page');
        }
        
    }

    public function register_page()
    {
        return view('frontend.register_page');
    }




    public function searchResult(Request $request)
    {
        $list = Products::query()->where('title', 'LIKE', "%{$request->_val}%")->where('status',1)->where('unit','!=',0)->get();
        return view('frontend.search.index', compact('list'));
        // echo '<ul>';
        // foreach ($list as $val) {
        //     echo '<li>'.$val->title.'</li>';
        // }
        // echo '<ul>';
    }

    public function f_pass()
    {
        return view('frontend.forgetPassword');
    }

}
