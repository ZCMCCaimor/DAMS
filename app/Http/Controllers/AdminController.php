<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Feedback;
use App\Models\attachments;
use App\Models\Ref_history;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        if(!auth()->check()){
          return redirect('/');
        }
        $id = Auth::user()->specialization;
        $dr = Auth::user()->id;
        $appt = Appointment::where('category',$id)->where('doctor',$dr)->get();
        $Doctor= User::where('user_type','doctor')->where('id',Auth::user()->id)->get();
        $category = Category::where('id',$id)->get();
        $Appointment = Appointment::where('category',$id)->where('doctor',$dr)->get();
        $data = Appointment::where('category',$id)->where('doctor',$dr)->where('status',0)->limit(4)->get();
        $allnew =Appointment::where('category',$id)->where('doctor',$dr)->where('status',0)->get();
         $user = User::all();
        $Patients = DB::select('select * from users where user_type="patient" and id in (select user_id from appointments where category ='.$id.' and doctor = '.$dr.' )');

        $datenow=date('Y-m-d');
        $schedule = DB::select('select * from schedules where doctorid = '.$dr.' and "'.$datenow.'" < dateofappt ');

        $feedback = Feedback::where('clinic',$id)->get();
        // $refer =   DB::select('select * from category where id in (select category from appointments where status=4 and refferedto ='.$id.' ) ');
      $refer = [];
    
        $tab = 'dashboard';
       return view('admin.dashboard',compact('tab','appt','Doctor','Appointment','Patients','category','data','user','feedback','refer','allnew','schedule'));
    }
    public function appointment(){
  
     
        $id = Auth::user()->id;
        $datenow = date('Y-m-d');
        $data = Appointment::where('doctor',$id)->where('status',0)->orWhere('status',1)->get();
        // $datawexpiry = DB::select('select * from appointments  where doctor = '.$id.' and status = 0 and  "'.$datenow.'" > dateofappointment;');
        
      // if(count($datawexpiry)>=1){
      //  foreach ($datawexpiry as $key => $value) {
      
      //   if($datenow > $value->dateofappointment){
      //       if($value->laps == 0){
      //         $userd = [];
      //         $getuser = User::findorFail($value->user_id);

              
      //         return redirect()->route('mail.notifylaps',['appt_id'=>$id,'userid'=>$getuser->id,'email'=>$getuser->email,'name'=>$getuser->name]);
      //       }
        
      //   }
      // }
      // }
   

        $Doctor = Auth::user();  
        $completeappt = Appointment::where('status',4)->where('doctor',Auth::user()->id)->get();
        $user = User::all();
        $tab = 'appointment';
        $alldoctor = User::where('user_type','doctor')->get();

        return view('admin.appointment',compact('tab','data','Doctor','user','completeappt','alldoctor'));
    }

    public function schedules(){
      $tab = 'schedules';

    
      $data = Schedule::where('doctorid',Auth::user()->id)->get();

      return view('admin.schedules',compact('tab','data'));
    }

    public function patient(){
        $id = Auth::user()->id;
      
        
        $data = DB::select('select * from users where user_type="patient" and id in (select user_id from appointments where doctor ='.$id.') ');
        $tab = 'patient';
        $appt = Appointment::where('doctor',$id)->get();
       return view('admin.patient',compact('tab','data','appt'));
    }
    public function referral(){

        echo 'TO DO';
        // $id = Auth::user()->clinic;
        // $cli = Clinic::where('id',$id)->get();
        // $clinicsName =  $cli[0]['name'];
        // $data = DB::select('select * from appointments where clinic = '.$id.' and status=1 or  refferedto = '.$id.'  ');
        // $user = User::all();
        // $clinic = Clinic::all();
        // $refhistory = Ref_history::all();
        // $appr_appointments = Appointment::where('status',1)->where('clinic',$id)->get();
        // $referred = DB::select('select * from clinics where id in (select clinic from appointments where status=4 and refferedto ='.$id.' and ad_status= 0  ) ');
        // $tab = 'referral';

        // return view('admin.referral',compact('tab','data','user','doctor','clinic','referred','appr_appointments','clinicsName','refhistory'));
    }

  

   
    public function feedback(){

     
       echo 'maintenance';
        // $user = User::all();
        // $alluser = DB::select('select * from users where id in (select user_id from feedback where clinic = '.$clinic_id.' )');
        // $data = Feedback::where('clinic',$clinic_id)->orderBy("created_at", "desc")->get();


        // $tab = 'feedback';
        // return view('admin.feedback',compact('tab','data','user','clinicsName','alluser'));
    }

    public function adddoctor(){
        $tab= 'doctors';
        $clinic_id = Auth::user()->clinic; 
        $cli = Clinic::where('id',$clinic_id)->get();
        $clinicsName =  $cli[0]['name'];
        $category = Category::where('clinic',$clinic_id)->get();
        return view('admin.action.add_doctor',compact('tab','category','clinicsName'));
    }

    public function edit_doctor(Request $request){
        $data = Doctor::where('id',$request->id)->get();
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $tab = 'doctors';
        return view('admin.action.edit_doctors',compact('tab','data','clinicsName'));
        
    }
    public function approved(){

        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Appointment::where('clinic',$id)->where('status',1)->get();
        $Doctor = Doctor::where('clinic',$id)->get();
        $user = User::all();
        $tab = 'appointment';
       
          $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
       
      
        return view('admin.approve_appointment',compact('tab','data','Doctor','user','clinicsName','completeappt','alldoctor','allclinic'));
      }

      public function completed(){
        $id = Auth::user()->clinic;
        $cli = Clinic::where('id',$id)->get();
        $clinicsName =  $cli[0]['name'];
        $data = Appointment::where('clinic',$id)->where('status',3)->get();
        $Doctor = Doctor::where('clinic',$id)->get();
        $user = User::all();
        $tab = 'appointment';
      
          $completeappt = Appointment::where('status',3)->get();
        $alldoctor = Doctor::all();
        $allclinic = Clinic::all();
       
      
        return view('admin.completed_appointment',compact('tab','data','Doctor','user','clinicsName', 'completeappt','alldoctor','allclinic'));
      }

      public function refer(Request $request){
        $tab ='referral';
        $id = $request->id;
        $userpatient = User::where('id',$request->patientId)->get();
        $remarks = $request->remarks;
     
        if($remarks == 'undefined'){
            $remarks = '';
        }else {
            $remarks = $remarks;
        }

        $appt_attachedfile = Appointment::findorFail($id)->attachedfile;
      
       //DB::select('select * from doctors where clinic != '.$clinicid.' ')
        $data = DB::select('select * from users where user_type="doctor" and id != '.Auth::user()->id.' ');
        $category = Category::all();
         return view('admin.action.refer',compact('tab','id','remarks','data','category','userpatient','appt_attachedfile'));
      }

      public function accept_referral(Request $request){
        $id = $request->id;
        $doctor = $request->ref;
        $patient = $request->patient;

       

        $data = Appointment::where('id',$id)->get();
        $clinicid = Auth::user()->clinic;
        $cli = Clinic::where('id',$clinicid)->get();
        $clinicsName =  $cli[0]['name'];
        $clinic= DB::select('select * from clinics where id in (select clinic from doctors where  id='.$doctor.' ) ');
        $category =DB::select('select * from categories where id in (select category from doctors where id = '.$doctor.' ) ');
        $doc = Doctor::where('id',$doctor)->get();

        $user = User::where('id',$patient)->get();

        foreach($clinic as $cl){
            $clinicname = $cl->name;
           
        }
       

       
        foreach($doc as $dc){
            $docname = $dc->firstname.' '.$dc->lastname;
        }
        $tab = 'referral';
        return view('admin.action.accept_referral',compact('tab','data','clinicid','clinicname','category','doc','docname','doctor','user','id','clinicsName'));
      }

      public function attachedfile(Request $request){
        $id = $request->input('apptid');
        if($request->file('imgfile')){
          // $imageName = time().'.'.$request->file('imgfile')->getClientOriginalExtension();
          // $request->file('imgfile')->move(public_path('attachments'), $imageName);

            foreach($request->file('imgfile') as $key => $files){
                $imagefile = $key.time().'.'.$files->getClientOriginalExtension();
              $files->move(public_path('attachments'),$imagefile);

              attachments::create([
                'appt'=>$id,
                'file'=>$imagefile,
              ]);

            }

            return redirect()->back();

      
  
        }
      }

      public function removeAttachment(Request $request){
        $id = $request->id;

        $appt_attachedfile = attachments::where('appt',$id)->get();

        foreach($appt_attachedfile as $items){
            $path =  public_path('attachments/' . $items->file);
            if(file_exists($path)){
              unlink($path);
            }

            attachments::where('appt',$id)->delete();
        }

        return redirect()->back();
        
     
  
      }
}
