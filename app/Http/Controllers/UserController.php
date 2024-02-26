<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Psr\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface as ContainerException;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

     public function __construct()
    {
        $this->middleware('auth', ['except' => [ 'profile']]);
    }
    public function profile($id)
    {
        $user = User::find($id);
        $user_id = auth()->user()->id;
        $usersettings = UserSettings::where('user_id', $user_id)->first();
        return view('user.profile', compact('user', 'usersettings') );
    }


    public function settings($id)
    {
        $user = User::find($id);
        return view('user.settings', compact('user') );
    }
    

    public function profileUpdate(Request $request){
        //validation rules

        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255'
        ]);
        $user =Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('message','Profile Updated');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(100);
        $user = auth()->user();
       //         $viewShareVars = ['users, user'];

       //  return view('user.index',compact($viewShareVars))
       //      ->with('i', (request()->input('page', 1) - 1) * 5);
                $usersettings = UserSettings::where('user_id', $user->id)->first();

        $user = auth()->user();
                $viewShareVars = ['user','users', 'usersettings'];

        return view('user.index',compact($viewShareVars));
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        User::create($request->all());
     
        return redirect()->route('admin.users')
                        ->with('success','User created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $user_id = auth()->user()->id;
        $usersettings = UserSettings::where('user_id', $user->id)->first();

        return view('user.show',compact('user', 'usersettings'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit',compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);


       
      
        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $path = $request->file('image')->store('public/images');
            $user->image = $path;
        }
        $user = \auth::user();

        $user->is_admin = $request['is_admin'];
        $user->is_verified = $request['is_verified'];


        $user->update($request->all());
        return redirect()->route('home')
                        ->with('success','Post updated successfully');



  


    }

    public function verifypractice(Request $request, User $user)
    {
        return view('user.verify_practice',compact('user'));
    }


      public function updatepractice(Request $request, $id){
      
        $myuser = User::find($id);
        
        $myuser->is_admin = $request['is_admin'];
        $myuser->is_verified = $request['is_verified'];
        $myuser->save();
        return back()->with('message','Profile Updated');
    }

   
     public function updateProfile(Request $request, $id){
        

        $myuser = User::find($id);
        $input = $request->all();
        $user = \auth::user();
        
        $input = $request->all();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/folder/images/';
                $filename = $file_extension;
                $request->file('image')->move($destination_path, $filename);

                
                $input['image'] = $filename;
                // $input['image'] = time() .'$filename';
               $input['image'] = time().'-'.$filename.'.jpg';

            }

        //$myuser->company = $request['company'];
        $myuser->surname = $request['surname'];

        $myuser->name = $request['name'];
        $myuser->surname = $request['surname'];
        $myuser->phone_number = $request['phone_number'];
        $myuser->whatsapp_number = $request['whatsapp_number'];
        $myuser->type = $request['type'];
        $myuser->practice_number = $request['practice_number'];
       // $myuser->company = $request['company'];

        if (empty($request['image'])) {
            $filename = "";
        }else{
        $myuser->image = $filename;

        }
        //$myuser->image = $filename;

        // $myuser->email_message = $request['email_message'];

        // $myuser->is_admin = $request['is_admin'];
        // $myuser->is_verified = $request['is_verified'];

        $myuser->save();
        //return back()->with('message','Profile Updated');


         return redirect()->back()->with(['success' => 'Profile Updated Successfully']);
    }


    


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect()->route('user.index')
                        ->with('success','User deleted successfully');
    }
   


   public function updateProfileEmailSettings(Request $request, $id){
        

        $myuser = User::find($id);
        $input = $request->all();
        $user = \auth::user();
        
        $input = $request->all();
            if ($request->hasFile('image_signature')) {
                $file = $request->file('image_signature');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/folder/images/signatures/';
                $filename = $file_extension;
                $request->file('image_signature')->move($destination_path, $filename);

                
                $input['image_signature'] = $filename;
                // $input['image'] = time() .'$filename';
               $input['image_signature'] = time().'-'.$filename.'.jpg';

            }

        $myuser->company = $request['company'];
        $myuser->surname = $request['surname'];

  

        if (empty($request['image_signature'])) {
            $filename = "";
        }else{
        $myuser->image_signature = $filename;

        }

        $myuser->email_message = $request['email_message'];

       

        $myuser->save();


         return redirect()->back()->with(['success' => 'Profile Updated Successfully']);
    }



       public function updateProfileEmailSettingsLogo(Request $request, $id){
        

        $myuser = User::find($id);
        $input = $request->all();
        $user = \auth::user();
        
        $input = $request->all();
            if ($request->hasFile('image_logo')) {
                $file = $request->file('image_logo');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/folder/images/signatures/';
                $filename = $file_extension;
                $request->file('image_logo')->move($destination_path, $filename);

                
                $input['image_logo'] = $filename;
                // $input['image'] = time() .'$filename';
               $input['image_logo'] = time().'-'.$filename.'.jpg';

            }

        //$myuser->company = $request['company'];
        //$myuser->surname = $request['surname'];

  

        if (empty($request['image_logo'])) {
            $filename = "";
        }else{
        $myuser->image_logo = $filename;

        }

        //$myuser->email_message = $request['email_message'];

       

        $myuser->save();


         return redirect()->back()->with(['success' => 'Profile Updated Successfully']);
    }




    public function updateProfileStatus(Request $request, $id){
        

        $myuser = User::find($id);
        $input = $request->all();
        $user = \auth::user();
        
        
        $myuser->company = $request['company'];
        $myuser->region = $request['region'];
        $myuser->sub_region = $request['sub_region'];
        $myuser->is_verified = $request['is_verified'];
        $myuser->save();


         return redirect()->back()->with(['success' => 'Profile Updated Successfully']);
    }



}


