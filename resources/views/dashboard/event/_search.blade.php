<table id="searchName" class="table table-bordered table-striped table-responsive">
   <thead>
                <tr>

                         <th>#</th>
                    <th>event title</th>
                    <th>member</th>
                    <th>member ID</th>
                    <th>mobile</th>
                    <th>Company</th>
                     <th>start Date</th>
                     <th>start Time</th>
                     <th>end Date</th>
                     <th>end Time</th>
                      <th>check In Date</th>
                     <th>check In Time</th>
                     <th>check out Date</th>
                     <th>check out Time</th>
 
                    @if (Auth::guard('admin')->check())
                    <th>Hospital</th>
                    @endif
                    <th>setting</th>


                </tr>
            </thead>
            <tbody>
                <span hidden>{{$counter = 0}}</span>
                        @foreach ($eventsData as $event)
         @php
         $statData =Carbon\Carbon::parse($event->start)->format('Y-m-d');
         $statTime = Carbon\Carbon::parse($event->start)->format(' H:i:s');
         $endData =Carbon\Carbon::parse($event->end)->format('Y-m-d');
         $endData = Carbon\Carbon::parse($event->end)->format(' H:i:s');
             @endphp
                <tr>
                    <td><span class="badge bg-info">#{{++$counter}}</span></td>
                    <td>{{$event->title}}</td>
                    <td>{{$event->member->first_name}}{{$event->member->last_name}}</td>
                   <td>{{$event->member->emirates_id}}</td>
                   <td>{{$event->member->mobile}}</td>
                   <td>{{$event->member->Company}}</td>
  
                    <td>{{$statData}}</td>
                     <td>{{$statTime}}</td>
                        <td>{{$endData}}</td>
                     <td>{{$endData}}</td>
                     
                     
                     <td>@if($event->check_in == null)
                         {{$event->check_in}}
                         @elseif($event->check_in != null)
                         {{Carbon\Carbon::parse($event->check_in)->format('Y-m-d')}}
                         @endif
                         </td>
                      <td>@if($event->check_in == null)
                         {{$event->check_in}}
                         @elseif($event->check_in != null)
                         {{Carbon\Carbon::parse($event->check_in)->format('H:i:s')}}
                         @endif
                         </td>
                         
                      <td>@if($event->check_out == null)
                         {{$event->check_out}}
                         @elseif($event->check_out != null)
                         {{Carbon\Carbon::parse($event->check_out)->format('H:i:s')}}
                         @endif
                         </td>
                         
                      <td>@if($event->check_out == null)
                         {{$event->check_out}}
                         @elseif($event->check_out != null)
                         {{Carbon\Carbon::parse($event->check_out)->format('H:i:s')}}
                         @endif
                         </td>
                     
                     
                    @if (Auth::guard('admin')->check())
                    <td>{{$event->clink->Username}}</td>
                    @endif
                    <td>
                    @if($event->check_out > $event->end)
                        <span class="badge badge-danger">late</span>
                    @endif
                     
                    @if($event->check_out == null)
                <button class="btn btn-primary" data-toggle="modal" data-target="#edit_model">
                <i class="fa fa-info"></i>edit
                </button>
                @endif
                </td>
                </tr>
                @endforeach

            </tbody>
                </table>