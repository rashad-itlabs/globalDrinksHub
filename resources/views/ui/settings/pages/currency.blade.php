
<div class="card">
    <div class="card-body">
        <form action="{{route('change_currency')}}" method="post">
            @csrf 
            <div class="row">
                <div class="col-4">
                    <div class="form-group mb-2">
                        <label for="">Currency</label>
                        <select name="currency" class="form-control" id="">
                            <option value="USD">United States Dollar</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Currency position</label>
                        <select name="currency_position" class="form-control" id="">
                            <option value="1" {{($settings->currency_position==1?'selected':'')}}>Left</option>
                            <option value="2" {{($settings->currency_position==2?'selected':'')}}>Right</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Decimal format</label>
                        <select name="decimal_format" class="form-control" id="">
                            <option value="en-US" {{($settings->decimal_format=='en-US'?'selected':'')}}>US English</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <button class="btn btn-primary">Update Currency</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>