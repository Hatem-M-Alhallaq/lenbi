 

            <table class="table table-separate table-head-custom table-checkable" id="searchName">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Emirates ID</th>
                    <th>Medicines</th>
                    <th>Status</th>
                    <th>Craeted by Clinic</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                {{-- @php
                    $counter = 0;
                @endphp --}}
                @foreach ($members as $member)
                <tr>
                    <td>{{$member->id}}</td>
                    <td> <img  width="50" height="50" class="rounded-circle img-thumbnail" src="{{ asset('members/' .$member->image) }}" alt=""> </td>
                    <td>
                        <div>{{$member->first_name}} {{$member->last_name}}</div>
                    </td>
                    <td>{{$member->mobile }}</td>
                    <td>{{$member->email }}</td>
                    <td>{{$member->Company }}</td>
                    <td>{{$member->emirates_id }}</td>
                    <td>
                        @php
                            $medicines = $member->medicines->pluck('medicine')->toArray();
                        @endphp
                        {{ implode(' - ', $medicines) }}
                    </td>
                    <td>{{$member->status }}</td>
                    <td>{{$member->clink->Username }}</td>
                    <td> <a href="{{ url('cms/admin/events/reports?member_id=' . $member->id) }}" class="badge badge-info">Events</a> </td>
                </tr>
                @endforeach
                </tbody>
            </table>
  

 