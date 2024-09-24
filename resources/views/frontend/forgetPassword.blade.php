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
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <h3>Forget Password</h3>
                    <div class="theme-card">
                        <form class="theme-form" action="{{route('check_mail')}}" onsubmit="return onsubmitForm(this);" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" style="margin-bottom:5px" class="form-control" id="email" placeholder="Email" required="">
                                <small class="text-danger"></small>
                                <small class="text-success"></small>
                            </div>
                            <button type="submit" id="checkMail" class="btn btn-solid">Send Mail</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function onsubmitForm(form){
        var ajax = new XMLHttpRequest();
        ajax.open("POST", form.getAttribute('action'), true);
        $('#checkMail').prop('disabled',true);
        $('#checkMail').text('Loading...');

        ajax.onreadystatechange = function(){
            if(this.status == 200){
                var data = JSON.parse(this.responseText);
                if(data.status==200){
                    $('small.text-success').text(data.msg)
                    $('small.text-danger').text('');
                    $('input[name=email]').val('');
                    $('#checkMail').prop('disabled',false);
                    $('#checkMail').text('Send Mail');
                }else{
                    $('small.text-danger').text(data.msg);
                    $('small.text-success').text('');
                    $('#checkMail').prop('disabled',false);
                    $('#checkMail').text('Send Mail');
                }

                setTimeout(() => {
                    $('small.text-danger').text('');
                    $('input[name=email]').val('');
                    $('small.text-success').text('');
                }, 1500);
                
            }

            if(this.status ==500){
                
            }
        };
        var formData = new FormData(form);

        ajax.send(formData);

        return false;
    }
</script>
@endsection