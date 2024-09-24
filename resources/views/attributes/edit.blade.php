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
<div class="card">
    <div class="card-header"><h5 class="card-title">Attribute form</h5></div>
    <div class="card-body">
        <form action="{{route('update_value')}}" method="post">
            @csrf 
            <div class="form-group mb-3">
                <label for="">Title</label>
                <input type="text" name="title" value="{{$list->title}}" class="form-control" placeholder="title">
            </div>
            <div class="form-group mb-3">
                <div class="alert alert-info">To delete an attribute value, just make the field empty.</div>
            </div>
            <div class="row">
                <div class="col-12 mt-2 mb-2">Attribute values</div>
                <div class="row" id="respons_values">
                @foreach($values as $vl)
                    @if($list->id==$vl->attribute_id)
                    <input type="hidden" name="attribute_value_id[]" value="{{$vl->id}}">
                     <div class="col-2 mb-3">
                        <input type="text" name="value[]" class="form-control" value="{{$vl->title}}">
                     </div>
                    @endif
                @endforeach
                </div>
                <div class="col-3">
                    <button type="button" id="addAttribute" class="btn btn-outline-primary">Add attribute values</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end">
                    <input type="hidden" name="attribute_id" value="{{$list->id}}">
                    
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(function(){
        $('#addAttribute').on('click',function(){
            $('#respons_values').append('<div class="col-2 mb-3"><input type="text" name="value[]" placeholder="Name" class="form-control"></div>');
        })
    })
</script>
@endsection