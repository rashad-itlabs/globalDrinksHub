@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('assets/css/')}}/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
<div class="header" style="">
	<div class="rows">
		<div class="col-6"></div>
		<div class="col-6 text-end d-flex justify-content-end align-conten-center">
			<a href="">Profile</a>
			<a href="">Message</a>
		</div>
	</div>
</div>
@section('content')

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="attributes-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Voucher codelug</th>
                        <th>Price($)</th>
                        <th>Capped price($)</th>
                        <th>Min spent($)</th>
                        <th>
                            <span>Usage limit</span>
                            <span>(Order)</span>
                        </th>
                        <th><span>Limit per</span><span>customer(Order)</span></th>
                        <th>Status</th>
                        <th style="width:155% !important" data-orderable="false">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($v_list as $ls)
                    <tr>
                        <td>{{$ls->title}}</td>
                        <td>{{$ls->code}}</td>
                        <td>{{$ls->price}} {{ ($ls->type==1?'$':'%') }}</td>
                        <td>{{ ($ls->capped_price==Null?'N/A':$ls->capped_price) }}</td>
                        <td>{{$ls->min_spend}}</td>
                        <td>{{$ls->usage_limit}}</td>
                        <td>{{$ls->limit_per_customer}}</td>
                        <td>
                            @if($ls->status==1)
                            <span class="badge bg-success">PUBLIC</span>
                            @else
                            <span class="badge bg-danger">PRIVATE</span>
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn btn-sm btn-link"><i class="la la-edit"></i> Edit</a>
                            <a href="" class="btn btn-sm btn-link"><i class="la la-trash"></i> Delete</a>
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
$('#attributes-table').DataTable();
</script>
@endsection