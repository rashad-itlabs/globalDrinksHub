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
<div class="alert alert-success">{{session('success')}}</div>
@endif
<div class="card">
    <div class="card-header"><h4 class="card-title">Settings</h4></div>
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#collection" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Currency</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Address</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#languages" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Languages</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#social_login" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Social login</button>
            </li> -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#smtp_settings" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">SMPT settings</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#analistics" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Analystics</button>
            </li> -->
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#media_storage" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Media storage</button>
            </li> -->
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#miscell" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Miscellaneous</button>
            </li> -->
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#clear_cache" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Clear cache</button>
            </li> -->
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="collection" role="tabpanel" aria-labelledby="home-tab" tabindex="0">@include('ui.settings.pages.currency')</div>
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">@include('ui.settings.pages.address')</div>
            <div class="tab-pane fade" id="languages" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">@include('ui.settings.pages.languages')</div>
            <!-- <div class="tab-pane fade" id="social_login" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">@include('ui.settings.pages.social_login')</div> -->
            <div class="tab-pane fade" id="smtp_settings" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">@include('ui.settings.pages.smtp_settings')</div>
            <!-- <div class="tab-pane fade" id="analistics" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">@include('ui.settings.pages.analistics')</div> -->
            <!-- <div class="tab-pane fade" id="media_storage" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">@include('ui.settings.pages.media_storage')</div> -->
            <!-- <div class="tab-pane fade" id="miscell" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">@include('ui.settings.pages.miscell')</div> -->
            <!-- <div class="tab-pane fade" id="clear_cache" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">@include('ui.settings.pages.clear_cache')</div> -->
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$('#attributes-table').DataTable({
    ordering:false
});
</script>
@endsection