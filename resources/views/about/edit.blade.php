@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('assets/css/')}}/style.css?v=5">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h4>About Us</h4>
                </div>
                <form action="{{route('updateOperation')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="about" id="editor_description">{{$about->about}}</textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Update query</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script>
    ClassicEditor
        ClassicEditor
        .create( document.querySelector( '#editor_description' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection