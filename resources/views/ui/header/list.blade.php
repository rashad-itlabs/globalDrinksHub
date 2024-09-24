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
<div class="card">
    <div class="card-header"><h4 class="card-title">Header</h4></div>
    <div class="card-body">
        <form action="{{route('update_headerlink')}}" method="post">
            @csrf
        <div class="alert alert-info">Links will maintain the order below in the frontend.</div>
        <div class="row">
            <div class="col-6"><h4>Left</h4></div>
            <div class="col-6 text-end"><button type="button" class="btn btn-outline-primary left_links">Add new link</button></div>
            <div class="col-12 m-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>URL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="respons_values_left">
                        @foreach($leftlist as $lf)
                        <tr id="first_tr">
                            <td><input type="text" name="title[]" class="form-control" value="{{$lf->title}}"></td>
                            <td><input type="text" name="url[]" class="form-control" value="{{$lf->url}}"></td>
                            <td>
                                <a href="{{route('header',$lf->id)}}" class="deletebtn"><i class="la la-trash"></i></a>
                            </td>
                            <input type="hidden" name="type[]" value="1">
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <!-- RIGHT -->

        <div class="row mt-3">
            <div class="col-6"><h4>Right</h4></div>
            <div class="col-6 text-end"><button type="button" class="btn btn-outline-primary right_links">Add new link</button></div>
            <div class="col-12 m-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>URL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="respons_values_right">
                        @foreach($rightlist as $rg)
                        <tr>
                            <td><input type="text" class="form-control" name="title[]" value="{{$rg->title}}"></td>
                            <td><input type="text" class="form-control" name="url[]" value="{{$rg->url}}"></td>
                            <td>
                                <a href="{{route('header',$rg->id)}}" class="deletebtn"><i class="la la-trash"></i></a>
                            </td>
                            <input type="hidden" name="type[]" value="2">
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-end">
                <button class="btn btn-primary">Save</button>
            </div>
        </div>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(function(){
        var i = 1;
        var remove = 1;
        $('.left_links').on('click',function(){
            $('#respons_values_left').append(
                '<tr id="extra_'+ i++ +'">'+
               '<td><input type="text" class="form-control"  name="title[]"></td>'+
               '<td><input type="text" class="form-control" name="url[]"></td>'+
                '<td>'+
                    '<a href="javascript::void()" onclick="remove('+remove++ +')" class="deletebtn"><i class="la la-trash"></i></a>'+
                '</td>'+
                '<input type="hidden" name="type[]" value="1">'+
                '</tr>'
            );
        });

        var rt = 1;
        var remove_rt = 1;

        $('.right_links').on('click',function(){
            $('#respons_values_right').append(
                '<tr id="extra_right_'+ rt++ +'">'+
               '<td><input type="text" class="form-control"  name="title[]"></td>'+
               '<td><input type="text" class="form-control" name="url[]"></td>'+
                '<td>'+
                    '<a href="javascript::void()" onclick="remove_rt('+remove_rt++ +')" class="deletebtn"><i class="la la-trash"></i></a>'+
                '</td>'+
                '<input type="hidden" name="type[]" value="2">'+
                '</tr>'
            );
        });

        

    })

    function remove(id){
        $('#extra_'+id).remove();
    }

    function remove_rt(id){
        $('#extra_right_'+id).remove();
    }
</script>
@endsection