@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('public/assets/css/')}}/style.css">
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
        <div class="card-header"><h5 class="card-title">Admin/vendor form</h5></div>
        <div class="card-body">
            <form action="{{route('edit_admin')}}" method="post">
                @csrf 
                <div class="form-group mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$admin->name}}">
                    @error('name')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{$admin->username}}">
                    @error('username')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{$admin->phone}}">
                    @error('phone')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{$admin->email}}">
                    @error('email')
                        <small style="color:red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">You want change password</label>
                    <input type="checkbox" name="ch_password" value="1" id="ch_password">
                </div>
                <div class="res_password">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="">New Password</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Password">
                                @error('password')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-3">
                            <label for="">Role</label>
                            <select name="role_id" class="form-control" id="role">
                                <option value="1" {{($admin->role_id==1?'selected':'')}}>superadmin</option>
                                <option value="2" {{($admin->role_id==2?'selected':'')}}>vendor</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="">Active</label>
                    <input type="checkbox" {{($admin->active==1?'checked':'')}} name="active" value="1" class="">
                </div>
                <div class="form-group mb-3">
                    <label for="">Verified</label>
                    <input type="checkbox" {{($admin->verified==1?'checked':'')}} name="verified" value="1" class="">
                </div>
                <div class="person">
                    <div class="form-group mb-3">
                        <label for="">Commission (%)</label>
                        <input type="text" name="comission" class="form-control" placeholder="Commission (%)">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success">Save and back</button>
                    <input type="hidden" name="admin_id" value="{{$admin->id}}">
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

        $('#ch_password').on('change',function(){
            var _value = $(this).is(':checked');
            if(_value){
                $('.res_password').fadeIn();
            }else{
                $('.res_password').fadeOut();
            }
        })
    })
</script>
@endsection