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
            <div class="col-12 text-end">
                <button class="btn btn-primary" id="openFilter"><i class="fa-solid fa-sliders"></i></button>
                <div class="rightBar">

                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-12 list_filter_cats">
        <div class="row game-product grid-products">
        @if($productCount > 0)
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
                            class="img-fluid blur-up lazyload bg-img" alt="">
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
                                Delivery terms: <b></b>
                            </div>
                            <div class="col-12 text-start">
                                Warehouse: <b></b>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection