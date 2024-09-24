@extends('layouts.app')
@section('content')

<div class="brand_header">
    <div class="container">
        <span></span>
    </div>
</div>
<section class="pt-0 section-b-space ratio_asos">
<div class="product-header">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <strong>{{$categoryName->title}}</strong>
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
            <!-- <div class="form-group mb-3">
                <strong>Brand</strong>
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
                        <label for="">{{$br->title}} </label>
                        @else 
                        <input id="brand" type="checkbox"  {{ ($id == $br->id?'checked':'') }} name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}} - {{$br->id}}</label>
                        @endif
                    </li>
                    @endforeach
                    <li>
                        <button class="btn btn-primary">Upply</button>
                    </li>
                </ul>
                </form>
            </div> -->
            <form action="{{route('category',$id)}}" method="get" id="form">
            @csrf
            <div class="formgroup mb-3">
                <div class="card filterCard">
                    <div class="card-body form-control">
                        <h4 class="card-text mb-3">Brand</h4>
                        <!-- <form action="{{route('brand',$id)}}" method="get" id="form"> -->
                        @csrf
                        <ul class="brand_list">
                            @foreach($list as $br)
                                @for($i=0; $i < count($brandList); $i++)
                                    @if($brandList[$i]==$br->id)
                                    <li>
                                    <input id="brand" type="checkbox"  {{ ($id == $br->id?'checked':'') }} name="brand_id[]" value="{{$br->id}}">
                                    <label for="">{{$br->title}}</label>
                                    </li>
                                    @endif
                                @endfor
                            @endforeach
                        </ul>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
            
            @foreach($attributes as $atr)
                <div class="col mb-3">
                    <select name="attr_id[]" class="form-select">
                        <option value="">{{$atr->title}}</option>
                        @foreach($attributesValue as $val)
                        @php
                            $key = array_search($val->id, $dataselect);
                        @endphp
                        @if($val->attribute_id == $atr->id)
                            @if($key !== false)
                            <option value="{{$val->id}}">{{$val->title}}</option>
                            @else 
                            <option value="{{$val->id}}">{{$val->title}}</option>
                            @endif
                        @endif
                        @endforeach
                    </select>
                </div>
                @endforeach
            <button class="btn btn-primary w-100 p-2" id="btnApply_">Apply</button>
        </form>
            
        </div>
        <div class="col-9 list_filter_cats">
        <div class="row game-product grid-products">
            <div class="testResult"></div>
        @if($product_Count > 0)
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
        @else 
        <div class="alert alert-info">No product found.</div>
        @endif
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
            <strong>Brand</strong>
            <form action="{{route('brand',$id)}}" method="get" id="form">
            @csrf
            <ul class="brand_list">
                @foreach($list as $br)
                    @for($i=0; $i < count($brandList); $i++)
                        @if($brandList[$i]==$br->id)
                        <li>
                        <input id="brand" type="checkbox"  {{ ($id == $br->id?'checked':'') }} name="brand_id[]" value="{{$br->id}}">
                        <label for="">{{$br->title}}</label>
                        </li>
                        @endif
                    @endfor
                @endforeach
                @if($productCount > 0)
                <li>
                    <button class="btn btn-primary">Upply</button>
                </li>
                @endif
            </ul>
            </form>
        </div>

        <form action="{{route('category',$id)}}" method="get" id="form">
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