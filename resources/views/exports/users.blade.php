<table>
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>User Type</th>
        <th>Company name</th>
        <th>Phone number</th>
        <th>Email</th>
        <th>Verified</th>
        <th>Created date</th>
    </tr>
    @foreach($userlist as $ls)
    <tr>
        <td>{{$ls->name}}</td>
        <td>{{$ls->username}}</td>
        <td>{{($ls->role_id==1?'Super Admin':'Vendor')}}</td>
        <td>{{$ls->company_name}}</td>
        <td>{{$ls->phone}}</td>
        <td>{{$ls->email}}</td>
        <td>{{($ls->email_verified_at==null?'Unverified':'Verified')}}</td>
        <td>{{date('d M Y',strtotime($ls->created_at))}}</td>
    </tr>
    @endforeach
</table>