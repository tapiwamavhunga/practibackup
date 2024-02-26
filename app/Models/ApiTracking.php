<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bitfumes\Multiauth\Model\Brochure;
use Bitfumes\Multiauth\Model\BrochureField;
use Bitfumes\Multiauth\Model\BrochureFieldValues;
use App\ApiTracking;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Corcel\Model\Category;

use Corcel\Acf\Field\BasicField;
use Corcel\Acf\FieldFactory;
use Corcel\Acf\Field\PostObject;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\UserSettings;
use App\Company;
use App\Redirect;
use Log;
use DB;
use Auth;

class ApiTracking extends Model
{
    protected $table = 'apitracking';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_name', 'endpoint_requested',
    ];

    public static function sanitize($s) {
        # to keep letters, numbers & underscore
        $s = str_replace('(', '', $s);
        $s = str_replace(')', '', $s);
        $return = preg_replace('/[^\w]+/', '-', $s);
        return strtolower($return);
    }

    public static function trackRequest($endpoint_requested){
        Log::debug(Auth::user());

        $apitracking = new ApiTracking;
        if(Auth::check()):
            $apitracking->user_id = Auth::user()->id;
            $apitracking->user_name = Auth::user()->name;
        else:
            $apitracking->user_id = 0;
            $apitracking->user_name = 'SMS RESPONDER';
        endif;
        $apitracking->endpoint_requested = $endpoint_requested;
        $apitracking->save();
    }
    public static function trackEmailBrochureLink($endpoint_requested){

        $endpoint_arr = explode('/', $endpoint_requested);
        $emailstamp = $endpoint_arr[1];
        $brochureid = $endpoint_arr[2];
        $brochure = Brochure::find($brochureid);

        $user_id = false;
        $endpoints = ApiTracking::where('endpoint_requested', 'LIKE', '%'.$emailstamp.'%')->get();
        foreach($endpoints as $endpoint):
            $user_id = $endpoint->user_id;
            $user_name = $endpoint->user_name;
        endforeach;

        $redirect_url = 'https://www.medinformer.co.za/health_subjects';
         //Log::debug($user_id);
        if($user_id){

            $usersettings = UserSettings::where('user_id', $user_id)->first();
            $company_name = $usersettings->company;
            if($company_name == ''){
                $company = Company::find(2);
                $company_name = $company->name;
            } else {
                $company = Company::where('name', $company_name)->first();
            }

            //Log::debug(print_r($company->name, true));
            //Log::debug('isPostScript: '.ApiTracking::isBrochurePostscript($brochure->id));

            if(ApiTracking::isBrochurePostscript($brochure->id)){
                $redirect_url = $company->private;
            } else {
                $redirect_url = $company->redirect;
            }
            $redirect_url .= '/'.ApiTracking::sanitize($brochure->title);
            //Log::debug($redirect_url);

            $apitracking = new ApiTracking;
            $apitracking->user_id = $user_id;
            $apitracking->user_name = $user_name;
            $apitracking->endpoint_requested = $endpoint_requested;
            $apitracking->save();

            //echo $redirect_url;

        }

        header("Location: ".$redirect_url);
        die();

    }

 	public static function isBrochurePostscript($bid){

        $postscript = false;
        $bf_postscript = BrochureField::where('slug', 'postscript')->first();
        $bfv_postscript = BrochureFieldValues::where([
            ['field_id', $bf_postscript->id],
            ['brochure_id', $bid]
        ])->first();
        //Log::debug(print_r($bfv_postscript, true));
        if($bfv_postscript && strtolower($bfv_postscript->value) == 'yes'):
            $postscript = true;
        endif;
        return $postscript;

    }

    public static function trackSMSBrochureLink($endpoint_requested){
        //Log::debug(Auth::user()->name);

        $endpoint_arr = explode('/', $endpoint_requested);
        $timestamp = $endpoint_arr[1];
        $brochureid = $endpoint_arr[2];
        $brochure = Brochure::find($brochureid);

        $user_id = false;
        $endpoints = ApiTracking::where('endpoint_requested', 'LIKE', '%'.$timestamp.'%')->get();
        foreach($endpoints as $endpoint):
            $user_id = $endpoint->user_id;
            $user_name = $endpoint->user_name;
        endforeach;

        $redirect_url = 'https://www.medinformer.co.za/health_subjects';
        if($user_id){

            $usersettings = UserSettings::where('user_id', $user_id)->first();
            $company_name = $usersettings->company;
            if($company_name == ''){
                $company = Company::find(2);
                $company_name = $company->name;
            } else {
                $company = Company::where('name', $company_name)->first();
            }
            if(ApiTracking::isBrochurePostscript($brochure->id)){
                $redirect_url = $company->private;
            } else {
                $redirect_url = $company->redirect;
            }
            $redirect_url .= '/'.ApiTracking::sanitize($brochure->title);

            $apitracking = new ApiTracking;
            $apitracking->user_id = $user_id;
            $apitracking->user_name = $user_name;
            $apitracking->endpoint_requested = $endpoint_requested;
            $apitracking->save();

            //echo $redirect_url;

        }

        header("Location: ".$redirect_url);
        die();

    }

     public static function closetags($html) {
        preg_match_all('#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i=0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</'.$openedtags[$i].'>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }

    public static function getBrochureEmailClicks($timestamp, $brochureid){
        $endpoints = ApiTracking::where([
            ['endpoint_requested', 'LIKE', '%'.$timestamp.'%'],
            ['endpoint_requested', 'LIKE', '%'.$brochureid.'%']
        ])->get();
        return $endpoints;
    }

    public static function getBrochureSMSClicks($timestamp, $brochureid){
        $endpoints = ApiTracking::where([
            ['endpoint_requested', 'LIKE', '%'.$timestamp.'%'],
            ['endpoint_requested', 'LIKE', '%'.$brochureid.'%']
        ])->get();
        return $endpoints;
    }

        public static function get_brochure_email_links_clicked($timestamp, $bid){

        $count = 0;
        $entries = ApiTracking::where([
            ['endpoint_requested', 'LIKE', '%'.$timestamp.'%'],
            ['endpoint_requested', 'LIKE', '%'.$bid.'%'],
        ])
        ->orderBy('created_at', 'desc')
        ->get();
        if(isset($entries)){
            foreach($entries as $entry){
                $requestarr = explode('/', $entry->endpoint_requested);
                $endpoint_type = $requestarr[0];
                if($endpoint_type == 'brochure-email-link'){
                    $count++;
                } else {

                    if(!filter_var($requestarr[1], FILTER_VALIDATE_EMAIL)){
                        $count++;
                    }

                }
            }
        }

        return $count;
    }

    public static function get_brochure_sms_links_clicked($timestamp, $bid){
        $clicks = ApiTracking::where([
            ['endpoint_requested', 'LIKE', '%'.$timestamp.'%'],
            ['endpoint_requested', 'LIKE', '%'.$bid.'%'],
            ['endpoint_requested', 'LIKE', '%brochure-sms-link%'],
        ])
        ->orderBy('created_at', 'desc')
        ->get();
        return $clicks->count();
    }

     public static function get_client_shares($cid, $start=false, $end=false){
        $shares = array();

        $apiqueries = false;

        if($start && $end):

            $emailqueries = ApiTracking::where([
                ['endpoint_requested', 'LIKE', 'brochure-email/%'],
                ['user_id', $cid]
            ])
            ->whereBetween('created_at', [$start, $end])
            ->get();
            //Log::debug($emailqueries->count().' email shares');

            $smsqueries = ApiTracking::where([
                ['endpoint_requested', 'LIKE', 'brochure-sms/%'],
                ['user_id', $cid]
            ])
            ->whereBetween('created_at', [$start, $end])
            ->get();
            //Log::debug($smsqueries->count().' sms shares');

            $merged = $emailqueries->merge($smsqueries);
            $apiqueries = $merged->all();

        else:

            $emailqueries = ApiTracking::where([
                ['endpoint_requested', 'LIKE', 'brochure-email/%'],
                ['user_id', $cid]
            ])
            ->get();
            //Log::debug($emailqueries->count().' email shares');

            $smsqueries = ApiTracking::where([
                ['endpoint_requested', 'LIKE', 'brochure-sms/%'],
                ['user_id', $cid]
            ])
            ->get();
            //Log::debug($smsqueries->count().' sms shares');

            $merged = $emailqueries->merge($smsqueries);
            $apiqueries = $merged->all();

        endif;

      foreach($apiqueries as $apiquery):
            $requestarr = explode('/', $apiquery->endpoint_requested);
            $endpoint_type = $requestarr[0];

            if($endpoint_type == 'brochure-email' && filter_var($requestarr[1], FILTER_VALIDATE_EMAIL)):
                $shares[] = array(
                    'endpoint' => $apiquery->endpoint_requested,
                    'type' => 'email',
                    //'entry' => $apiquery
                );
            endif;

            if($endpoint_type == 'brochure-sms'):
                $shares[] = array(
                    'endpoint' => $apiquery->endpoint_requested,
                    'type' => 'sms',
                    //'entry' => $apiquery
                );
            endif;

        endforeach;
        //Log::debug(print_r($shares, true));
        return $shares;
    }

