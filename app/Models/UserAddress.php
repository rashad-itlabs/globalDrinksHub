<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAddress extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'user_addresses';


    public function orders()
    {
        return $this->hasMany(Users::class);
    }
}
