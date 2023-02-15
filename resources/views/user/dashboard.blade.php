@extends('layouts.user_layout')
@section('content')
    <div class="container">


        
        @if (session()->has('Error'))
        <script>
            swal("Booking Unsuccessful!", "You have already set an appointment on your selected Schedules!", "error").then(()=>{
                location.reload();
            });
        </script>

            {{session()->forget('saveappt')}}
        @endif
        @if(session()->has('Successbooked'))
        <script>
            swal("Booked Successfully!", "Your request is still pending, and waiting for approval.", "success").then(()=>{
                location.reload();
            });
            
        </script>
            {{session()->forget('saveappt')}}
        @endif


        <div class="titlebar">
            <h4 class="hf mb-3">Dashboard</h4>


        </div>
       
        @if (Session::has('upt'))
            <script>
                swal("Updated!", "Account updated successfully!", "success")
            </script>
        @endif

        @if(Session::has('accept'))
        <script>
            swal("Accepted!", "Appointment Accepted successfully!", "success")
        </script>

        @endif

        @if(Session::has('saveaccept'))
        <script>
            swal("Accepted!", "Appointment Schedule set and  Accepted successfully!", "success")
        </script>

        @endif

        

        <h5></h5>
        <div class="row">

            <div class="col-md-3">
                <a href="{{ route('user.book') }}" style="text-decoration:none">
                    <div class="card shadow bg-light" style="height: 100px;border-left: 10px solid rgb(99, 178, 202);border-bottom:1px dashed gray">
                        <div class="card-body">
                            <h5 class="text-primary af" style="font-weight:bold">
                                Pending


                            </h5>
                            <span class=" badge bg-danger">
                                @isset($pending)
                                    {{ count($pending) }}
                                @endisset
                            </span>
                            <h1 style="position: absolute;right:10px;top:0;padding:10px">

                                <i class="fas fa-circle-minus text-secondary"></i>
                            </h1>

                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('user.book') }}" style="text-decoration:none">
                    <div class="card shadow" style="height: 100px;border-left:10px solid rgb(81, 129, 87);border-bottom:1px dashed gray">
                        <div class="card-body">
                            <h5 class="text-primary af" style="font-weight:bold">
                                Approved


                            </h5>
                            <span class="badge bg-danger">
                                @isset($approved)
                                    {{ count($approved) }}
                                @endisset
                            </span>
                            <h1 style="position: absolute;right:10px;top:0;padding:10px">

                                <i class="fas fa-check-circle text-secondary"></i>
                            </h1>

                        </div>
                    </div>
                </a>
            </div>





            <div class="col-md-3">
                <a href="{{ route('user.book') }}" style="text-decoration:none">
                    <div class="card shadow" style="height: 100px;border-left:10px solid rgb(194, 63, 63);border-bottom:1px dashed gray">
                        <div class="card-body">
                            <h5 class="text-primary af" style="font-weight:bold">
                                Cancelled

                            </h5>
                            <span class="badge bg-danger">
                                @isset($cancelled)
                                    {{ count($cancelled) }}
                                @endisset
                            </span>
                            <h1 style="position: absolute;right:10px;top:0;padding:10px">

                                <i class="fas fa-ban text-secondary"></i>
                            </h1>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">

                <div class="card shadow" style="height: 100px;border-left:10px solid rgb(168, 63, 194);border-bottom:1px dashed gray">
                    <div class="card-body">
                        <h5 class="text-primary af" style="font-weight:bold">
                            Referred


                        </h5>
                        <span class="badge bg-danger">
                            @isset($referred)
                                {{ count($referred) }}
                            @endisset
                        </span>
                        <h1 style="position: absolute;right:10px;top:0;padding:10px">
                            <i class="fas fa-circle-arrow-right text-secondary"></i>

                        </h1>

                    </div>
                </div>

            </div>


        </div>



        <div class="row mt-5">
            <div class="col-md-8">
        
            </div>

            <div class="col-md-4">
            
            </div>

        </div>
    </div>

    <script>

        $('.btnaccept').click(function(){

            var id = $(this).data('id');
            var refdoctor = $(this).data('ref');
            var refclinic = $(this).data('refclinic');
          
           swal({
  title: "Are you sure?",
  text: "Once accepted, they will be expecting you on this date and time stated.",
  icon: "info",
  buttons: true,
  dangerMode: false,
})
.then((willDelete) => {
  if (willDelete) {
    window.location.href='{{route("edit.accept_newSchedule")}}'+'?id='+id+'&doctor='+refdoctor+"&clinic="+refclinic;
  } 
});
         //   alert('aww');
        })
        
    $('.btncancel').click(function(){
        var id =$(this).data('id');

        swal("Please Write a Remarks or Reason of Declining Your Appointment:", {
  content: "input",
  icon: "warning",
  dangerMode: true,
})
.then((value) => {
 if(value == ''){
    swal({
  title: "Remarks Required!",
  text: "Please provide a Remarks or Reason of Declining.",
  icon: "error",
  button: "Close",
  dangerMode: true,
});
 }else {
    $(this).removeClass('btn-primary').addClass('btn-light').html('<span class="text-danger" style="font-size:12px">Declining..</span>'); 
   window.location.href='{{route("edit.cancel_appointment")}}'+'?id='+id+'&remarks='+value;

  
 }
});
       
     /*    swal({
  title: "Are you sure to Disapproved this Booking? ",
  text: "Patient can still resend the request after 1 day of disapproval",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $(this).removeClass('btn-primary').addClass('btn-light').html('<span class="text-danger" style="font-size:12px">Disapproving..</span>'); 
   window.location.href='{{route("home.disapprove_booking")}}'+'?id='+id;
  } else {
  
  }
}); */
    })
    </script>

    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Booking Update in Statistics"
                },
                data: [{
                    type: "pie",
                    startAngle: 240,
                    yValueFormatString: "=##0\"\"",
                    indexLabel: "{label} {y}",
                    dataPoints: [{
                            y: @isset($approved)
                                {{ count($approved) }}
                            @endisset ,
                            label: "Approved"
                        },


                        {
                            y: @isset($cancelled)
                                {{ count($cancelled) }}
                            @endisset ,
                            label: "Cancelled"
                        },
                        {
                            y: @isset($pending)
                                {{ count($pending) }}
                            @endisset ,
                            label: "Pending"
                        },

                        {
                            y: @isset($referred)
                                {{ count($referred) }}
                            @endisset ,
                            label: "Referred"
                        },
                        {
                            y: @isset($disapproved)
                                {{ count($disapproved) }}
                            @endisset ,
                            label: "Disapproved"
                        }
                    ]
                }]
            });
            chart.render();

        }
    </script>
@endsection
