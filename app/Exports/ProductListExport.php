<?php

namespace App\Exports;

use App\Models\Products;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Attributes;
use App\Models\AttributeValuesModel;
use App\Models\InventoryAttributes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductListExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.listProduct',[
            'prods' => Products::all(),
            'categories' => Categories::all(),
            'brands' => Brands::all(),
            'attributes' => Attributes::all(),
            'keysType' => AttributeValuesModel::all(),
            'keys' => AttributeValuesModel::join('inventory_attributes','attribute_values.id','=','inventory_attributes.attribute_value_id')
            ->join('updated_inventories','inventory_attributes.inventory_id','=','updated_inventories.id')
            ->get(),
        ]);
    }
}
