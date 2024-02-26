<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use File;
class ProfileController extends Controller
{
       public function change_password(Request $request)
   {
      $validator=Validator::make($request->all(),[
         'old_password'        =>'required',
         'new_password'         =>'required|min:8|max:30',
         'confirm_password' =>'required|same:new_password'
      ]);
      if ($validator->fails()) {
         return response()->json([
            'message'=>'validations fails',
            'errors' =>$validator->errors()
         ],422);
      }
      $user=$request->user();

      if (Hash::check($request->old_password,$user->password)) {
         $user->update([
            'password'=>Hash::make($request->new_password)
         ]);


         return response()->json([
            'message'=>' password successfully updated',
            'errors' =>$validator->errors()
         ],200);
      }
      else
      {
         return response()->json([
            'message'=>'old password does not match',
            'errors' =>$validator->errors()
         ],422);
      }
   }

    public function update_profile(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'surname'=>'nullable|max:100',
            'image'=>'nullable|image|mimes:jpg,bmp,png',
            'email'=>'nullable|max:100',
            'practice_number'=>'nullable|max:100',
            'phone_number'=>'nullable',
            'whatsapp_number'=>'nullable',
            'is_verified'=>'nullable',
            'company'=>'nullable',
            'type'=>'nullable'


        ]);
        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validations fails',
                'errors'=>$validator->errors()
            ],422);
        } 

        $user=$request->user();

        if($request->hasFile('image')){
            if($user->image){
                $old_path=public_path().'/uploads/profile_images/'.$user->image;
                if(File::exists($old_path)){
                    File::delete($old_path);
                }
            }

            $image_name='profile-image-'.time().'.'.$request->image->extension();
            $request->image->move(public_path('/uploads/profile_images'),$image_name);
        }else{
            $image_name=$user->image;
        }


        $user->update([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'image'=>$image_name,
            'email'=>$request->email,
            'practice_number'=>$request->email,
            'phone_number'=>$request->phone_number,
            'whatsapp_number'=>$request->whatsapp_number,
            'is_verified'=>$request->is_verified,
            'company'=>$request->company,
            'type'=>$request->type

        ]);

        return response()->json([
            'message'=>'Profile successfully updated',
        ],200);


    }
}
