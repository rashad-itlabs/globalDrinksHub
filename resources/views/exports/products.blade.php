<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Case Quantity</th>
        <th>Bottle quantity</th>
        <th>Categories</th>
        <th>Sub Categories</th>
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
        <th>Description</th>
        <th>Overview</th>
        <th>Meta title</th>
        <th>Meta description</th>
        <th>Image</th>
        <th>Slug</th>
        <th>Tags</th>
        <th>Brand</th>
        <th>Purchases</th>
        <th>Selling</th>
        <th>Status</th>
        <th>Id</th>
        
    </tr>
    @foreach($prods as $pr)
    <tr>
        <td>{{$pr->id}}</td>
        <td>{{$pr->title}}</td>
        <td>{{$pr->unit}}</td>
        <td>{{$pr->badge}}</td>
        <td>{{$pr->category_id}}</td>
        <td>{{$pr->subcategory_id}}</td>
        @foreach($attributes as $atr)
            @if($atr->type != 'keys')
                <td>
                    @foreach($keys as $ky)
                        @if($ky->attribute_id==$atr->id)
                        [{{$ky->title}}]
                        @endif
                    @endforeach
                </td>
                @endif
            @endforeach
        <td>{{$pr->description}}</td>
        <td>{{$pr->overview}}</td>
        <td>{{$pr->meta_title}}</td>
        <td>{{$pr->meta_description}}</td>
        <td>{{$pr->image}}</td>
        <td>{{$pr->slug}}</td>
        <td>{{$pr->tags}}</td>
        <td>{{$pr->brand_id}}</td>
        <td>{{$pr->purchases}}</td>
        <td>{{$pr->selling}}</td>
        <td>{{$pr->status}}</td>
        <td>{{$pr->id}}</td>
        
    </tr>
    @endforeach
</table>