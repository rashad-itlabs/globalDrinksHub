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
	<div class="card-header"><h5 class="card-title">Language form</h5></div>
	<div class="card-body">
		<form action="{{route('change_language')}}" method="post">
			@csrf
			<table border='0' class="table">
				<tr>
					<td width="100">Language</td>
					<td>
						<div class="row">
							<div class="col-3">
								<select name="name" class="formcontrol" id="">
									<option value="{{$list->name}}">{{$list->name}}</option>
								</select>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Code</td>
					<td>
						<input type="text" name="code" class="form-control" value="{{$list->code}}">
					</td>
				</tr>
				<tr>
					<td>Direction</td>
					<td>
						<div class="row">
							<div class="col-3">
								<select name="direction" class="formcontrol" id="">
									<option value="ltr" {{($list->direction=='ltr'?'selected':'')}}>LTR</option>
									<option value="rtl" {{($list->direction=='rtl'?'selected':'')}}>RTL</option>
								</select>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Default</td>
					<td>
						<div class="row">
							<div class="col-3">
								<input type="checkbox" {{($list->default==1?'checked':'')}} name="default" id="">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>
						<div class="row">
							<div class="col-3">
								<select name="status" class="formcontrol" id="">
									<option value="1" {{($list->status==1?'checked':'')}}>Public</option>
									<option value="2" {{($list->status==2?'checked':'')}}>Private</option>
								</select>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="id" value="{{$list->id}}">
						<button class="btn btn-success">Save All</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>

@endsection