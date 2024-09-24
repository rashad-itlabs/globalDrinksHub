@extends('layouts.app')
@section('content')
<div class="container">
    @if(Auth::check())
    <div class="category-tile-wrapper">
        @foreach($list as $ls)
        <a href="{{route('brand',$ls->id)}}" class="block page-link category-tile">
            <div class="img-wrapper">
                <img src="https://globaldrinkshub.com/uploads/{{$ls->image}}" class="lazy-img" alt="">
            </div>
            <h5 class="item-title ellipsis ellipsis-1">{{$ls->title}}</h5>
        </a>
        @endforeach
    </div>
    @else 
    <div class="row d-flex justify-content-center text-center">
        <div class="col-md-12 mt-4 mb-4 d-flex align-items-center justify-content-center" style="min-height: 35vh;background: #ececec;">
            <h3>You need to <a href="{{route('register')}}">Register</a> or <a href="{{backpack_url('login')}}">Login</a> to see this page</h3>
        </div>
    </div>
    @endif
</div>
@endsection