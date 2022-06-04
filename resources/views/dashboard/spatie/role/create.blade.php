{{-- Extends layout --}}
@extends('layout.default')
@section('title','Role')

@section('styles')
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
@endsection

{{-- Content --}}
@section('content')


<div class="card card-custom">

    <div class="card-header">
        <h3 class="card-title">
            Create Role
        </h3>
        <div class="card-toolbar">
            <div class="example-tools justify-content-center">
                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
            </div>
        </div>
    </div>
    <form class="form" method="post" id="create_form">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Guard</label>
                <select class="form-control form-control-solid" name="guards" id="guards">
                    @if (Auth::guard('admin')->check())
                        <option value="admin">Admin</option>
                        @endif
                        <option value="clink">Hospital</option>

                    </select>
                    </div>
            <div class="form-group">
                <label>Role:</label>
                <input type="text" name="name" id="name"  class="form-control form-control-solid" placeholder="Enter Permission"/>
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
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('crudjs/crud.js')}}"></script>
<script>
        //Initialize Select2 Elements
    $('.guards').select2({
        theme: 'bootstrap4'
    })
    function performStore(){
     let data = {
        name: document.getElementById('name').value,
        guard_name: document.getElementById('guards').value
        };
        storeRoute('/cms/admin/roles',data);
        }



  
</script> 
@endsection
