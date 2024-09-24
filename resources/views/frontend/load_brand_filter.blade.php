@foreach($all as $pr)

    <div class="product-box col-xl-3 col-lg-3 col-sm-4 col-6">
        <div class="img-wrapper">
            <div class="front">
                <a href="{{route('product_detail',$pr->id)}}"><img src="https://globaldrinkshub.com/uploads/{{$pr->image}}"
                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
            </div>
            <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                cart</div>
        </div>
        <div class="product-detail">
            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
            <a href="{{route('product_detail',$pr->id)}}">
                <h6>{{$pr->title}}</h6>
            </a>
            <h4>${{$pr->purchased}}</h4>
        </div>
    </div>

    

@endforeach