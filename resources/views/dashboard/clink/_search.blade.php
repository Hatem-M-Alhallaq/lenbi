<table id="searchName" class="table table-bordered table-checkable" id="kt_datatable">
   <thead>
                <tr>

                    <th>#</th>
                    <th>event title</th>
                    <th>member</th>
                    <th>start</th>
                    <th>end</th>
                    <th>check in</th>
                    <th>check out</th>
                    @if (Auth::guard('admin')->check())
                    <th>clink</th>
                    @endif


                </tr>
            </thead>
            <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($eventsData as $event)
                <tr>
                    <td><span class="badge bg-info">#{{++$counter}}</span></td>
                    <td>{{$event->title}}</td>
                    <td>{{$event->member->first_name}}</td>
                    <td>{{$event->start}}</td>
                    <td>{{$event->end}}</td>
                    <td>{{$event->check_in}}</td>
                    <td>{{$event->check_out}}</td>
                    @if (Auth::guard('admin')->check())
                    <td>{{$event->clink->Username}}</td>
                    @endif




                </tr>
                @endforeach

            </tbody>
                </table>