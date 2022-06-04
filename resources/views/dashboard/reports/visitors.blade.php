{{-- Extends layout --}}
@extends('layout.default')
@section('title','Reports Events')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Reports Visitors 
                </h3>
            </div>
           
            <div class="card-toolbar">
                
            </div>
                <div class="form-group col-md-4" style="float:left;">
                        <label for="exampleSelect1">search <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="search" id="search" style="float:left;">
                    </div>
        </div>

        <div class="card-body">
            <a class="btn btn-primary btn-sm" href="{{ url('/cms/admin/visitors/reports/xlsx') }}"><i class="fa fa-download"></i> XLSX</a>
   <div id="searchName">
            <table class="table table-separate table-head-custom table-checkable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Company</th>
                    <th>Emirates ID</th>
                    <th>Medicines</th>
                    <th>Status</th>
                    <th>Craeted by Clinic</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                {{-- @php
                    $counter = 0;
                @endphp --}}
                @foreach ($members as $member)
                <tr>
                    <td>{{$member->id}}</td>
                    <td> <img  width="50" height="50" class="rounded-circle img-thumbnail" src="{{ asset('members/' .$member->image) }}" alt=""> </td>
                    <td>
                        <div>{{$member->first_name}} {{$member->last_name}}</div>
                    </td>
                    <td>{{$member->mobile }}</td>
                    <td>{{$member->email }}</td>
                    <td>{{$member->Company }}</td>
                    <td>{{$member->emirates_id }}</td>
                    <td>
                        @php
                            $medicines = $member->medicines->pluck('medicine')->toArray();
                        @endphp
                        {{ implode(' - ', $medicines) }}
                    </td>
                    <td>{{$member->status }}</td>
                    <td>{{$member->clink->Username }}</td>
                    <td> <a href="{{ url('cms/admin/events/reports?member_id=' . $member->id) }}" class="badge badge-info">Events</a> </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
 
    </div>
</div>
@endsection

{{-- Styles Section --}}
{{-- @section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection --}}


{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    {{-- <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> --}}
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{asset('crudjs/crud.js')}}"></script>

 <script>
   $.ajaxSetup({
          headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
           });
         $("#search").keyup(function() {

            var text = $("#search").val();

            //   var bills = $("#allbills").val();
            console.log(text);

            var token = $("#token").val();
            $.post('{{ url('cms/admin/serach/visitor/reports') }}', {
                // bills:bills,
                text: text,
                _token: token
            }).done(function(data) {
                console.log(data)

                $('#searchName').html(data.html);

            });

        });
        </script>
@endsection
