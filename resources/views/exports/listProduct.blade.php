<table border="1">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Case Quantity</th>
        <th>Bottle quantity</th>
        <th>Categories</th>
        @foreach($attributes as $atr)
            @if($atr->type != 'keys')
                <th style="font-size: 12px; width:250px">{{$atr->title}}</th>    
            @endif
        @endforeach
        @foreach($attributes as $atr)
            @if($atr->type=='keys')
                <th style="font-size: 12px;width:250px">{{$atr->title}}</th>
            @endif
        @endforeach
        <th>Meta title</th>
        <th>Meta description</th>
        <th>Image</th>
        <th>Slug</th>
        <th>Tags</th>
        <th>Brand</th>
        <th>Price</th>
        <th>Total Price</th>
        <th>Created Date</th>
        
    </tr>
    @foreach($prods as $pr)
    <tr>
        <td>{{$pr->id}}</td>
        <td>{{$pr->title}}</td>
        <td>{{$pr->unit}}</td>
        <td>{{$pr->badge}}</td>
        <td>{{$pr->category_id}}</td>
        @foreach($attributes as $atr)
            @if($atr->type != 'keys')
                <td>
                    @foreach($keys as $ky)
                        @if($ky->attribute_id==$atr->id)
                            @if($ky->product_id==$pr->id)
                            [{{$ky->title}}]
                            @endif
                        @endif
                    @endforeach
                </td>
            @endif
        @endforeach
        @foreach($attributes as $atr_key)
            @if($atr_key->type == 'keys')
                <td>
                    @foreach($keysType as $kys)
                        @if($kys->attribute_id==$atr_key->id)
                            @if($kys->title==$pr->keys_type)
                            [{{$kys->title}}]
                            @endif
                        @endif
                    @endforeach
                </td>
            @endif
        @endforeach
        <td>{{$pr->meta_title}}</td>
        <td>{{$pr->meta_description}}</td>
        <td>{{$pr->image}}</td>
        <td>{{$pr->slug}}</td>
        <td>{{$pr->tags}}</td>
        <td>{{$pr->brand_id}}</td>
        <td>&#8364; {{$pr->total_price_for_case}}</td>
        <td>&#8364; {{$pr->total_price}}</td>
        <td>{{date('d M Y')}}</td>
        
    </tr>
    @endforeach
</table>