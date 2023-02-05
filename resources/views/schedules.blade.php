<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Doctor Appointment-MS</title>

    <!-- Fonts -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  
</head>

<body style="background-color: rgb(255, 255, 255)">

 

   

    <div class=" mb-5">
            <a href="/" class="btn btn-light mt-5 ml-3 text-primary">Back to Home </a>
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                <div class="row">
                        <div class="col-md-4 mb-5">
                            <img src="{{asset('img/doctors.svg')}}" class="imgbanner" width="100%" alt="">
                            <br>
                            <h3 style="text-align: center;font-weight:bold;color:#269444">
                               ONLINE DOCTOR
                                    
                               
                            </h3>
                            <h6 style="text-align: center;color:rgb(93, 95, 107);font-weight:bold">
                                Appointment Management System
                            </h6>
                       
                           
                        </div>
                        <div class="col-md-8" style="margin-top: 120px;">
                                        <h3 style="font-weight:bold;color:rgb(78, 142, 226)">Doctor Schedules</h3>
                            <div class="container reveal table-responsive" >
                            <table class="table table-sm table-bordered mt-4 table-hover" style="font-size:14px">
  <thead>
    <tr class="table-success">
      <th scope="col">Doctor</th>
      <th scope="col">Date of Appointment</th>
      <th scope="col">Time | Start</th>
      <th scope="col">Time | End</th>
      <th scope="col">No of Patient to Accommodate</th>
      <th scope="col">No of Vacancy</th>
      <th scope="col">Specialization</th>
      <th scope="col">Status</th>
      <th scope="col">Remarks</th>

    </tr>
  </thead>
  <tbody>
 @foreach ($doctorwsched as $row)
    <tr class="table-primary">
        <td colspan="9" style="font-weight:bold;text-align:center">Dr. {{$row->name}} Schedules</td>
    </tr>
    

 @endforeach
  </tbody>
</table>
                                      
                                
                                        
                            </div>
                      

                        </div>
                    </div>


                </div>
                <div class="col-md-1"></div>
             
            </div>
        </div>
       
    </div>
       
               
        <br><br>

        <span id="footer">Doctor Appointment-MS &middot; All rights Reserved | 2023</span>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="canvasbody">

        </div>
    </div>
    @if (session('Success'))
        <script>
            swal("Your Password Changed Successfully!", "You can now login and feel free to give us some feedbacks. Thank you!",
                "success");
        </script>
    @endif

    <script>
        function reveal() {
            var reveals = document.querySelectorAll(".reveal");
            for (var i = 0; i < reveals.length; i++) {
                var windowHeight = window.innerHeight;
                var elementTop = reveals[i].getBoundingClientRect().top;
                var elementVisible = 150;
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add("active");
                } else {
                    reveals[i].classList.remove("active");
                }
            }
        }

        window.addEventListener("scroll", reveal);

        // To check the scroll position on page load
        reveal();
        $('#btnbars').click(function() {
            $('.tabs ul').attr('style', 'display:inline-block;z-index:1');
        })
        var nav = $('.tabs').html();
        $('#canvasbody').html(nav);

        $('#submitbtn').click(function() {
            $('.txtbox').val('');

            swal("Thanks for Sending Message!", "We get back to you Soon!", "success")
        })
    </script>
   



</body>

</html>
