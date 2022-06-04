{{-- Extends layout --}}
@extends('layout.default')
@section('title','Hospital')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Clink Hospital
                </h3>
            </div>
            @can('create-clink')
            <div class="card-toolbar">
                <!--begin::Dropdown-->
            
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{route('clinks.create')}}" class="btn btn-primary font-weight-bolder">
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
                </span>New Hospital</a>
                <!--end::Button-->
            </div>
            @endcan
        </div>

        <div class="card-body">



            <table class="table table-separate table-head-custom table-checkable"  >
                <thead>
                <tr>
                   
                    <th>#</th>
                    <th>id</th>
                     <th>Username</th>
                     <th>Email</th>
                    <th>address</th>
                    <th>Mobile</th>
                     <th>Expiry of subscription</th>
                    <th>rhythm of visit</th>
                    <th>user type</th>
                    {{-- @if(Auth::guard('admin')->check()) --}}
                    <th>created by</th>
                    {{-- @endif --}}
                    <th>settings</th>

                </tr>
                </thead>
                <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($clinks as $clink)
                @if($clink->model != 'user')
                <tr>
                    <td><span class="badge bg-info">#{{++$counter}}</span></td>
                    <td>{{$clink->id}}</td>
                    <td>{{$clink->Username}}</td>
                    <td>{{$clink->email}}</td>
                    <td>{{$clink->address}}</td>
                    <td>{{$clink->mobile}}</td>
                     <td>{{$clink->expiry_of_subscription}}</td> 
                    <td>{{$clink->rhythm_of_visit}}</td>
                     @if($clink->model == 'admin')
                        <td>Main Branch</td>
                    @elseif ($clink->model == 'clink')
                        <td>branch</td>
                
                   @endif  
             <td>{{$clink->created_by}}</td>
                      <td>  
                    <a href="{{route('clinks.edit',[$clink->id])}}" class="btn btn-xs btn-info"
                    style="color: white;">Edit</a>
                    @if(Auth::guard('admin')->user())
                    <a href="{{route('showResetPasswordView',[$clink->id])}}" class="btn btn-xs btn-info"
                    style="color: white;">reset password</a>
                    @endif
                </td>
                   @endif   
                </tr>
                @endforeach
           
                </tbody>
         

            </table>
                      <span class="span">
                {{$clinks->links()}} 
              </span>
        </div>
 
    </div>

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
    let url = '/cms/admin/admins/'+id;
    confirmDestroy(url, reference);
  }
</script>
@endsection
