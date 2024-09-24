@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('public/assets/css/')}}/style.css">
<link rel="stylesheet" href="{{asset('vendor/backpack/theme-tabler/resources/assets/css/style.css?v=12')}}">
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')

@section('after_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'after_breadcrumbs')->toArray() ])
@endsection

@section('before_content_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_content')->toArray() ])
@endsection

@section('content')
	@php 

		if(backpack_user()->id==1){
			$prod = App\Models\Products::count();
			$user = App\Models\Users::count();
			$order = App\Models\Orders::count();
			$sells = App\Models\Orders::sum('total_amount');
			$pending = App\Models\Orders::where('status',1)->count();
			$cancelled = App\Models\Orders::where('status',1)->count();
			$confirmed  = App\Models\Orders::where('status',1)->count();
			$delivered = App\Models\Orders::where('status',5)->count();
			$theway = App\Models\Orders::where('status',1)->count();

		}else{
			
			$prod = App\Models\Products::where('admin_id',Auth::user()->id)->count();
			$order = App\Models\Orders::where('user_id',Auth::user()->id)->count();
			$user = App\Models\Users::where('id',Auth::user()->id)->count();
			$sells = App\Models\Orders::where('user_id',Auth::user()->id)->sum('total_amount');
			$pending = App\Models\Orders::where('status',1)->where('user_id',Auth::user()->id)->count();
			$cancelled = App\Models\Orders::where('status',1)->where('user_id',Auth::user()->id)->count();
			$confirmed  = App\Models\Orders::where('status',1)->where('user_id',Auth::user()->id)->count();
			$delivered = App\Models\Orders::where('status',5)->where('user_id',Auth::user()->id)->count();
			$theway = App\Models\Orders::where('status',1)->where('user_id',Auth::user()->id)->count();
		}

		
		
	@endphp


<div class="row">
	<div class="col-3">
		<div class="card text-bg-primary">
			<div class="card-body">
			<div class="d-flex align-items-center">
				<div class="subheader"><h4>Total Products</h4></div>
			</div>
			<div class="h1 mb-3">{{$prod}}</div>
			<div class="progress progress-sm">
				<div class="progress-bar bg-success" style="width: {{$prod}}%" role="progressbar" aria-valuenow="{{$prod}}" aria-valuemin="0" aria-valuemax="100" aria-label="{{$prod}}% Complete">
				<span class="visually-hidden">{{$prod}}% Complete</span>
				</div>
			</div>
			</div>
		</div>
	</div>
	@if(backpack_user()->id==1)
	<div class="col-3">
		<div class="card text-bg-danger">
			<div class="card-body">
			<div class="d-flex align-items-center">
				<div class="subheader"><h4>Total Users</h4></div>
			</div>
			<div class="h1 mb-3">{{$user}}</div>
			<div class="progress progress-sm">
				<div class="progress-bar bg-primary" style="width: {{$user}}%" role="progressbar" aria-valuenow="{{$user}}" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
				<span class="visually-hidden">{{$user}}% Complete</span>
				</div>
			</div>
			</div>
		</div>
	</div>
	@endif
	<div class="col-3">
		<div class="card">
			<div class="card-body text-bg-warning">
			<div class="d-flex align-items-center">
				<div class="subheader"><h4>Total Orders</h4></div>
			</div>
			<div class="h1 mb-3">{{$order}}</div>
			<div class="progress progress-sm">
				<div class="progress-bar bg-primary" style="width: {{$order}}%" role="progressbar" aria-valuenow="{{$order}}" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
				<span class="visually-hidden">{{$order}}% Complete</span>
				</div>
			</div>
			</div>
		</div>
	</div>

	<div class="col-3">
		<div class="card">
			<div class="card-body text-bg-success">
			<div class="d-flex align-items-center">
				<div class="subheader"><h4>Total Sells</h4></div>
			</div>
			<div class="h1 mb-3">${{$sells}}</div>
			<div class="progress progress-sm">
				<div class="progress-bar bg-danger" style="width: 5%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
				<span class="visually-hidden">5% Complete</span>
				</div>
			</div>
			</div>
		</div>
	</div>

 	<!-- chart -->
</div>
@if(backpack_user()->id==1)
<div class="row mt-3">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<h3 class="card-title">User Traffic</h3>
				<div>
					<canvas id="myChart"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
<!-- <div class="row mt-3">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<div>
					<canvas id="myChart"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<div>
					<canvas id="myChartTwo"></canvas>
				</div>
			</div>
		</div>
	</div>
</div> -->

<div class="row mt-4">
	<div class="col-4">
		<div class="card">
			<div class="card-body">
			<p>Order cancelled</p> <h3>0</h3>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-body">
			<p>Pending orders</p> <h3>{{$pending}}</h3>
			</div>
		</div>
	</div>
	<div class="col-4">
		<div class="card">
			<div class="card-body">
			<p>Confirmed orders</p> <h3>0</h3>
			</div>
		</div>
	</div>
	<!--  ==================================== -->
	<div class="col-4 mt-3">
		<div class="card">
			<div class="card-body">
			<p>Package picked up</p> <h3>0</h3>
			</div>
		</div>
	</div>
	<div class="col-4 mt-3">
		<div class="card">
			<div class="card-body">
			<p>On the way</p> <h3>0</h3>
			</div>
		</div>
	</div>
	<div class="col-4 mt-3">
		<div class="card">
			<div class="card-body">
			<p>Delivered</p> <h3>{{$delivered}}</h3>
			</div>
		</div>
	</div>
</div>

<div class="row mt-4">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<p><strong>Top category</strong></p>
				<p><small>No think</small></p>
			</div>
		</div>
	</div>

	<div class="col-6">
		<div class="card">
			<div class="card-body">
				<p><strong>Top brand</strong></p>
				<p><small>No think</small></p>
			</div>
		</div>
	</div>
</div>

<div class="row mt-4">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<p><strong>Top products</strong></p>
				<p><small>No think</small></p>
			</div>
		</div>
	</div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('myChart');
  const ctxTwo = document.getElementById('myChartTwo');

const DATA_COUNT = 7;
const NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 100};

const plan_plan = [{label: "Yan"}, {label: "Feb",}]; 
  new Chart(ctx, {
    type: 'bar', // Use 'line' type for area chart
    data: {
        labels: ['September', 'October', 'November', 'December', 'January', 'February', 'March'],
        datasets: [{
            label: 'line',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: true, // Fill the area under the line
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Area color
            borderColor: 'rgba(75, 192, 192, 1)', // Line color
            borderWidth: 1
        }]
    },
  });



  new Chart(ctxTwo, {
    type: 'bar',
	background: '#38f',
    data: {
      labels: ['Yanuary','Feburary','March','April','May','June','July','August','September','October','November','December'],
      datasets: [{
        label: 'Orders earning',
        data: [],
		backgroundColor: ['green','red'],
        borderWidth: 1
      }]
    },
  });



</script>

@endsection