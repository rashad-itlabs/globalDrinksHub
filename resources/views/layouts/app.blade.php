<!DOCTYPE html>
<html lang="en">
<?php  
    $site = @DB::table('site_settings')->get();
    $stn = @DB::table('settings')->get();

    $cats = @DB::table('categories')->where('parent',0)->get();

    $featured = @DB::table('categories')->get();
    $subcats = @DB::table('categories')->where('featured',1)->get();
    $ltrLinks = @DB::table('header_links')->where('type',1)->get();
    $rtlLinks = @DB::table('header_links')->where('type',2)->get();
    $cardSum = @DB::table('carts')->where('user_id',Auth::user()->id)->sum('totalPrice');
    $countCard = @DB::table('carts')->where('user_id',Auth::user()->id)->count();

    // foreach($cats as $ct){
    //     if($ct->parent == 0){
    //         $title = $ct->title;
    //     }

    //     $data[$title] = '';
    // }

    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="author" content="multikart">
    <link rel="icon" href="{{asset('')}}public/assets/frontend/images/favicon/drink.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('')}}public/assets/frontend/images/favicon/drink.png" type="image/x-icon">
    <title>{{$site[0]->site_name}}</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/vendors/font-awesome.css">

    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/vendors/slick-theme.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/vendors/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/vendors/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/vendors/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/style.css?v=13">
    <link rel="stylesheet" type="text/css" href="{{asset('')}}public/assets/frontend/css/main.css?v={{time()}}">


</head>
<style>
.swal2-popup.swal2-modal.swal2-icon-error.swal2-show {
    place-self: center !important;
}
</style>
<body class="theme-color-19">
<!-- mobile top -->
 <div class="openedMenu">
    <div class="opened_header">
        <div class="lft_title">Menu</div>
        <div class="rtl_btn"><i class="fa-solid fa-xmark"></i></div>
    </div>
    <div class="opened_body">
        <ul class="opened_body_li">
            @foreach($cats as $ct)
                <li>
                    @if($ct->icon ==null)
                    <a href="{{route('categories',$ct->id)}}">{{$ct->title}} {!! ($ct->icon!='' ? $ct->icon:'') !!}</a>
                    @else 
                    <a href="javascript::void">{{$ct->title}} {!! ($ct->icon!='' ? $ct->icon:'') !!}</a>
                    @endif
                    <ul class="subdropdown_m">
                    @foreach($subcats as $sb)
                        @if($sb->parent==$ct->id)
                            <li><a href="{{route('categories',$sb->id)}}">{{$sb->title}}</a></li>
                        @endif
                    @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
 </div>
 <div class="mob_header">
    <div id="bar"><i class="fa-solid fa-bars-staggered"></i></div>
    <div class="mob_head_menu">
        <a href="{{route('login')}}"><i class="fa-regular fa-user"></i></a>
        <a href=""><i class="fa-solid fa-cart-shopping"></i></a>
    </div>
 </div>
 <div class="mob_brand_header">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-2">
                <a href="{{asset('')}}"><img src="{{asset('')}}public/uploads/{{$site[0]->header_logo}}" class="img-fluid blur-up lazyload" alt=""></a>
            </div>
            <div class="col-12 text-center mb-3">
                <a href="tel:{{$stn[0]->phone}}" style="font-size: 20px;font-weight: 700;color: #666;"><i class="fa fa-phone" aria-hidden="true"></i>{{$stn[0]->phone}}</a>
            </div>
            <div class="col-12">
                <form action="" method="post">
                    @csrf 
                    <div class="input-group">
                        <input type="text" class="form-control" id="autoSearch" placeholder="Search...">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <div class="searchResponse">...</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
<!-- mobile top -->

<!-- header start -->
<header class="header-tools marketplace">
    <div class="mobile-fix-option"></div>
    <div class="top-header">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-contact">
                        <ul>
                            <li>English</li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i>{{$stn[0]->email}}</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i>{{$stn[0]->phone}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-end">
                    <ul class="header-dropdown">
                        <li class="mobile-wishlist"><a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a>
                        </li>
                        @if(Auth::check())
                        <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" aria-hidden="true"></i>
                            <a target="_blank" href="{{route('auth_vendor_panel')}}">
                                My Business Panel
                            </a>
                        </li>
                        @else 
                        <li class="mobile-account">
                            <a href="{{(@backpack_user()->id==1 ? 'javascript::void' : backpack_url('login')) }}" id="{{(@backpack_user()->id==1 ? 'showModal' : '' )}}" >
                                <i class="fa fa-user" style="color:#333"></i>
                                Login
                            </a>
                        </li>
                        <li class="mobile-account">
                            <a href="{{route('register')}}">
                                <i class="fa fa-user" style="color:#333"></i>
                                Register
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-sm-12">
                <div class="main-menu">
                    <div class="menu-left">
                        <div class="brand-logo">
                            <a href="{{asset('')}}">
                                <img src="{{asset('')}}public/uploads/{{$site[0]->header_logo}}"
                                    class="img-fluid blur-up lazyload" alt=""></a>
                        </div>
                    </div>
                    <div class="input-group" style="width:66%">
                        <input type="text" class="form-control" id="autoSearch" placeholder="Search...">
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <div class="searchResponse">...</div>
                    </div>
                    <div class="menu-right pull-right">
                        <div>
                            <div class="icon-nav">
                                <ul>
                                    <li class="onhover-div mobile-cart">
                                        <div>
                                            <img src="{{asset('')}}public/assets/frontend/images/icon/cart.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                            <span class="badge bg-danger">{{$countCard}}</span>
                                            <div class="countPrice">
                                                <a href="{{route('card')}}">{{number_format($cardSum,2)}} USD</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</header>
<div class="botMenu">
    <div class="container">
        <div class="flex sided">
            <div>
                @foreach($ltrLinks as $ltr)
                @if($ltr->dropdown==1)
                <button class="dropdown"><span><i id="bar" class="fa-solid fa-bars"></i>&nbsp;&nbsp;&nbsp; &nbsp;   {{$ltr->title}}</span>
                    <div class="dropdownMenu">
                        <ul class="dropdown_li">
                            @foreach($cats as $ct)
                                <li>
                                    @if($ct->icon ==null)
                                    <a href="{{route('categories',$ct->id)}}">{{$ct->title}} {!! ($ct->icon!='' ? $ct->icon:'') !!}</a>
                                    @else 
                                    <a href="javascript::void">{{$ct->title}} {!! ($ct->icon!='' ? $ct->icon:'') !!}</a>
                                    @endif
                                    <ul class="subdropdown">
                                    @foreach($subcats as $sb)
                                        @if($sb->parent==$ct->id)
                                            <li><a href="{{route('categories',$sb->id)}}">{{$sb->title}}</a></li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </button>
                @else
                <a href="{{route($ltr->url)}}"><span>{{$ltr->title}}</span></a>
                @endif
                @endforeach
            </div>
            <div>
                @foreach($rtlLinks as $rtl)
                <a href="{{route($rtl->url)}}"><span>{{$rtl->title}}</span></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- header end -->

@yield('content')

<!-- footer -->
<footer class="footer-light">
        <div class="light-layout">
            <div class="container">
                <section class="small-section border-section border-top-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="subscribe">
                                <div>
                                    <h4>KNOW IT ALL FIRST!</h4>
                                    <p>Never Miss Anything From Multikart By Signing Up To Our Newsletter.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <form action="{{route('add_subscription')}}"
                                class="form-inline subscribe-form auth-form needs-validation" method="post"
                                id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form">
                                @csrf
                                <div class="form-group mx-sm-3">
                                    <input type="text" class="form-control" name="subs_email" id="mce-EMAIL"
                                        placeholder="Enter your email" required="required">
                                    @if($errors->has('subs_email'))
                                    <small class="text-danger">{{$errors->first('subs_email')}}</small>
                                    @endif
                                    @if(Session::has('success'))
                                    <small class="text-success">{{session('success')}}</small>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-solid" id="mc-submit">subscribe</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <section class="section-b-space light-layout">
            <div class="container">
                <div class="row footer-theme partition-f d-flex justify-content-between">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-title footer-mobile-title">
                            <h4>about</h4>
                        </div>
                        <div class="footer-contant">
                            <div class="footer-logo"><img src="{{asset('')}}public/uploads/{{$site[0]->footer_logo}}" alt=""></div>
                            <!-- <p></p> -->
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col offset-xl-1">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>my account</h4>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li><a href="#">mens</a></li>
                                    <li><a href="#">womens</a></li>
                                    <li><a href="#">clothing</a></li>
                                    <li><a href="#">accessories</a></li>
                                    <li><a href="#">featured</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>why we choose</h4>
                            </div>
                            <div class="footer-contant">
                                <ul>
                                    <li><a href="#">shipping & return</a></li>
                                    <li><a href="#">secure shopping</a></li>
                                    <li><a href="#">gallary</a></li>
                                    <li><a href="#">affiliates</a></li>
                                    <li><a href="#">contacts</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-4 text-end">
                        <div class="sub-title">
                            <div class="footer-title">
                                <h4>store information</h4>
                            </div>
                            <div class="footer-contant">
                                <ul class="contact-list">
                                    <li><i class="fa fa-map-marker"></i>{{$stn[0]->address_1}},{{$stn[0]->city}}</li>
                                    <li><i class="fa fa-phone"></i>{{$stn[0]->phone}}</li>
                                    <li><i class="fa fa-envelope"></i><a href="#">{{$stn[0]->email}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-md-12 text-center col-sm-12">
                        <div class="footer-end">
                            <p><i class="fa fa-copyright" aria-hidden="true"></i> {{date('Y')}} - Avangarde</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->



    <!-- tap to top -->
    <div class="tap-top top-cls">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top end -->


    <!-- latest jquery-->
    <script src="{{asset('')}}public/assets/frontend/js/jquery-3.3.1.min.js"></script>

    <!-- fly cart ui jquery-->
    <script src="{{asset('')}}public/assets/frontend/js/jquery-ui.min.js"></script>

    <!-- exitintent jquery-->
    <script src="{{asset('')}}public/assets/frontend/js/jquery.exitintent.js"></script>
    <script src="{{asset('')}}public/assets/frontend/js/exit.js"></script>

    <!-- slick js-->
    <script src="{{asset('')}}public/assets/frontend/js/slick.js"></script>

    <!-- menu js-->
    <script src="{{asset('')}}public/assets/frontend/js/menu.js"></script>

    <!-- lazyload js-->
    <script src="{{asset('')}}public/assets/frontend/js/lazysizes.min.js"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('')}}public/assets/frontend/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{asset('')}}public/assets/frontend/js/bootstrap-notify.min.js"></script>

    <!-- Fly cart js-->
    <script src="{{asset('')}}public/assets/frontend/js/fly-cart.js"></script>

    <!-- Theme js-->
    <script src="{{asset('')}}public/assets/frontend/js/theme-setting.js"></script>
    <script src="{{asset('')}}public/assets/frontend/js/script.js"></script>
    <script src="{{asset('')}}public/assets/frontend/js/myscript.js?v={{time()}}"></script>

    <script>
        $(window).on('load', function () {
            setTimeout(function () {
                $('#exampleModal').modal('show');
            }, 2500);
        });

        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }

        $('input#autoSearch').on('keyup',function(){
            var _val = $(this).val();
            var valCount = $(this).val().length;
            if(valCount < 1){
                $('div.searchResponse').hide();
            }else{
                $('div.searchResponse').fadeIn();
                $.ajax({
                    url:"{{route('showSearchFilter')}}",
                    method:'GET',
                    data:{'_val':_val},
                    beforeSend:function(){
                        $('.searchResponse').text('Loading...')
                    },
                    success:function(result){
                        $('.searchResponse').html(result);
                    }
                })
            }
            
        })
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
