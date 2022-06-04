{{-- Extends layout --}}
@extends('layout.default')


{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Roles View
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
            
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{route('roles.create')}}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>New Role</a>
                <!--end::Button-->
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover" id="kt_datatable">
                <thead>
                <tr>   
                  <th>#</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Guard</th>
                  <th>Permissions</th>
                   <th>created By Guard</th>
                  <th>created By </th>
                  <th>Settings</th>
                </tr>
                </thead>

               <tbody>
                <span hidden>{{$counter = 0}}</span>
                 @foreach ($roles as $role)
                <tr>
                  {{-- <span class="tag tag-success">Approved</span>s --}}
                  <td><span class="badge bg-info">#{{++$counter}}</span></td>
                  <td>{{$role->id}}</td>
                   <td>{{$role->name}}</td>
                  <td><span class="badge bg-success">  @if($role->guard_name == 'clink')Hospital
                   @else
                   admin
                   @endif</span></td>
                  <td><a href="{{route('role.permissions.index',$role->id)}}"
                      class="btn btn-primary mr-2">({{$role->permissions_count}})
                      permission/s</a></td>
                       
                   <td>@if($role->guard_name == 'clink')Hospital
                    @elseif($role->guard_name == 'admin')admin
                     
                    @endif
                </td>
                  @php
                  $user = App\Models\clink::where('id',$role->clink_id)->first();
                  @endphp 
                     @php
                  $userAdmin = App\Models\Admin::where('id',$role->clink_id)->first();
                  @endphp 
                    @if($role->guard_name == 'clink')
                    <td>{{$user->Username ?? null}}</td> 
                    @elseif($role->guard_name == 'admin')
                    <td>{{$userAdmin->username ?? null}}</td> 
                    @endif
                      <td>
                    <div class="btn-group">
                      <a href="{{route('roles.edit',$role->id)}}" class="btn btn-primary mr-2" >
                        <i class="fas fa-edit"></i>
                      </a>
                        <a data-toggle="modal" data-target="#delete_model_{{$role->id}}" class="btn btn-danger mr-2" >
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
          
            </table>
        </div>
 
    </div>
    @foreach($roles as $role)
    <div class="modal fade" id="delete_model_{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                         
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h1>
                        <i class="fa fa-exclamation"></i>
                    </h1>
                    <h2>Are you sure?</h2>
                    <p>You Will Not Be Able To Recover This Item Again?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-default" data-dismiss="modal">
                        No, cancel!
                    </button>
                    <a href="{{route('role-remove',['id'=>$role->id])}}" class="btn btn-round btn-danger">Yes, delete it!</a>
                </div>
            </div>
        </div>
    </div>
    
@endforeach
@endsection

{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('crudjs/crud.js')}}"></script>
<script>
  function performDestroy(id, reference){
    let url = '/cms/admin/roles/'+id;
    confirmDestroy(url, reference);
  }
</script>
@endsection
