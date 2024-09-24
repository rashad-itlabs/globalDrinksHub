@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('public/assets/css/')}}/style.css?v=1">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')

<div class="main-slider">
    <div class="left">
        <div class="carousel">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                @php
                    $slide = 1;
                    $slideto = 0;
                    $active = 0
                @endphp
                @foreach($slider as $sl)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$slideto++}}" class="{{ ($active++ ==0 ? 'active':'') }}" aria-current="true" aria-label="Slide {{$slide++}}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($slider as $sl)
                    <div class="carousel-item {{ ($sl->id==1 ? 'active':'') }}">
                        <img src="https://globaldrinkshub.com/uploads/{{$sl->image}}" class="d-block w-100" title="{{$sl->titles}}">
                        <div class="btn-wrapper">
                            <a href="javascript::void" data-bs-toggle="modal" data-bs-target="#addSlide" class="btn btn-primary"><i class="la la-plus"></i>&nbsp; Add New Slide</a>
                            <a href="{{ route('edit',$sl->id) }}" class="btn btn-primary">Edit</a>
                            <a href="" class="btn btn-primary">Delete</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>

        </div>
    </div>
</div>



@endsection

<!-- Modal -->
<div class="modal fade" id="addSlide" tabindex="1" aria-labelledby="addSlideLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{route('add_slider')}}" method="post" enctype="multipart/form-data">
        @csrf 
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="addSlideLabel">Slider Form</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <input type="file" name="file" class="form-control" id="">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success">Save changes</button>
        </div>
        </div>
    </form>
  </div>
</div>