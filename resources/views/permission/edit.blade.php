@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('assets/css/')}}/style.css">
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
    <div class="card">
        <div class="card-header"><h4 class="card-title">Roles permissions form</h4></div>
        <div class="card-body">
            <form action="">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" value="{{$role->name}}">
                </div>
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="permissions">
                            <table class="table" style="font-size: 12px;">
                                <thead>
                                @foreach($permissions as $pr)
                                  <tr>
                                    <td>
                                        <input type="checkbox">
                                        <label for="">{{ucfirst($pr->group_name)}}</label>
                                    </td>
                                    <td>
                                        <input type="checkbox">
                                        <label for="">Wiew</label>
                                    </td>
                                    <td>
                                        <input type="checkbox">
                                        <label for="">Create</label>
                                    </td>
                                    <td>
                                        <input type="checkbox">
                                        <label for="">Edit</label>
                                    </td>
                                    <td>
                                        <input type="checkbox">
                                        <label for="">Delete</label>
                                    </td>
                                  </tr>
                                  
                                @endforeach
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 mt-3 text-end">
                        <button class="btn btn-success">Save all</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection