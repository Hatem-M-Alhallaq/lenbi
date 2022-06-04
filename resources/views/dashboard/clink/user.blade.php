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
            Create user
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
            @if(Auth::guard('admin')->check())
            <div class="form-group">
                <label>clink:</label>
                <select class="form-control form-control-solid" name="clink_id" id="clink_id">
                    @foreach ($clink as $clinks)
                    <option value="{{$clinks->id}}">{{$clinks->Username}}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <label>Role:</label>
                <select class="form-control form-control-solid" name="role_id" id="role_id">
                    @foreach ($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
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

                if(document.getElementById('clink_id') != null){
                 formData.append('clink_id',document.getElementById('clink_id').value);
                 }
            formData.append('email',document.getElementById('email').value);
            formData.append('password',document.getElementById('password').value);
            formData.append('username',document.getElementById('username').value);
 
       

    storeRoute('/cms/admin/clink/user', formData)
    }
      

</script>
@endsection
