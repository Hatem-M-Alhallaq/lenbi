{{-- Extends layout --}}
@extends('layout.default')
@section('title','Member')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Visitors View
                </h3>
            </div>
             @can('create-members')
             @if(Auth::guard('clink')->check())
            <div class="card-toolbar">
                <!--begin::Dropdown-->
            
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{route('members.create')}}" class="btn btn-primary font-weight-bolder">
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
                </span>New Members</a>
                <!--end::Button-->
                
            </div>
            @endif
            @endcan
        </div>
             
        <div class="card-body">
    
                        <div class="form-group col-md-4" style="float:right;">
                        <label for="exampleSelect1">search <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="search" id="search" style="float:right;">
                    </div>
            <div id="searchItems">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                   
                    <th>#</th>
                     <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>company</th>
                    <th>emirates ID</th>
                    <th>status</th>
                    <th>image</th>
                   @if (Auth::guard('admin')->check())
                    <th>created By</th>
                    @endif
               
                </tr>
                </thead>
                <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($members as $member)
                <tr>
                    <td><span class="badge bg-info">#{{++$counter}}</span></td>
                    <td>{{$member->first_name}}</td>
                    <td>{{$member->last_name}}</td>
                    <td>{{$member->email}}</td>
                    <td>{{$member->mobile}}</td>
                     <td>{{$member->Company}}</td>
                    <td>{{$member->emirates_id}}</td>
                    @can('user-status')
                        <td>
                    <div class="form-group row">
                    <div class="col-3">
                    <span class="switch">
                    <label>
                    <input type="checkbox" class="toggle-switch" data-toggle="toggle" data-on="active"
                    data-off="Deactive" id="{{$member->id}}" @if($member->status == "active")
                        checked="checked"
                        value="active"
                        @else
                        value="block"
                        @endif
                        >                 <span></span>
                        </label>
                            </span>
                    </div>         
                            </td>
                            @endcan
                     <td> 
                    <img class="rounded-circle" src="{{url('members/'.$member->image)}}" width="50" height="50">
                    </td>
                     @if (Auth::guard('admin')->check())
                    <td>{{$member->clink->Username}}</td>
                     @endif
               
                    <td> <a 
                   href="{{route('medicines',['id'=>$member->id])}}" class="btn btn-xs btn-info" style="color: white;" >
                    ({{$member->medicines_count}})/medicines
                  </a>
                </td>
                    <td> <a 
                   href="{{route('members.edit',[$member->id])}}" class="btn btn-xs btn-info" style="color: white;" >
                    Edit
                  </a>
                </td>
                </tr>
                @endforeach
           
                </tbody>
         

            </table>

                  <span class="span">
                {{$members->links()}} 
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
    {{-- <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('crudjs/crud.js')}}"></script>
<script>
    $.ajaxSetup({
          headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
           });
       $("input.toggle-switch").change(function(){
        var id = $(this).attr('id');
        var member_toggle_value = $(this).attr('value');
        if(member_toggle_value == "active")
        {
            member_toggle_value = "block";
        }
        else
        {
            member_toggle_value = 'active';
        }
        $.ajax({
            url: "{{route('members.status')}}",
            type: "POST",
            cache: false,
            data: {
                    id: id ,
                    member_toggle_value:member_toggle_value,
                    },
                   
                dataType: "json",
                success:function(response) {

                }
            });
        });
           $("#search").keyup(function() {

            var text = $("#search").val();

            //   var bills = $("#allbills").val();
            console.log(text);

            var token = $("#token").val();
            $.post('serach/member', {
                // bills:bills,
                text: text,
                _token: token
            }).done(function(data) {
                console.log(data)

                $('#searchItems').html(data.html);

            });

        });
        </script>
@endsection
