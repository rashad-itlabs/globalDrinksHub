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
@if(Session::has('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif
<!-- <form action="{{route('action_products')}}" method="post">
    @csrf -->
<div class="card">
    <div class="card-header">
        <input name="action" type="submit" value="Save" class="btn btn-primary">
        &nbsp;
        <input name="action" type="submit" value="Delete" class="btn btn-danger">
    </div>
</div>
 <div class="table-responsive">
    <table class="" style="width:3800px">
        <thead>
            <tr>
                <th></th>
                <th style="width:450px;font-size: 12px;">Title</th>
                <th style="font-size: 12px; width:150px">Categoies</th>
                <th style="font-size: 12px; width:150px">Sub category</th>
                @foreach($attributes as $atr)
                    @if($atr->type != 'keys')
                        <th style="font-size: 12px; width:250px">{{$atr->title}}</th>    
                    @endif
                @endforeach
                @foreach($attributes as $atr)
                    @if($atr->type=='keys')
                        <th style="font-size: 12px;width:250px">{{$atr->title}}</th>
                    @endif
                @endforeach
                <th style="font-size: 12px; width:150px">Case quantity</th>
                <th style="font-size: 12px; width:150px">Bottle quantity</th>
                <th style="font-size: 12px; width:150px">Price($)</th>
                <th style="font-size: 12px; width:150px">Deposit (%)</th>
                <th style="font-size: 12px; width:150px">Sale Price($)</th>
                <th style="font-size: 12px; width:150px">Status</th>
                <th style="font-size: 12px; width:150px">Minmal Case Quantity for sale</th>
                <th style="font-size: 12px; width:150px">Brand</th>
                <th style="font-size: 12px; width:150px">Delivery time (MIN)</th>
                <th style="font-size: 12px; width:150px">Delivery time (MAX)</th>
                <th style="font-size: 12px; width:150px">Description</th>
                <th class="text-end" style="font-size: 12px;text-align:right">Actions</th>
            </tr>
        </thead>
        <tbody>
        
        
            @foreach($products as $pr)
            <form action="{{route('update_multi')}}" method="post">
            @csrf
            <tr>
                <td>
                    <input type="checkbox" name="multy[]" value="{{$pr->id}}" id="">
                </td>
                <td>
                    <input type="text" name="title" value="{{$pr->title}}" class="form-control">
                    <input type="hidden" name="slug" class="form-control" placeholder="Slug" value="{{$pr->slug}}">
                </td>
                <td>
                    <select name="category_id" class="form-control" id="cats_id">
                        <option value="">Select</option>
                        @foreach($categories as $ct)
                        <option {{ ($pr->category_id==$ct->id ? 'selected':'') }} value="{{$ct->id}}">{{$ct->title}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="subcategory_id" class="form-control" id="prim_id">
                        <option value=""></option>
                    </select>
                </td>
                @foreach($attributes as $atr)
                <input type="hidden" value="{{$atr->id}}" name="attrID">
                @if($atr->type != 'keys')
                    <td>
                        <select name="attr_id[]" class="form-control" id="">
                            <option value="">Select</option>
                                @foreach($keys as $ky)
                                    @if($ky->attribute_id==$atr->id)
                                    <option {{ ($dList[$atr->title][0]['attr_id']==$ky->id ? 'selected':'') }} value="{{$ky->id}}">{{$ky->title}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </td>
                    @endif
                @endforeach
                @foreach($attributes as $atr)
                @if($atr->type=='keys')
                    <td>
                        <select name="keys_quan" data-id="{{$pr->id}}" class="form-control" id="keys_quan">
                            <option value="">Select - {{$pr->keys_typ}}</option>
                            @foreach($keys as $ky)
                                @if($ky->attribute_id==$atr->id)
                                    <option {{ ($pr->keys_type==$ky->title ? 'selected':'') }} value="{{$ky->title}}">{{$ky->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                    @endif
                @endforeach
                <td>
                    <input type="text" name="unit" id="unit" class="form-control" data-id="{{$pr->id}}" placeholder="Keys quantity" value="{{$pr->unit}}">
                    <input type="hidden" id="key_values_{{$pr->id}}" class="form-control">
                </td>
                <td>
                    <input type="text" name="badge" id="badge_{{$pr->id}}" class="form-control" placeholder="Bottle quantity" value="{{$pr->badge}}">
                </td>
                <td>
                    <input type="number" name="purchased" value="{{$pr->purchased}}" class="form-control" placeholder="Price">
                </td>
                <td>
                    <input type="number" name="deposit" value="{{$pr->deposit}}" class="form-control" placeholder="Deposit">
                </td>
                <td>
                    <input type="number" name="selling" value="{{$pr->selling}}" class="form-control" placeholder="Selling">
                </td>
                <td>
                    <select name="status" class="form-control" id="">
                        <option {{($pr->status==1?'selected':'')}} value="1">Public</option>
                        <option {{($pr->status==2?'selected':'')}} value="2">Private</option>
                    </select>
                </td>
                <td><input type="number" class="form-control"  name="max_quan" value="{{$pr->max_keys_quan}}" min="1" id=""></td>
                <td>
                    <select name="brand_id" class="form-control" id="">
                        <option value="">----</option>
                        @foreach($brands as $br)
                        <option {{($pr->brand_id==$br->id?'selected':'')}} value="{{$br->id}}">{{$br->title}}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="date" name="delivery_time_min" value="{{$pr->delivery_time_min}}" class="form-control"></td>
                <td><input type="date" name="delivery_time_max" value="{{$pr->delivery_time_max}}" class="form-control"></td>
                <td>
                    <input type="hidden" name="meta_title" class="form-control" value="{{$pr->meta_title}}" placeholder="Meta title">
                    <input type="hidden" name="meta_description" class="form-control" value="{{$pr->meta_description}}" placeholder="Meta description">
                    <input type="" name="pro_id" value="{{$pr->id}}">
                </td>
                <td></td>
                <td>
                    <button class="btn btn-success" onclick="editSave('{{$pr->id}}')">Save</button>
                </td>
            </tr>
            </form>
            @endforeach
            
        </tbody>
        
    </table>
 </div>
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

        $("select#keys_quan").on('change',function(){
            var _value = $(this).val();
            var id = $(this).attr('data-id');
            $('#key_values_'+id).attr('value',_value);
        });
        $('input#unit').keyup(function(){
            var unit = Number($(this).val());
            var proid = $(this).attr('data-id');
            var key_values = Number($('#key_values_'+proid).val());
            var cem = unit*key_values
            $('#badge_'+proid).attr('value',cem);
        })

$(function(){
    var loadid = $('#cats_id').val();
    $.ajax({
            url:"{{route('load_primary_categories')}}",
            method:'GET',
            data:{'catid':loadid},
           // dataType:'json',
            success:function(response){
                $('#prim_id').html(response);
                $.each(response, function(index, items){
                    $('.response_image').html('<img src="https://globaldrinkshub.com/uploads/'+items.image+'">')
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
   
})

function editSave(id)
{
    $.ajax({
        url:"{{route('update_multi')}}",
        method:'POST',
        data:{'id':id},
        processData: false,
        contentType: false,
        success:function(data){
            alert(data);
        }
    })
}

</script>



@endsection