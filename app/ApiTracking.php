<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bitfumes\Multiauth\Model\Brochure;
use Bitfumes\Multiauth\Model\BrochureField;
use Bitfumes\Multiauth\Model\BrochureFieldValues;
use App\ApiTracking;
use App\UserSettings;
use App\Company;
use App\Redirect;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Corcel\Model\Category;

use Corcel\Acf\Field\BasicField;
use Corcel\Acf\FieldFactory;
use Corcel\Acf\Field\PostObject;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
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
        $brochure = Post::find($brochureid);

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

    public static function trackSMSCodeBrochureLink($endpoint_requested){
        //Log::debug(Auth::user()->name);

        $endpoint_arr = explode('/', $endpoint_requested);
        $timestamp = $endpoint_arr[1];
        $brochureid = $endpoint_arr[2];
        $smscode = $endpoint_arr[3];
        
        $brochure = Brochure::find($brochureid);

        $redirect_url = 'https://www.medinformer.co.za/health_subjects';
        $c = Company::where('smscode', $smscode)->first();
        if($c):
            if(ApiTracking::isBrochurePostscript($brochure->id)){
                $redirect_url = $c->private;
            } else {
                $redirect_url = $c->redirect;
            }         
        endif;

        $redirect_url .= '/'.ApiTracking::sanitize($brochure->title);
        Log::debug($redirect_url);
        
        /*if($user_id){

            $usersettings = UserSettings::where('user_id', $user_id)->first();
            $company_name = $usersettings->company;
            if($company_name == ''){
                $company = Company::find(2);
                $company_name = $company->name;
            } else {
                $company = Company::where('name', $company_name)->first();
            }
            $redirect_url = $company->redirect;
            $redirect_url .= '/'.ApiTracking::sanitize($brochure->title);


            $apitracking = new ApiTracking;
            $apitracking->user_id = $user_id;
            $apitracking->user_name = $user_name;
            $apitracking->endpoint_requested = $endpoint_requested;
            $apitracking->save();

            //echo $redirect_url;

        }*/

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

    public static function get_brochure_shares($bid, $start=false, $end=false){
        
        $shares = array();
        if($start && $end):
            $apiqueries = ApiTracking::where([
                ['endpoint_requested', 'LIKE', '%'.$bid.'%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-segments%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-fields%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-categories%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-search%'],
                ['endpoint_requested', 'NOT LIKE', 'brochures%'],
                ['endpoint_requested', 'NOT LIKE', 'categories%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-html%'],           
                ['endpoint_requested', 'NOT LIKE', 'brochure-email-link%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-sms-link%'],           
                ['endpoint_requested', 'NOT LIKE', 'mostpopular%'],
                ['endpoint_requested', 'NOT LIKE', 'scripts%'],
                ['endpoint_requested', 'NOT LIKE', 'stylesheet%'],
                ['endpoint_requested', 'NOT LIKE', 'articlestylesheet%'],
                ['endpoint_requested', 'NOT LIKE', 'articles-prescript%'],
                ['endpoint_requested', 'NOT LIKE', 'articles-postscript%'],
                ['endpoint_requested', 'NOT LIKE', 'article-html%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-stylesheet%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-scripts%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-html%'],
            ])
            ->whereBetween('created_at', [$start, $end])
            ->get();
        else:
            $apiqueries = ApiTracking::where([
                ['endpoint_requested', 'LIKE', '%'.$bid.'%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-segments%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-fields%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-categories%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-search%'],
                ['endpoint_requested', 'NOT LIKE', 'brochures%'],
                ['endpoint_requested', 'NOT LIKE', 'categories%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-html%'],           
                ['endpoint_requested', 'NOT LIKE', 'brochure-email-link%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-sms-link%'],           
                ['endpoint_requested', 'NOT LIKE', 'mostpopular%'],
                ['endpoint_requested', 'NOT LIKE', 'scripts%'],
                ['endpoint_requested', 'NOT LIKE', 'stylesheet%'],
                ['endpoint_requested', 'NOT LIKE', 'articlestylesheet%'],
                ['endpoint_requested', 'NOT LIKE', 'articles-prescript%'],
                ['endpoint_requested', 'NOT LIKE', 'articles-postscript%'],
                ['endpoint_requested', 'NOT LIKE', 'article-html%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-stylesheet%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-scripts%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-html%'],
            ])
            ->get();
        endif;

        foreach($apiqueries as $apiquery):
            $requestarr = explode('/', $apiquery->endpoint_requested);
            $endpoint_type = $requestarr[0];
            $bids = (isset($requestarr[2]))? explode(',', $requestarr[2]): array();

            if($endpoint_type == 'brochure-email' && filter_var($requestarr[1], FILTER_VALIDATE_EMAIL)):
                $shares[] = $apiquery;
            endif;

            if($endpoint_type == 'brochure-sms'):
                if(in_array($bid, $bids)):
                    $shares[] = $apiquery;
                endif;
            endif;
        
        endforeach;
        
        return $shares;
        
    }
    
    public static function get_share_clicks($timestamp){
        $share_clicks = 0;
        $apiqueries = ApiTracking::where([
            ['endpoint_requested', 'LIKE', '%'.$timestamp.'%'],
        ])->get();
        foreach($apiqueries as $apiquery):
            
            $requestarr = explode('/', $apiquery->endpoint_requested);
            $endpoint_type = $requestarr[0];
            
                if(!isset($requestarr[3])){
                    $share_clicks++;
                }
            
        
        endforeach;
        
        return $share_clicks;
    }

    public static function get_brochure_share_clicks($bid, $timestamp){
        $share_clicks = 0;
        $apiqueries = ApiTracking::where([
            ['endpoint_requested', 'LIKE', '%'.$timestamp.'%'],
        ])->get();
        foreach($apiqueries as $apiquery):
            
            $requestarr = explode('/', $apiquery->endpoint_requested);
            $endpoint_type = $requestarr[0];
            $bids = (isset($requestarr[2]))? explode(',', $requestarr[2]): false;
            
            if(!isset($requestarr[3]) && $bids != false){
                if(in_array($bid, $bids)):
                    $share_clicks++;
                endif;
            }
        
        endforeach;
        
        return $share_clicks;
    }

    public static function get_shares_by_date($start=false, $end=false){
        
        $shares = array();

        //Log::debug('Get shares by date.');

        
        if($start && $end ):

            Log::debug($start.' - '.$end);


           /*$apiqueries = ApiTracking::where([
                ['endpoint_requested', 'NOT LIKE', 'brochure-segments%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-fields%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-categories%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-search%'],
                ['endpoint_requested', 'NOT LIKE', 'brochures%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure%'],
                ['endpoint_requested', 'NOT LIKE', 'categories%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-html%'],           
                ['endpoint_requested', 'NOT LIKE', 'stylesheet%'],           
                ['endpoint_requested', 'NOT LIKE', 'script%'],           
                ['endpoint_requested', 'NOT LIKE', 'brochure-email-link%'],
                ['endpoint_requested', 'NOT LIKE', 'brochure-sms-link%'],           
                ['endpoint_requested', 'NOT LIKE', 'mostpopular%'],
                ['endpoint_requested', 'NOT LIKE', 'article%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-stylesheet%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-scripts%'],
                ['endpoint_requested', 'NOT LIKE', 'manikin-html%'],
            ])*/
            $apiqueries = false;

            $emailqueries = ApiTracking::where('endpoint_requested', 'LIKE', 'brochure-email/%')
            ->whereBetween('created_at', [$start, $end])
            ->get();
            //Log::debug($emailqueries->count().' email shares');

            $smsqueries = ApiTracking::where('endpoint_requested', 'LIKE', 'brochure-sms/%')
            ->whereBetween('created_at', [$start, $end])
            ->get();
            //Log::debug($smsqueries->count().' sms shares');
        
            $merged = $emailqueries->merge($smsqueries);
            $apiqueries = $merged->all();

            foreach($apiqueries as $apiquery):
        
                $requestarr = explode('/', $apiquery->endpoint_requested);
                $endpoint_type = $requestarr[0];
                //$bids = (isset($requestarr[2]))? explode(',', $requestarr[2]): array();

                if($endpoint_type == 'brochure-email' && filter_var($requestarr[1], FILTER_VALIDATE_EMAIL)):
                    $shares[] = $apiquery;
                endif;

                if($endpoint_type == 'brochure-sms'):
                    //if(in_array($bid, $bids)):
                        $shares[] = $apiquery;
                    //endif;
                endif;

            endforeach;
        
        endif;

        //Log::debug(count($shares).' total shares');

        return $shares;
    }
    
    public static function get_client_shares_formatted($start, $end){
        $entries = array();
        //Log::debug('Get shares formatted.');

        $shares = ApiTracking::get_shares_by_date($start, $end);
        if($shares){
            $sharescnt = 0;
            foreach($shares as $share){
                
                if(isset($share->user_id) && $share->user_id != ''):

                    //Log::debug($share->user_name.': '.$share->endpoint_requested);

                    $is_email_share = false;
                    $is_sms_share = false;

                    if(strpos($share->endpoint_requested, 'email')){
                        $is_email_share = true;
                    }
                    if(strpos($share->endpoint_requested, 'sms')){
                        $is_sms_share = true;
                    }
                    //Log::debug('email share: '.$is_email_share);
                    //Log::debug('sms share: '.$is_sms_share);
                
                    $user = User::find($share->user_id);
                    if(isset($user->id)):
                
                        $userSettings = UserSettings::where('user_id', $user->id)->first();
                        $occupation = (isset($userSettings))? $userSettings->occupation: '';
                        $company = (isset($userSettings))? $userSettings->company: '';
                        $region = (isset($userSettings))? $userSettings->region: '';

                        $clickscnt = 0;
                        if( !isset( $entries[$share->user_id] ) ){

                            $requestarr = explode('/', $share->endpoint_requested);
                            if(isset($requestarr[3])):
                                $clickscnt = ApiTracking::get_share_clicks($requestarr[3]);
                            endif;

                            $entries[$share->user_id] = array(
                                'id' => $share->user_id,
                                'name' => $share->user_name,
                                'email' => $user->email,
                                'occupation' => $occupation,
                                'company' => $company,
                                'region' => $region,
                                'requests' => array( $share->endpoint_requested ),
                                'emails' => ($is_email_share)? 1: 0,
                                'smses' => ($is_sms_share)? 1: 0,
                                'shares' => 1,
                                'email_clicks' => ($is_email_share)? $clickscnt: 0, 
                                'sms_clicks' => ($is_sms_share)? $clickscnt: 0, 
                                'clicks' => $clickscnt 
                            );

                        } else {

                            $entries[$share->user_id]['requests'][] = $share->endpoint_requested;
                            if($is_email_share):
                                //Log::debug('is email share.');
                                $entries[$share->user_id]['emails']++;
                            endif;
                            if($is_sms_share):
                                //Log::debug('is sms share.');
                                $entries[$share->user_id]['smses']++;
                            endif; 

                            $entries[$share->user_id]['shares']++;


                            $requestarr = explode('/', $share->endpoint_requested);
                            if(isset($requestarr[3])):
                                $clickscnt = ApiTracking::get_share_clicks($requestarr[3]);
                            endif;

                            if($is_email_share):
                                Log::debug('is email click.');
                                $entries[$share->user_id]['email_clicks'] += $clickscnt;
                            endif;
                            if($is_sms_share):
                                Log::debug('is sms click.');
                                $entries[$share->user_id]['sms_clicks'] += $clickscnt;
                            endif; 

                            $entries[$share->user_id]['clicks'] += $clickscnt;

                        }
                
                    endif;
                    Log::debug(print_r($entries, true));
                endif;
            }
        }
        return $entries;
    }

}
