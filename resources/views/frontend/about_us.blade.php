@extends('layouts.app')
@section('content')
<!-- breadcrumb start -->
<div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>about us</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('')}}">Home</a></li>
                            <li class="breadcrumb-item active">about us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->

    <section class="contact-page section-b-space">
        <div class="container">
            <div class="title text-center mb-4"><h3>Who are we?</h3></div>
            {!! $about->about !!}
        </div>
    </section>
    <!--section start-->
    <!--Section ends-->
@endsection