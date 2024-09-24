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
        <div class="card-header"><h5 class="card-title">Page form</h5></div>
        <div class="card-body">
            <form action="{{route('update_pages')}}" method="post">
                @csrf 
                <div class="form-group mb-3">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control" value="{{$page->title}}">
                </div>
                <div class="form-group mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{$page->slug}}">
                </div>
                <div class="form-group mb-3">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <label for="">Page from component</label>
                        </div>
                        <div class="col-3">
                            <select name="from_component" class="formcontrol" id="from_component">
                                <option value="1" {{($page->page_from_component==1?'selected':'')}}>Yes</option>
                                <option value="2" {{($page->page_from_component==2?'selected':'')}}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 _add_field">
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <label for="">Component</label>
                        </div>
                        <div class="col-3">
                            <select name="page_from_component" class="formcontrol" id="">
                                <option value="1" {{($page->description=='Contact'?'selected':'')}}>Contact</option>
                                <option value="2" {{($page->description=='Sitemap'?'selected':'')}}>Sitemap</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 for_description">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" id="editor">{!! $page->description !!}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="">Meta title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{$page->meta_title}}">
                </div>
                <div class="form-group mb-3">
                    <label for="">Meta description</label>
                    <textarea name="meta_description" class="form-control">{{$page->meta_description}}</textarea>
                </div>
                <div class="form-group mb-3 text-end">
                    <input type="hidden" name="id" value="{{$page->id}}">
                    <button class="btn btn-success">Update Information</button>
                </div>
            </form>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
    });


    $(function(){
        var cn = "{{$page->page_from_component}}";
        if(cn==2){
            $('._add_field').hide();
                $('.for_description').show();
        }else{
            $('._add_field').show();
                $('.for_description').hide();
        }

        $('#from_component').on('change',function(){
            var _value = $(this).val();
            if(_value=='1'){
                $('._add_field').show();
                $('.for_description').hide();
            }else{
                $('._add_field').hide();
                $('.for_description').show();
            }
        })


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