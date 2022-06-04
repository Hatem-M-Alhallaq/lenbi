{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

{{-- Dashboard 1 --}}

@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- Extends layout --}}
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{asset('crudjs/crud.js')}}"></script>

<html>

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @csrf
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

</head>

<body>






</body>

</html>

<script>

$(document).ready(function ()
{
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });


    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:"{{route('full-calender')}}",

        selectable:true,
        selectHelper: true,

        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                    url:"{{route('full-calender.action')}}",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function showMessage(data) {
                console.log(data);
                Swal.fire({
                position: 'center',
                icon: data.icon,
                title: data.title,
                showConfirmButton: false,
                timer: 1500
                })
                }
            })
        },
        eventDrop: function(event, delta)
        {



            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                    url:"{{route('full-calender.action')}}",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function showMessage(data) {
                console.log(data);
                Swal.fire({
                position: 'center',
                icon: data.icon,
                title: data.title,
                showConfirmButton: false,
                timer: 1500
                })
                }
            })


        },

        eventClick:function(event)
        {

            if ( event.check_in == null && event.check_out == null)
            {
                @can('check_in')
                Swal.fire
                ({
                    title: 'Where are you! ?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `check in`,
                    cancelButtonText: `check out`,
                    denyButtonText: `Don't save`,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) =>
                {
                    if (result.isConfirmed) {
                         changeEventStatus(event, 'check_in');
                    } else if (result.dismiss === Swal.DismissReason.cancel){
                         changeEventStatus(event, 'check_out');
                    }
                })
                @endcan
            }else if (event.check_out == null && event.check_in != null)
            {
                @can('check_out')
                Swal.fire
                ({
                    title: 'Where are you! ?',
                    // showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: `check out`,
                    // cancelButtonText: ``,
                    // denyButtonText: `Don't save`,
                }).then((result) =>
                {
                    if (result.isConfirmed) {
                        changeEventStatus(event, 'check_out');
                    } else{

                    }
                })
                @endcan
            } else{
                Swal.fire('Not More action', '', 'info');
            }

            function changeEventStatus(event, type = 'check_in')
            {
                var id = event.id;
                $.ajax
                ({
                    url:"{{route('full-calender.action')}}",
                    type:"POST",
                    data:{
                        id:id,
                        type: type
                    },
                    success:function showMessage(data)
                    {
                        if ( data.code_response == 302 )
                        {
                            Swal.fire({
                                position: 'center',
                                icon: data.icon,
                                title: data.title,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }else{
                            Swal.fire({
                                position: 'center',
                                icon: data.icon,
                                title: data.title,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        console.log(data);


                       window.setTimeout(function(){location.reload()},1000)

                    }
                })
            }


        }
    });

});

function LoadCalendar() {
        if (typeof calendar != "undefined") {
            document.getElementById("calendar").innerHTML = "";
        }
        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
        //... parameters
        });
        calendar.render();
    }

</script>

<script>
    $.ajaxSetup({
          headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
           });
       $("input.toggle-switch").change(function(){
        var id = $(this).attr('id');
        var member_toggle_value = $(this).attr('value');

        if($(this).prop("checked") != true)
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


         function performStore()
    {

        let formData = new FormData();
             formData.append('title',document.getElementById('title').value);
            formData.append('start',document.getElementById('start').value);
            formData.append('end',document.getElementById('end').value);
            formData.append('user_id',document.getElementById('user_id').value);
            storeRefresh('/cms/admin/full-calender/store', formData);
    }
        function check()
         {

        let formData = new FormData();
             formData.append('event_id',document.getElementById('event_id').value);
        if (document.getElementById('check_in') != null ) {
             formData.append('check_in',document.getElementById('check_in').value);

        }
        if (document.getElementById('check_out') != null ) {
             formData.append('check_out',document.getElementById('check_out').value);

        }
            storeRefresh('/cms/admin/checkIn/store', formData);

    }
        </script>



@endsection
