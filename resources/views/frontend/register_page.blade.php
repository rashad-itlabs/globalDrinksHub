@extends('layouts.app')
@section('content')

    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>create account</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">create account</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <!--section start-->
    <section class="register-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>create account</h3>
                    <div class="theme-card">
                        <form class="theme-form" action="{{route('create_register')}}" data-attr="form__form" method="post">
                            @csrf
                            <div class="form-row row">
                                <div class="col-md-6 mb-4">
                                    <label for="email">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="fname" value="{{old('first_name')}}" placeholder="First Name"
                                        required="">
                                    @if($errors->has('first_name'))
                                    <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="review">Last Name</label>
                                    <input type="text" class="form-control" name="username" value="{{old('username')}}" id="lname" placeholder="Last Name"
                                        required="">
                                    @if($errors->has('username'))
                                    <small class="text-danger">{{ $errors->first('username') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-4">
                                    <label for="email">phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}" id="phone" placeholder="phone" required="">
                                    @if($errors->has('phone'))
                                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="email">Company name</label>
                                    <input type="text" class="form-control" name="company_name" value="" placeholder="Company Name">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="email">email</label>
                                    <input type="text" class="form-control" name="email" value="{{old('email')}}" id="email" placeholder="Email" required="">
                                    @if($errors->has('email'))
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="review">Password</label>
                                    <input type="password" class="form-control" name="password" id="review"
                                        placeholder="Enter your password" required="">
                                    @if($errors->has('password'))
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="review">Confirmation password</label>
                                    <input type="password" class="form-control" name="re_password" id="review"
                                        placeholder="Enter your password" required="">
                                    @if($errors->has('re_password'))
                                    <small class="text-danger">{{ $errors->first('re_password') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 mb-3">
                                    <h1 class="modal-title fs-5 mb-4" id="exampleModalLabel">Terms and Conditions of Use</h1>
                                    <p>Acceptance of Terms:By creating an account, users agree to abide by the platform's rules, policies, and privacy guidelines.</p>
                                    <p>User Responsibility: Account holders are responsible for maintaining the confidentiality of their login credentials and ensuring that any activities carried out under their account are legitimate.</p>
                                    <p>Product and Service Usage: Users may only purchase and engage with the products offered on the platform under applicable legal guidelines, including age restrictions on alcohol.</p>
                                    <p>Order Fulfillment: There will be conditions regarding the fulfillment of orders, payments, and cancellations. Refund policies may also apply.</p>
                                    <p>Data Collection: The platform might collect and store personal data according to its privacy policy to facilitate transactions and improve user experience.</p>
                                    <p>For specific details on terms and conditions, including legal liabilities, it’s advisable to review the registration process on their website ​(Global Drinks Hub).</p>
                                    <p>Price Changes: The seller reserves the right to modify product prices at any time without prior notice. Any such changes will only apply to orders placed after the price adjustment. Orders confirmed before the price change will remain at the previously agreed price.</p>
                                    <p>This ensures that customers are informed about potential price adjustments while protecting both the seller and the buyer during transactions.</p>
                                </div>
                                <div class="col-6 mt-3">
                                    <div class="input-group mb-2">
                                        <input type="checkbox" name="terms" id="inputgroup">
                                        <label for="inputgroup" class="inputgroup"> I have read and agree to the terms and conditions</label>
                                        @if($errors->has('terms'))
                                        <small class="text-danger">{{ $errors->first('terms') }}</small>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <input type="checkbox" name="confirm_olds" id="inputgroup">
                                        <label for="inputgroup" class="inputgroup"> Are you over +18?</label>
                                    </div>
                                </div>
                                <div class="col-6  text-end ">
                                    <button class="btn btn-solid w-auto" id="btn_created">create Account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->
  

@endsection