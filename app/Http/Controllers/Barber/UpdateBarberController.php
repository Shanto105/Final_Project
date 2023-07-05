<?php

namespace App\Http\Controllers\Barber;
use \Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UpdateBarberController extends Controller
{
    
    public function updatedoctor(REQUEST $request){
        // /$data =Auth::id()

        $data=array();   
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['about']=$request->about;
        $data['experience']=$request->experience;
        $data['experience_year']=$request->experience_year;
        $data['award_date']=$request->award_date;
        $data['award_name']=$request->award_name;
        $data['award_description']=$request->award_description;

        $data['saturday_time']=$request->saturday_time;
        $data['sunday_time']=$request->sunday_time;
        $data['monday_time']=$request->monday_time;
        $data['tuesday_time']=$request->tuesday_time;
        $data['Wednesday_time']=$request->Wednesday_time;
        $data['thursday_time']=$request->thursday_time;
        $data['friday_time']=$request->friday_time;
        $data['price']=$request->price;
        
        $image=$request->image;

          if($image){
                $image_= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('public/slidder/'.$image_);
                $data['image']='public/slidder/'.$image_;
               
                $done=DB::table('doctors')->where('id',Auth::guard('doctor')->user()->id)->update($data);

                

                if($done){
                    $notification = array(
                        'message' => 'Profile Update Successfully.',
                        'alert-type' => 'success'
                    );
                return redirect()->back()->with($notification);
                }else{
                  $notification = array(
                        'message' => 'Profile Not Update',
                        'alert-type' => 'danger'
                    );
                return redirect()->back()->with($notification);
                }
                }else{
                    $done=DB::table('doctors')->where('id',Auth::guard('doctor')->user()->id)->update($data);

                            if($done){
                                $notification = array(
                                    'message' => 'Profile Update Successfully.',
                                    'alert-type' => 'success'
                                );
                            return redirect()->back()->with($notification);
                            }else{
                            $notification = array(
                                    'message' => 'Profile Not Update',
                                    'alert-type' => 'danger'
                                );
                            return redirect()->back()->with($notification);
                            }
                }

    }

    public function doctorprofile(){
        
        $user=DB::table('doctors')->where('id',Auth::guard('doctor')->user()->id)->first();

        return view('dashboard.barber.barber-profile',compact('user'));

    }



    public function allDoctorAppoinment(){
        $profile=DB::table('appoinment')
                    ->join('doctors','appoinment.doctor_id','doctors.id')
                    ->join('users','appoinment.user_id','users.id')
                    ->select('appoinment.*','doctors.image','doctors.name','doctors.specialization','doctors.price')
                    ->where('appoinment.doctor_id',Auth::guard('doctor')->user()->id)
                    ->get();
        return view('dashboard.barber.barber-appoinment-show',compact('profile'));
    }

    public function ConfirmAppoinment($id){
        //echo "Aschi";
        $data=array();   
        $data['status']=1;
        $done=DB::table('appoinment')->where('id',$id)->update($data);
        if($done){
            $notification = array(
                'message' => 'Appoinment Confirm Successfully.',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }else{
        $notification = array(
                'message' => 'Appoinment Confirm UnSuccessfully',
                'alert-type' => 'danger'
            );
        return redirect()->back()->with($notification);
        }

    }


    public function CencelAppoinment($id){

        $data=array();   
        $data['status']=2;
        $done=DB::table('appoinment')->where('id',$id)->update($data);
        if($done){
            $notification = array(
                'message' => 'Appoinment Cancel Successfully.',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }else{
        $notification = array(
                'message' => 'Appoinment Cancel UnSuccessfully',
                'alert-type' => 'danger'
            );
        return redirect()->back()->with($notification);
        }

    }


    public function DeleteAppoinment($id){

      
        $done=DB::table('appoinment')->where('id',$id)->delete();
        if($done){
            $notification = array(
                'message' => 'Appoinment Delete Successfully.',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }else{
        $notification = array(
                'message' => 'Appoinment Delete UnSuccessfully',
                'alert-type' => 'danger'
            );
        return redirect()->back()->with($notification);
        }

    }

    

    public function DoneAppoinment($id){

      
        $data=array();   
        $data['status']=2;
        $done=DB::table('appoinment')->where('id',$id)->update($data);
        if($done){
            $notification = array(
                'message' => 'Appoinment Done  Successfully.',
                'alert-type' => 'success'
            );
        return redirect()->back()->with($notification);
        }else{
        $notification = array(
                'message' => 'Appoinment Done UnSuccessfully',
                'alert-type' => 'danger'
            );
        return redirect()->back()->with($notification);
        }

    }

    public function category_doctor_list($id){
        $doctor =DB::table('doctors')
        ->join('category','doctors.cat_id','category.id')
        ->select('doctors.*','category.title')
        ->where('doctors.status',1)
        ->where('doctors.cat_id',$id)
        ->get();
        if($doctor){
            return view('dashboard.user.barberlist',compact('doctor'));
        }
        else{
            return view('dashboard.user.NOtFounddoctorlist');
        }
        
        
    }

    //storesDoctor

    public function storesDoctor(REQUEST $request){
        $data=array();   
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['cat_id']=$request->cat_id;
        $data['password']= Hash::make($request->password);
        $data['hospital']=$request->hospital;
        $data['specialization']=$request->specialization;	
        $data['status']=1;	
        $data['about']=$request->about;
        $data['university_name']=$request->university_name;
        $data['degree']=$request->degree;
        $data['year']=$request->year;
        $data['experience']=$request->experience;
        $data['experience_year']=$request->experience_year;
        $data['award_date']=$request->award_date;
        $data['award_name']=$request->award_name;
        $data['award_description']=$request->award_description;

        $data['saturday_time']=$request->saturday_time;
        $data['sunday_time']=$request->sunday_time;
        $data['monday_time']=$request->monday_time;
        $data['tuesday_time']=$request->tuesday_time;
        $data['Wednesday_time']=$request->Wednesday_time;
        $data['thursday_time']=$request->thursday_time;
        $data['friday_time']=$request->friday_time;
        $data['price']=$request->price;





       
 
        
        $image=$request->image;

          if($image){
                $image_= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(300,300)->save('public/slidder/'.$image_);
                $data['image']='public/slidder/'.$image_;
               
                $done=DB::table('doctors')->insert($data);

                

                if($done){
                    $notification = array(
                        'message' => 'Barber Account Created.',
                        'alert-type' => 'success'
                    );
                return redirect()->back()->with($notification);
                }else{
                  $notification = array(
                        'message' => 'Barber Account Not Created',
                        'alert-type' => 'danger'
                    );
                return redirect()->back()->with($notification);
                }
                }else{
                   
                    $notification = array(
                        'message' => 'Babrer Image  Must Be Uploaded.',
                        'alert-type' => 'warning'
                    );
                return redirect()->back()->with($notification);
                           
                           
                }

    }

    public function userProfileUpdateAccount(REQUEST $request){
        $data=array();   
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['date_of_brith']=$request->date_of_brith;
        $data['user_address']=$request->user_address;
        $data['Mobile']=$request->	Mobile;
        $data['city']=$request->city;
        $data['state']=$request->state;
       
        $image=$request->image;

        if($image){
              $image_= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
              Image::make($image)->resize(300,300)->save('public/slidder/'.$image_);
              $data['image']='public/slidder/'.$image_;
             
              $done=DB::table('users')->where('id',Auth::user()->id)->update($data);
              

              if($done){
                  $notification = array(
                      'message' => 'User Profile Update Successfully.',
                      'alert-type' => 'success'
                  );
              return redirect()->back()->with($notification);
              }else{
                $notification = array(
                      'message' => ' Profile Not Update',
                      'alert-type' => 'danger'
                  );
              return redirect()->back()->with($notification);
              }
              }else{
                $done=DB::table('users')->where('id',Auth::user()->id)->update($data);
                          if($done){
                              $notification = array(
                                  'message' => 'User Profile Update Successfully.',
                                  'alert-type' => 'success'
                              );
                          return redirect()->back()->with($notification);
                          }else{
                          $notification = array(
                                  'message' => ' Profile Not Update',
                                  'alert-type' => 'danger'
                              );
                          return redirect()->back()->with($notification);
                          }
              }
       



    }

    public function PassChange(REQUEST $request){ 
        $oldpass=$request->oldpassword;
        $user=DB::table('users')->where('id',Auth::user()->id)->first();
        $dpa=$user->password;
        
        if(Hash::check($oldpass,$user->password)){
           
            $data=array();   
            $data['password']=Hash::make($request->newpassword);
            DB::table('users')->where('id',Auth::user()->id)->update($data);
            $notification = array(
                'message' => ' Password Change successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
            //return response()->json('Success');
        }else{
            $notification = array(
                'message' => 'Old Password Not Match Try Again!!.',
                'alert-type' => 'warning'
            );
        return redirect()->back()->with($notification);
        }
        

    }


    

    
}
