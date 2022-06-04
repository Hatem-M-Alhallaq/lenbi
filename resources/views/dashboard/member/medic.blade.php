{{-- Extends layout --}}
@extends('layout.default')
@section('title','Member')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">medicines View
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
            
                <!--end::Dropdown-->
                <!--begin::Button-->
          <button class="btn btn-primary" data-toggle="modal" data-target="#edit_model">
                <i class="fa fa-info"></i>add 
                </button>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="kt_datatable">
                <thead>
                <tr>
                    <th>#</th>
                     <th>medicines</th>
                    <th>settings</th>

                </tr>
                </thead>
                <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($medic as $medics)
                <tr>
                    <td><span class="badge bg-info">#{{++$counter}}</span></td>
                    <td>{{$medics->medicine}}</td>
                    <td>
                       <div class="btn-group">
                        <a data-toggle="modal" data-target="#delete_model_{{$medics->id}}" class="btn btn-danger mr-2" >
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                    </td>
                </tr>
                 
                @endforeach
                </tbody>
            </table>
                  <span class="span">
                {{$medic->links()}} 
              </span>
        </div>
    </div>
    @foreach ($medic as $medics)
        <div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;"> 
                             <br />
                             <label>medicines</label>
                        <input type="text" class="form-control" name="member_id" id="member_id" value="{{$medics->member_id}}" hidden>
                            <input type="text" class="form-control" name="medicine" id="medicine" value="{{$medics->title}}">
                            <br />
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-round btn-danger" data-dismiss="modal">
                        No, cancel!
                    </button>
                    <button onclick="performStore()" class="btn btn-round btn-info">Yes, edit it!</button>

                </div>

            </div>

        </div>

    </div> 
    @endforeach
    @foreach($medic as $medics)
    <div class="modal fade" id="delete_model_{{$medics->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <a href="{{route('Medic-remove',['id'=>$medics->id])}}" class="btn btn-round btn-danger">Yes, delete it!</a>
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

    function performStore(id) 
         {
        
        let formData = new FormData();
             formData.append('member_id',document.getElementById('member_id').value);
            formData.append('medicine',document.getElementById('medicine').value);
            storeRefresh('/cms/admin/medicine/store',formData);
        }
</script>
@endsection
