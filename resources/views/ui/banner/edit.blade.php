@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('assets/css/')}}/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.css">
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')
<div class="card">
    <div class="card-header"><h5 class="card-title">Banner form</h5></div>
    <div class="card-body">
        <form action="" method="post">
            @csrf 
            <div class="row">
                <div class="col-6 mb-3 d-flex align-items-center">
                    <div id="resultImage_box"><img src="{{asset('uploads/'.$list->image)}}" alt=""></div>
                    <input type="file" name="file" id="showFolder">
                    <label for="showFolder" class="showFolder">Choose file</label>
                </div>
                <div class="col-12 mb-3">
                    <label for="">Title</label>
                    <input type="text" placeholder="Title" name="title" class="form-control" value="{{ $list->title }}">
                </div>
                <div class="col-12 mb-3">
                    <label for="">Slug</label>
                    <input type="text" placeholder="Slug" name="slug" class="form-control" value="{{ $list->slug }}">
                </div>
                <div class="col-3 mb-3">
                    <div class="col-12"><label for="">Source type</label></div>
                    <select name="featured" class="" id="sourcetype">
                        <option value="1" {{($list->source_type==1?'selected':'')}}>Categories</option>
                        <option value="3" {{($list->source_type==3?'selected':'')}}>Tags</option>
                        <option value="4" {{($list->source_type==4?'selected':'')}}>Brands</option>
                        <option value="5" {{($list->source_type==5?'selected':'')}}>Products</option>
                        <option value="6" {{($list->source_type==6?'selected':'')}}>Url</option>
                    </select>
                </div>


                <!-- static -->


                <div class="col-12 mb-4 enable" id="_for_brand">
                    <div class="row">
                        <div class="col-6"><label for="">Brand</label></div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-outline-primary">Add new brend</button>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($source as $sr)
                        <div class="col-3">
                            <div class="input-group">
                                <select name="featured" class="formcontrol" id="">
                                    @foreach($brands as $br)
                                        <option value="{{$br->id}}" {{($br->id==$sr->brand_id?'selected':'')}}>{{$br->title}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btndanger"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 mb-4 disable" id="_for_category">
                    <div class="row">
                        <div class="col-6"><label for="">Category</label></div>
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-outline-primary">Add new category</button>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($source as $sr)
                        <div class="col-3">
                            <select name="featured" class="formcontrol" id="">
                                @foreach($category as $cr)
                                    <option value="{{$br->id}}" {{($cr->id==$sr->brand_id?'selected':'')}}>{{$cr->title}}</option>
                                @endforeach
                            </select>
                            <button class="btn btndanger"><i class="fa-solid fa-xmark"></i></button>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 mb-4 disable" id="_for_url">
                    <div class="col-12 mt-3 mb-3">
                        <div class="alert alert-info">Please put internal URL here. eg. producturl</div>
                    </div>
                    <label for="">Url</label>
                    <input type="text" class="form-control" placeholder="url">
                </div>

                <div class="col-12 mb-4 disable" id="_for_tag">
                    <label for="">Tags</label>
                    <input type="text" class="form-control" placeholder="Write here">
                </div>

                <div class="col-12 mb-4 disable" id="_for_products">
                    <label for="">Tags</label>
                    <input type="text" class="form-control" placeholder="Write here">
                </div>


                <!-- end static -->
                <p></p>
                <div class="col-3 mb-3">
                    <div class="col-12"><label for="">Status</label></div>
                    <select name="featured" class="formcontrol" id="">
                        <option value="1" {{($list->status==1?'selected':'')}}>Public</option>
                        <option value="2" {{($list->status==1?'selected':'')}}>Private</option>
                    </select>
                </div>
                <div class="col-12"></div>
                <div class="col-3 mb-3">
                    <div class="col-12"><label for="">Closable</label></div>
                    <select name="featured" class="formcontrol" id="">
                        <option value="1" {{($list->closable==1?'selected':'')}}>Yes</option>
                        <option value="2" {{($list->closable==2?'selected':'')}}>No</option>
                    </select>
                </div>

                <div class="col-12 mt-3 mb-3 text-end">
                    <button name="save_edit" class="btn btn-success">Save and Edit</button>
                    <button name="save_back" class="btn btn-success">Save all</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>

$(function(){
    var src_type = "{{$list->source_type}}";

    // if(src_type==6){
    //     $('#_for_url').show();
    //     $('#_for_tag').hide();
    //     $('#_for_brand').hide(); 
    // }

    $('#sourcetype').on('change',function(){
        var _val = $(this).val();
        if(_val==1){
            $('#_for_url').hide();
            $('#_for_tag').hide();
            $('#_for_products').hide();
            $('#_for_brand').hide();
            $('#_for_category').show();
        }else if(_val==3){
            $('#_for_url').hide();
            $('#_for_tag').show();
            $('#_for_brand').hide();
            $('#_for_products').hide();
            $('#_for_category').hide();
        }else if(_val==4){
            $('#_for_url').hide();
            $('#_for_tag').hide();
            $('#_for_brand').show(); 
            $('#_for_products').hide();
            $('#_for_category').hide();
        }else if(_val==5){
            $('#_for_url').hide();
            $('#_for_tag').hide();
            $('#_for_brand').hide(); 
            $('#_for_products').show();
            $('#_for_category').hide();
        }else if(_val==6){
            $('#_for_url').show();
            $('#_for_tag').hide();
            $('#_for_brand').hide(); 
            $('#_for_products').hide();
            $('#_for_category').hide();
        }
    })

    
})


$(function(){
    $('select').niceSelect();
})
</script>

@endsection
