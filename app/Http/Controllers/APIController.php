<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Corcel\Acf\Field\BasicField;
use Corcel\Acf\FieldFactory;
use Corcel\Acf\Field\PostObject;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
class APIController extends Controller
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
   

   // public function brochures(){
   //  $test = "ededed";
   //  return $test;
   //  die();
   // }

    public function brochuresearch(){

        echo "Tapowa";
        die();
      
        return $return;

    }

 
    // get specific brochure
    public function findbrochure(Request $request) {


        $return = false;
        $brochure_id = (isset($request->brochure_id))? $request->brochure_id: false;

        // print_r($brochure_id);
        // die();
        if($brochure_id):
            if($this->can_access_brochure($brochure_id)):
                $brochure = Brochure::find($brochure_id);
                if($brochure === null):

                    $this->trackRequest('brochure/'.$brochure_id.'/error');
                    $return = array( 'Error' => "Brochure not found. Please try a different brochure id.");

                else:
                    $this->trackRequest('brochure/'.$brochure_id);

                    $return = array();
                    $return['id'] = $brochure->id;
                    $return['title'] = $brochure->title;
                    $return['desc'] = strip_tags($brochure->desc);
                    $return['categories'] = $brochure->categories;
                    $return['image'] = $brochure->image;
                    $return['created_at'] = $brochure->created_at;
                    $return['updated_at'] = $brochure->updated_at;
                    $return['redirect_url'] = $this->getUserCompanyRedirectUrl();
                    $return['private_url'] = $this->getUserCompanyPrivateUrl();

                    //get all brochure field values
                    $return['brochure_fields'] = array();
                    $bfvs = BrochureFieldValues::where('brochure_id', $brochure_id)->get();
                    if($bfvs !== null):
                        $dataarr = array();
                        foreach($bfvs as $fvalue):
                            $field = BrochureField::find($fvalue->field_id);
                            if(!empty($field)){
                                $dataarr[str_slug( $field->title )] = $fvalue->value;
                            }
                        endforeach;
                        $return['brochure_fields'] = $dataarr;
                    endif;

                    //get all segments
                    $bs = BrochureSegments::where('brochure_id', '=', $brochure_id)->get();
                    if($bs !== null):
                        $brochuresegments = $bs;
                        $return['brochure_segments'] = $bs;
                    endif;

                endif;

            else:
                $return = array( 'Error' => "This brocure hasn't been assigned to your profile. Contact Medinformer Administrator to get this brochure assigned to your profile.");
            endif;

        else:
            $this->trackRequest('brochure/error');
            $return = array( 'Error' => "No 'brochure_id' field value found. Your request requires MultiForm POST data with field 'brochure_id' and its value.");
        endif;
        return $return;
    }










}


