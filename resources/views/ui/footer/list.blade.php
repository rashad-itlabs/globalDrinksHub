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
    <div class="card-header"><h4 class="card-title">Footer</h4></div>
    <div class="card-body">
        <div class="alert alert-info">Links will maintain the order below in the frontend.</div>
        <div class="row">
            <div class="col-6">
                <h4>Servives links</h4>
                <div class="formgroup">
                @foreach($services as $sr)
                <div class="listitem">
                    <select width="120" name="" id="" class="formcontrol">
                        @foreach($pages as $pg)
                        <option {{($sr->page_id==$pg->id ? 'selected':'')}} value="{{$pg->id}}">{{$pg->title}}</option>
                        @endforeach
                    </select>
                    <a href="" class="btndanger"><i class="la la-trash"></i></a>
                </div>
                @endforeach
                </div>
            </div>
            <div class="col-6 text-end">
                <h4>About links</h4>
                <div class="formgroup">
                @foreach($aboutes as $abs)
                <div class="listitem">
                    <select width="120" name="" id="" class="formcontrol">
                        @foreach($pages as $pg)
                        <option {{($abs->page_id==$pg->id ? 'selected':'')}} value="{{$pg->id}}">{{$pg->title}}</option>
                        @endforeach
                    </select>
                    <a href="" class="btndanger"><i class="la la-trash"></i></a>
                </div>
                @endforeach
                </div>
            </div>
            <div class="col-12 mt-4 text-end">
                <button class="btn btn-primary">Save All</button>
            </div>
        </div>
    </div>
</div>


@endsection