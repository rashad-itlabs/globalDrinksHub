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
    @if(Session::has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    <div class="card">
        <div class="card-header"><h5 class="card-title">Brand form</h5></div>
        <div class="card-body">
            <form action="{{route('update_brands')}}" method="post" id="frmAutoload" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-6 mb-3 d-flex align-items-center">
                    <div id="resultImage_box">
                        @if($list->image!='')
                        <img src="{{asset('uploads/'.$list->image)}}" alt="">
                        @endif
                    </div>
                    <input type="file" name="file" id="showFolder">
                    <label for="showFolder" class="showFolder">Choose file</label>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Title</label>
                    <input type="text" placeholder="Title" value="{{$list->title}}" name="title" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <div class="input-group">
                        <button type="button" class="btn btn-success" id="add_new_column">Add product name</button>
                    </div>
                </div>
                <div class="addProdName">
                    @php 
                    $i=1;
                    $r=1;
                    @endphp
                    @foreach($listProdName as $item)
                    <div class="col-12 mb-3" id="columns_{{$i++}}">
                        <input type="hidden" value="{{$item->id}}" name="brid[]">
                        <div class="input-group">
                            <img src="{{asset('uploads/'.$item->pr_image)}}" width="50px" alt="">
                            <input type="text" name="pr_name_edit[]" value="{{ $item->pr_name }}" class="form-control max-width=400" placeholder="Produc name">
                            <input type="hidden" name="old_pr_name_edit[]" value="{{ $item->pr_name }}" class="form-control max-width=400" placeholder="Produc name">
                            <input type="file" name="images" id="autoUpload" data-prod="{{$item->id}}" class="form-control">
                            <button type="button" class="btn btn-danger" data-title="{{$item->pr_name}}" data-prod-id="{{$item->id}}" data-ids="{{$r++}}" id="remove_column_php">Delete</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="newAtts">
                    <div class="attsBtn"></div>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Slug</label>
                    <input type="text" placeholder="Slug" name="slug" value="{{$list->slug}}" class="form-control">
                </div>
                <div class="col-3 mb-3">
                    <label for="">Featured</label>
                    <select name="featured" class="form-control" id="">
                        <option value="0" {{($list->featured==0?'selected':'')}}>No</option>
                        <option value="1" {{($list->featured==1?'selected':'')}}>Yes</option>
                    </select>
                </div>
                <div class="col12"></div>
                <div class="col-3 mb-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="1" {{$list->status==1?'selected':''}}>Public</option>
                        <option value="0" {{$list->status==2?'selected':''}}>Private</option>
                    </select>
                </div>
                <div class="col-12 mb-3 text-end">
                    <input type="hidden" value="{{$list->id}}" name="id">
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
        var br_id = $('input[name=id]').val();
        $('#showFolder').change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e){
                $('#resultImage_box').html('<img src="'+e.target.result+'" alt="Uploaded Image">');
            }
            reader.readAsDataURL(file);
        });

        $('input[name=title]').keyup(function(){
            var slug = $(this).val();
            var trimmed = $.trim(slug);
            slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
            replace(/-+/g, '-').
            replace(/^-|-$/g, '');
            $('input[name=slug]').attr('value',slug).css("text-transform","lowercase")
        });


        $i=1;
        $in=1
        $im=1
        $r=1;
        $s=1
        $('#add_new_column').on('click',function(){
            $('.addProdName').append(
                '<div class="col-12 mb-3" id="column_'+$i++ +'">'+
                    '<div class="input-group">'+
                        '<input type="text" id="pr_'+$in++ +'" name="pr_name[]" class="form-control max-width=400" placeholder="Produc name">'+
                        '<input type="file" id="images_auto" name="images[]" class="form-control image_'+$im++ +'">'+
                        '<button type="button" class="btn btn-danger" data-id="'+$r++ +'" id="remove_column">Delete</button>'+
                    '</div>'+
                '</div>'
            );
        });

        $(document).on('click', '#remove_column', function(){
            var id = $(this).attr('data-id');
            $('#column_'+id).remove();
            //$('#add_new_column').prop('disabled',false);
        })

        $(document).on('click', '#remove_column_php', function(){
            var id = $(this).attr('data-ids');
            var prod_id = $(this).attr('data-prod-id');
            var title = $(this).attr('data-title');
            if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url:"{{route('remove')}}",
                    method:'GET',
                    data:{'prod_id':prod_id,'title':title},
                    success:function(res){
                        alert(res);
                        $('#columns_'+id).remove();
                    }
                })
            } else {
                // User clicked Cancel, do nothing
                console.log("Deletion canceled.");
            }
            
        })


        $(document).on('change','#images_auto', function(){
            //$('#addOnly').prop('disabled',false)
        })

        $(document).on('click','#addOnly',function(){
            
            var id = $(this).attr('data-id_save');
            var fileValue = $('.image_'+id)[0].files[0];
            var in_value = $('input#pr_'+id).val();
            var formData = new FormData();
            alert(fileValue);
            formData.append('br_id',br_id);
            formData.append('in_value',in_value);
            formData.append('images', fileValue);
            $.ajax({
                url:"{{route('addOnly')}}",
                method:'POST',
                data: formData,
                processData: false,
                contentType: false,
                success:function(res){
                    alert(res);
                    //window.location.reload();
                    $('button#addOnly').hide();
                    $('button#remove_column').hide();
                    $('#add_new_column').prop('disabled',false);
                }
            })
        })
       
        $('input#autoUpload').change(function(){
            var id = $(this).attr('data-prod');
            var fileValue = $(this)[0].files[0];
            var formData = new FormData();
            formData.append('brid',id);
            formData.append('images', fileValue);
            $.ajax({
                url:"{{route('autouploadImage')}}",
                method:'POST',
                data: formData,
                processData: false,
                contentType: false,
                success:function(res){
                    alert(res)
                }
            })
        })

    })
</script>
@endsection