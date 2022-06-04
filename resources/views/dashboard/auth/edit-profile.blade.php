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
                <label>First Name:</label>
                <input type="text" id="first_name"  class="form-control form-control-solid" placeholder="Enter First Name"/>
            </div>
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" id="last_name"  class="form-control form-control-solid" placeholder="Enter Last Name"/>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" class="form-control form-control-solid" placeholder="Enter Email" />
            </div>
             <div class="form-group">
                <label>Mobile</label>
                <input type="number" id="mobile" class="form-control form-control-solid" placeholder="Enter mobile" />
            </div>
            <div class="form-group">
                <label>B.D</label>
                <input type="date" id="birth_date" class="form-control form-control-solid" placeholder="Enter B.D"/>
            </div>
            <div class="form-group">
                
                {{-- <input type="file" class="custom-file-label" name="image">
                <label class="custom-file-label" for="image">Choose Image</label> --}}
                <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
					<div class="image-input-wrapper" style="background-image: "></div>
						<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
							<i class="fa fa-pen icon-sm text-muted"></i>
								<input type="file" id="image" accept=".png, .jpg, .jpeg">
									<input type="hidden" name="profile_avatar_remove">
										</label>
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="Cancel avatar">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
												</span>
													</div>
            </div>
              <div class="form-group">
              <label>Gender</label>
                 <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                   <input type="radio" id="male" name="gender" checked>
                      <label for="male">
                         Male
                         </label>
                          </div>
                            <div class="icheck-primary d-inline">
                             <input type="radio" id="female" name="gender">
                              <label for="female">
                              Female
                       </label>
                     </div>
               </div>
            </div>
          
        </div>
     </div>
      <div class="card-footer">
         <button type="button" onclick="performUpdate()" class="btn btn-primary mr-2">Submit</button>
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

    function performUpdate() {
        
        let data = {
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            birth_date: document.getElementById('birth_date').value,
            gender: document.getElementById('male').checked ? "M" : "F",          
            image: document.getElementById('image').files[0],

        };
    update('/cms/admin/profile/update', data);
    }

       

</script>
@endsection
