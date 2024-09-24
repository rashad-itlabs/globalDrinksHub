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
    <div class="card-header">
        <a href="" class="btn btn-primary">Add custom script</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px"><input type="checkbox" name="" id=""></th>
                    <th>Route param</th>
                    <th>Status</th>
                    <th width="50">Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($list as $ls)
               <tr>
                <td><input type="checkbox"></td>
                <td>{{$ls->route_pattern}}</td>
                <td>
                    @if($ls->status==1)
                    <span class="badge bg-success">PUBLIC</span>
                    @else 
                    <span class="badge bg-danger">PRIVATE</span>
                    @endif
                </td>
                <td>
                    <a href="" class="deletebtn">Delete</a>
                </td>
               </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection