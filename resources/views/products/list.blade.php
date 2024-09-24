@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('public/assets/css/')}}/style.css?v=7">
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
@if(Session::has('error'))
<div class="alert alert-danger">{{session('error')}}</div>
@endif
<div class="card">
    <div class="card-header">
        <div class="row w-100">
            <div class="col-md-12">
                <a href="{{route('create_product')}}" class="btn btn-primary">Add new product</a>
                <a href="{{route('exportProduct_xlsx')}}" class="btn btn-success">Export Excel</a>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="filterBox">
            <form action="" method="get">
                @csrf
            <div class="row">
                <div class="col-2">
                    <select name="status" class="form-select" id="">
                        <option value="">Product status</option>
                        <option value="1" {{Request::get('status') == '1' ? 'selected':''}}>Public</option>
                        <option value="2" {{Request::get('status') == '2' ? 'selected':''}}>Private</option>
                    </select>
                </div>
                @if(backpack_user()->id==1)
                <div class="col-2">
                    <select name="admin_id" class="form-select" id="">
                        <option value="">Select User Email</option>
                        @foreach($users as $us)
                        <option value="{{$us->id}}" {{Request::get('admin_id') == $us->id ? 'selected':''}}>{{ $us->email }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-2">
                    <select name="cats_id" class="form-select" id="cats_id">
                        <option value="">Select Categories</option>
                        @foreach($categories as $ct)
                        <option value="{{$ct->id}}" {{Request::get('cats_id') == $ct->id ? 'selected':''}}>{{ $ct->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <select name="sub_cats_id" class="form-select" id="prim_id">
                        <option value="">Select Sub Categories</option>
                    </select>
                </div>
                <div class="col-2">
                    <select name="brand_id" class="form-select" id="">
                        <option value="">Select Brands</option>
                        @foreach($brands as $br)
                        <option value="{{$br->id}}" {{Request::get('brand_id') == $br->id ? 'selected':''}}>{{ $br->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary w-100"><i class="la la-search"></i>&nbsp; Filter</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="attributes-table">
                <thead>
                    <tr>
                        <th style="width:155% !important" >Title</th>
                        <th>Creator</th>
                        <th>Company name</th>
                        <th>Status</th>
                        <th>Brand</th>
                        <th>Categories</th>
                        <th>Price($)</th>
                        <th>Selling($)</th>
                        <th>Created</th>
                        <th style="width:155% !important" data-orderable="false">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $ls)
                    <tr style="background:{{ $ls->proStatus==2 ? '#ff919133':''}} {{$ls->proStatus==7 ? '#ebebeb':''}}">
                        <td style="display: flex;align-items: center;">
                            @if($ls->proImage=='')
                            <img witdh="50" height="70" style="object-fit:cover" src="{{asset('public/uploads/thumb-default-image.webp')}}" alt="" id="image">
                            @else 
                            <img witdh="50" height="70" style="object-fit:cover" src="{{asset('uploads')}}/{{$ls->proImage}}" alt="" id="image">
                            @endif
                            {{Str::limit($ls->proName, 50)}}
                        </td>
                        <td>
                            {{$ls->name}} {{$ls->username}}
                        </td>
                        <td>
                            {{$ls->company_name}}
                        </td>
                        <td>
                            @if($ls->proStatus==1)
                            <span class="badge bg-success">PUBLIC</span>
                            @elseif($ls->proStatus==7)
                            <span class="badge bg-warning">Rejected</span>
                            @else 
                            <span class="badge bg-danger">Private</span>
                            @endif
                        </td>
                        <td><a href="">{{$ls->brandName}}</a></td>
                        <td>
                        {{$ls->ctTitle}}
                        </td>
                        <td>{{$ls->purchased}}</td>
                        <td>{{$ls->selling}}</td>
                        <td>{{ date('d M Y', strtotime($ls->created_at)) }}</td>
                        <td style="">
                            @if(backpack_user()->id==1)
                                @if($ls->proStatus!=7)
                                    <a href="{{route('edit_product', $ls->proID)}}" class="litebtn">Edit</a>
                                @endif
                            @endif
                            @if(backpack_user()->id!=1)
                                <a href="{{route('edit_product', $ls->proID)}}" class="litebtn">Edit</a>
                            @endif
                            <a href="{{route('delete_product', $ls->proID)}}" class="deletebtn">Delete</a>
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
    ordering:false,
});
$(function(){
    setTimeout(function(){
        $('.alert-success').fadeOut();
    }, 1500);

    $('#cats_id').on('change',function(){
        var catID = $(this).val();
        $.ajax({
            url:"{{route('load_primary_categories')}}",
            method:'GET',
            data:{'catid':catID},
            success:function(response){
                $('#prim_id').html(response);
            }
        })
    });


})

</script>
@endsection