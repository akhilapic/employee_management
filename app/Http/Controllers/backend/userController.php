<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\User;
class userController extends Controller
{
    public function index()
    {   
        //$users = User::where('role',97)->get();
        //$users = DB::table('users')->get();
        $users=User::where('status','!=',4)->where('role',97)->where('id', '!=' , 8)->where('id', '!=' , 72)->orderby('id','desc')->get();
         dd($users);
        return view('Pages.customer', compact('users'));
    }

    public function create() {
        return view('pages.user-create');
    }

   public function store(Request $request)
    {
        if($request->all())
        {


            $user =new  User();
            $validatedData = $request->validate([
              'full_name' => 'required',
              'employee_id' => 'required',
              'emergency_contact_no' => 'required',
              'valid_upto' => 'required',
              'level'=>'required'
            ]);

            $user->full_name = $request->full_name;
            $user->employee_id = $request->employee_id;
            $user->emergency_contact_no = $request->emergency_contact_no;
            $user->agency = $request->agency;
            $user->valid_upto= $request->valid_upto;
            $user->level= $request->level;
            $user->dob= isset($request->dob)? $request->dob:'';
            $user->doj= isset($request->doj)? $request->doj:'';
           
            $user->work_station= isset($request->work_station) ? $request->work_station : '';
            $user->date_of_training= isset($request->date_of_training) ? $request->date_of_training : '';
            $user->authorized_by= isset($request->authorized_by) ? $request->authorized_by : '';
            $user->blood_group= isset($request->blood_group) ? $request->blood_group : '';
            $user->address = isset($request->address) ? $request->address : '';

            $user->status = 1;

            $nameTaken = $user->where('employee_id', $request->employee_id)->count();
            $emergency_contact_no = $user->where('emergency_contact_no', $request->emergency_contact_no)->count();

            if($nameTaken > 0){
                $result=array('employee_id'=> false,'message'=> 'Employee id is allready taken.');
            }elseif($emergency_contact_no > 0){
                $result=array('emergency_contact_no'=> false,'message'=> 'Emergency contact no is allready taken.');
            }else{
                $user->updated_at = date("Y-m-d h:i:s");
                $user->created_at = date("Y-m-d h:i:s");
                $fileimage="";
                $image_url='';

                if($request->hasfile('image')){
                    
                    $file_image=$request->file('image');
                    $fileimage=$file_image->getClientOriginalName();
                    $destination=public_path("images");
                    $file_image->move($destination,$fileimage);
                    $image_url=url('public/images').'/'.$fileimage;
                    $user->image =$image_url;
                }    
                else
                {
                    $user->image="";
                }

                $user->role="97";
                $users =  $user->save();
                if($users){
                    $result=array('status'=>true,'message'=> 'Data Insert Successfully.');
                }else{
                    $result=array('status'=>false,'message'=> 'Data Insert Not Successfully.');
                }
            }
            echo json_encode($result);
        }
    }

    public function userview(Request $request,$id){
        $id = $request->id;
        $user = DB::table('users')->where('id', $id)->first();
        return view('Pages.master.user_view',compact('user'));
    }


   
    public function delete(Request $request, $id)
    {   
        $id = $request->id;
        $user = User::where('id',$id)->update('status'=>4);
        return redirect('/user_list');
    }
    
    public function edit($id){
        $users = User::where('id',$id)->first();
        // $users = DB::table('users')->where('id',$id)->first();
        return view('Pages.user-edit', compact('users')); 
    }
    
    public function changeStatus(Request $request){
        $id = $request->user_id;
        $status = $request->status;
        $data = ['status'=>$status];
        $update =  DB::table('users')->where('id',$id)->update($data);
        if($update){
            $result = array("status"=> true, "message"=>"update status");
        }
        else{
            $result = array("status"=> false, "message"=>"not update status");
        }
    }


  
//ravi sir
    public function updateData(Request $request)
    {   
        $validatedData = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
          ]);
          $id=$request->user_id;
          $name = $request->name;
          $email = $request->email;
          $phone = $request->phone;
          $language = $request->language;

        $nameExists =  DB::table('users')->where('id',$id)->where('name',$name)->count();
        $emailExists =  DB::table('users')->where('id',$id)->where('email',$email)->count();

            $before = DB::table('users')->where('id',$id)->first();
            $date = date("Y-m-d h:i:s");
            
            if($before){
                $data = $data = ['name'=>$name ? $name : $before->name,'email'=>$email ?
                 $email : $before->email,'phone'=>$phone ? $phone : $before->phone, 'language'=>$language ? $language : $before->language,'updated_at'=>$date];;
               // $update =  DB::table('users')->where('id',$id)->update($data);
               $update =  DB::table('users')->where('id',$id)->update($data);
                if($update){
                    $result = array("status"=> true, "message"=>"User update success");
                }
                else{
                    $result = array("status"=> false, "message"=>"User not update success");
                }
            }
            else{
                 $result = array("status"=> false, "message"=>"User not update success");
            }    
       echo json_encode($result);
    }


    public function user_change_password(Request $request)
    {
        if(!empty($request->input()))
        {
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $id = $request->id;
             $users =  new User();
            
            $user =   $users->where("id",$id)->first();
            if($old_password==$new_password)
            {
                $result = array("status"=> false, "message"=>"Old Password and New Password should not be same");
            }
            else
            {
                if (!$user) {
                    $result = array("status"=> false, "message"=>"invalid old password");
                    
                 }

                 if (!Hash::check($old_password, $user->password)) {
                    $result = array("status"=> false, "message"=>"invalid old password");
                 }
                 else{
                    
                //    $result = array("status"=> false, "message"=>"invalid old password");
                    $data['password'] = Hash::make($new_password);
                  
                    $update = $user->where('id',$id) ->update($data);
                    $result = array("status"=> true, "message"=>"change password Successfully");
               }  
            }
         echo json_encode($result);
        }
    }
    

    public function update_admin_profile(Request $request)
    {
             if(!empty($request->input()))
            {
                   $image_url=url('public/images/userimage.png');
              //  dd($request->file());
                 //  dd($request->input());
                $id = $request->id;
                $usreData = DB::table('users')->where('id',$id)->first();
                $users =  new User();
                 $fileimage="";
                   $image_url='';
                   if($request->hasfile('file'))
                  {
                    $file_image=$request->file('file');
                    $fileimage=md5(date("Y-m-d h:i:s", time())).".".$file_image->getClientOriginalExtension();
                    $destination=public_path("images");
                    $file_image->move($destination,$fileimage);
                    $image_url=url('public/images').'/'.$fileimage;
                 
                  }
                  else
                  {
                    $image_url= $usreData->image;
                  }
                $user =   $users->where("id",$id)->first();
                $data['name'] = isset($request->name)? $request->name: $user->name;
                $data['image']=$image_url;
   
                $update = User::where('id', $id)->update($data);

                //$update =DB::table('users')->where('id',$id) ->update($data);
                //$update = $user->where('id',$id) ->update($data);
                if($update)
                {
                    $result = array("status"=> true, "message"=>"Profile Update Successfully");
                }
                else
                {
                    $result = array("status"=> true, "message"=>"Profile Update Fail");
                }
            }
        echo json_encode($result);
    } 


            public function userchangeStatus(Request $request)
            {
                dd($request->input());
                $id = $request->user_id;
                $status = $request->status;
                $data = ['status'=>$status,'reason'=>isset($request->reason) ? $request->reason : '' ];
                $update=  User::where('id', $id)->update($data);
                if($update){
                    $result = array("status"=> true, "message"=>"User status  deactive successfully ");
                }
                else{
                    $result = array("status"=> false, "message"=>"not update status");
                }
                echo json_encode($result);
            }

            public function userchangestatusactive(Request $request)
            {
              //  dd($request->input());
                $id = $request->id;
                $status = $request->status;
                $data1 = ['status'=>$status];
               // $updated=  DB::table('users')->where('id',$id)->update($data);
                 //User::where('id', $id)->update($data);
                 $updated=  User::where('id', $id)->update($data1);
                if($updated){
                    $result = array("status"=> true, "message"=>"User status  active successfully ");
                }
                else{
                    $result = array("status"=> false, "message"=>"not update status");
                }
                echo json_encode($result);
            }

    public function updaterusers(Request $request)
    {
         if($request->all())
        {
            $user =new  User();
            $validatedData = $request->validate([
              'full_name' => 'required',
              'employee_id' => 'required',
              'emergency_contact_no' => 'required',
              'valid_upto' => 'required',
              'level'=>'required'
            ]);
           // dd($request->all());
            $getuserdata = User::where("id",$request->user_id)->first();
          

            $data['full_name'] = isset($request->full_name)  ? $request->full_name : $getuserdata->full_name;
            
            $data['employee_id'] = isset($request->employee_id) ? $request->employee_id : $getuserdata->employee_id;

            $data['emergency_contact_no'] = isset($request->emergency_contact_no) ? $request->emergency_contact_no : $getuserdata->emergency_contact_no;
            $data['agency'] = isset($request->agency) ? $request->agency : $getuserdata->agency;

            $data['valid_upto']= isset($request->valid_upto) ? $request->valid_upto : $getuserdata->valid_upto;
            
            $data['level']= isset($request->level) ? $request->level :$getuserdata->level;
            
            $data['dob']= isset($request->dob)? $request->dob:$getuserdata->dob;
            
            $data['doj']= isset($request->doj)? $request->doj:$getuserdata->doj;
           
            $data['work_station']= isset($request->work_station) ? $request->work_station : $getuserdata->work_station;

            $data['date_of_training']= isset($request->date_of_training) ? $request->date_of_training : $getuserdata->date_of_training;
            $data['authorized_by']= isset($request->authorized_by) ? $request->authorized_by : $getuserdata->authorized_by;
            $data['blood_group']= isset($request->blood_group) ? $request->blood_group : $getuserdata->blood_group;
            $data['address'] = isset($request->address) ? $request->address : $getuserdata->address;

          
                $data['updated_at'] = date("Y-m-d h:i:s");
                $fileimage="";
                $image_url='';

                if($request->hasfile('image')){
                    
                    $file_image=$request->file('image');
                    $fileimage=$file_image->getClientOriginalName();
                    $destination=public_path("images");
                    $file_image->move($destination,$fileimage);
                    $image_url=url('public/images').'/'.$fileimage;
                    $data['image'] =$image_url;
                }    
                else
                {
                    $data['image']=$getuserdata->image;
                }
                $data['role']="97";
              
                $users =  User::where('id',$request->user_id)->update($data);
                if($users){
                    $result=array('status'=>true,'message'=> 'Data Update Successfully.');
                }else{
                    $result=array('status'=>false,'message'=> 'Data Update Not Successfully.');
                }
            }
            echo json_encode($result);
        }
    
}
