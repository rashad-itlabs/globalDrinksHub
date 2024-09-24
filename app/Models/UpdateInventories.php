<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateInventories extends Model
{

    protected $table = 'updated_inventories';
    protected $fillable = [
        'product_id', 'quantity', 'price', 'sku'
    ];










}