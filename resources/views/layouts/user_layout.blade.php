@guest 
<script>
    window.location.href = '/';
</script>
@else 
@if (Auth::user()->user_type == 'patient')
    @else 
    <script>
        window.location.href = '/';
    </script> 
@endif

@endguest
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Doctor Appointment-MS</title>

    <!-- Scripts -->
     <!-- Fonts -->
     <link rel="stylesheet" href="{{asset('css/app.css')}}"
     >
     <link rel="stylesheet" href="{{asset('css/admin.css')}}"
     >
     <link rel="stylesheet" href="{{asset('css/home.css')}}"
     >
     <link rel="stylesheet" href="{{asset('css/mobile.css')}}"
     >
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  

</head>

<body style="background-color: rgb(255, 255, 255)">

    <div id="app">
        <nav class="sidenav shadow" id="navitems">
            <div class="userinfo">
                @if(Auth::user()->image == null)
                <img src="https://img.freepik.com/free-icon/user_318-875902.jpg?w=2000" alt="" class="img-thumbnnail shadow rounded-circle"
                style="width: 60px;height: 60px;border-radius: 30px;">
                @else 
                <img src="{{asset('profile'.'/'.Auth::user()->image)}}" alt="" class="img-thumbnnail shadow rounded-circle"
                style="width: 60px;height: 60px;border-radius: 30px;">

                @endif


                        

                <div class="dropdown " style="font-weight: bolder;z-index: 9999">

                    <h6 style="text-align:center;margin-left:20px">
                        @if (Auth::check())
                       {{ Auth::user()->name }}
                        <br>
                    @endif
                    
                <span id="em" class="" style="font-weight: normal;font-size: 12px">
                    @if (Auth::check())
                   
                        {{ Auth::user()->email }}
                    @endif
    
                </span>
    
                     </h6>
               
                  <span id="username" class="dropdown-toggle" type="button"
                        id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></span>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="font-size: 13px;">
                        <li><a class="dropdown-item af" href="{{route('edit.account')}}">Profile</a></li>
                        <li>   <form id="logout" action="{{route('logout')}}" method="post">
                            @csrf
                            <a class="dropdown-item af" style="cursor: pointer" onclick="$('#logout').submit();">Logout</a>
                     </form></li>

                    </ul>
                </div>
                
               

            </div>
          <br>
            <div class="navigations">



                <ul class="nav accordion" id="accordionSidebar" style="font-size: 14px">




                  

                    <li class="nav-item navitems" id="dashboard">
                  <a class="nav-link navlinks " href="{{route('user.dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>

                    
                  




                    <!-- Divider -->
                {{--     <hr class="sidebar-divider">
 --}}
                    <!-- Heading -->
                  

                    <li class="nav-item navitems" id="book">
                        <a class="nav-link navlinks  " href="{{route('user.book')}}">
                                 
                            <i class="fas fa-book"></i>
                            <span>My Appointments </span></a>
                    </li>

               



                
                </ul>


            </div>


        </nav>


        <div class="topbar">
            <span class="topbartitle" style=""></span>
            <a class=" hf" id="canvas" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
               <i class="fas fa-bars"></i>
            </a>


            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header" style=" background-color: #9aa1bd;">
                    <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel"></h5>
                    <button type="button" class="btn-close " data-bs-dismiss="offcanvas"
                        style="background-color: white;" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body" id="canvasitems">

                </div>
            </div>


          {{--   <h6 class="  hf" id="abtext">
             Doctors-Appointment
            </h6> --}}

        </div>

        <main class="py-4">
            <div class="mt-5"></div>
            @yield('content')
        </main>
    </div>
    <h6 id="res" class="">Patient Appointment Scheduling-MS &middot; All rights Reserved &middot; 2023</h6>
    
    @if(Auth::user()->fl == 0)

    
 <button type="button" id="btnfirstlogin" class="btn btn-primary d-none" data-bs-toggle="modal" data-bs-target="#firstlogin" >
  
  </button>
  

  <div class="modal fade" id="firstlogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title hf" id="exampleModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         <h6 class="text-secondary af">We have Notice that this is your first Login . Please Change your password..</h6>

         <h6 class="text-secondary">
            New Password
         </h6>
         <input type="password" class="form-control" id="np" autocomplete="off">
         <div class="invalid-feedback" id="npfeed"></div>
         <h6 class="text-secondary">
            Confirm Password
         </h6>
         <input type="password" class="form-control" id="cp">
         <div class="invalid-feedback" id="cpfeed"></div>

         <button class="btn btn-primary  mt-3" id="sc">Save Changes</button>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>
  </div> 
  

  <script>
   $(document).ready(function(){
    $('#btnfirstlogin').click();

    $('#sc').click(function(){
        var np = $('#np').val();
        var cp = $('#cp').val();
        
        if(np == ''){
            $('#np').addClass('is-invalid');
            $('#npfeed').html('<span class="text-danger" style="font-size:13px">Please input new Password</span>');

        }else if (cp == ''){
            $('#cp').addClass('is-invalid');
            $('#cpfeed').html('<span class="text-danger" style="font-size:13px">Please Confirm your New Password</span>');
        }else if (np != cp) {
            $('#cp').addClass('is-invalid');
            $('#cpfeed').html('<span class="text-danger" style="font-size:13px">Password Does not Match!</span>');
        }else {
            
            $.ajax({
                url:'{{route("edit.firslogin")}}',
                method:'get',
                data:{newpass:np},
                success:function(data){
               swal ( "Successful" ,  "Password Changed Successfully!" ,  "success" );
               $('#firstlogin').modal('hide');
                }
            })


        }
    })

    $('#np').keyup(function(){
        $(this).removeClass('is-invalid');

    })
    $('#cp').keyup(function(){
        $(this).removeClass('is-invalid');
        var np = $('#np').val();
        var cp = $(this).val();

        if(np != cp){
            $(this).addClass('is-invalid');
            $('#cpfeed').html('<span class="text-danger" style="font-size:13px">Password Does not Match!</span>');
        }else {
            $(this).removeClass('is-invalid').addClass('is-valid');
            $('#cpfeed').html('<span class="text-success" style="font-size:13px">Password Match</span>');
        }


        
        
    })
   });
  </script> 
    @endif
    <script>
        var div1 = document.getElementById("navitems");
        var div1html = document.getElementById("canvasitems");
        div1html.innerHTML = div1.innerHTML;
    </script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>         

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
$(document).ready( function () {
            $('#myTable').DataTable();

            $('#{{ $tab }}').attr('style', 'background-color: #EAE7B1;');
} );
</script>   

</body>

</html>
