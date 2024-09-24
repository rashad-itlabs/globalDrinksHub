<?php

namespace App\Models;

use App\Http\Requests\WithdrawalAccountRequest;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalRequests extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'withdrawals';
    protected $primaryKey = 'approved_by';
    // public $timestamps = false;
    //protected $guarded = ['id'];
    //protected $fillable = ['approved_by'];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function admins()
    {
        return $this->hasOne(Admins::class,'id');
    }

    public function bank()
    {
        return $this->hasOne(WithdrawalAccount::class,'id');
    }

    public function branch()
    {
        return $this->hasOne(WithdrawalAccount::class,'id');
    }

    public function account_name()
    {
        return $this->hasOne(WithdrawalAccount::class,'id');
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
