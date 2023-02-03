@extends('layouts.superadmin_layout')
@section('content')
    <div class="container">
        <div class="titlebar">
            <h4 class="hf mb-3">Doctors</h4>
            

        </div>

        <div class="card shadow-sm">
            <div class="card-body">
           <div class="container">
            <button class="btn btn-secondary btn-sm px-3 mb-2" onclick="window.location.href='{{route('superadmin.add_doctor')}}' ">Add</button>

            @if(Session::get('Success'))
            <div class="row">
             
                 <div class="alert alert-success alert-dismissible fade af show" role="alert">
                    {{Session::get('Success')}}
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>
           
            </div>
            
         @endif
            <div class="table-responsive">
                <table class="table table-striped table-sm af" style="font-size: 14px" id="myTable">
                    <thead>
                      <tr class="table-success">
                        <th scope="col">Name</th>
                        <th scope="col">License</th>
                        <th scope="col">Email & Contact No</th>
                        <th scope="col">Specialization</th>
                        <th scope="col">Appt-Schedules</th>
                        <th scope="col">Date-added</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td style="font-weight: bold">Dr. {{$row->name}}</td>
                            <td>
                                License#: {{$row->license}}
                            </td>
                            <td>
                               {{$row->email}}
                                <br>
                                #{{$row->contactno}}
                            </td>
                            <td>
                          
                                @foreach ($category as $ee)
                                @if($ee->id == $row->specialization)
                                <span class="text-primary" style="font-weight: bold;text-transform:uppercase">{{$ee->name}}</span>
                                @endif
                            @endforeach
                            </td>
                            <td>
                             <button class="btn btn-light text-primary border-success btn-sm" data-bs-toggle="modal" data-bs-target="#viewappt{{$row->id}}">View all  <span class="badge bg-danger">5</span></button>


<!-- Modal -->
<div class="modal fade" id="viewappt{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title " id="exampleModalLabel"><span style="font-weight:bold">Dr. {{$row->name}}</span>  Schedules</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        

      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
                            </td>
                            <td>{{Date('@h:ia F j,Y',strtotime($row->created_at))}}</td>
                          
                            <td>
                                <div class="btn-group">
                                    <button onclick="window.location.href='{{route('superadmin.edit_doctor',$row->id)}}' " class="btn btn-light btn-sm text-success"><i class="fas fa-edit"></i></button>
                                    <button data-id="{{$row->id}}" class="btndelete btn btn-light btn-sm text-danger"><i class="fas fa-trash-can"></i></button>
                                </div>
                            </td>
                          </tr>
                            
                        @endforeach
                      
                     
                    </tbody>
                  </table>
            </div>
           </div>
            </div>
        </div>
    </div>

    <script>
          $('.btndelete').click(function(){
        var id =$(this).data('id');
        
       
        swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $(this).html('Deleting ..');
    window.location.href='{{route("delete.delete_doctor")}}'+'?id='+id;
  } else {
  
  }
});
    })
      
    </script>

@endsection