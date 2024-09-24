<?php

namespace App\Http\Controllers;

use App\Exports\ProductsDataExport;
use App\Imports\ProductsDataImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BulkController extends Controller
{
    public function index()
    {
        return view('bulk.index');
    }

    public function exporting()
    {
        return Excel::download(new ProductsDataExport, 'products-'.date('Y-m-d').'.xlsx');
    }

    public function importing()
    {
        dd(request()->file());
        // Excel::import(new ProductsDataImport, request()->file('import_file'));
        // return back()->with('success','Excell file uploaded successfully');
    }
}
