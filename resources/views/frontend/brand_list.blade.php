@extends('layouts.app')
@section('content')
<div class="brand_header">
    <div class="container">
        <span></span>
    </div>
</div>
<section class="pt-0 section-b-space ratio_asos">
<div class="product-header mt-3">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <strong>Brand</strong>
            </div>
            <div class="col-6 text-end" id="for_mob">
                <span id="btnFilter"><i class="fa-solid fa-filter"></i> Filter</span>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-3 left_filter">
            <div class="form-group mb-3">
                <strong>Brands</strong>
                <form action="{{route('brand',$id)}}" method="get" id="form">
                @csrf
                <ul class="brand_list">
                    @foreach($list as $br)
                    @php
                        $key = array_search($br->id, $dataselect);
                    @endphp
                    <li>
                        @if($key !== false)
                        <input id="brand" type="checkbox"  checked name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}} ({{$brCount}})</label>
                        @else 
                        @if($_GET)
                        <input id="brand" type="checkbox" name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}} ({{$brCount}})</label>
                        @else 
                        <input id="brand" type="checkbox"  {{ ($id == $br->id?'checked':'') }} name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}}   ({{$brCount}})</label>
                        @endif
                        @endif
                    </li>
                    @endforeach
                    <!-- <li>
                        <button class="btn btn-primary">Upply</button>
                    </li> -->
                </ul>
            </div>

            <!-- <form action="{{route('brand',$id)}}" method="get" id="form"> -->
            @csrf
            @foreach($attributes as $atr)
            <div class="form-group mb-3">
                <strong>{{$atr->title}}</strong>
                <ul class="brand_list">
                    @foreach($attributesValue as $val)
                    @php
                        $key = array_search($val->id, $dataselect);
                    @endphp
                    @if($val->attribute_id == $atr->id)
                    <li>
                        @if($key !== false)
                        <input id="brand" type="checkbox" checked name="attr_id[]" value="{{$val->id}}">
                        <label for="">{{$val->title}}</label>
                        @else 
                        <input id="brand" type="checkbox" name="attr_id[]" value="{{$val->id}}">
                        <label for="">{{$val->title}}</label>
                        @endif
                        
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endforeach
            <button class="btn btn-primary w-100">Apply</button>
            </form>

            
            
        </div>
        <div class="col-9 list_filter_cats">
        <div class="row game-product grid-products">
        <div class="loadJson"></div>
        @foreach($all as $pr)

            <div class="product-box col-xl-3 col-lg-3 col-sm-4 col-6">
                <div class="img-wrapper">
                    <div class="front">
                        <a href="{{route('product_detail',$pr->id)}}">
                            @if(substr($pr->image, -5) =='.webp')
                            <img src="https://globaldrinkshub.com/uploads/default-image.webp"
                                class="img-fluid blur-up lazyload bg-img" alt="">
                            @else 
                            <img src="https://globaldrinkshub.com/uploads/{{$pr->image}}"
                            style="width:100%;height: 216px;object-fit: contain;" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">
                        <a href="{{route('product_detail',$pr->id)}}" style="color:#fff; text-decoration:none">Read more</a>
                    </div>
                </div>
                <div class="product-detail">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                            class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                    <a href="{{route('product_detail',$pr->id)}}">
                        <h6>{{$pr->title}}</h6>
                    </a>
                    @if(Auth::check())
                    <div class="row">
                        <div class="col-12 text-start">
                            Case quantity: <b>{{$pr->unit}}</b>
                        </div>
                        <div class="col-12 text-start">
                            Price for case: <b><i class="fa-solid fa-euro-sign"></i> {{$pr->total_price_for_case}}</b>
                        </div>
                        <div class="col-12 text-start">
                            Total price: <b><i class="fa-solid fa-euro-sign"></i> {{$pr->total_price}}</b>
                        </div>
                        <div class="col-12 text-start">
                            Delivery terms: <b><?php
                                foreach($attribute as $atr){
                                    foreach($attribute_inventories as $in){
                                        if($atr->id == $in->attrId){
                                            if($in->product_id==$pr->id){
                                                if($atr->id==12){
                                                    echo $in->attrTitle;
                                                }
                                            }
                                        }
                                    }
                                }
                            ?></b></b>
                        </div>
                        <div class="col-12 text-start">
                            Warehouse: <b><?php
                                foreach($attribute as $atr){
                                    foreach($attribute_inventories as $in){
                                        if($atr->id == $in->attrId){
                                            if($in->product_id==$pr->id){
                                                if($atr->id==26){
                                                    echo $in->attrTitle;
                                                }
                                            }
                                        }
                                    }
                                }
                            ?></b></b>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            

        @endforeach
        </div>
        </div>
    </div>
</div>
</section>
<div class="filterMenu">
    <div class="opened_header">
        <div class="lft_title">Filter</div>
        <div class="rtl_btn"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div class="opened_body">
        <div class="form-group mb-3">
                <strong>Brands</strong>
                <form action="{{route('brand',$id)}}" method="get" id="form">
                @csrf
                <ul class="brand_list">
                    @foreach($list as $br)
                    @php
                        $key = array_search($br->id, $dataselect);
                    @endphp
                    <li>
                        @if($key !== false)
                        <input id="brand" type="checkbox"  checked name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}} ({{$brCount}})</label>
                        @else 
                        @if($_GET)
                        <input id="brand" type="checkbox" name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}} ({{$brCount}})</label>
                        @else 
                        <input id="brand" type="checkbox"  {{ ($id == $br->id?'checked':'') }} name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}}   ({{$brCount}})</label>
                        @endif
                        @endif
                    </li>
                    @endforeach
                    <!-- <li>
                        <button class="btn btn-primary">Upply</button>
                    </li> -->
                </ul>
            </div>

            <!-- <form action="{{route('brand',$id)}}" method="get" id="form"> -->
            @csrf
            @foreach($attributes as $atr)
            <div class="form-group mb-3">
                <strong>{{$atr->title}}</strong>
                <ul class="brand_list">
                    @foreach($attributesValue as $val)
                    @php
                        $key = array_search($val->id, $dataselect);
                    @endphp
                    @if($val->attribute_id == $atr->id)
                    <li>
                        @if($key !== false)
                        <input id="brand" type="checkbox" checked name="attr_id[]" value="{{$val->id}}">
                        <label for="">{{$val->title}}</label>
                        @else 
                        <input id="brand" type="checkbox" name="attr_id[]" value="{{$val->id}}">
                        <label for="">{{$val->title}}</label>
                        @endif
                        
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
            @endforeach
            <button class="btn btn-primary">Upply</button>
            </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script>
    $(function(){
        $('#form').on('submit',function(e){
            e.preventDefault();
            alert("{{route('loadBrand',$id)}}");
            $.ajax({
                url:"{{route('loadBrand',$id)}}",
                method:'GET',
                data:$('form').serialize(),
                success:function(resp){
                    $('.loadJson').html(resp);
                }
            })
        })
    })
</script> -->
@endsection