
@extends('layouts.app')
@section('content')
@if(Session::has('oneway'))
<div class="container" style="height:50vh">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-8 text-center mt-4 mb-4">
            <img width="130px" src="{{asset('public/assets/frontend/images/accept.png')}}" alt="">
            <h3 class="mt-3">Your registration is complete. It will be activated by admin as soon as possible</h3>
            <span id="timeUp"></span>
        </div>
    </div>
</div>
@endif
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(!Session::has('oneway'))
<script>
    $(function(){
        location.href="{{asset('')}}";
    })
</script>
@endif
<script>
    $(function(){
        var minutes = 0;
        var seconds = 10;
        var totalSeconds = (minutes * 60) + seconds;
        var x=setInterval(function(){
            var min = Math.floor(totalSeconds / 60);
            var sec = totalSeconds % 60;
            var minStr = min < 10 ? '0' + min : min;
            var secStr = sec < 10 ? '0' + sec : sec;
            $('#timeUp').text(minStr + ':' + secStr);
            totalSeconds--;
            if (totalSeconds < 0) {
                clearInterval(x);
                location.href="{{asset('')}}";
            }
        },1000)
    })
</script>