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
use App\Models\User;

use App\Models\Nhs;
use App\Models\Medicines;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

 use DataTables;
use URL;
use Route;
use Excel;
use Log;
use Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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




  protected function nhsget(){



        $alphabet = range('a', 'z');


foreach ($alphabet as $letter) {

    $url = "https://api.nhs.uk/medicines/?category=$letter";



$uri = $url;
    $params['headers'] = [
                     'Content-type' => 'application/json',
                     'subscription-key' => 'b17461bb272b444eae354ded4b935a4d'];

     $client = new Client();
                $response = $client->request('GET', $uri, $params);
                $data = json_decode($response->getBody(), true);

                $resultss = $data['significantLink'];

 $resultss = $data['significantLink'];


                $brochures = $data['significantLink'];



               $posts = $data['significantLink'];

                foreach ($posts as $key => $post) {
                    


        $newUser = new Medicines;

       
        //$newUser->ID = $post['ID'];
         $newUser->post_title = $post['name'];
        $newUser->excerpt = $post['description'];
        $newUser->description = $post['description'];
        $newUser->url = $post['url'];
        $newUser->image = "https://www.nhs.uk/static/nhsuk/img/open-graph.a74435697f45.png";
        $newUser->save();
    }

}

$viewShareVars = ['result'];
        return view('nhshome',compact($viewShareVars));
}



protected function indexd(){


       $result = array(); 
       $userbrochures = auth()->user();

       $appurl = URL::to('/');
        $user = Auth::user()->id;
        $id = Auth::user()->id;
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
                

                    if ($this->can_access_brochure($post->ID)) {
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
                            'brochure_show_on_api'=>$post->meta->brochure_show_on_api,
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
        return view('home',compact($viewShareVars));
    }


protected function nhsmeds(){


       $result = array(); 

       
       $userbrochures = auth()->user();

       $appurl = URL::to('/');
        $user = Auth::user()->id;
        $id = Auth::user()->id;
        $userSettings = UserSettings::where('user_id', $id)->first();
        if($userSettings->brochures_allowed !== NULL):
            $brochures_allowed = explode(',', $userSettings->brochures_allowed);
        else:
            $brochures_allowed = array();
        endif;
        // $brochures = Post::orderBy('title', 'asc')->get();
        $brochures = Medicines::all();
        $posts = Medicines::all();




         if ( $posts ) {
                foreach ( $posts as $key => $post ) {
                

                    //if ($this->can_access_brochure($post->ID)) {
                        // code...
                    
                    $first_letter = substr($post->post_title,0,1);
                    if( ! empty( $first_letter ) ) {
                        $result[$first_letter][] = array(
                            'ID' => $post->ID,
                            'title' => $post->post_title,
                            'excerpt'=>$post->excerpt,
                            'meta'=> $post->brochure_type,
                            'url'=> $post->link,
                            'password'=> $post->password,
                            'slug'=> $post->slug,
                            'brochure_show_on_api'=>$post->brochure_show_on_api,
                        );
                    }
                   // }
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
        return view('nhsmeds',compact($viewShareVars));
    }



protected function nhsindex(){


       $result = array(); 
       $userbrochures = auth()->user();

       $appurl = URL::to('/');
        $user = Auth::user()->id;
        $id = Auth::user()->id;
        $userSettings = UserSettings::where('user_id', $id)->first();
        if($userSettings->brochures_allowed !== NULL):
            $brochures_allowed = explode(',', $userSettings->brochures_allowed);
        else:
            $brochures_allowed = array();
        endif;
        // $brochures = Post::orderBy('title', 'asc')->get();
        $brochures = Nhs::all();
        $posts = Nhs::all();




         if ( $posts ) {
                foreach ( $posts as $key => $post ) {
                

                    //if ($this->can_access_brochure($post->ID)) {
                        // code...
                    
                    $first_letter = substr($post->post_title,0,1);
                    if( ! empty( $first_letter ) ) {
                        $result[$first_letter][] = array(
                            'ID' => $post->ID,
                            'title' => $post->post_title,
                            'excerpt'=>$post->excerpt,
                            'meta'=> $post->brochure_type,
                            'url'=> $post->link,
                            'password'=> $post->password,
                            'slug'=> $post->slug,
                            'brochure_show_on_api'=>$post->brochure_show_on_api,
                        );
                    }
                   // }
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
        return view('nhshome',compact($viewShareVars));
    }



   

//     protected function nhsindex(){



//         $alphabet = range('a', 'z');


// foreach ($alphabet as $letter) {

//     $url = "https://api.nhs.uk/conditions/?category=$letter";



// $uri = $url;
//     $params['headers'] = [
//                      'Content-type' => 'application/json',
//                      'subscription-key' => 'f8281dbbdefe4c06ad9e55d946887749'];

//      $client = new Client();
//                 $response = $client->request('GET', $uri, $params);
//                 $data = json_decode($response->getBody(), true);

//                 $resultss = $data['significantLink'];

//  $resultss = $data['significantLink'];


//                 $brochures = $data['significantLink'];



//                $posts = $data['significantLink'];



//                  if ( $posts ) {
//                         foreach ( $posts as $key => $post ) {
                        

                         
//                             $first_letter = substr($post['name'],0,1);
//                             if( ! empty( $first_letter ) ) {
//                                 $result[$first_letter][] = array(
//                                     'ID' => 1,
//                                     'title' => $post['name'],
//                                     // 'excerpt'=>$post->excerpt,
//                                     // 'meta'=> $post->meta->brochure_type,
//                                     // 'link'=> $post->meta->link,
//                                     // 'password'=> $post->meta->password,
//                                     // 'slug'=> $post->slug,
//                                     // 'brochure_show_on_api'=>$post->meta->brochure_show_on_api,
//                                 );
//                             }
                            
//                         }
//                     }


// }

       

     

        
       

//         $categories = Taxonomy::where('taxonomy', 'category')->get();

        
//         $categories->each(function($category) {
//             //echo $category->name;
//         });
       

       


       
        

//         $viewShareVars = ['result', 'categories'];
//         return view('nhshome',compact($viewShareVars));
//     }


    protected function index(){


       $result = array(); 
       $userbrochures = auth()->user();

       $appurl = URL::to('/');
        $user = Auth::user()->id;
        $id = Auth::user()->id;
        $userSettings = UserSettings::where('user_id', $id)->first();
        if($userSettings->brochures_allowed !== NULL):
            $brochures_allowed = explode(',', $userSettings->brochures_allowed);
        else:
            $brochures_allowed = array();
        endif;
        // $brochures = Post::orderBy('title', 'asc')->get();
        //$brochures = Post::type('medicalbrochure')->status('publish')->get();



       //$posts = Post::type('medicalbrochure')->status('publish')->get();
       $posts = Post::published()->type('medicalbrochure')->status('publish')->get();
         if ( $posts ) {
                foreach ( $posts as $key => $post ) {
                

                   // if ($this->can_access_brochure($post->ID)) {
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
                            'icd10tags'=> $post->meta->icd10tags,
                            'brochure_show_on_api'=>$post->meta->brochure_show_on_api,
                            'tapiwa'=>'test',
                        );
                    }
                    //}
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
        return view('home',compact($viewShareVars));
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



    $users = User::latest()->paginate(10);
    $user_id = auth()->user()->id;

    $user = auth()->user();
    $usersettings = UserSettings::where('user_id', $user_id)->first();

    $users_count = User::all()->count();
    $emails_sent = Emails::all()->count();
    $sms_sent = SMS::all()->count();
    $whatsapp_sent = SMS::all()->count();

    $number_blocks = [
            [
                'title' => 'Users Logged In Today',
                'number' => User::whereDate('last_login_at', today())->count()
            ],
            [
                'title' => 'Users Logged In Last 7 Days',
                'number' => User::whereDate('last_login_at', '>', today()->subDays(7))->count()
            ],
            [
                'title' => 'Users Logged In Last 30 Days',
                'number' => User::whereDate('last_login_at', '>', today()->subDays(30))->count()
            ],
        ];

        $list_blocks = [
            [
                'title' => 'Last Logged In Users',
                'entries' => User::orderBy('last_login_at', 'desc')
                    ->take(5)
                    ->get(),
            ],
            [
                'title' => 'Users Not Logged In For 30 Days',
                'entries' => User::where('last_login_at', '<', today()->subDays(30))
                    ->orwhere('last_login_at', null)
                    ->orderBy('last_login_at', 'desc')
                    ->take(5)
                    ->get()
            ],
        ];

        $chart_settings = [
            'chart_title'        => 'Users By Months',
            'chart_type'         => 'line',
            'report_type'        => 'group_by_date',
            'model'              => 'App\Models\User',
            'group_by_field'     => 'last_login_at',
            'group_by_period'    => 'month',
            'aggregate_function' => 'count',
            'filter_field'       => 'last_login_at',
            'column_class'       => 'col-md-12',
            'entries_number'     => '5',
        ];
        $chart = new LaravelChart($chart_settings);
    
    $viewShareVars = ['user','posts', 'users', 'usersettings', 'users_count', 'emails_sent', 'sms_sent', 'whatsapp_sent', 'number_blocks', 'list_blocks', 'chart'];

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



       public function adminUsers(Request $request, ) {


        $user = auth()->user();
        $user_id = auth()->user()->id;
        $usersettings = UserSettings::where('user_id', $user_id)->first();
        
        $users = User::query()->orderBy('created_at', 'desc');

        if(!empty($request->search)) {
            $users->where('email', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->orWhere('company', 'like', '%' . $request->search . '%');
        }

        $users = $users->paginate(20);
        $viewShareVars = ['users', 'user', 'usersettings'];

         return view('adminUsers',compact($viewShareVars));
    }


        public function adminNewUsers(Request $request, ) {


        $user = auth()->user();
        $user_id = auth()->user()->id;
        $usersettings = UserSettings::where('user_id', $user_id)->first();
        
        $users = User::where( 'created_at', '>=', Carbon::now()->subMonths(1));

        if(!empty($request->search)) {
            $users->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $users->paginate(20);
        $viewShareVars = ['users', 'user', 'usersettings'];

         return view('adminNewUsers',compact($viewShareVars));
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



     public function nhs(){
        
     }



}


