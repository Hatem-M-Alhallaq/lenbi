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
            Create Admin Password
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

       <div class="alert alert-danger" id="error_alert" role="alert" hidden>
         <ul id="error_messages_ul"></ul>
        </div>  

              {{-- <input id="clink_id" type="clink_id" value="{{$id}}" class="form-control"
                                                    hidden> --}}

                                    <div class="col-md-8">
                                    
                                        <div class="form-group">
                                            <label for="newPasswordInput">New Password</label>
                                            <input id="new_password" name="new_password" type="password" class="form-control"
                                                   placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="newPasswordConfirmationInput">New Password Confirmation</label>
                                            <input id="new_password_confirmation" name='new_password_confirmation' type="password" class="form-control"
                                                   placeholder="New Password Confirmation">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" onclick="performStore()" class="btn btn-primary">Reset
                                        Password
                                    </button>
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
        //    formData.append('clink_id',document.getElementById('clink_id').value);
            formData.append('new_password',document.getElementById('new_password').value);
            formData.append('new_password_confirmation',document.getElementById('new_password_confirmation').value);
 

    storeRoute('/cms/admin/password/admin/reset', formData)
    }
      

</script>
@endsection
