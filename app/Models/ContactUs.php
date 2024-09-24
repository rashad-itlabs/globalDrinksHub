<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'contact_us';
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'subject', 'message', 'replied', 'viewed'
    ];

}
