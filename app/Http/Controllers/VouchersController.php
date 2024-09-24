<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VouchersController extends Controller
{
    public function index()
    {
        $v_list = Voucher::orderBy('id','ASC')->get();
        return view('vouchers.index',compact('v_list'));
    }
}
