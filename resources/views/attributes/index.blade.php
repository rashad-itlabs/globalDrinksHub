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
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   <div class="card">
    <div class="card-header">
        <a href="{{route('store_attribute')}}" class="btn btn-primary">Add attribute</a>
    </div>
    <div class="card-body">
    <div class="table-responseive">
   <table id="attributes-table" class="table">
       <thead>
            <tr>
                <th>Title</th>
                <th>Attribute values</th>
                <th>Created date</th>
                <th data-orderable="false">Actions</th>
            </tr>
       </thead>
       
        @foreach($attributes as $ats)
            <tr>
                <td>{{$ats->title}}</td>
                <td>
                @foreach($values as $vl)
                    @if($ats->id==$vl->attribute_id)
                    <span class="badge bg-info">{{$vl->title}}</span>
                    @endif
                @endforeach
                </td>
                <td>{{$ats->created_at}}</td>
                <td>
                    <a href="{{route('attributes',$ats->id)}}" class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                    <a href="{{route('delete_attribute',$ats->id)}}" class="btn btn-sm btn-link"><i class="la la-trash"></i> Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
   </div>
    </div>
   </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('#attributes-table').DataTable();
</script>

@endsection





