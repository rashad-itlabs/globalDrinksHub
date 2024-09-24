@extends('layouts.app')
<style>
.swal2-popup.swal2-modal.swal2-icon-success.swal2-show {
    place-self: center !important;
}
</style>
@section('content')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>cart</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{asset('')}}">Home</a></li>
                            <li class="breadcrumb-item active">cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="cart-section section-b-space">
    <form action="{{route('check_order')}}" id="submitCheckout" method="post">
    @csrf
        <div class="container">
            <div class="row">
                <div class="col-sm-12 table-responsive-xs">
                    
                    @if($cardcount > 0)

                    @if(Session::has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @endif
                    <div class="table-responsive">
                    <table class="table cart-table">
                        <thead>
                            <tr class="table-head">
                                <th></th>
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">price</th>
                                <th scope="col">quantity</th>
                                <th scope="col">action</th>
                                <th scope="col">total</th>
                            </tr>
                        </thead>
                        @foreach($card as $cr)
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" name="card[]" value="{{$cr->id}}" id="check_product">
                                </td>
                                <td>
                                    <a href="#"><img src="https://globaldrinkshub.com/uploads/{{$cr->image}}" alt=""></a>
                                </td>
                                <td><a href="#">{{$cr->title}}</a>
                                    <div class="mobile-cart-content row">
                                        <div class="col">
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="text" readonly name="quantity" min="{{$cr->quantity}}" class="form-control input-number"
                                                        value="{{$cr->quantity}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h2 class="td-color">${{$cr->purchased}}</h2>
                                        </div>
                                        <div class="col">
                                            <h2 class="td-color"><a href="#" class="icon"><i class="ti-close"></i></a>
                                            </h2>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <h2>${{$cr->purchased}}</h2>
                                </td>
                                <td>
                                    <div class="qty-box">
                                        <div class="input-group">
                                            <input type="number" readonly name="quantity" min="{{$cr->quantity}}" class="form-control input-number"
                                                value="{{$cr->quantity}}">
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{route('remove_card',$cr->crid)}}" class="icon"><i class="ti-close"></i></a></td>
                                <td>
                                    <h2 class="td-color">${{number_format($cr->totalPrice,2)}}</h2>
                                </td>
                            </tr>
                        </tbody>
                        
                        
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="vendor_id" value="{{$cr->admin_id}}">
                        @endforeach
                    </table>
                    </div>
                    <div class="table-responsive-md">
                        <table class="table cart-table ">
                            <tfoot>
                                <tr>
                                    <td>total price :</td>
                                    <td>
                                        <h2>${{number_format($cardSum,2)}}</h2>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @else 
                    <div class="col-md-12 mt-4 mb-4 d-flex align-items-center justify-content-center" style="min-height: 35vh;background: #ececec;">
                        <h3>There are no products in your cart</h3>
                    </div>
                    @endif

                    
                </div>
            </div>
            @if($cardcount > 0)
            <div class="row cart-buttons">
                <div class="col-6"><a href="{{route('/brands')}}" class="btn btn-solid">continue shopping</a></div>
                <div class="col-6"><button id="btnCheckout" class="btn btn-solid">check out</button></div>
            </div>
            @endif
        </div>
        </form>
    </section>
    <!--section end-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#submitCheckout').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url:"{{route('check_order')}}",
                method:'POST',
                data:$('form').serialize(),
                success:function(res){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Your order has been successfully created. Our support will contact you soon.",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href="{{backpack_url('/orders')}}";
                        }
                    }); 
                }
            })
        });

        $(function(){
            $('#btnCheckout').prop('disabled',true);
            $('input#check_product').on('click',function(){
                // var cont = $('input#check_product').length;
                // alert(cont);
                if($('input#check_product').is(':checked')){
                    $('#btnCheckout').prop('disabled',false)
                }else{
                    $('#btnCheckout').prop('disabled',true)
                }
            })
            
        })
    </script>
@endsection