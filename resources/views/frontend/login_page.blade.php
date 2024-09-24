@extends('layouts.app')
@section('content')

 <!-- breadcrumb start -->
 <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>customer's login</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('')}}">Home</a></li>
                            <li class="breadcrumb-item active">login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="login-page section-b-space">
        <div class="container">
            @if(Session::has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="row">
                <div class="col-lg-6">
                    <h3>Login</h3>
                    <div class="theme-card">
                        <!-- <form class="theme-form" action="{{ route('login') }}" method="post"> -->
                        <form class="theme-form" action="{{ route('backpack.auth.login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" placeholder="Email" required="">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="review">Password</label>
                                <input type="password" name="password" class="form-control" id="review"
                                    placeholder="Enter your password" required="">
                                    <input type="hidden" value="{{@$_SERVER['HTTP_REFERER']}}" name="back_url">
                            </div>
                            <div class="row">
                                <div class="col-md-9"><button class="btn btn-solid">Login</button></div>
                                <div class="col-md-3 text-end d-flex justify-contnet-end align-items-center"><a href="{{ route('forget_password') }}">Forget password</a></div>
                            </div>
                            <br>
                            <br>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 right-login">
                    <h3>New Customer</h3>
                    <div class="theme-card authentication-right">
                        <h6 class="title-font">Create A Account</h6>
                        <p>Sign up for a free account at our store. Registration is quick and easy. It allows you to be
                            able to order from our shop. To start shopping click register.</p><a href="{{route('register')}}"
                            class="btn btn-solid">Create an Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->



<script src=""></script>
<script></script>
@endsection