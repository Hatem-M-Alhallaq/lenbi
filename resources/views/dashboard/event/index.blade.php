{{-- Extends layout --}}
@extends('layout.default')
@section('title','Visits')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Visits View
            </h3>
        </div>
 
        
            <div class="form-group col-md-4" style="float:left;">
                        <label for="exampleSelect1">search <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="search" id="search" style="float:left;">
                    </div>

    </div>

    <div class="card-body">


        <div id='searchItems'>
        <table class="table table-bordered table-striped table-responsive"  >
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
                @foreach ($events as $event)
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
        <span class="span">
            {{$events->links()}}
        </span>
    </div>
  </div>
</div>
@if(Auth::guard('clink')->check())
@foreach($events as $event)

    <div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                             @php 
                            $time = Carbon\Carbon::now();
                            @endphp
                             
                             <br />
                        <input type="text" class="form-control" name="event_id" id="event_id" value="{{$event->id}}" hidden>
                            <input type="text" class="form-control" name="title" id="title" value="{{$event->title}}">
                            <br />

                                    <div class="form-group row">
                                 <label for="example-datetime-local-input" class="col-2 col-form-label">Start
                                    Time</label>
                                <div class="col-10">
                                    <input class="form-control" type="datetime-local" name='start' id='start'
                                        value={{date('Y-m-d\TH:i', strtotime($event->start))}} id="start-datetime-local-input" />
                                </div>
                               </div>
                          <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">End Time</label>
                                <div class="col-10">
                                    <input class="form-control" type="datetime-local" name='end' id='end'
                                        value={{date('Y-m-d\TH:i', strtotime($event->end))}} id="example-datetime-local-input" />
                                </div>
                             </div>
                         <div class="form-group row">
                                <label class="col-2 col-form-label">Live Search</label>
                                <div class="col-10">
                                    <select class="form-control form-control-solid" name='user_id' id='user_id' data-size="7"
                                        data-live-search="true">
                                       
                                        @foreach($member as $members)
                                        <option value="{{$members->id}}" @if($event->member_id == $members->id) selected="selected" @endif >
                                         {{$members->first_name}}{{$members->last_name}} | {{$members->emirates_id}}
                                         </option>
                                        @endforeach
                                           @foreach($memberDis as $members)
                                        <option value="{{$members->id}}" disabled>{{$members->first_name}}{{$members->last_name}} | {{$members->emirates_id}} | Blocked
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-round btn-danger" data-dismiss="modal">

                        No, cancel!

                    </button>

                    <button onclick="performStore({{$event->id}})" class="btn btn-round btn-info">Yes, edit it!</button>

                </div>

            </div>

        </div>

    </div> 
    

@endforeach
@endif
@endsection

{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    {{-- page scripts --}}

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('crudjs/crud.js')}}"></script>
<script>
    $.ajaxSetup({
          headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
           });
       $("input.toggle-switch").change(function(){
        var id = $(this).attr('id');
        var member_toggle_value = $(this).attr('value');
        if(member_toggle_value == "active")
        {
            member_toggle_value = "block";
        }
        else
        {
            member_toggle_value = 'active';
        }
        $.ajax({
            url: "{{route('members.status')}}",
            type: "POST",
            cache: false,
            data: {
                    id: id ,
                    member_toggle_value:member_toggle_value,
                    },
                   
                dataType: "json",
                success:function(response) {

                }
            });
        });
        </script>
        <script>
  function performDestroy(id, reference){
    let url = '/cms/admin/admins/'+id;
    confirmDestroy(url, reference);
  }

   
         
              $("#search").keyup(function() {

            var text = $("#search").val();

            //   var bills = $("#allbills").val();
            console.log(text);

            var token = $("#token").val();
            $.post('serach/event', {
                // bills:bills,
                text: text,
                _token: token
            }).done(function(data) {
                console.log(data)

                $('#searchItems').html(data.html);

            });

        });
         function performStore(id) 
         {
        
        let formData = new FormData();
             formData.append('title',document.getElementById('title').value);
            formData.append('start',document.getElementById('start').value);
            formData.append('end',document.getElementById('end').value);
            formData.append('user_id',document.getElementById('user_id').value);
            formData.append('event_id',document.getElementById('event_id').value);
            storeRefresh('/cms/admin/events/store',formData);
        }
</script>

@endsection
