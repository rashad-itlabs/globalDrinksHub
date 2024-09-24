@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('public/assets/css/')}}/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')

<div class="row">
    <div class="col-4 mb-3">
        <a href="{{route('add_new_categories')}}" class="btn btn-primary">Add categories</a>
    </div>
    <div class="col-8">
        <nav class="d-none d-lg-block">
            <ol class="breadcrumb bg-transparent p-0 mx-3 justify-content-end">
                <li class="breadcrumb-item text-capitalize"><a href="{{backpack_url('')}}">Admin</a></li>
            </ol>
        </nav>
    </div>
    
    <div class="col-12">
        @if(Session::has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <?php
                $sublist=[];
                    foreach ($subcats as $sct) {
                        $sublist[]=[
                            'sub_id'=>$sct->id,
                            'parentID'=>$sct->parent,
                            'image' => $sct->image,
                            'subname'=>$sct->title,
                            'image_sub'=>$sct->image
                        ];
                    }
                    foreach ($cats as $ct) {
                        $list[$ct->title] = [
                            'id'=>$ct->id,
                            'image'=>$ct->image,
                            'subcats'=>$sublist
                        ];
                    }
                // echo '<pre>';
                // print_r($list);
                // echo '</pre>';
                // print_r($list['Whisky']['subcats'][1]['subname']);
                // echo count($list['Whisky']['subcats']);
                ?>
                <ul class="table-tree">
                    @foreach($list as $key=>$item)
                    <li class="tree-node">
                        <input type="checkbox" name="categories" value="{{$item['id']}}" id="">
                        <span class="node-data">
                        <img alt="Whisky" height="50" width="50" class="lazy-img" src="{{asset('public/uploads/'.$item['image'])}}" data-loaded="true" style="opacity: 1;">
                        {{$key}}
                        </span>
                        <span>
                            <button class="lite-btn"><a href="{{route('category_edit',$item['id'])}}">Edit</a></button>
                            <button class="delete-btn lite-btn"><a href="{{route('list',$item['id'])}}">Delete</a></button>
                        </span>
                        <ul class="subcats">
                            @for($i=0; $i < count($list[$key]['subcats']); $i++)
                            @if($item['id']==$list[$key]['subcats'][$i]['parentID'])
                            <li class="node-data">
                                <input type="checkbox" name="" id="">
                                <span class="node-data">
                                    <img src="{{asset('public/uploads/default-image.webp')}}" alt="">
                                <span class="subtitle">{{$list[$key]['subcats'][$i]['subname']}}</span>
                                </span>
                                <span>
                                    <button class="lite-btn"><a href="{{route('category_edit',$list[$key]['subcats'][$i]['sub_id'])}}">Edit</a></button>
                                    <button class="delete-btn lite-btn"><a href="{{route('list',$list[$key]['subcats'][$i]['sub_id'])}}">Delete</a></button>
                                </span>
                            </li>
                            @endif
                            @endfor
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection