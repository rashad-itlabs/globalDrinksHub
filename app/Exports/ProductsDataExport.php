<?php

namespace App\Exports;

use App\Models\Products;
use App\Models\Categories;
use App\Models\Brands;
use App\Models\Attributes;
use App\Models\AttributeValuesModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsDataExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.products', [
            'prods' => Products::all(),
            'categories' => Categories::all(),
            'brands' => Brands::all(),
            'attributes' => Attributes::all(),
            'keys' => AttributeValuesModel::all(),
        ]);
    }
}



