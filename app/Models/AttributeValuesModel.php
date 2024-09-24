<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValuesModel extends Model
{
    use HasFactory;
    protected $table = 'attribute_values';
    protected $fillable = [
        'attribute_id',
        'title'
    ];

    
    public function values()
    {
        return $this->hasOne(Attributes::class,'attribute_id'); // burada yazdigimiz Attributes table-sindeki id-ni AttributeValues-daki cinema_id-i ile qarsilasdirir
    }

}
