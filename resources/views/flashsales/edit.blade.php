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
    <div class="card-header">
        <h4 class="card-title">Flash sale form</h4>
    </div>
    <div class="card-body">
        <form action="">
            @csrf 
            <div class="form-group mb-2">
                <label for="">Title</label>
                <input type="text" class="form-control" value="{{$listsales->title}}">
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group mb-2">
                        <label for="">Start time</label>
                        <input type="date" class="form-control" value="{{date('Y-m-d', strtotime($listsales->start_time)) }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group mb-2">
                        <label for="">End time</label>
                        <input type="date" class="form-control" value="{{date('Y-m-d', strtotime($listsales->end_time)) }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group mb-2">
                        <label for="">Status</label>
                        <select name="" class="form-control" id="">
                            <option value="1" {{($listsales->status==1?'selected':'')}}>Public</option>
                            <option value="2" {{($listsales->status==2?'selected':'')}}>Private</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group mb-2">
                        <label for="">Search product</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <table class="table" style="font-size:14px">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Price($)</th>
                                <th>Offered($)</th>
                                <th>Sale price($)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salesProduct as $ls)
                            <tr>
                                <td>
                                    <img src="{{asset('uploads/'.$ls->products->image)}}" alt="" id="prod">
                                    {{$ls->products->title}}
                                </td>
                                <td>{{$ls->products->selling}}$</td>
                                <td>{{$ls->products->offered}}$</td>
                                <td>
                                    <input type="number" class="form-control" style="width:100px" value="{{$ls->price}}">
                                </td>
                                <td>
                                    <a href="" class="deletebtn">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-end">
                    <button class="btn btn-primary">Save All</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection