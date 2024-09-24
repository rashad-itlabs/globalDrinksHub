@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('assets/css/')}}/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif
<div class="alert alert-info mb-2">Important: We have used an advance caching system. If you change anything in the admin panel, please, make sure to clear the cache from here. Setting > Clear cache.</div>
<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <div class="card-header"><h5 class="card-title">Exporting product data</h5></div>
            <div class="card-body">
                <div class="alert alert-info">A Xlsx file will be downloaded containing all the product data.</div>
                <a href="{{route('export_xlsx')}}" class="btn btn-primary mt-3">Export Xlsx</a>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header"><h5 class="card-title">File to import</h5></div>
            <div class="card-body">
                <div class="alert alert-info">Upload a Xlsx file with the proper format. Please click the export button above in order to get the idea.</div>
                <div class="alert alert-info">To update in bulk, please put the product ID in the Excel row. To translate in bulk, please put the product id in the Excel row and select the language from the header.</div>
                <form action="{{route('import_xlsx')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="import_file" class="form-control">
                    <button class="btn btn-primary mt-3">Import Xlsx</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header" style="display: inline-block;">
                <div class="row">
                    <div class="col-8"><h5 class="card-title">Images in Bulk</h5></div>
                    <div class="col-4 text-end"><a href="{{route('images')}}">Wiev images</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">You will be able to upload multiple images from here. You can upload maximum 10 images at once.</div>
                <form action="{{route('import_xlsx')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="import_file" class="form-control">
                    <button class="btn btn-primary mt-3">Upload images in bulk</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection