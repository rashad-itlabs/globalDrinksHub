<?php

namespace App\Http\Controllers;

use App\Models\HeaderLink;
use App\Models\Headerlinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeaderlinksController extends Controller
{
   public function headerlist()
   {
    $leftlist = Headerlinks::where('type',1)->get();
    $rightlist = Headerlinks::where('type',2)->get();
    return view('ui.header.list',compact('leftlist','rightlist'));
   }

   public function update(Request $request)
   {
      
      DB::transaction(function() use ($request){
         DB::select("DELETE FROM header_links");
         $all = $request->except('_token');
         for ($i=0; $i < count($all['title']); $i++) { 
            $data[] = [
               'title'=>$all['title'][$i],
               'url'=>$all['url'][$i],
               'type'=>$all['type'][$i],
               'admin_id'=>1,
               'created_at'=>date('Y-m-d H:i:s'),
               'updated_at'=>date('Y-m-d H:i:s'),
            ];
         }
         Headerlinks::insert($data);
         return redirect(backpack_url('headerlinks'))->with('success','Information has been changed');
      });
      
   }

   public function delete($id)
   {
      HeaderLink::find($id)->delete();
      return back()->with('success','Link has been deleted');
   }
}
