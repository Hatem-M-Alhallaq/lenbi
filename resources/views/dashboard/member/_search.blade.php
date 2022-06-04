
<table id="searchItems" class="table table-bordered table-hover">
          <thead>
                <tr>
                   
                    <th>#</th>
                     <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>company</th>
                    <th>emirates ID</th>
                    <th>status</th>
                    <th>image</th>
               
                </tr>
                </thead>
                <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($members as $member)
                <tr>
                    <td><span class="badge bg-info">#{{++$counter}}</span></td>
                    <td>{{$member->first_name}}</td>
                    <td>{{$member->last_name}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->mobile}}</td>
                     <td>{{$member->Company}}</td>
                    <td>{{$member->emirates_id}}</td>
                        <td>
                    <div class="form-group row">
                    <div class="col-3">
                    <span class="switch">
                    <label>
                    <input type="checkbox" class="toggle-switch" data-toggle="toggle" data-on="active"
                    data-off="Deactive" id="{{$member->id}}" @if($member->status == "active")
                        checked="checked"
                        value="active"
                        @else
                        value="block"
                        @endif
                        >                 <span></span>
                        </label>
                            </span>
                    </div>         
                            </td>
                     <td> 
                    <img class="rounded-circle" src="{{url('members/'.$member->image)}}" width="50" height="50">
                    </td>

                   <td> <a 
                   href="{{route('medicines',['id' =>$member->id])}}" class="btn btn-xs btn-info" style="color: white;" >
                    ({{$member->medicines_count}})/medicines
                  </a>
                </td>
                    </td>
                    <td> <a 
                   href="{{route('members.edit',[$member->id])}}" class="btn btn-xs btn-info" style="color: white;" >
                    Edit
                  </a>
                </td>
                </tr>
                @endforeach
           
                </tbody>
                </table>
                </div>