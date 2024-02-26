<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Corcel\Acf\Field\BasicField;
use Corcel\Acf\FieldFactory;
use Corcel\Acf\Field\PostObject;
use Corcel\Model\Meta\ThumbnailMeta;
use App\Models\SMS;
use App\Models\UserSettings;
use App\Models\EmailTracking;
use App\Models\Company;
use App\Models\Emails;
use App\Models\Verify;
use App\Models\Posts;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
 use DataTables;
use URL;
use Route;
use Excel;
use Log;
use Auth;

use App\Models\User;

use DB;
class ExternalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function can_access_brochure($brochure_id){
        $return = false;
        $userSettings = UserSettings::where('user_id', Auth::user()->id)->first();
        if( $userSettings->brochures_allowed === NULL ):
            $return = true; 
        else:
            $bids = explode(',', $userSettings->brochures_allowed);
            if(in_array($brochure_id, $bids)):
               $return = true; 
            endif;
        endif;
        return $return;
    }


        public function can_access_frames($brochure_id){
        $return = false;
        $userSettings = UserSettings::where('user_id', 1)->first();
        if( $userSettings->brochures_allowed === NULL ):
            $return = true; 
        else:
            $bids = explode(',', $userSettings->brochures_allowed);
            if(in_array($brochure_id, $bids)):
               $return = true; 
            endif;
        endif;
        return $return;
    }

    public function test(){
        $verify = Verify::all();
        $users = User::all();

        foreach($users as $user){
            

         $usersettings = UserSettings::create([
    'occupation' => '',
    'company' => '',
    'region' => '',
    'token' => '',
    'brochures_allowed' => NULL,
    'user_id' => $user->id,
]);


        }
        
      //$viewShareVars = ['users', 'verify'];
        //return view('adminVerify',compact($viewShareVars));
   }






    protected function babycity(){
       $result = array(); 

       $appurl = URL::to('/');
        
        // $brochures = Post::orderBy('title', 'asc')->get();
        $brochures = Post::type('medicalbrochure')->status('publish')->get();

        $test = Post::find(260915);

        //print_r($test);

        //die();
        $current_campaign =  Posts::where('current_campaign', 1)->get(); 

        


        $featured =  Posts::where('featured_brochures', 1)->paginate(4); 
        $main_landing_brochures =  Posts::where('main_landing_brochures', 1)->paginate(4); 


       $posts = Post::type('medicalbrochure')->status('publish')->get();

         if ( $posts ) {
                foreach ( $posts as $key => $post ) {
                

                    
                        // code...
                    
                    $first_letter = substr($post->post_title,0,1);
                    if( ! empty( $first_letter ) ) {
                        $result[$first_letter][] = array(
                            'ID' => $post->ID,
                            'title' => $post->post_title,
                            'excerpt'=>$post->excerpt,
                            'meta'=> $post->meta->brochure_type,
                            'link'=> $post->meta->link,
                            'password'=> $post->meta->password,
                             'slug'=> $post->slug,
                            'featured'=> $post->meta->featured,

                        );
                    }
                
                }
            }



        if( ! empty( $result ) ) {
            ksort( $result );
        }

        $categories = Taxonomy::where('taxonomy', 'medicalbrochure_category', 'featured')->get();

        
        // $cat->each(function($category) {
        //     echo $category->name;
        // });

        // foreach ($categories as $cat) {

        // }

        

        $viewShareVars = ['result','categories', 'current_campaign', 'featured', 'main_landing_brochures'];
        return view('babycity',compact($viewShareVars));
    }



    public function frames(){

       
       $result = array(); 
       $userbrochures = auth()->user();

       $appurl = URL::to('/');
        $user = '1';
        $id = '1';
        $userSettings = UserSettings::where('user_id', $id)->first();
        if($userSettings->brochures_allowed !== NULL):
            $brochures_allowed = explode(',', $userSettings->brochures_allowed);
        else:
            $brochures_allowed = array();
        endif;
        // $brochures = Post::orderBy('title', 'asc')->get();
        $brochures = Post::type('medicalbrochure')->status('publish')->get();

        

       $posts = Post::type('medicalbrochure')->status('publish')->get();

         if ( $posts ) {
                foreach ( $posts as $key => $post ) {
                

                    if ($this->can_access_frames($post->ID)) {
                        // code...
                    
                    $first_letter = substr($post->post_title,0,1);
                    if( ! empty( $first_letter ) ) {
                        $result[$first_letter][] = array(
                            'ID' => $post->ID,
                            'title' => $post->post_title,
                            'excerpt'=>$post->excerpt,
                            'meta'=> $post->meta->brochure_type,
                            'link'=> $post->meta->link,
                            'password'=> $post->meta->password,
                             'slug'=> $post->slug,
                        );
                    }
                    }
                }
            }



        if( ! empty( $result ) ) {
            ksort( $result );
        }

        $categories = Taxonomy::where('taxonomy', 'category')->get();

        
        $categories->each(function($category) {
            //echo $category->name;
        });


       
        

        $viewShareVars = ['result','categories'];
        return view('frames',compact($viewShareVars));
    }

protected function dischem(){
       $result = array(); 

       $appurl = URL::to('/');
        
        // $brochures = Post::orderBy('title', 'asc')->get();
        $brochures = Post::type('medicalbrochure')->status('publish')->get();


        $current_campaign =  Posts::where('current_campaign', 1)->get(); 
        $featured =  Posts::where('featured_brochures', 1)->paginate(3); 
        $main_landing_brochures =  Posts::where('main_landing_brochures', 1)->paginate(4); 


       $posts = Post::type('medicalbrochure')->status('publish')->get();

         if ( $posts ) {
                foreach ( $posts as $key => $post ) {
                

                    
                        // code...
                    
                    $first_letter = substr($post->post_title,0,1);
                    if( ! empty( $first_letter ) ) {
                        $result[$first_letter][] = array(
                            'ID' => $post->ID,
                            'title' => $post->post_title,
                            'excerpt'=>$post->excerpt,
                            'meta'=> $post->meta->brochure_type,
                            'link'=> $post->meta->link,
                            'password'=> $post->meta->password,
                             'slug'=> $post->slug,
                            'featured'=> $post->meta->featured,

                        );
                    }
                
                }
            }



        if( ! empty( $result ) ) {
            ksort( $result );
        }

        $categories = Taxonomy::where('taxonomy', 'medicalbrochure_category', 'featured')->get();

        
        // $cat->each(function($category) {
        //     echo $category->name;
        // });

        // foreach ($categories as $cat) {

        // }

        

        $viewShareVars = ['result','categories', 'current_campaign', 'featured', 'main_landing_brochures'];
        return view('dischem',compact($viewShareVars));
    }


    public function getPostThumbnailUrl($size = ''){

   if ($this->thumbnail !== null && $this->thumbnail->size($size) !== null) {

      return $this->thumbnail->size($size)['url'];

   }


   return '';

 }



   public function adminVerify(){
        $verify = Verify::latest()->paginate(50);
        $users = User::where('is_verified', NULL)->get();

        
      $viewShareVars = ['users', 'verify'];
        return view('adminVerify',compact($viewShareVars));
   }


   public function adminHome()

    {   

    $result = array(); 
    $posts = Post::type('medicalbrochure')->status('publish')->paginate(20);



    $users = User::latest()->paginate(20);
    $user_id = auth()->user()->id;

    $user = auth()->user();
    $usersettings = UserSettings::where('user_id', $user_id)->first();

    $viewShareVars = ['user','posts', 'users', 'usersettings'];

        return view('adminHome',compact($viewShareVars));

    }


     public function adminCompanies()

    {   
        $users = User::latest()->paginate(5);
        $posts = Post::type('medicalbrochure')->status('publish')->paginate(6);
        $companies = Company::all();
        $user_id = auth()->user()->id;
        $user = auth()->user();

        $viewShareVars = ['user','posts', 'users', 'companies'];

        return view('adminCompanies',compact($viewShareVars));

    }


    public function getusers(Request $request)

    {
        $user = auth()->user();
        $user_id = auth()->user()->id;
        $users = User::latest()->paginate(5);
        $usersettings = UserSettings::where('user_id', $user_id)->first();

        if ($request->ajax()) {

            $data = User::select('*');

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->addColumn('action', function($row){

       

                           $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';

                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';

                           $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';

         

                            return $btn;

                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }

        
         $viewShareVars = ['users', 'user', 'usersettings'];
        return view('adminUsers',compact($viewShareVars));
        //return view('users');

    }



    public function adminUsers()

    {   


        $users= User::paginate(50); //Eloquent ORM

        $user = auth()->user();
        $user_id = auth()->user()->id;
        $usersettings = UserSettings::where('user_id', $user_id)->first();
        // print_r($usersettings);
        $viewShareVars = ['users', 'user', 'usersettings'];
        return view('adminUsers',compact($viewShareVars));

    }


    public function adminBrochures()

    {   


        ds('Hello World');
        die();
        $users = User::latest()->paginate(25);

        $user = auth()->user();
        $user_id = auth()->user()->id;
            $posts = Post::type('medicalbrochure')->status('publish')->paginate(25);

        $viewShareVars = ['users', 'user', 'posts'];

        return view('adminBrochures',compact($viewShareVars));

    }


    
    public function adminSettings()

    {   

    // $result = array(); 
    //    $posts = Post::type('medicalbrochure')->status('publish')->take(6)->get();;
       
         $user = auth()->user();
    //             $viewShareVars = ['user','posts'];

       $users = User::latest()->paginate(5);
        $viewShareVars = ['users', 'user'];
        return view('adminSettings',compact($viewShareVars));

    }


    public function edit(User $user)
    {   
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }
    
     public function update(User $user)
    { 
        if(Auth::user()->email == request('email')) {
        
        $this->validate(request(), [
                'name' => 'required',
              //  'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);

            $user->name = request('name');
           // $user->email = request('email');
            $user->password = bcrypt(request('password'));
            $user->save();
            return back();
            
        }
        else{
            
        $this->validate(request(), [
                'name' => 'required',
                //'email' => 'required|email|unique:users',
                'email' => 'email|required|unique:users,email,'.$this->segment(2),
                'password' => 'required|min:6|confirmed'
            ]);

            $user->name = request('name');
            $user->email = request('email');
            $user->password = bcrypt(request('password'));

            $user->save();

            return back();  
            
        }
    }
   

   

      public function reports(){ 

       



        $user = auth()->user();
        $user_id = auth()->user()->id;

        $reports = Emails::where('user_id', $user_id)->get();

        //dd($reports);

         $sms_reports_count = SMS::where('user_id', $user_id)->count();
         $sms_reports = SMS::where('user_id', $user_id)->get();



        $viewShareVars = ['user','reports', 'sms_reports_count', 'sms_reports'];

        return view('reports', compact($viewShareVars));

     }



       public function sms_reports(){ 

        $user = auth()->user();
        $user_id = auth()->user()->id;
        $reports = EmailTracking::where('user_id', $user_id)->first();
        
        $viewShareVars = ['user','reports'];

        return view('sms_reports', compact($viewShareVars));

     }



}


