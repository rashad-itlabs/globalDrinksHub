<div class="card">
    <div class="card-body">
        <form action="{{route('change_address')}}" method="post">
            @csrf 
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control" value="{{$settings->email}}">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{$settings->phone}}">
                    </div>
                    <div class="form-group">
                        <label for="">Address line 1</label>
                        <input type="text" name="address_1" class="form-control" value="{{$settings->address_1}}">
                    </div>
                    <div class="form-group">
                        <label for="">Address line 2</label>
                        <input type="text" name="address_2" class="form-control" value="{{$settings->address_2}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" name="city" class="form-control" value="{{$settings->city}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">State</label>
                        <input type="text" name="state" class="form-control" value="{{$settings->state}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Zip</label>
                        <input type="text" name="zip" class="form-control" value="{{$settings->zip}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Country</label>
                        <input type="text" name="country" class="form-control" value="{{$settings->country}}">
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-success">Update Address</button>
                </div>
            </div>
        </form>
    </div>
</div>