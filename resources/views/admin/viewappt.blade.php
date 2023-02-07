<div class="container">
    <div class="table-responsive">
        <table class="table" id="myTable"> 
            <thead>
              <tr>
                <th scope="col">Patient Data</th>
                <th scope="col">Appointment Details</th>
                  <th scope="col">Status</th>
                <th scope="col">Action</th>          
              </tr>
            </thead>
            <tbody>
                @if(count($data)>=1)
                @foreach ($data as $row)

                @php
                $schedule = DB::select('select * from schedules where id ='.$row->apptID.' ');
                $category = DB::select('select * from categories where id = '.$row->category.'');
               //  $doctor   = DB::select('select * from users where id = '.$row->doctor.' ');
                $userinfo = DB::select('select * from users where id = '.$row->user_id.' ')
            @endphp
                <tr>
                    <td>
                        Appointment No: {{$row->id}}
                        <br>
                        @foreach ($userinfo as $user)

                        @php
                       $p_id = $user->id;
                                                   
                         @endphp
                        {{$user->name}}
                        <br>
                        <span style="font-size:12px" class="text-secondary">{{$user->email}} </span>
                        <br>
                       <span class="text-secondary" style="font-size:13px">
                        
                          {{$user->address}}
            
                       
                      </span>
                            
                        @endforeach   

                    </td>
                    <td>
                            
           <h6 style="font-size:14px">Specialization : <span class="text-primary" style="font-weight:bold">
            @foreach ($category as $cat)
                {{$cat->name}}
            @endforeach
            </span>
            <br>
              @foreach ($schedule as $sched)
            Date of Appointment : <span class="text-danger">{{date('F j,Y',strtotime($sched->dateofappt))}}</span>
            <br>
            Time Frame :  <span class="text-danger">{{date('h:i a',strtotime($sched->timestart))}} - {{date('h:i a',strtotime($sched->timeend))}}</span>
            <br>
            @if($sched->remarks)
            Remarks : <span class="text-danger">
              {{$sched->remarks}}
            </span>
            @endif
  
          
            Purpose :  <span class="text-danger">
              {{$row->purpose}}
            </span>


  
  
              @endforeach 
              <br>
            <h6 style="font-size:14px" class="text-info">
                Medical History
            </h6>
            @include('admin.viewhistory')
        


          </h6>
                    </td>
                    <td>
                        @php
                        switch ($row->status) {
                         case '0':
                           echo '<span class="badge bg-warning">Pending</span>';
                           break;
                           case '1':
                           echo '<span class="badge bg-primary">Approved</span>';
                           break;
                           case '2':
                           echo '<span class="badge bg-danger">Cancelled</span>';
                           break;
                           case '3':
                           echo '<span class="badge bg-danger">Disapproved</span>';
                           break;
                           case '4':
                           echo '<span class="badge bg-success">Completed</span>';
                           break;
                         
                        }
                     @endphp



                    </td>
                    <td>
                
            @if($row->status == 0)
            <button data-id="{{$row->id}}" class="btn btn-light btnapprove text-primary btn-sm">Approve <i class="fas fa-check-circle"></i></button>
            <button  data-id="{{$row->id}}" class="btn btncancel btn-light text-danger btn-sm">Disapprove <i class="fas fa-times-circle"></i></button>

            @elseif($row->status == 1)

            @include('admin.approve_appointment')

            @endif   

                    </td>
                </tr>
                @endforeach
                @else 
                <tr>
                    <td style="text-align: center" colspan="4">
                        No Data Found
                    </td>
                </tr>

                @endif
            </tbody>
          </table>
    </div>
</div>

<script>
       $('.btnapprove').click(function(){
        var id =$(this).data('id');
       
             
        swal({
  title: "Are you sure to Approve this Booking? ",
  text: "",
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
       
   
    })
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>         

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
$(document).ready( function () {
            $('#myTable').DataTable();

           
} );
</script>   