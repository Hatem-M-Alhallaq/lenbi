{{-- Extends layout --}}
@extends('layout.default')

@section('title','Member')
@section('page_description','Create Admin')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
@endsection

{{-- Content --}}
@section('content')


<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Edit Visitors
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
                                 <input type="text" id="id" value="{{$member->id}}" class="form-control form-control-solid" hidden/>

                <label>First Name:</label>
                <input type="text" id="first_name" value="{{$member->first_name}}" class="form-control form-control-solid"
                    placeholder="Enter First Name" required/>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" id="last_name" value="{{$member->last_name}}" class="form-control form-control-solid"
                    placeholder="Enter Last Name" required/>
            </div>
            <div class="form-group">
                <label>Company:</label>
                <input type="text" id="Company" value="{{$member->Company}}" class="form-control form-control-solid"
                    placeholder="Enter Company" required/>
            </div>
              <div class="form-group">
                <label>Emirates ID:</label>
                <input type="text" id="emirates_id" value="{{$member->emirates_id}}" class="form-control form-control-solid"
                    placeholder="Enter emirates id" required/>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" value="{{$member->email}}" class="form-control form-control-solid" placeholder="Enter Email" required/>
            </div>
            <div class="form-group">
                <label>Mobile</label>
                <input type="number" id="mobile" value="{{$member->mobile}}" class="form-control form-control-solid" placeholder="Enter mobile" required/>
            </div>
               <div class="form-group">
                <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                    <label>image</label>
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


jQuery(document).ready(function() {
    KTFormRepeater.init();
});

    function performStore() 
    {
        let formData = new FormData();
              formData.append('id',document.getElementById('id').value);

             formData.append('first_name',document.getElementById('first_name').value);
            formData.append('last_name',document.getElementById('last_name').value);
            formData.append('email',document.getElementById('email').value);
            formData.append('mobile',document.getElementById('mobile').value);
            formData.append('emirates_id',document.getElementById('emirates_id').value);
            formData.append('Company',document.getElementById('Company').value);
            formData.append('image',document.getElementById('image').files[0]);
             store('/cms/admin/members/updates',formData);
    }
    
</script>
@endsection
