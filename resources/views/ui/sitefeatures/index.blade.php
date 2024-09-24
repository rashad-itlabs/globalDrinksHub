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
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:50px"><input type="checkbox" name="" id=""></th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($features as $ft)
                <tr>
                    <td>
                        <input type="checkbox">
                    </td>
                    <td>
                        <img class="lazy-img mx-w-70x" src="{{asset('upload/'.$ft->image)}}" alt="">
                    </td>
                    <td>{!! $ft->detail !!}</td>
                    <td>
                        @if($ft->status==1)
                        <span class="badge bg-success">PUBLIC</span>
                        @else 
                        <span class="badge bg-danger">PRIVATE</span>
                        @endif
                    </td>
                    <td>{{date('d M Y', strtotime($ft->created_at))}}</td>
                    <td class="featrues-table">
                        <a href="" class="litebtn">Edit</a>
                        <a href="" class="deletebtn">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection