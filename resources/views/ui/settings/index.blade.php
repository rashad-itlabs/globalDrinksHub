@extends(backpack_view('layouts.' . (backpack_theme_config('layout') ?? 'vertical')))
<link rel="stylesheet" href="{{asset('assets/css/')}}/style.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('before_breadcrumbs_widgets')
	@include(backpack_view('inc.widgets'), [ 'widgets' => app('widgets')->where('section', 'before_breadcrumbs')->toArray() ])
@endsection
@include('layouts._topHeader')
@section('content')
    @if(Session::has('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @foreach($settings as $st)
    <div class="card">
        <div class="card-header"><h4 class="card-title">Site setting</h4></div>
        <div class="card-body settings">
            <div class="row">
                <div class="col-4">
                    <h5>
                    <span>Header logo</span>
                    <small>Suggested (200 x 50)</small>
                    </h5>
                    <div class="image_box"><img src="{{asset('uploads/'.$st->header_logo)}}" alt=""></div>
                    <input type="file" name="heade_logo" id="header_loog">
                    <label for="header_loog" id="uploadBtn">Change header logo</label>
                </div>
                <div class="col-4">
                    <h5>
                    <span>Footer logo</span>
                    <small>Suggested (200 x 50)</small>
                    </h5>
                    <div class="image_box"><img src="{{asset('uploads/'.$st->footer_logo)}}" alt=""></div>
                    <input type="file" name="heade_logo" id="header_loog">
                    <label for="header_loog" id="uploadBtn">Change footer logo</label>
                </div>
                <div class="col-4">
                    <h5>
                    <span>Logo in email</span>
                    <small>Suggested (200 x 50)</small>
                    </h5>
                    <div class="image_box"><img src="{{asset('uploads/'.$st->email_logo)}}" alt=""></div>
                    <input type="file" name="heade_logo" id="header_loog">
                    <label for="header_loog" id="uploadBtn">Change email logo</label>
                </div>
            </div>

            <div class="row mt-4">
                <form action="{{route('update_site_settings')}}" method="post">
                    @csrf 
                    <div class="form-group mb-2">
                        <label for="">Site name</label>
                        <input type="text" name="site_name" class="form-control" value="{{$st->site_name}}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Site Url</label>
                        <input type="text" name="site_url" class="form-control" value="{{$st->site_url}}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Meta title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{$st->meta_title}}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Meta description</label>
                        <textarea name="meta_description" class="form-control" cols="10" rows="7">{{$st->meta_description}}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Copyright text</label>
                        <input type="text" name="copyright_text" class="form-control" value="{{$st->copyright_text}}">
                    </div>
                    <div class="row mb-2">
                        <div class="col-6">
                            <div class="form-group mb-2">
                                <label for="">Primary color</label>
                                <input type="text" name="primary_color" class="form-control" value="{{$st->primay_color}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mb-2">
                                <label for="">Primary hover color</label>
                                <input type="text" name="primary_hover_color" class="form-control" value="{{$st->primary_hover_color}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Styling</label>
                        <textarea name="styling" class="form-control" cols="10" rows="7">{{$st->styling}}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection