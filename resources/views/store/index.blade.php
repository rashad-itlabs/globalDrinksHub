@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('public/assets/css/')}}/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')
@foreach($stores as $st)
@if(Session::has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif
<div class="card">
    <div class="card-header"><h4 class="card-title">Store form</h4></div>
    <div class="card-body">
        <form action="{{route('update_store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="">Stoer logo</label>
                    <div class="image_box"><img src="{{asset('uploads/'.$st->image)}}" id="head_logo" alt=""></div>
                    <input type="file" name="heade_logo" id="header_loog">
                    <label for="header_loog" id="uploadBtn">Change header logo</label>
                </div>
                <div class="dvider"></div>
                <div class="col-12 mt-3">
                    <div class="form-group">
                        <label for="">Store name</label>
                        <input type="text" class="form-control" name="name" value="{{$st->name}}">
                    </div>
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{$st->slug}}">
                    </div>
                    <div class="form-group">
                        <label for="">Meta title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{$st->meta_title}}">
                    </div>
                    <div class="form-group">
                        <label for="">Meta descripption</label>
                        <textarea name="meta_description" id="" cols="10" rows="8" class="form-control">{{$st->meta_description}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" {{($st->whatsapp_btn==1?'checked':'')}} name="wp" id="">
                        <label for="">WhasApp buttons</label>
                    </div>
                    <div class="dropWp">
                        <div class="form-group">
                            <label for="">WhatsApp number</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{$st->whatsapp_number}}">
                        </div>
                        <div class="form-group">
                            <label for="">WhatsApp default message</label>
                            <input type="text" name="whatsapp_default_msg" class="form-control" value="{{$st->whatsapp_default_msg}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Save All</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(function(){
    $('#header_loog').change(function(){
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e){
            $('.image_box').html('<img src="'+e.target.result+'" alt="Uploaded Image">');
        }
        reader.readAsDataURL(file);
    });
})
</script>
@endsection