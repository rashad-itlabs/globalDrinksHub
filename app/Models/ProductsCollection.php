<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsCollection extends Model
{
    use CrudTrait;
    use HasFactory;

    
    protected $table = 'product_collections';
}
