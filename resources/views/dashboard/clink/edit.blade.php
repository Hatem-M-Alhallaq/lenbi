{{-- Extends layout --}}
@extends('layout.default')

@section('title','Hospital')
@section('page_description','Create Admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
@endsection

{{-- Content --}}
@section('content')


<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            edit Hospital
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form id="basic-form" method="post" action="{{route('clinks.update',[$clinks->id])}}" enctype="multipart/form-data"
        novalidate>
        @method('put')
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="alert {{session()->get('status')}} alert-dismissible fade show" role="alert">
            <span> {{ session()->get('message') }}<span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
        </div>
        @endif
        <div class="card-body">

           
          @if(Auth::guard('clink')->check())
            @if(Auth::user()->id != $clinks->id)
            <div class="form-group">
                <label>Role:</label>
                <select class="form-control form-control-solid" name="role_id" id="role_id">
                      @foreach ($roles as $role)
                    <option value="{{$role->id}}" @if($roleModel->role_id == $role->id) selected="selected" @endif >
                        {{$role->name}}
                    </option>
                     @endforeach
                </select>
            </div>
            @endif
            @endif
            @if(Auth::guard('admin')->check())

            <div class="form-group">
                <label>Role:</label>
                <select class="form-control form-control-solid" name="role_id" id="role_id">
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}" @if($roleModel->role_id == $role->id) selected="selected" @endif >
                        {{$role->name}}
                    </option>
                     @endforeach
                </select>
            </div>
            @endif
            @if($clinks->model != 'user')
            <div class="form-group">
                <label>address:</label>
                <input type="text" name='address' id="address" value='{{$clinks->address}}'
                    class="form-control form-control-solid" placeholder="Enter address" />
            </div>
            @endif
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" id="username" value='{{$clinks->Username}}'
                    class="form-control form-control-solid" placeholder="Enter username" />
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" name='email' value='{{$clinks->email}}'
                    class="form-control form-control-solid" placeholder="Enter Email" />
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="number" name="mobile" id="mobile" value='{{$clinks->mobile}}'
                    class="form-control form-control-solid" placeholder="Enter mobile" />
            </div>
            @if(Auth::guard('admin')->user())

            <div class="form-group">
                <label>Expiry of subscription</label>
                <input type="date" name="expiry_of_subscription" id="expiry_of_subscription"
                    value='{{$clinks->expiry_of_subscription}}' class="form-control form-control-solid"
                    placeholder="Enter B.D" />
            </div>
            @endif
            <div class="form-group">
                <label>rhythm of visit</label>
                <input type="number" name="rhythm_of_visit" id="rhythm_of_visit" value='{{$clinks->rhythm_of_visit}}'
                    class="form-control form-control-solid" placeholder="Enter Days" />
            </div>
        </div>


        @if($clinks->model != 'user')
        <div class="card-header">
            <h5 class="h3 mb-0">{{ __("Working Hours")}}</h5>
        </div>
        <div class="card-body">

            <div class="form-group">
                @foreach($days as $key => $value)
                <br />
                <div class="row">
                    <div class="col-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="days" class="custom-control-input" id="{{ 'day'.$key }}"
                                value={{ $key }}>
                            <label class="custom-control-label" for="{{ 'day'.$key }}">{{ __($value) }}</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                            </div>
                            <input id="{{ $key.'_from' }}" name="{{ $key.'_from' }}" value="{{$hours[ $key.'_from']}}"
                                class="form-control" type="time" placeholder="{{ __('Time') }}">
                        </div>
                    </div>
                    <div class="col-2 text-center">
                        <p class="display-4">-</p>
                    </div>
                    <div class="col-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-time-alarm"></i></span>
                            </div>
                            <input id="{{ $key.'_to' }}" name="{{ $key.'_to' }}" value="{{$hours[ $key.'_to']}}"
                                class="form-control" type="time" placeholder="{{ __('Time') }}">
                        </div>
                    </div>


                </div>
                @endforeach
            </div>
            @endif
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
        </div>


</div>
</div>
</form>
@endsection



{{-- Scripts Section --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('crudjs/crud.js')}}"></script>
<script>
    $('.role_id').select2({
        theme: 'bootstrap4'
    })

  var defaultHourFrom = "09:00";
        var defaultHourTo = "17:00";

        var timeFormat = '{{ config('settings.time_format') }}';

        function formatAMPM(date) {
            //var hours = date.getHours();
            //var minutes = date.getMinutes();
            var hours = date.split(':')[0];
            var minutes = date.split(':')[1];

            var ampm = hours >= 12 ? 'pm' : 'am';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            //minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
            return strTime;
        }

            var config = {
            enableTime: true,
            dateFormat: timeFormat == "AM/PM" ? "h:i K": "H:i",
            noCalendar: true,
            altFormat: timeFormat == "AM/PM" ? "h:i K" : "H:i",
            altInput: true,
            allowInput: true,
            time_24hr: timeFormat == "AM/PM" ? false : true,
            onChange: [
                function(selectedDates, dateStr, instance){
                    //...
                    this._selDateStr = dateStr;
                },
            ],
            onClose: [
                function(selDates, dateStr, instance){
                    if (this.config.allowInput && this._input.value && this._input.value !== this._selDateStr) {
                        this.setDate(this.altInput.value, false);
                    }
                }
            ]
        };
          $("input[type='checkbox'][name='days']").change(function() {


            var hourFrom = flatpickr($('#'+ this.value + '_from'), config);
            var hourTo = flatpickr($('#'+ this.value + '_to'), config);

            if(this.checked){
                hourFrom.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourFrom) : defaultHourFrom, false);
                hourTo.setDate(timeFormat == "AP/PM" ? formatAMPM(defaultHourTo) : defaultHourTo, false);
            }else{
                hourFrom.clear();
                hourTo.clear();
            }
        });

        $('input:radio[name="primer"]').change(function(){
            if($(this).val() == 'map') {
                $("#clear_area").hide();
            }else if($(this).val() == 'area' && isClosed){
                $("#clear_area").show();
            }
        });
  
</script>
@endsection
