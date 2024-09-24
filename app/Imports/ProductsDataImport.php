<?php

namespace App\Imports;

use App\Models\Products;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsDataImport implements ToModel,WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function startRow(): int
    {
       return 2;
    }
    
    public function model(array $row)
    {
        return new Products([
            'title' =>$row[0],
            'badge' =>$row[1],
            'unit' =>$row[2],
            'description' =>$row[3],
            'overview' =>$row[4],
            'meta_title' =>$row[5],
            'meta_description' =>$row[6],
            'image' =>$row[7],
            'video' =>$row[8],
            'video_thump' =>$row[9],
            'slug' =>$row[10],
            'tags' =>$row[11],
            'brand_id' =>$row[12],
            'purchases' =>$row[13],
            'selling' =>$row[14],
            'status' =>$row[15],
            'id' =>$row[16],
            'category_id' =>$row[17],
        ]);
    }
}
