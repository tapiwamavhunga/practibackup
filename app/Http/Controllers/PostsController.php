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
use App\Models\Iframe;
use App\Models\Posts;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DataTables;
use URL;
use Route;
use Excel;
use Log;
use Auth;
use Response;

use App\Models\User;

use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      $posts = Posts::all();
      return view('admin.posts.index', compact('posts' ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
             $posts = Posts::all();

               

             $brochures = Post::type('medicalbrochure')->status('publish')->get();
             return view('admin.posts.create', compact('posts','brochures' ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




   public function store(Request $request)
    {  
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
       ]);
 
        $id = $request->id;
 
        $details = [
        'title' => $request->title, 
        'content' => $request->content, 
        'show' => $request->show,
        'link' => $request->link,
        'featured_brochures' => $request->featured_brochures,
        'main_landing_brochures' => $request->main_landing_brochures,
        'current_campaign' => $request->current_campaign,
        'image' => $request->image,


    ];
    
    $posts = Posts::all();


        if ($files = $request->file('image')) {
            
           //delete old file
           \File::delete('public/product/'.$request->hidden_image);
         
           //insert new file
           $destinationPath = 'public/product/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $details['image'] = "$profileImage";
        }
         
        $post   =   Posts::updateOrCreate(['id' => $id], $details);  
                     

        //return Response::json($post);

        return view('admin.posts.index', compact('post', 'posts'));
    } 



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 public function edit($id)
    {   
        $where = array('id' => $id);
        $post  = Posts::where($where)->first();
      
        // return Response::json($post);
                return view('admin.posts.edit', compact('post'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy($id) 
    {
        $data = Posts::where('id',$id)->first(['image']);
        \File::delete('public/product/'.$data->image);
        $post = Posts::where('id',$id)->delete();
        $posts = Posts::all();

                      return view('admin.posts.index', compact('post', 'posts'));

        //return Response::json($product);
    }


  
}
