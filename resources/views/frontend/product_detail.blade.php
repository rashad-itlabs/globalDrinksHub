@extends('layouts.app')
@section('content')


    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>{{ $info->proTitle }}</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">product</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    @if(Session::has('error'))
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">{{session('error')}}</div>
            </div>
        </div>
    </div>
    @endif
    <!-- section start -->
    <section>
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-slick">
                            @foreach($images as $img)
                            <div><img src="{{asset('')}}uploads/{{$img->image}}" alt=""
                                    class="img-fluid blur-up lazyload image_zoom_cls-0"></div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <div class="slider-nav">
                                @foreach($images as $img)
                                    <div><img src="{{asset('')}}uploads/{{$img->image}}" alt=""
                                            class="img-fluid blur-up lazyload"></div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 rtl-text">
                        <div class="product-right">
                            <div class="product-count">
                                <ul>
                                    <li>
                                        <img src="{{asset('')}}assets/frontend/images/fire.gif" class="img-fluid" alt="image">
                                        <span class="p-counter">37</span>
                                        <span class="lang">orders in last 24 hours</span>
                                    </li>
                                    <li>
                                        <img src="{{asset('')}}assets/frontend/images/person.gif" class="img-fluid user_img" alt="image">
                                        <span class="p-counter">44</span>
                                        <span class="lang">active view this</span>
                                    </li>
                                </ul>
                            </div>
                            <h2>{{ $info->proTitle }}</h2>
                            <div class="rating-section">
                                <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                        class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                </div>
                                <h6>120 ratings</h6>
                            </div>
                            <div class="label-section">
                                @if(!Auth::check())
                                <a href="{{ route('register') }}" class="btn btn-success">For More Information Please Registration</a>
                                @endif
                            </div>
                            @if(Auth::check())
                            <h3 class="price-detail"><i class="fa-solid fa-euro-sign"></i> {{$info->total_price_for_case}}
                            <!--<del>$459.00</del><span>55% off</span>--> </h3>
                            @endif
                            <div id="selectSize" class="addeffect-section product-description border-product mb-3 mt-3">
                                @if(Auth::check())
                                <div class="two-sided mb-15">
                                    <h6 class=" left">Brand </h6>
                                    <div class="right">{{$info->title}}</div>
                                </div>
                                <div class="two-sided mb-15">
                                    <h6 class=" left">Category </h6>
                                    <div class="right">{{$categories[0]->catTitle}}</div>
                                </div>
                                @foreach($attribute as $atr)
                                @foreach($attribute_inventories as $in)
                                @if($atr->id == $in->attrId)
                                <div class="two-sided mb-15">
                                    <h6 class=" left">{{$atr->title}}</h6>
                                    <div class="right">
                                        <ul>
                                            <li>
                                                {{$in->attrTitle}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endforeach
                                <div class="two-sided mb-15">
                                    <h6 class=" left">Case quantity</h6>
                                    <div class="right">
                                        <ul>
                                            <li>
                                                {{$info->unit}}
                                                <input name="quantity" type="hidden" value="{{$info->unit}}">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="two-sided mb-15">
                                    <h6 class=" left">Bottle quantity</h6>
                                    <div class="right">
                                        <ul>
                                            <li>
                                                {{$info->badge}}
                                                <input name="quantity" type="hidden" value="{{$info->badge}}">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="two-sided mb-15">
                                    <h6 class=" left">Minimal case quantity</h6>
                                    <div class="right">
                                        <ul>
                                            <li>
                                                {{$info->max_keys_quan}} Cases
                                                <input name="quantity" type="hidden" value="{{$info->max_keys_quan}}">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="two-sided mb-15">
                                    <h6 class=" left">Minimum delivery time</h6>
                                    <div class="right">
                                        <ul>
                                            <li>
                                            {{ ($info->delivery_time_min!=null?$info->delivery_time_min.' Day':'empty') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="two-sided mb-15">
                                    <h6 class=" left">Maximum delivery time</h6>
                                    <div class="right">
                                        <ul>
                                            <li>
                                                {{ ($info->delivery_time_max!=null?$info->delivery_time_max.' Day':'empty') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @if($reservationStatus==1)
                            <div class="col-12">
                                <div class="alert alert-danger"><i class="fa-solid fa-circle-info"></i> This item is reserved by another user. Requests are processed in the order of the queue. If orders preceding yours are not agreed upon, your order will be processed.</div>
                            </div>
                            @endif
                            <div class="product-buttons"><a href="javascript:void(0)" onclick="addtoCard('{{$info->proID}}')" id="cartEffect"
                                    class="btn btn-solid hover-solid btn-animation"><i class="fa fa-shopping-cart me-1"
                                        aria-hidden="true"></i> Create Order</a> </div>
                            </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- product-tab starts -->
    <section class="tab-product m-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                                href="#top-home" role="tab" aria-selected="true"><i
                                    class="icofont icofont-ui-home"></i>Details</a>
                            <div class="material-border"></div>
                        </li>
                        <!-- <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab"
                                href="#top-profile" role="tab" aria-selected="false"><i
                                    class="icofont icofont-man-in-glasses"></i>Specification</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab"
                                href="#top-contact" role="tab" aria-selected="false"><i
                                    class="icofont icofont-contacts"></i>Video</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="review-top-tab" data-bs-toggle="tab"
                                href="#top-review" role="tab" aria-selected="false"><i
                                    class="icofont icofont-contacts"></i>Write Review</a>
                            <div class="material-border"></div>
                        </li> -->
                    </ul>
                    <div class="tab-content nav-material" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                            aria-labelledby="top-home-tab">
                            <div class="product-tab-discription">
                                <div class="part">
                                    <p>{!! $info->description !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <p>The Model is wearing a white blouse from our stylist's collection, see the image for a
                                mock-up of what the actual blouse would look like.it has text written on it in a black
                                cursive language which looks great on a white color.</p>
                            <div class="single-product-tables">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Sleeve Length</td>
                                            <td>Sleevless</td>
                                        </tr>
                                        <tr>
                                            <td>Neck</td>
                                            <td>Round Neck</td>
                                        </tr>
                                        <tr>
                                            <td>Occasion</td>
                                            <td>Sports</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Fabric</td>
                                            <td>Polyester</td>
                                        </tr>
                                        <tr>
                                            <td>Fit</td>
                                            <td>Regular Fit</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                            <div class="">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/BUWzX78Ye_8"
                                    allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                            <form class="theme-form">
                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <div class="media">
                                            <label>Rating</label>
                                            <div class="media-body ms-3">
                                                <div class="rating three-star"><i class="fa fa-star"></i> <i
                                                        class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                        class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter Your name"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Email" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="review">Review Title</label>
                                        <input type="text" class="form-control" id="review"
                                            placeholder="Enter your Review Subjects" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="review">Review Title</label>
                                        <textarea class="form-control" placeholder="Wrire Your Testimonial Here"
                                            id="exampleFormControlTextarea1" rows="6"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-solid" type="submit">Submit YOur
                                            Review</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-tab ends -->


    <!-- product section start -->
    <section class="section-b-space ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>related products</h2>
                </div>
            </div>
            <div class="row search-product">

                @foreach($cats as $rt)
                @if($rt->category_id == $info->category_id)
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="product-box">
                        <div class="img-wrapper">
                            <div class="front">
                                <a href="{{route('product_detail',$rt->id)}}"><img src="{{asset('')}}uploads/{{$rt->image}}"
                                style="width:100%;height: 216px;object-fit: contain;" alt=""></a>
                            </div>
                            <div class="back">
                                <a href="{{route('product_detail',$rt->id)}}"><img src="{{asset('')}}uploads/{{$rt->image}}"
                                style="width:100%;height: 216px;object-fit: contain;" alt=""></a>
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                            </div>
                            <a href="{{route('product_detail',$rt->id)}}">
                                <h6>{{$rt->title}}</h6>
                            </a>
                            @if(Auth::check())
                            <div class="row">
                                <div class="col-12 text-start">
                                    Case quantity: <b>{{$rt->unit}}</b>
                                </div>
                                <div class="col-12 text-start">
                                    Price for case: <b><i class="fa-solid fa-euro-sign"></i> {{$rt->total_price_for_case}}</b>
                                </div>
                                <div class="col-12 text-start">
                                    Total price: <b><i class="fa-solid fa-euro-sign"></i> {{$rt->total_price}}</b>
                                </div>
                                <div class="col-12 text-start">
                                    Delivery terms: <b><?php
                                        foreach($attribute as $atr){
                                            foreach($attribute__inventories as $in){
                                                if($atr->id == $in->attrId){
                                                    if($in->product_id==$rt->id){
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
                                            foreach($attribute__inventories as $in){
                                                if($atr->id == $in->attrId){
                                                    if($in->product_id==$rt->id){
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
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- product section end -->


@endsection