@extends('layouts.admin_layout')

@section('content')



   <div class="container">
    
    <div class="titlebar">
        <h4 class="hf mb-3">Appointments</h4>

        @if(Session::get('Success'))
        
             <div class="alert alert-success alert-dismissible fade af show" role="alert">
                {{Session::get('Success')}}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>
         
        
     @endif
     

     <div class="dropdown">
      <button  class="shadow btn btn-light btn-sm mb-2 text-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Advance Options <i class="fas fa-cogs"></i> <i class="fas fa-arrow-right"></i>
      </button>
      <ul class="dropdown-menu">
      
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 13px" >Pending</a></li>
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 13px" >Approved</a></li>
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 13px">Cancelled</a></li>
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 13px" >Disapproved</a></li>
        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 13px">Completed</a></li>
      </ul>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title fs-5" id="exampleModalLabel"></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="viewappts">   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
     
      </div>
    </div>
  </div>
</div>
  
    </div>
   

    <div class="row">
      <div class="col-md-6">


        <div class="card shadow mb-2">
          
          <div class="card-body text-secondary" style="font-size:14px">
           
            @if(count($data)>=1)
            @foreach ($data as $row)
            
            @endforeach
            @else
              No Data Found
            @endif




          </div>

      


      </div>
    
    </div>

   
   </div>
   <script>
   $('.btnapprove').click(function(){
        var id =$(this).data('id');
        var doc = $(this).data('doc');
             
        swal({
  title: "Are you sure to Approved this Booking? ",
  text: "Please make sure that Dr. "+doc+" is Available, before proceeding..",
  icon: "warning",
  buttons: true,
  dangerMode: false,
})
.then((willDelete) => {
  if (willDelete) {
    $(this).removeClass('btn-primary').addClass('btn-light').html('<span class="text-primary" style="font-size:12px">Approving..</span>'); 
   window.location.href='{{route("home.approve_booking")}}'+'?id='+id;
  } else {
  
  }
});
    })

    $('.btncannot').click(function(){
        swal({
            title:"Doctor Unavailable!",
            text: "Disapproved Appointment or wait for the Doctors availability",
            dangerMode: true,
            });
    })
    $('.btncancel').click(function(){
        var id =$(this).data('id');

        swal("Please Write a Remarks:", {
  content: "input",
  icon: "warning",
  dangerMode: true,
})
.then((value) => {
 if(value == ''){
    swal({
  title: "Remarks Required!",
  text: "Please provide a Remarks to inform the patient.",
  icon: "error",
  button: "Close",
  dangerMode: true,
});
 }else {
    $(this).removeClass('btn-primary').addClass('btn-light').html('<span class="text-danger" style="font-size:12px">Disapproving..</span>'); 
   window.location.href='{{route("home.disapprove_booking")}}'+'?id='+id+'&remarks='+value;
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
@endsection