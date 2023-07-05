<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
class UserLogicController extends Controller
{

    public function SearchDoctor(Request $request)
    {
         //$brands=DB::table('brand')->get();
          //$brands= DB::table('products')->where('subcategory_id',$id)->select('brand_id')->groupBy('brand_id')->get();
          $item=$request->search;
          $doctor=DB::table('doctors')
                       ->where('name','LIKE', "%{$item}%")
                       ->orWhere('specialization','LIKE', "%{$item}%")
                       ->get();
        
          return view('dashboard.user.search',compact('doctor'));
    
    }

    public function viewProfile($id){
        
        $user=DB::table('doctors')->where('id',$id)->first();
        return view('dashboard.user.barber-profile-details',compact('user')); 

    }

    public function appoinmentDoctor($id){

        $appoinment=DB::table('doctors')->where('id',$id)->first();
        return view('dashboard.user.barber-appoinment',compact('appoinment'));

    }

    public function appoinment(Request $request){
        $check_times= $request->appoinment_time;
        $check_date= $request->appoinment_date;
        
       $time_date_Check=DB::table('appoinment')->where('appoinment_time',$check_times)->where('appoinment_date',$check_date)->first();
       if($time_date_Check == null){
        if(Auth::check()){
            $data=array();   
            $data['first_name']=$request->first_name;
            
            $data['appoinment_date']=$request->appoinment_date;
            $data['appoinment_time']=$request->appoinment_time;
            $data['email']=$request->email;
            $data['last_name']=$request->last_name;
            $data['phone']=$request->phone;
            $data['payment']=$request->payment;
            $data['doctor_id']=$request->doctor_id;
            $data['user_id']=Auth::user()->id;
            $data['status']=0;
           
    
            $done=DB::table('appoinment')->insert($data);
    
            if($done){
                $notification = array(
                    'message' => 'Appoinment  Done Successfully.',
                    'alert-type' => 'success'
                );
            return redirect()->back()->with($notification);
            }else{
            $notification = array(
                    'message' => 'Appoinment  Done Unsuccessfully',
                    'alert-type' => 'danger'
                );
            return redirect()->back()->with($notification);
            }
            
        }else{
            $notification = array(
                'message' => 'At First Login Your Account .',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
            
       }else if($time_date_Check->appoinment_date == $check_date && $time_date_Check->appoinment_time == $check_times){
        

        $notification = array(
            'message' => 'Change your Time this time already booked this time!! Thank youa nd try again!!! .',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

       }
    

    }

    public function UserProfileShow(){

        
        $user=DB::table('users')->where('id',Auth::user()->id)->first();
        $profile=DB::table('appoinment')
        ->join('doctors','appoinment.doctor_id','doctors.id')
        ->join('users','appoinment.user_id','users.id')
        ->select('appoinment.*','doctors.image','doctors.name','doctors.specialization','doctors.price')
        ->where('appoinment.user_id',Auth::user()->id)
        ->get();
        return view('dashboard.user.user-appoinment-show',compact('profile','user'));

    }

    public function DeleteUserCancelAppinment($id){
        $done=DB::table('appoinment')->where('id',$id)->delete();
        if($done){
            $notification = array(
                'message' => ' Delete Appoinment Successfully.',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }else{
        $notification = array(
                'message' => ' Delete UnSuccessfully',
                'alert-type' => 'danger'
            );
        return redirect()->back()->with($notification);
        }

    }

    public function UserProfileUpdate(){
        
        $user=DB::table('users')->where('id',Auth::user()->id)->first();
        
        return view('dashboard.user.user-profile-update',compact('user'));
    }
    
    public function UserPassChange(){
        $user=DB::table('users')->where('id',Auth::user()->id)->first();
        return view('dashboard.user.pass_change',compact('user'));

    }


}
