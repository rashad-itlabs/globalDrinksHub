<div class="container p-0">
    <div class="row">
        <div class="col-12 mt-3 mb-3">
            <h4>Products</h4>
        </div>
        @foreach($list as $item)
        <div class="col-md-4 mb-4">
            <a href="{{route('product_detail',$item->id)}}">
            <div class="card">
                <div class="card-body">
                    <div class="cardImg">
                        <img src="https://globaldrinkshub.com/uploads/{{$item->image}}" alt="">
                    </div>
                    <div class="cardContent">
                        <strong>{{Str::limit($item->title,30)}}</strong>
                        <span>${{$item->purchased}}</span>
                    </div>
                </div>
            </div>
            </a>
        </div>
        @endforeach
    </div>
</div>