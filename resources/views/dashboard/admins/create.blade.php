{{-- Extends layout --}}
@extends('layout.default')

@section('title','Admin')
@section('page_description','Create Admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
@endsection

{{-- Content --}}
@section('content')


<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Create Admin
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form class="form" method="post" id='create_admin_form'>
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
                <label>username:</label>
                <input type="text" id="username" class="form-control form-control-solid"
                    placeholder="Enter First Name" />
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

                <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                    <div class="image-input-wrapper" style="background-image: "></div>
                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                        data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" id="image" accept=".png, .jpg, .jpeg">
                        <input type="hidden" name="profile_avatar_remove">
                    </label>
                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                        data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                </div>
            </div>
        </div>
</div>
<div class="card-footer">
    <button type="button" onclick="performStore()" class="btn btn-primary mr-2">Submit</button>
    <button type="reset" class="btn btn-secondary">Cancel</button>
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
            formData.append('username',document.getElementById('username').value);
                formData.append('role_id',document.getElementById('role_id').value);

            formData.append('email',document.getElementById('email').value);
            formData.append('password',document.getElementById('password').value);
            formData.append('image',document.getElementById('image').files[0]);

       
    storeRoute('/cms/admin/admins', formData)
    }
       

</script>
@endsection
