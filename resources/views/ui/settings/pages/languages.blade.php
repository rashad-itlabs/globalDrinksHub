<div class="card">
    <div class="card-body">
        <table class="table" id="attributes-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Direction</th>
                    <th>Default</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($langs as $lg)
                <tr>
                    <td>{{$lg->name}}</td>
                    <td>{{$lg->code}}</td>
                    <td>{{$lg->direction}}</td>
                    <td>
                        @if($lg->default==1)
                        <span class="badge bg-success">YES</span>
                        @else 
                        <span class="badge bg-danger">NO</span>
                        @endif
                    </td>
                    <td>
                        @if($lg->status==1)
                        <span class="badge bg-success">PUBLIC</span>
                        @else 
                        <span class="badge bg-danger">PRIVATE</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{backpack_url('edit/'.$lg->id.'/language')}}" class="litebtn">Edit</a>
                        <a href="{{route('delete_lang', $lg->id)}}" class="deletebtn">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>