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
            Create Hospital
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form class="form" method="post" id='create_form'>
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label>Role:</label>
                <select class="form-control form-control-solid" name="role_id" id="role_id">
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" id="first_name" class="form-control form-control-solid"
                    placeholder="Enter Name" />
            </div>
            <div class="form-group">
                <label>address:</label>
                <input type="text" id="address" class="form-control form-control-solid"
                    placeholder="Enter address" />
            </div>
            <div class="form-group">
                <label>Username:</label>
                <input type="text" id="username" class="form-control form-control-solid"
                    placeholder="Enter username" />
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" class="form-control form-control-solid" placeholder="Enter Email" />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" id="password" class="form-control form-control-solid"
                    placeholder="Enter Password" />
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="number" id="mobile" class="form-control form-control-solid" placeholder="Enter mobile" />
            </div>
            @if(Auth::guard('admin')->user())
            <div class="form-group">
                <label>Expiry of subscription</label>
                <input type="date" id="expiry_of_subscription" class="form-control form-control-solid" placeholder="Enter Expiry of subscription" />
            </div>
            @endif
             <div class="form-group">
                <label>rhythm of visit</label>
                <input type="number" id="rhythm_of_visit" class="form-control form-control-solid" placeholder="Enter Days" />
            </div>
        </div>

         
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
                                <input id="{{ $key.'_from' }}" name="{{ $key.'_from' }}"
                                   class="form-control" type="time"
                                    placeholder="{{ __('Time') }}">
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
                                <input id="{{ $key.'_to' }}" name="{{ $key.'_to' }}"
                                    class="form-control" type="time"
                                    placeholder="{{ __('Time') }}">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
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
    function performStore() {
        let formData = new FormData(); 
            formData.append('role_id',document.getElementById('role_id').value);
            formData.append('first_name',document.getElementById('first_name').value);
            formData.append('address',document.getElementById('address').value);
            formData.append('email',document.getElementById('email').value);
            formData.append('password',document.getElementById('password').value);
            formData.append('mobile',document.getElementById('mobile').value);
            formData.append('username',document.getElementById('username').value);
            formData.append('rhythm_of_visit',document.getElementById('rhythm_of_visit').value);
            if (document.getElementById('expiry_of_subscription') != null ) {
            formData.append('expiry_of_subscription',document.getElementById('expiry_of_subscription').value);     
            }      
            formData.append('0_from',document.getElementById('0_from').value);
            formData.append('1_from',document.getElementById('1_from').value);
            formData.append('2_from',document.getElementById('2_from').value);
            formData.append('3_from',document.getElementById('3_from').value);
            formData.append('4_from',document.getElementById('4_from').value);
            formData.append('5_from',document.getElementById('5_from').value);
            formData.append('6_from',document.getElementById('6_from').value);
            formData.append('0_to',document.getElementById('0_to').value);
            formData.append('1_to',document.getElementById('1_to').value);
            formData.append('2_to',document.getElementById('2_to').value);
            formData.append('3_to',document.getElementById('3_to').value);
            formData.append('4_to',document.getElementById('4_to').value);
            formData.append('5_to',document.getElementById('5_to').value);
            formData.append('6_to',document.getElementById('6_to').value);
            data = $('#create_form').serialize();

    storeRoute('/cms/admin/clinks', formData)
    }
      

</script>
@endsection
