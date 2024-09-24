<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashsalesProducts extends Model
{
    use HasFactory;
    protected $table = 'flash_sale_products';
    
    protected $primaryKey = 'product_id';


    public function products()
    {
        return $this->hasOne(Products::class,'id');
    }
}
