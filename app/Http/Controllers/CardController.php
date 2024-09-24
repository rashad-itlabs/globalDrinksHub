<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CardModel;
use App\Models\InventoryAttributes;
use App\Models\Orders;
use App\Models\Products;
use App\Models\UpdateInventories;
use Auth;
use DB;

class CardController extends Controller {


    public function index()
    {
        $card = CardModel::join('products','carts.product_id','=','products.id')
        ->select('products.*','carts.*','carts.id as crid','products.id as proId')
        ->where('carts.user_id',@Auth::user()->id)
        ->get();
        $cardcount = CardModel::where('user_id',@Auth::user()->id)->count();
        $cardSum = CardModel::where('user_id',@Auth::user()->id)->sum('totalPrice');
        return view('frontend.card',compact('card','cardcount','cardSum'));
    }

    public function card(Request $request)
    {
       //dd(Auth::user()->id);
        if(Auth::check()){
            try {
                $pr = Products::find($request->id);
                if($request->quan=='NaN'){
                    $quant = 1;
                }else{
                    $quant = $request->quan;
                }

                $intID = UpdateInventories::where('product_id',$pr->id)->get();
                $create = new CardModel();
                $create->product_id = $request->id;
                $create->user_id = Auth::user()->id;
                $create->price = $pr->purchased;
                $create->totalPrice = $pr->purchased * $quant;
                $create->quantity = $request->quan;
                $create->inventory_id = $intID[0]->id;
                $create->status = 0;
                $create->save();

                return redirect(route('card'));
            } catch (\Throwable $th) {
                //throw $th;
                return back()->with('error','The product attribute must be selected');
            }
            
        }else{
            return redirect(route('login'));
        }
    }

    public function remove($id)
    {
        CardModel::where('id',$id)->delete();
        return back()->with('success','The product has been removed from the cart');
    }


    public function check(Request $request)
    {
        date_default_timezone_set('Asia/Baku');
        unset($request['_token']);
        
        DB::transaction(function() use ($request){
            $cart = CardModel::whereIn('id',$request->card)->get();
            foreach ($cart as $key) {
                $dataOrder = [
                    'status' => 1,
                    'order'=> time().'glob'.rand(1111,9999),
                    'product_id'=>$key->product_id,
                    'price'=> number_format($key->price,2),
                    'total_amount' => number_format($key->totalPrice,2),
                    'order_method'=> 1,
                    'currency' =>'EUR',
                    'quantity' => $key->quantity,
                    'user_id' => Auth::user()->id,
                    'user_address_id'=> $request->user_id,
                    'product_created_id'=>$request->vendor_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
        
                ];
                
                
                    Orders::insert($dataOrder);
                    CardModel::whereIn('id',$request->card)->delete();
                    return redirect(backpack_url('/orders'));
            }
        });


       
        
    }

    public function changeOrder(Request $request)
    {
        Orders::where('id',$request->orderid)->update(['status'=>$request->status]);
        return redirect(backpack_url('/orders'));
    }



}