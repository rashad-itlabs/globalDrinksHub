@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('assets/css/')}}/style.css?v={{time()}}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')

    <form action="{{route('create_products')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        </div>
        <div class="col-8">
            @if(Session::has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <div class="card">
                <div class="card-header"><h4 class="card-title">Product form</h4></div>
                <div class="card-body">
                        @csrf 
                        <div class="row">
                            @if(backpack_user()->id!=1)
                            <div class="col-12 mb-3">
                                <input type="checkbox" name="empty_values" id="empty_values">
                                <label for="empty_values">I did not find the name and brand of the product in the selections</label>
                            </div>
                            @endif
                            <div class="col-4 mb-3 __brand_id">
                                <label for="">Brand</label>
                                <div class="__box__addedd_brand">
                                    <select name="brand_id" class="form-select" id="brand_id">
                                        <option value="">----</option>
                                        @foreach($brandList as $br)
                                        <option {{(old('brand_id')==$br->id?'selected':'')}} value="{{$br->id}}">{{$br->title}}</option>
                                        @endforeach
                                    </select>
                                    @if(backpack_user()->id!=1)
                                    <input type="text" class="form-control" value="{{old('brand_name')}}" name="brand_name" id="__box__addedd_brand">
                                    @endif
                                </div>
                            </div>
                            <div class="col-8 mb-3 __product_name" style="position:relative">
                                <div class="loader" id="loader"></div>
                                <label for="">Products name</label>
                                <div class="__box__addedd_product">
                                    <select name="title" class="form-select" id="products_title">
                                        <option value="">----</option>
                                    </select>
                                    @if(backpack_user()->id!=1)
                                    <input type="text" class="form-control" name="title" id="__box__addedd_product">
                                    @endif
                                </div>
                                <input type="hidden" name="slug" class="form-control" placeholder="Slug">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Categoies</label>
                                <select name="category_id" class="form-select" id="cats_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $ct)
                                    <option {{(old('category_id')==$ct->id?'selected':'')}} value="{{$ct->id}}">{{$ct->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Sub category</label>
                                <select name="subcategory_id" class="form-select" id="prim_id">
                                    <option value=""></option>
                                </select>
                            </div>
                            
                            <!-- <div class="col-4 mb-3">
                                <label for="">Keys type</label>
                                <select name="keys_type" class="form-control" id="">
                                    <option value="">Select</option>
                                    @foreach($keys as $ky)
                                    <option value="">Keys: {{$ky->title}}</option>
                                    @endforeach
                                </select>
                            </div> -->
                            

                            <!-- dynamic section -->

                            @foreach($attributes as $atr)
                            <input type="hidden" value="{{$atr->id}}" name="attrID">
                            @if($atr->type != 'keys')
                                <div class="col-4 mb-3">
                                    <div class="form-group">
                                        <label for="">{{$atr->title}}</label>
                                        <select name="attr_id[]" class="form-select" id="">
                                            <option value="">Select</option>
                                                @foreach($keys as $ky)
                                                    @if($ky->attribute_id==$atr->id)
                                                        <option value="{{$ky->id}}">{{$ky->title}}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                            @endforeach

                            <!-- dynamic section -->

                            <div class="col-12"></div>
                            <div class="col-4 mb-3 de">
                            @foreach($attributes as $atr)
                                @if($atr->type=='keys')
                                <div class="form-group">
                                    <label for="">{{$atr->title}}</label>
                                    <select name="keys_quan" class="form-select" id="keys_quan">
                                        <option value="">Select</option>
                                        @foreach($keys as $ky)
                                            @if($ky->attribute_id==$atr->id)
                                                <option value="{{$ky->title}}">{{$ky->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                            @endforeach
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Case quantity</label>
                                <input type="text" name="unit" id="unit" class="form-control" placeholder="Keys quantity">
                                <input type="hidden" id="key_values" class="form-control">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Bottle quantity</label>
                                <input type="text" name="badge" class="form-control" placeholder="Bottle quantity">
                            </div>
                            
                            <div class="col-6 mb-3">
                                <label for="">Case Price ( <i class="fa-solid fa-euro-sign"></i> )</label>
                                <input type="number" id="case_price" name="purchased" value="{{old('purchased')}}" class="form-control" placeholder="Purchased">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Deposit (%)</label>
                                <input type="number" name="deposit" class="form-control" placeholder="Deposit">
                            </div>
                            @if(backpack_user()->role_id==1)
                            <div class="col-4 mb-3">
                                <label for="">Admin fee</label>
                                <input type="number" id="adminFee" name="admin_fee"  class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Total price for case</label>
                                <input type="text" readonly id="total_for_case" name="total_for_case" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Total price</label>
                                <input type="text" readonly id="total_price" name="total_price" class="form-control" placeholder="0">
                            </div>
                            @else
                            <div class="col-4 mb-3">
                                <input type="hidden"  id="total_for_case" name="total_for_case" class="form-control" placeholder="0">
                            </div>
                            <div class="col-4 mb-3">
                                <input type="hidden" readonly id="total_price" name="total_price" class="form-control" placeholder="0">
                            </div>
                            @endif
                            <!-- <div class="col-4 mb-3">
                                <label for="">Sale Price ($)</label>
                                <input type="number" name="selling" min="0" value="0" class="form-control" placeholder="Selling">
                            </div> -->
                            <!-- <div class="col-12 mt-4">
                                <label for="">Overview</label>
                                <textarea name="overview" style="display:none" class="form-control" id="editor"></textarea>
                            </div> -->
                            
                            <div class="col-6 mt-2">
                                <label for="">Status</label>
                                <select name="status" class="form-select" id="">
                                    @if(backpack_user()->id==1)
                                    <option value="1">Public</option>
                                    <option value="2">Private</option>
                                    @else 
                                    <option selected>Private</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Minmal Case Quantity for sale <sup>*</sup></label>
                                <input type="number" class="form-control" required name="max_quan" value="1" min="1" id="">
                            </div>
                            <div class="col-6 mt-4">
                                <label for="">Delivery time (MIN DAY)</label>
                                <input type="text" name="delivery_time_min" class="form-control">
                            </div>
                            <div class="col-6 mt-4">
                                <label for="">Delivery time (MAX DAY)</label>
                                <input type="text" name="delivery_time_max" class="form-control">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="checkbox" name="onflow" id="on_flow">
                                <label for="on_flow">On Flow</label>
                            </div>
                            <div class="col-12 mt-4">
                                <label for="">Description</label>
                                <textarea name="description" style="display:none" class="form-control" id="editor_description"></textarea>
                            </div>
                             <!-- <div class="col-12 mt-3">
                                <label for="">Meta title</label>
                                <input type="text" name="meta_title" class="form-control" placeholder="Meta title">
                            </div>
                            <div class="col-12 mt-3">
                                <label for="">Meta description</label>
                                <textarea name="meta_description" class="form-control" id="" placeholder="Meta description"></textarea>
                            </div> -->
                            <div class="col-12 mt-3">
                                <input type="hidden" name="meta_title" class="form-control" placeholder="Meta title">
                                <input type="hidden" name="meta_description" class="form-control" placeholder="Meta description">
                                <input type="hidden" name="admin_id" value="1">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Product inventaro -->

        </div>
        <div class="col-4">
            <div class="right_bar">
                <div class="card">
                    <div class="card-header"><h5 class="card-title">Preview image (Suggested 1:1)</h5></div>
                    <div class="card-body">
                        <div class="response_image">
                            <img id="upload_image" src="https://globaldrinkshub.com/uploads/default-image.webp" alt="">
                        </div>
                        <div class="response_input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
        ClassicEditor
        .create( document.querySelector( '#editor_description' ) )
        .catch( error => {
            console.error( error );
        } );


        $("#keys_quan").on('change',function(){
            var v_value = $('#keys_quan').val();
            $('#key_values').attr('value',v_value);
            var unit = Number($('#unit').val());
            var key_value = Number($('#key_values').val());
            var cem = unit*key_value;
            $('input[name=badge]').attr('value',cem);
        });

        $('#unit').keyup(function(){
            var unit = Number($(this).val());
            var key_values = Number($('#key_values').val());
            var cem = unit*key_values
            $('input[name=badge]').attr('value',cem);
        })

$(function(){
    
    
    $('input#case_price').on('keyup',function(){
        var case_quan = $('#unit').val();
        var case_price = $(this).val();
        var adminFee = 0;
        var cem = '';
        var cem_total = '';

        cem = Number(case_price)*Number(case_quan)+adminFee;
        cem_total = Number(case_price)*Number(case_quan)+adminFee;
        
        $('#total_for_case').attr('value',cem/case_quan);
        $('#total_price').attr('value',cem_total);
    })


    $('input#adminFee').on('keyup',function(){
        var case_quan = $('#unit').val();
        var case_price = $('#case_price').val();
        var adminFee = $(this).val();
        var cem = '';
        var cem_total = '';
        if(adminFee =='' || adminFee==0){
            cem = 0;
            cem_total=0;
        }else{
            cem = Number(case_price)*Number(case_quan)+Number(adminFee);
            cem_total = Number(case_price)*Number(case_quan)+Number(adminFee);
        }
        $('#total_for_case').attr('value',cem/case_quan);
        $('#total_price').attr('value',cem_total);
    })


    $('#cats_id').on('change',function(){
        var catID = $(this).val();
        $.ajax({
            url:"{{route('load_primary_categories')}}",
            method:'GET',
            data:{'catid':catID},
           // dataType:'json',
            success:function(response){
                $('#prim_id').html(response);
                $.each(response, function(index, items){
                    $('.response_image').html('<img src="https://globaldrinkshub.com/uploads/'+items.image+'">')
                })
            }
        })
    });

    

    $('#products_title').change(function(){
        var metaTitile = $(this).val();
        var keys = $("#keys_quan select").attr('selected','selected');

        
        var slug = $(this).val();
        var trimmed = $.trim(slug);
        slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
        replace(/-+/g, '-').
        replace(/^-|-$/g, '');
        $('input[name=slug]').attr('value',slug).css("text-transform","lowercase")
        $('input[name=meta_title]').attr('value',metaTitile)
        $('input[name=meta_description]').attr('value','title:'+metaTitile)

        // title:title+keys:keys_quantyty+brend:brend name +price:price text:description
    })

    $('#uploadImage').change(function(){
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e){
                $('.response_image').html('<img src="'+e.target.result+'" alt="Uploaded Image">');
            }
            reader.readAsDataURL(file);
        });


    $('#openVideobtn').on('click',function(){
        $('#uploadImage').click();
    });

    var brandID = $('#brand_id').val();
    $.ajax({
        url:"{{route('jsonProdName')}}",
        method:'GET',
        data:{'brandID':brandID},
        beforeSend:function(){
            $('div#loader').show();
            $('#products_title').prop('disabled',true)
        },
        success:function(response){
            $('#products_title').prop('disabled',false)
            $('#products_title').html(response);
            $('div#loader').hide();
        }
    })

    $('#brand_id').on('change',function(){
        var brandID = $(this).val();
        $.ajax({
            url:"{{route('jsonProdName')}}",
            method:'GET',
            data:{'brandID':brandID},
            beforeSend:function(){
                $('div#loader').show();
                $('#products_title').prop('disabled',true)
            },
            success:function(response){
                $('#products_title').prop('disabled',false)
                $('#products_title').html(response);
                $('div#loader').hide();
            }
        })
    })

    $('#products_title').on('change',function(){
        var brandID = $(this).val();
        $.ajax({
            url:"{{route('jsonProdImage')}}",
            method:'GET',
            data:{'brandID':brandID},
            dataType:'json',
            success:function(response){
                $.each(response, function(index, item){
                    $('.response_image').html('<img src="{{asset("uploads")}}/'+item.image+'">')
                    $('.response_input').html('<input type="hidden" name="image_title" value="'+item.image+'">')
                })
            }
        })
    })
   


    $('#on_flow').on('click',function(){
        if($(this).is(':checked')){
            $('input[name=delivery_time_min]').prop('disabled',true)
            $('input[name=delivery_time_max]').prop('disabled',true)
        }else{
            $('input[name=delivery_time_min]').prop('disabled',false)
            $('input[name=delivery_time_max]').prop('disabled',false)
        }
    })


    $('input[name=empty_values]').on('click',function(){
        if($(this).is(':checked')){
            $('#brand_id').hide();
            $('#brand_id').prop('disabled', true);
            $('#products_title').hide();
            $('#__box__addedd_brand').show();
            $('#__box__addedd_product').show();
            
        }else{
            $('#brand_id').show();
            $('#brand_id').prop('disabled', false);
            $('#products_title').show();
            $('#__box__addedd_brand').hide();
            $('#__box__addedd_product').hide();
        }
    });



})


</script>
@endsection
<!-- 
50*10=500
50/6 = price per bottle -->