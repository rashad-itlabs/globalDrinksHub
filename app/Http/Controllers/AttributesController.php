<?php

namespace App\Http\Controllers;

use App\DataTables\AttributesDataTable;
use App\Models\Attributes;
use App\Models\AttributeValuesModel;
use App\Models\InventoryAttributes;
use Attribute;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;
use DB;

class AttributesController extends Controller
{
    public function index(AttributesDataTable $dataTable)
    {
        $attributes = Attributes::all();
        $values = AttributeValuesModel::all();
        return $dataTable->render('attributes.index',compact('attributes','values'));
    }

    public function store()
    {
        return view('attributes.create');
    }

    public function create(Request $request)
    {
        DB::transaction(function() use ($request){
            $create_attrs = new Attributes();
            $create_attrs->title = $request->title_attrs;
            $create_attrs->admin_id = 1;
            $create_attrs->save();

            
            for ($i=0; $i < count($request->value); $i++) { 
                $vals = new AttributeValuesModel();
                $vals->title = $request->value[$i];
                $vals->attribute_id = $create_attrs->id;
                $vals->admin_id = 1;
                $vals->save();
            }
            
        });

        return redirect(backpack_url('attributes'))->with('success','Cases have been added');
    }

    public function attribute_delete($id)
    {
        DB::transaction(function() use ($id){
            AttributeValuesModel::where('attribute_id',$id)->delete();
            Attributes::where('id',$id)->delete();
        });
        return redirect(backpack_url('attributes'))->with('success','Cases have been deleted');
    }

    public function edit_page($id)
    {
        $list = Attributes::find($id);
        $values = AttributeValuesModel::all();
        return view('attributes.edit',compact('list','values'));
    }

    public function update(Request $request)
    {
        DB::transaction(function() use ($request){
            $values = $request->value;
            $valuesArray = array_values(array_filter($values));
           // dd($request->attribute_value_id);
            InventoryAttributes::whereIn('attribute_value_id',$request->attribute_value_id)->delete();
            AttributeValuesModel::where('attribute_id',$request->attribute_id)->delete();
            Attributes::where('id',$request->attribute_id)->delete();

            $create_attrs = new Attributes();
            $create_attrs->title = $request->title;
            $create_attrs->admin_id = 1;
            $create_attrs->save();

            for ($i=0; $i < count($valuesArray); $i++) { 
                $vals = new AttributeValuesModel();
                $vals->title = $valuesArray[$i];
                $vals->attribute_id = $create_attrs->id;
                $vals->admin_id = 1;
                $vals->save();
            }
            
        });
        return redirect(backpack_url('attributes'))->with('success','Cases have been changed');
    }
}
