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
        <div class="card-header"><h5 class="card-title">Admin/vendor form</h5></div>
        <div class="card-body">
            <form action="{{route('create_admins')}}" method="post">
                @csrf 
                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{old('name')}}">
                    @error('name')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{old('username')}}">
                    @error('username')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{old('phone')}}">
                    @error('phone')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                    @error('email')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    @error('password')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Confirm password</label>
                    <input type="password" name="re_password" class="form-control" placeholder="Confirm password">
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Role</label>
                            <select name="role_id" class="form-control" id="role">
                                <option value="1">superadmin</option>
                                <option value="2">vendor</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="">Active</label>
                    <input type="checkbox" name="active" value="1" class="">
                </div>
                <div class="form-group mb-3">
                    <label for="">Verified</label>
                    <input type="checkbox" name="verified" value="1" class="">
                </div>
                <div class="person">
                    <div class="form-group mb-3">
                        <label for="">Commission (%)</label>
                        <input type="text" name="comission" class="form-control" placeholder="Commission (%)">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success">Save and back</button>
                </div>
            </form>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(function(){
        $('#role').on('change',function(){
            var _value = $(this).val();
            if(_value==2){
                $('.person').fadeIn();
            }else{
                $('.person').fadeOut();
            }
        })
    })
</script>
@endsection