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
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DataTables;
use URL;
use Route;
use Excel;
use Log;
use Auth;

use App\Models\User;

use DB;
class IframeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      $iframes = Iframe::all();
      return view('admin.iframe.index', compact('iframes', ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
             $iframes = Iframe::all();

                $iframe = "";

             $brochures = Post::type('medicalbrochure')->status('publish')->get();
             return view('admin.iframe.create', compact('iframes','brochures','iframe' ));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




    public function store(Request $request)

    {

        $input = $request->all();

        $featured_brochures = $input['featured_brochures'];
        $main_landing_brochures = $input['main_landing_brochures'];
        $current_campaign = $input['current_campaign'];

        $input['featured_brochures'] = implode(',', $featured_brochures);
        $input['main_landing_brochures'] = implode(',', $main_landing_brochures);
        $input['current_campaign'] = implode(',', $current_campaign);
        


        $iframes = Iframe::all();

       

        $brochures = Post::type('medicalbrochure')->status('publish')->get();

        // $requestData = $request->all();
        
        Iframe::create($input);



                return redirect()->route('iframe.index')
                        ->with('success','User created successfully.');


        

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

        $iframe = Iframe::findOrFail($id);

          //print_r($id);
            $featured_brochures = Iframe::where('id', $id)->first();

            if($iframe->featured_brochures  !== NULL):
                $featured_brochures  = explode(',', $iframe->featured_brochures );
            else:
                $featured_brochures  = array();
            endif;

        $iframes = Iframe::all();

        $brochures = Post::type('medicalbrochure')->status('publish')->get();
        return view('admin.iframe.edit', compact('iframes', 'brochures','iframe','featured_brochures'));
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
    public function destroy(Iframe $iframe)
    {
        $iframe->delete();
    
        return redirect()->route('iframe.index')
                        ->with('success','Iframe deleted successfully');
    }
}
