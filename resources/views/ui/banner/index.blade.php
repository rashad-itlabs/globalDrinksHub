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
        <div class="table-responsive">
            <table class="table banner-table" id="attributes-table">
                <thead>
                    <tr>
                        <th style="" >image</th>
                        <th>Type</th>
                        <th>Slug</th>
                        <th>Closable</th>
                        <th>Status</th>
                        <th>Source type</th>
                        <th style="" data-orderable="false">Actions</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($list as $ls)
                   @php 
                    if($ls->source_type==1){
                        $source = 'Categories';
                    }elseif($ls->source_type==3){
                        $source = 'Tags';
                    }elseif($ls->source_type==4){
                        $source = 'Brands';
                    }elseif($ls->source_type==5){
                        $source = 'Products';
                    }elseif($ls->source_type==6){
                        $source = 'URL';
                    }        

                    
                   if($ls->type==1){
                        $type = 'Beside featured brands';
                    }elseif($ls->type==2){
                        $type = 'Bottom of flash sale section';
                    }elseif($ls->type==3){
                        $type = 'Bottom of flash sale section';
                    }elseif($ls->type==4){
                        $type = 'Bottom of flash sale section';
                    }elseif($ls->type==5){
                        $type = 'Top of daily discover';
                    }elseif($ls->type==6){
                        $type = 'Bottom of daily discover';
                    }elseif($ls->type==7){
                        $type = 'Detail page(beside rating)';
                    }elseif($ls->type==8){
                        $type = 'Top banner';
                    }elseif($ls->type==9){
                        $type = 'Popup banner';
                    }
                    @endphp
                   <tr>
                    <td>
                        <img width="250" class="lazy-img" src="{{asset('uploads/'.$ls->image)}}" alt="">
                    </td>
                    <td>{{$type}}</td>
                    <td>{{$ls->slug}}</td>
                    <td>{{$ls->closable==1?'Yes':'No'}}</td>
                    <td>
                        @if($ls->status==1)
                        <span class="badge bg-success">PUBLIC</span>
                        @else
                        <span class="badge bg-danger">PRIVATE</span>
                        @endif
                    </td>
                    <td>{{$source}}</td>
                    <td>
                        <a href="{{route('banner',$ls->id)}}" class="litebtn">Edit</a>
                    </td>
                   </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('#attributes-table').DataTable({
    ordering:false
});
</script>
@endsection