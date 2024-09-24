<div class="row">
    @if(Session::has('success'))
    <div class="col-12 mt-3 mb-3">
        <div class="alert alert-success">{{ session('success') }}</div>
    </div>
    @endif
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable" style="margin-bottom:0px !important">
                <thead>
                <tr>
                    <th>Phones</th>
                    <th>Emails</th>
                    <th>Address</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        @for($i=0; $i < count($phones); $i++)
                        <small><p>{{ $phones[$i].';' }}</p></small>
                        @endfor
                    </td>
                    <td>
                        @for($i=0; $i < count($emails); $i++)
                        <small><p>{{ $emails[$i].';' }}</p></small>
                        @endfor
                    </td>
                    <td>
                        <small><p>{{$contact->address}}</p></small>
                    </td>
                    <td class="text-end">
                    <span class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                        <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">
                            Edit
                        </a>
                        </div>
                    </span>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="contactModalLabel">Edit Contact Information</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-lg">
        <form action="{{route('save_info')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Phone #</label>
                @for($i=0; $i < count($phones); $i++)
                    <div class="form-group mb-3">
                        <input type="text" name="phones[]" class="form-control" value="{{$phones[$i]}}">
                    </div>
                @endfor
            </div>
            <div class="form-group">
            <label for="">Emails #</label>
            @for($i=0; $i < count($emails); $i++)
                <div class="form-group mb-3">
                    <input type="text" name="emails[]" class="form-control" value="{{$emails[$i]}}">
                </div>
            @endfor
            </div>
            <div class="form-group mb-3">
                <label for="">Address #</label>
                <textarea name="address" id="" cols="10" rows="10" class="form-control">{{$contact->address}}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>