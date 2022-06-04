{{-- Extends layout --}}
@extends('layout.default')
@section('title','Reports Visits')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Reports Visits</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>

        <div class="card-body">
            <a class="btn btn-primary btn-sm" href="{{ url('/cms/admin/events/reports/xlsx')}}?member_id={{request('member_id')}}&clink_id={{request('clink_id')}}&from={{request('from')}}&to={{request('to')}}"><i class="fa fa-download"></i> XLSX</a>
            <form action="" method="get">
                <div class="row">
                    @if (Auth()->guard('admin')->user() !== null)
                    <div class="col">
                        <div class="form-group">
                            <label for="">Filter By Visitors</label>
                            <select class="custom-select" name="member_id" id="">
                                <option selected>Select one</option>
                                @foreach(\App\Models\Member::get() as $member)
                                <option @if( request()->member_id == $member->id ) selected @endif value="{{ $member->id }}">{{ $member->first_name }} {{ $member->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Filter By Hospital</label>
                            <select class="custom-select" name="clink_id" id="">
                                <option selected value="">Select one</option>
                                @foreach(\App\Models\clink::get() as $clink)
                                <option @if( request()->clink_id == $clink->id ) selected @endif value="{{ $clink->id }}">{{ $clink->Username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="col">
                        <div class="form-group">
                            <label for="">Filter Date</label>
                            from <input type="date" value="{{ request()->from }}" name="from" class="form-control">
                            To <input type="date" value="{{ request()->to }}" name="to" class="mt-1 form-control">

                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary btn-sm" type="submit">Filter</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-hover" id="kt_datatable">
                <thead>
                <tr>
                    {{-- <th>#</th> --}}
                    <th>Visitor ID</th>
                    <th>Visitor Name</th>
                    <th>Visitor Company</th>
                    <th>Hospital Info</th>
                    <th>title</th>
                     <th>start Data</th>
                     <th>start Time</th>
                     <th>end Data</th>
                     <th>end Time</th>
                      <th>check In Data</th>
                     <th>check In Time</th>
                     <th>check out Data</th>
                     <th>check out Time</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                {{-- @php
                    $counter = 0;
                @endphp --}}
                @if ($events->isNotEmpty())
                @foreach ($events as $event)
            @php
         $statData =Carbon\Carbon::parse($event->start)->format('Y-m-d');
         $statTime = Carbon\Carbon::parse($event->start)->format(' H:i:s');
         $endData =Carbon\Carbon::parse($event->end)->format('Y-m-d');
         $endData = Carbon\Carbon::parse($event->end)->format(' H:i:s');
             @endphp
                 <tr>
                    {{-- <td><span class="badge bg-info">#{{++$counter}}</span></td> --}}
                    <td>{{$event->member->id}}</td>
                    <td>
                        <div>{{$event->member->first_name}} {{$event->member->last_name}}</div>
                    </td>
                    <td>{{$event->member->Company }}</td>
                    <td>{{$event->clink->Username }}</td>
                    <td>{{$event->title}}</td>
                    <td>{{Carbon\Carbon::parse($event->start)->format('Y-m-d')}}</td>
                     <td>{{Carbon\Carbon::parse($event->start)->format(' H:i:s')}}</td>
                        <td>{{Carbon\Carbon::parse($event->end)->format('Y-m-d')}}</td>
                     <td>{{Carbon\Carbon::parse($event->end)->format(' H:i:s')}}</td>
                     
                     
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
                     
                    <td> <a href="{{ url('cms/admin/visitors/reports?member_id=' . $event->member->id) }}" class="badge badge-primary">info</a> </td>
                     @if($event->check_out > $event->end)
                     <td>
                        <span class="badge badge-danger">late</span>
                    </td>@endif
                </tr>
                @endforeach
                @else 
                    <tr>
                        <td class="text-center" colspan="10">No More Data !</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
 
    </div>

@endsection

{{-- Styles Section --}}
{{-- @section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection --}}


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    {{-- <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> --}}
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('crudjs/crud.js')}}"></script>
@endsection
