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

<div class="alert alert-info">Important: We have used an advance caching system. If you change anything in the admin panel, please, make sure to clear the cache from here. Setting > Clear cache.</div>
<div class="image-container">
    @foreach ($files as $file)
    <div class="card" id="clone-{{$file->getFilename()}}">
        <img src="{{'https://globaldrinkshub.com/uploads/'.$file->getFilename()}}" height="50" width="50" alt="">
        <button onclick="remove('{{$file->getFilename()}}')">✖</button>
    </div>
    @endforeach
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function remove(title){
        $('#clone-'+title).fadeOut();
        $.ajax({
            url:"{{route('remove_images')}}",
            method:'POST',
            data:{'title':title},
            success:function(response){
                alert(response);
                window.location.reload();
            }
        })
    }
</script>
@endsection