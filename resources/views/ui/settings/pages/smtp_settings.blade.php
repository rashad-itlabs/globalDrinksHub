<div class="card">
    <div class="card-body">
        <form action="{{route('update-smtp')}}" method="post">
            @csrf 
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">SMTP host</label>
                        <input type="text" name="mail_host" class="form-control" value="{{ $mailConfig['mailers']['smtp']['host'] }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">SMTP port</label>
                        <input type="text" name="mail_port" class="form-control" value="{{ $mailConfig['mailers']['smtp']['port'] }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">SMTP encryption</label>
                        <input type="text" name="mail_encryption" class="form-control" value="{{ $mailConfig['mailers']['smtp']['encryption'] }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">SMTP username</label>
                        <input type="text" name="mail_username" class="form-control" value="{{ $mailConfig['mailers']['smtp']['username'] }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">SMTP password</label>
                        <input type="text" name="mail_password" class="form-control" value="{{ $mailConfig['mailers']['smtp']['password'] }}">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Mail from</label>
                        <input type="text" name="from_addresses" class="form-control" value="{{ $mailConfig['from']['address'] }}">
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary">Update SMTP</button>
                </div>
            </div>
        </form>
    </div>
</div>