@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('public/assets/css/')}}/style.css?v={{time()}}">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')

    <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-8">
            @if(Session::has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="card">
                <div class="card-header"><h4 class="card-title">Product Editing form</h4></div>
                <div class="card-body">
                        @csrf 
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="checkbox" name="empty_values" {{ ($products->empty_product_name==1? 'checked':'') }} id="empty_values">
                                <label for="empty_values">I did not find the name and brand of the product in the selections</label>
                            </div>
                            @if(backpack_user()->id==1)
                                @if($products->empty_product_name==1)
                                    <div class="col-12 mb-3">
                                        <div class="alert alert-danger"><i class="fa fa-circle-info"></i> User has used additional Brand name and Product name</div>
                                    </div>
                                @endif
                            @endif
                            <div class="col-4 mb-3">
                                <label for="">Brand</label>
                                <select name="brand_id" class="form-select" id="brand_id">
                                    <option value="">----</option>
                                    @foreach($brands as $br)
                                    <option {{($products->brand_id==$br->id?'selected':'')}} value="{{$br->id}}">{{$br->title}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control" name="brand_id" value="{{ $products->request_brand_name }}" id="__box__addedd_brand">
                            </div>
                            <div class="col-8 mb-3" style="position:relative">
                                <div class="loader" id="loader"></div>
                                <label for="">Products name</label>
                                <input type="hidden" id="prod_name" value="{{ $products->title }}">
                                <select name="title" class="form-select" id="products_title">
                                    <option value="">----</option>
                                </select>
                                <input type="text" class="form-control" name="title" value="{{ $products->title }}" id="__box__addedd_product">
                                <input type="hidden" name="slug" class="form-control" placeholder="Slug" value="{{$products->slug}}">
                                <!-- //////////////////// -->
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Categoies</label>
                                <select name="category_id" class="form-select" id="cats_id">
                                    <option value="">Select</option>
                                    @foreach($categories as $ct)
                                    <option {{ ($products->category_id==$ct->id ? 'selected':'') }} value="{{$ct->id}}">{{$ct->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="">Sub category</label>
                                <select name="subcategory_id" class="form-select" id="prim_id">
                                    <option value=""></option>
                                </select>
                            </div>
                            

                            <!-- dynamic section -->

                            @foreach($attributes as $atr)
                            <input type="hidden" value="{{$atr->id}}" name="attrID">
                            @php 
                            error_reporting(0);
                            $decode = json_decode($products->attributes);
                            @endphp
                            @if($atr->type != 'keys')
                                <div class="col-4 mb-3">
                                    <div class="form-group">
                                        <label for="">{{$atr->title}}</label>
                                        <select name="attr_id[]" class="form-select" id="">
                                            <option value="">Select</option>
                                                @foreach($keys as $ky)
                                                    @if($ky->attribute_id==$atr->id)
                                                    <option {{ ($dList[$atr->title][0]['attr_id']==$ky->id ? 'selected':'') }} value="{{$ky->id}}">{{$ky->title}}</option>
                                                    @endif
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                            @endforeach

                            <!-- dynamic section -->

                            <div class="col-12"></div>
                            <div class="col-4 mb-3 f">
                            @foreach($attributes as $atr)
                            @if($atr->type=='keys')
                                <div class="form-group">
                                    <label for="">{{$atr->title}}</label>
                                    <select name="keys_quan" class="form-select" id="keys_quan">
                                        <option value="">Select</option>
                                        @foreach($keys as $ky)
                                            @if($ky->attribute_id==$atr->id)
                                                <option {{ ($products->keys_type==$ky->title ? 'selected':'') }} value="{{$ky->title}}">{{$ky->title}}</option>
                                            @endif
                                        @endforeach
                                    
                                    </select>
                                </div>
                                @endif
                            @endforeach
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Case quantity</label>
                                <input type="text" name="unit" id="unit" class="form-control" placeholder="Keys quantity" value="{{$products->unit}}">
                                <input type="hidden" id="key_values" class="form-control">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Bottle quantity</label>
                                <input type="text" name="badge" class="form-control" placeholder="Bottle quantity" readonly value="{{$products->badge}}">
                            </div>
                            
                            <div class="col-6 mb-3">
                                <label for="">Case Price ( <i class="fa-solid fa-euro-sign"></i> )</label>
                                <input type="number" id="case_price" name="purchased" value="{{$products->purchased}}" class="form-control" placeholder="Purchased">
                            </div>
                            <!-- <div class="col-4 mb-3">
                                <label for="">Sale Price($)</label>
                                <input type="number" name="selling" value="{{$products->selling}}" class="form-control" placeholder="Selling">
                            </div> -->
                            <div class="col-6 mb-3">
                                <label for="">Deposit (%)</label>
                                <input type="number" name="deposit" value="{{$products->deposit}}" class="form-control" placeholder="Deposit">
                            </div>
                            @if(backpack_user()->role_id==1)
                            <div class="col-4 mb-3">
                                <label for="">Admin fee</label>
                                <input type="number" id="adminFee" name="admin_fee" value="{{$products->admin_fee}}" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Total price for case</label>
                                <input type="text" readonly id="total_for_case" name="total_for_case" value="{{$products->total_price_for_case}}" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="">Total price</label>
                                <input type="text" readonly id="total_price" name="total_price" value="{{ $products->total_price }}" class="form-control" placeholder="0.00">
                            </div>
                            @else 
                            <div class="col-4 mb-3">
                                <input type="hidden" readonly id="total_for_case" name="total_for_case" value="{{$products->total_price_for_case}}" class="form-control" placeholder="0.00">
                            </div>
                            <div class="col-4 mb-3">
                                <input type="hidden" readonly id="total_price" name="total_price" value="{{ $products->total_price }}" class="form-control" placeholder="0.00">
                            </div>
                            @endif
                            
                            <div class="col-6 mt-2">
                                <label for="">Status</label>
                                <select name="status" class="form-select" id="">
                                    @if(backpack_user()->role_id==1)
                                    <option {{($products->status==1?'selected':'')}} value="1">Public</option>
                                    <option {{($products->status==2 ? 'selected':'')}} value="2">Private</option>
                                    @else
                                    <option {{($products->status==2 ? 'selected':'')}} value="{{$products->status}}">{{($products->status==2 ? 'Private':'Public')}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-6 mt-2">
                                <label for="">Minmal Case Quantity for sale <sup>*</sup></label>
                                <input type="number" class="form-control" required name="max_quan" value="{{$products->max_keys_quan}}" min="1" id="">
                            </div>
                            <div class="col-6 mt-4">
                                <label for="">Delivery time (MIN DAY)</label>
                                <input type="text" name="delivery_time_min" value="{{$products->delivery_time_min}}" class="form-control">
                            </div>
                            <div class="col-6 mt-4">
                                <label for="">Delivery time (MAX DAY)</label>
                                <input type="text" name="delivery_time_max" value="{{$products->delivery_time_max}}" class="form-control">
                            </div>
                            <div class="col-12 mt-4">
                                <input type="checkbox" name="onflow" id="on_flow">
                                <label for="on_flow">On Flow</label>
                            </div>
                            <div class="col-12 mt-4">
                                <label for="">Description</label>
                                <textarea name="description" style="display:none" class="form-control" id="editor_description">{{$products->description}}</textarea>
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
                                <input type="hidden" name="meta_title" class="form-control" value="{{$products->meta_title}}" placeholder="Meta title">
                                <input type="hidden" name="meta_description" class="form-control" value="{{$products->meta_description}}" placeholder="Meta description">
                                <input type="hidden" name="pro_id" value="{{$products->id}}">
                                <button class="btn btn-success">Save And Publish</button>
                                @if(backpack_user()->id ==1)
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject product</button>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
            <!-- Modal -->
            
            <!-- Product inventaro -->
            
            <!-- <div class="card mt-3">
                <div class="card-header"><h5 class="card-title">Product Inventary</h5></div>
                <div class="card-body">
                    <div class="mb-20 mb-sm-15 atr-wrapper">
                        @foreach($attributes as $atr)
                        <div class="single-atr">
                            <label class="cb atr-title f-1-2 bold">
                                <input type="checkbox">
                                <span>{{$atr->title}} -</span>
                            </label>
                            @foreach($keys as $ky)
                            
                                @if($ky->attribute_id==$atr->id)
                                <label class="cb">
                                    <input type="checkbox">
                                    <span>{{$ky->title}}</span>
                                </label>
                                @endif
                            @endforeach
                        </div>
                        @endforeach

                        <table class="table">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> -->


        </div>
        <div class="col-4">
            <div class="right_bar">
                <div class="card">
                    <div class="card-header"><h5 class="card-title">Preview image (Suggested 1:1)</h5></div>
                    <div class="card-body">
                        <div class="response_image">
                            @if($products->image)
                            <img src="{{asset('uploads/'.$products->image)}}" alt="">
                            @else 
                            <img src="{{asset('uploads/default-image.webp')}}" alt="">
                            @endif
                        </div>
                        <div class="response_input">
                            <input type="hidden" name="image_title" value="{{$products->image}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form action="{{ route('reject_product') }}" method="post" class="m-0">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reason for rejecting the product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="transaction_id" value="{{$products->id}}">
                <textarea name="message" required class="form-control" col="10" rows="10" id="" placeholder="Reason for rejecting the product"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary">Send email</button>
            </div>
        </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.3.1/ckeditor.min.js" integrity="sha512-Qhh+VfoTh+a2tbFw+u86fMKfvyNyHR4aTVbivQAIkFQPcXFa1S0ZlTcib0HXiT4XBVS0a/FtSGamQ9YfXIaPRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('public/assets/js/main.js')}}"></script>
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

        var _value = $('#keys_quan').val();
        $('#key_values').attr('value',_value);


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
            var cem = unit*key_values;
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
        var total_for_case = $('#total_for_case').val();
        var total_price = $('#total_price').val();
        var case_quan = $('#unit').val();
        var case_price = $('#case_price').val();
        var adminFee = $(this).val();
        var cem = '';
        var cem_total = '';
        if(adminFee =='' || adminFee==0){
            cem = Number(case_price);
            cem_total=Number(case_price)*Number(case_quan);

            $('#total_for_case').attr('value',cem);
            $('#total_price').attr('value',cem_total);
        }else{
            cem = Number(case_price)*Number(case_quan)+Number(adminFee);
            cem_total = Number(case_price)*Number(case_quan)+Number(adminFee);
            var totals = cem/case_quan;
            $('#total_for_case').attr('value',totals.toFixed(2));
            $('#total_price').attr('value',cem_total);
        }
        
        
    })




    var loadid = $('#cats_id').val();
    var brandID = $('#brand_id').val();
    var prodName = $('#prod_name').val();


    $.ajax({
        url:"{{route('jsonProdNameEdit')}}",
        method:'GET',
        data:{'brandID':brandID,'prodName':prodName},
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


    $.ajax({
            url:"{{route('load_primary_categories')}}",
            method:'GET',
            data:{'catid':loadid},
           // dataType:'json',
            success:function(response){
                $('#prim_id').html(response);
                $.each(response, function(index, items){
                    $('.response_image').html('<img src="https://globaldrinkshub.com/public/uploads/'+items.image+'">')
                })
            }
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

    $('input[name=title]').keyup(function(){
        var metaTitile = $(this).val();
        var keys = $('#keys_quan').val();
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
    });

    
    if($('input[name=empty_values]').is(':checked')){
        $('#brand_id').hide();
        $('#products_title').hide();
        $('#__box__addedd_brand').show();
        $('#__box__addedd_product').show();
    }


    $('input[name=empty_values]').on('click',function(){
        if($(this).is(':checked')){
            $('#brand_id').hide();
            $('#products_title').hide();
            $('#__box__addedd_brand').show();
            $('#__box__addedd_product').show();
            
        }else{
            $('#brand_id').show();
            $('#products_title').show();
            $('#__box__addedd_brand').hide();
            $('#__box__addedd_product').hide();
        }
    });
   
})

</script>
@endsection