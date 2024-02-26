<?php

namespace App\Http\Controllers;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Corcel\Acf\Field\BasicField;
use Corcel\Acf\FieldFactory;
use Corcel\Acf\Field\PostObject;
use Corcel\Model\Meta\ThumbnailMeta;
use App\Models\Users;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserSettings;
use URL;
use Route;
use DB;
use Excel;
use Log;
use Auth;


class UsersController extends Controller
{


    public function create(){}

      // public function store(){}

      //   public function update(){}

          public function show(){}





    public function index(Request $request)
    {
        $editableUsers = null;
        $usersQuery = Users::query();
        $usersQuery->where('name', 'like', '%'.$request->get('q').'%');
        //$usersQuery->sortBy('name');
        $users = $usersQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableUsers = Users::find(request('id'));
        }

        return view('users.index', compact('users', 'editableUsers'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', new Users);

        $newUsers = $request->validate([
            'name'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newUsers['creator_id'] = auth()->id();

        Users::create($newUsers);

        return redirect()->route('users.index');
    }

    public function update(Request $request, Users $users)
    {
         $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

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

         // $input = $request->all();
         //    if ($request->hasFile('email_signature')) {
         //        $file = $request->file('email_signature');
         //        $file_extension = $file->getClientOriginalName();
         //        $destination_path_sig = public_path() . '/folder/images/';
         //        $email_signature = $file_extension;
         //        $request->file('email_signature')->move($destination_path_sig, $email_signature);

                
         //        $input['email_signature'] = $email_signature;


         //    }

    

         //    $email_signature =  $request['email_signature'];


        // Fill user model
        $user->fill([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'whatsapp_number' => $request->whatsapp_number,
            'type' => $request->type,
            'practice_number' => $request->practice_number,
            'company' => $request->company,
            'salutation' => $request->salutation,
            'email_message' => $request->email_message,
            'image' => $filename,
            'is_admin' => $request->is_admin,
            'is_verified' => $request->is_verified,
            'region' => $request->region,
            'sub_region' => $request->sub_region,


        ]);




        // Save user to database
        $user->save();




         return redirect()->back()->with(['success' => 'Profile Updated Successfully']);
    }

    // public function destroy(Request $request, Users $users)
    // {
    //     $this->authorize('delete', $users);

    //     print_r($users); 

    //     die();
    //     $request->validate(['users_id' => 'required']);

    //     if ($request->get('users_id') == $users->id && $users->delete()) {
    //         $routeParam = request()->only('page', 'q');

    //         return redirect()->route('users.index', $routeParam);
    //     }

    //     return back();
    // }

    public function destroy(User $user)
    {
        $user->delete();
    
        return redirect()->route('admin.newusers')
                        ->with('success','User deleted successfully');
    }



    // public function edit(User $user)
    // {
    //     return view('user.edit',compact('user'));
    // }

    public function edit($id){

        $appurl = URL::to('/');
        $user = User::find($id);
        $userSettings = UserSettings::where('user_id', $id)->first();

        if(empty($userSettings->brochures_allowed)) {
         
         $userSettings = new userSettings;
        $userSettings->user_id = $user->id;
        $userSettings->brochures_allowed = '[]';
        $userSettings->save();

        }

           


        if($userSettings->brochures_allowed !== NULL):
            $brochures_allowed = explode(',', $userSettings->brochures_allowed);
        else:
            $brochures_allowed = array();
        endif;



        

                $userSettings = UserSettings::where('user_id', $id)->first();


        //$brochures = Post::orderBy('post_title', 'asc')->get();
        $brochures = Post::type('medicalbrochure')->status('publish')->get();

        return view('user.edit', compact(
            'id',
            'appurl',
            'user',
            'userSettings',
            'brochures',
            'brochures_allowed'
            )
        );
    }

     public function userbrochures($id){

        $appurl = URL::to('/');
        $user = User::find($id);
        $userSettings = UserSettings::where('user_id', $id)->first();
        if($userSettings->brochures_allowed !== NULL):
            $brochures_allowed = explode(',', $userSettings->brochures_allowed);
        else:
            $brochures_allowed = array();
        endif;
        // $brochures = Post::orderBy('title', 'asc')->get();
        $brochures = Post::type('medicalbrochure')->status('publish')->get();
        return view('admin.users.brochures', compact(
            'id',
            'appurl',
            'user',
            'userSettings',
            'brochures',
            'brochures_allowed'
            )
        );
    }


    public function userupdatebrochures(Request $request, $id){

        $bids = $request->input('brochures_allowed');

        if(isset($bids)):
            $brochureids = implode(',', $bids);
        else:
            $brochureids = NULL;
        endif;

        $us = UserSettings::where('user_id', $id)->first();
        $us->brochures_allowed = $brochureids;
        $us->save();

        return back()->with('message', 'User brochures assigned.');

    }

        public function updatecompanies(Request $request){

        $dischem_users = DB::table("users")->where("company", NULL)->update(['company' => 'medinformer']);
            
             }


}
