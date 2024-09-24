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
        <div class="card-header"><h5 class="card-title">Category form</h5></div>
        <div class="card-body">
            <form action="{{route('createCategories')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-6 mb-3 d-flex align-items-center">
                    <div id="resultImage_box"></div>
                    <input type="file" name="file" id="showFolder">
                    <label for="showFolder" class="showFolder">Choose file</label>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Title</label>
                    <input type="text" placeholder="Title" name="title" class="form-control">
                    @if($errors->has('title'))
                    <small class="text-danger">{{ $errors->first('title') }}</small>
                    @endif
                </div>
                <div class="col-3 mb-3">
                    <label for="">Sub category</label>
                    <select name="sub_cat_id" class="form-control" id="">
                        <option value="">--------</option>
                        @foreach($cats as $ct)
                        <option value="{{$ct->id}}">{{$ct->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Slug</label>
                    <input type="text" placeholder="Slug" name="slug" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="">Meta title</label>
                    <input type="text" placeholder="Meta title" name="meta_title" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="">Meta description</label>
                    <textarea name="meta_description" class="form-control" placeholder="Meta description" cols="10" rows="5"></textarea>
                </div>
                <div class="col-3 mb-3">
                    <label for="">Featured</label>
                    <select name="featured" class="form-control" id="">
                        <option value="2">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="col-3 mb-3">
                    <label for="">Show in footer</label>
                    <select name="in_footer" class="form-control" id="">
                        <option value="1">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="col-3 mb-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="1">Public</option>
                        <option value="2">Private</option>
                    </select>
                </div>
                <div class="col-12 mb-3 text-end">
                    <button class="btn btn-success">Save All</button>
                </div>
            </div>
            </form>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function(){
        $('#showFolder').change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e){
                $('#resultImage_box').html('<img src="'+e.target.result+'" alt="Uploaded Image">');
            }
            reader.readAsDataURL(file);
        });

        $('input[name=title]').keyup(function(){
            var metaTitile = $(this).val();

            
            var slug = $(this).val();
            var trimmed = $.trim(slug);
            slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
            $('input[name=slug]').attr('value',slug).css("text-transform","lowercase")
            $('input[name=meta_title]').attr('value',metaTitile)
        })
    })
</script>
@endsection