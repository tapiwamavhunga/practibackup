<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiTrackingController;
use App\ApiTracking;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\SMSReportsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\VerificationsController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\PostsController;
use App\Models\Users;
use App\Mail\SendDemoMail;
use Psr\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface as ContainerException;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\DateRangeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/conditions', [App\Http\Controllers\HomeController::class, 'nhsindex'])->name('nhsindex');


Route::get('/medicines', [App\Http\Controllers\HomeController::class, 'nhsmeds'])->name('nhsmeds');



Route::get('/nhs_get', [App\Http\Controllers\HomeController::class, 'nhsget'])->name('nhsget');


Route::get('frames', [App\Http\Controllers\ExternalController::class, 'frames'])->name('frames');


Route::get('babycity', [App\Http\Controllers\ExternalController::class, 'babycity'])->name('babycity');

Route::get('dischem', [App\Http\Controllers\ExternalController::class, 'dischem'])->name('dischem');

Route::resource('daterange', DateRangeController::class);


Auth::routes();


//Reports
Route::get('smsreports', [App\Http\Controllers\DisplayDataController::class, 'smsreports'])->name('smsreports');
Route::get('smsreportscreate', [App\Http\Controllers\DisplayDataController::class, 'smsreportscreate'])->name('smsreportscreate');

Route::get('emailreports', [App\Http\Controllers\DisplayDataController::class, 'emailreports'])->name('emailreports');
Route::get('emailreportscreate', [App\Http\Controllers\DisplayDataController::class, 'emailreportscreate'])->name('emailreportscreate');





//

//Route::get('daterange', [App\Http\Controllers\HomeController::class, 'index'])->name('daterange.index');

Route::resource('user_reports', App\Http\Controllers\DateRangeController::class);



Route::get('whatsapp', [App\Http\Controllers\DateRangeController::class, 'whatsapp'])->name('whatsapp');
Route::get('whatsappadmin', [App\Http\Controllers\DateRangeController::class, 'whatsappadmin'])->name('whatsappadmin');
Route::get('sms', [App\Http\Controllers\DateRangeController::class, 'sms'])->name('sms');

Route::get('smsadmin', [App\Http\Controllers\DateRangeController::class, 'smsadmin'])->name('smsadmin');
Route::get('sms/export/', [App\Http\Controllers\DateRangeController::class, 'export'])->name('export');


Route::get('emailadmin', [App\Http\Controllers\DateRangeController::class, 'emailadmin'])->name('emailadmin');



Route::get('email/export/', [App\Http\Controllers\DateRangeController::class, 'email_export'])->name('email_export');


Route::get('whatsapp/export/', [App\Http\Controllers\DateRangeController::class, 'whatsapp_export'])->name('whatsapp_export');

Route::get('users/export/', [App\Http\Controllers\DateRangeController::class, 'users_export'])->name('users_export');
// Here
Route::resource('admin/admin_reports', App\Http\Controllers\AdminDateRangeController::class);



// Here



// Route::get('users/export/', [UsersController::class, 'export']);


//Route::resource('sms_reports', App\Http\Controllers\SMSReportsController::class);
Route::get('smsreportscreate', [App\Http\Controllers\DisplayDataController::class, 'smsreportscreate'])->name('smsreportscreate');





//End Reports 
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reports', [App\Http\Controllers\HomeController::class, 'reports'])->name('reports');
Route::get('/sms_reports', [App\Http\Controllers\HomeController::class, 'sms_reports'])->name('sms_reports');

// Verify 
Route::get('/verify-me', [App\Http\Controllers\VerifyController::class, 'contactForm'])->name('contact-form');

Route::post('/verify-me', [App\Http\Controllers\VerifyController::class, 'storeContactForm'])->name('contact-form.store');








Route::get('/export', [App\Http\Controllers\AjaxController::class, 'export']);
Route::post('/brochuresearch', [App\Http\Controllers\AjaxController::class, 'brochuresearch']);

Route::post('/brochuresearchnhs', [App\Http\Controllers\AjaxController::class, 'brochuresearchnhs']);


Route::post('/brochurefetch', [App\Http\Controllers\AjaxController::class, 'brochurefetch']);

Route::post('/brochurefetchnhs', [App\Http\Controllers\AjaxController::class, 'brochurefetchnhs']);

Route::post('/brochurefetchnhsmeds', [App\Http\Controllers\AjaxController::class, 'brochurefetchnhsmeds']);


Route::get('/brochurecategory', [App\Http\Controllers\AjaxController::class, 'brochurecategory']);
Route::post('/brochureemail', [App\Http\Controllers\AjaxController::class, 'brochureemail']);

Route::post('/brochureemailnhs', [App\Http\Controllers\AjaxController::class, 'brochureemailnhs']);

Route::post('/brochuresms', [App\Http\Controllers\AjaxController::class, 'brochuresms']);
Route::post('/brochuresmsnhs', [App\Http\Controllers\AjaxController::class, 'brochuresmsnhs']);
Route::post('/brochurewhatsapp', [App\Http\Controllers\AjaxController::class, 'brochurewhatsapp']);

Route::post('/brochurewhatsappnhs', [App\Http\Controllers\AjaxController::class, 'brochurewhatsappnhs']);


Route::get('/ajax', [App\Http\Controllers\AjaxController::class, 'ajax'])->name('ajax');


Route::get('brochures/{id}/preview', [App\Http\Controllers\AuthController::class, 'brochurepreview'])->name('admin.brochure.preview');


// Route::get('brochures/{id}/preview', 'AdminController@brochurepreview')->middleware('role:admin')->name('admin.brochure.preview');



Route::get('/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
Route::get('/user/verify-practice/{id}', [App\Http\Controllers\UserController::class, 'verifypractice'])->name('user.verify-practice');

Route::put('/user/update-practice/{id}', [App\Http\Controllers\UserController::class, 'updatepractice'])->name('user.update-practice');

Route::put('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

Route::put('/user/updateProfile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.updateProfile');
Route::put('/user/updateProfileEmailSettings/{id}', [App\Http\Controllers\UserController::class, 'updateProfileEmailSettings'])->name('user.updateProfileEmailSettings');

Route::put('/user/updateProfileEmailSettingsLogo/{id}', [App\Http\Controllers\UserController::class, 'updateProfileEmailSettingsLogo'])->name('user.updateProfileEmailSettingsLogo');


Route::put('/user/updateProfileStatus/{id}', [App\Http\Controllers\UserController::class, 'updateProfileStatus'])->name('user.updateProfileStatus');




Route::get('/admin/user/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');


Route::get('admin/users', [App\Http\Controllers\HomeController::class, 'adminUsers'])->name('admin.users')->middleware('is_admin');

Route::get('admin/newusers', [App\Http\Controllers\HomeController::class, 'adminNewUsers'])->name('admin.newusers')->middleware('is_admin');


Route::get('users/getusers', [App\Http\Controllers\HomeController::class, 'getusers'])->name('users.getusers');


Route::get('admin/brochures', [App\Http\Controllers\HomeController::class, 'adminBrochures'])->name('admin.brochures')->middleware('is_admin');

Route::get('admin/users/verify-me', [App\Http\Controllers\HomeController::class, 'adminVerify'])->name('admin.users.verify-me')->middleware('is_admin');

Route::get('admin/companies', [App\Http\Controllers\HomeController::class, 'adminCompanies'])->name('admin.companies')->middleware('is_admin');

Route::resource('users', UserController::class);


Route::get('send-mail', function () {

$users = Users::all();

foreach($users as $user){
    Mail::to($user)->send(new SendDemoMail);
}


foreach ($users as $user) {
    
    $user->password =  Hash::make('medinformer');
    $user->update();

        //var_dump($user->password);


    dd("Email is Sent.");

}
   



});




/**
 * Send an email and do processing on a model with the email
 */



// Track Brochure Views
// Route::get('/tracking/email/{timestamp}/{brochureid}', 'ApiTrackingController@trackEmailLinkBrochure')->name('track.email.brochure');

Route::get('/tracking/email/{timestamp}/{brochureid}', [App\Http\Controllers\ApiTrackingController::class, 'trackEmailLinkBrochure'])->name('track.email.brochure');


Route::get('/tracking/sms/{timestamp}/{brochureid}', [App\Http\Controllers\ApiTrackingController::class, 'trackSMSLinkBrochure'])->name('track.sms.brochure');

 //Route::get('/tracking/sms/{timestamp}/{brochureid}', 'ApiTrackingController@trackSMSLinkBrochure')->name('track.sms.brochure');

Route::get('/tracking/smscode/{timestamp}/{brochureid}/{smscode}', [App\Http\Controllers\ApiTrackingController::class, 'trackSMSCodeLinkBrochure'])->name('track.smscode.brochure');

// Route::get('/tracking/smscode/{timestamp}/{brochureid}/{smscode}', 'ApiTrackingController@trackSMSCodeLinkBrochure')->name('track.smscode.brochure');



//api sms responder
Route::get('/smsbrochure/', function () {
        dd("dghdgfgdgfhsdgf");
        $timestamp = time();
        $xmlarr = array(
                'keyword' => false,
                'to' => false,
                'from' => false,
                'eventDate' => false,
        );

    $xmldata = (isset($_GET['XMLDATA']))? urldecode($_GET['XMLDATA']): false;
    $xmldata = str_replace('<SMS_RECEIVE><RECEIVE_RESPONSE></XML>','</SMS_RECEIVE></RECEIVE_RESPONSE></XML>', $xmldata);
    //Log::debug($xmldata);

    $ob = simplexml_load_string($xmldata);

    //Log::debug(print_r($ob->RECEIVE_RESPONSE[0], true));

    $keywordjson = json_encode($ob->RECEIVE_RESPONSE[0]);
    $keywordarr = json_decode($keywordjson, true);
    $keyword = $keywordarr['SMS_RECEIVE'];
    $xmlarr['keyword'] = $keyword;

        $tojson = json_encode($ob->RECEIVE_RESPONSE->SMS_RECEIVE['to']);
        $toarr = json_decode($tojson, true);
    $xmlarr['to'] = $toarr[0];

        $fromjson = json_encode($ob->RECEIVE_RESPONSE->SMS_RECEIVE['from']);
        $fromarr = json_decode($fromjson, true);
    $xmlarr['from'] = $fromarr[0];

        $eventDatejson = json_encode($ob->RECEIVE_RESPONSE->SMS_RECEIVE['eventDate']);
        $eventDatearr = json_decode($eventDatejson, true);
    $xmlarr['eventDate'] = $eventDatearr[0];

    //Log::debug(print_r($xmlarr, true));

    //Log::debug(print_r($xmlarr['keyword'], true));

     $conditions = array(
        'health',
        'contact'
    );

    if(!in_array(strtolower($keyword), $conditions)){

        //Log::debug('BROCHURE KEYWORD REQUEST');
        /* get health basket brochure ids*/
        $bids = array();
        $bf = BrochureField::where('title', 'Health Basket')->first();
        if($bf):
            $bfvs = BrochureFieldValues::where('field_id', $bf->id)->distinct()->get();
            foreach($bfvs as $bfv){
                if(stripos($bfv->value, $keyword) !== false){
                    $bids[] = $bfv->brochure_id;
                }
            }
        endif;
        //$brochures = Brochure::where('title', 'LIKE', '%'.$xmlarr['keyword'].'%')->get();

        /*if(count($brochures) > 0){
            foreach($brochures as $brochure){
                $bids .= $brochure->id.',';
            }
        }
        $bids = substr($bids, 0, -1);*/

        ApiTracking::trackRequest('brochure-sms-responder/'.trim($xmlarr['from']).'/'.implode(',', $bids).'/'.$timestamp.'/'.trim($xmlarr['to']));


  $body_msg = '';
        $brochures = Brochure::find($bids); //Brochure::where('title', 'LIKE', '%'.$xmlarr['keyword'].'%')->get();
        if(count($brochures) > 0){
            $body_msg = 'Click link below for Medinformer health info:'."\n"."\n";
            foreach($brochures as $brochure){
                Log::debug(print_r($brochure, true));
                $trackurl = route('track.smscode.brochure', ['timestamp' => $timestamp, 'brochureid' => $brochure->id, 'smscode' => trim($xmlarr['to'])] );
                Log::debug($trackurl);
                $bitlyobj = json_decode(
                    file_get_contents(
                        "http://api.bit.ly/v3/shorten?login=o_59ur33ucle&apiKey=R_e64642d5e5bd459dad58b1bfe1e38e1a&longUrl=".urlencode($trackurl)."&format=json"
                    )
                )->data->url;
                $body_msg .= $brochure->title.": ";
                $body_msg .= $bitlyobj."\n"."\n";
            }
        }

    } else {
        //Log::debug('MANUAL KEYWORD REQUEST');
        //Log::debug(print_r($keyword, true));
        //$body_msg = '';
        switch(strtolower($keyword)):
            case 'health':
                $body_msg = 'Click link below for Medinformer health info:'."\n"."\n";
                $qrlanding = 'https://www.medinformer.co.za/medinformer-qrlanding/';
                if($xmlarr['to'] == '39291'){
                    $qrlanding = 'https://www.medinformer.co.za/dischem-qrlanding/';
                }
                $bitlyobj = json_decode(
                    file_get_contents(
                        "http://api.bit.ly/v3/shorten?login=o_59ur33ucle&apiKey=R_e64642d5e5bd459dad58b1bfe1e38e1a&longUrl=".urlencode($qrlanding)."&format=json"
                    )
                )->data->url;
                $body_msg .= $bitlyobj."\n"."\n";
            break;
            case 'contact':
                $body_msg = 'Click link and fill out contact form:'."\n"."\n";
                $url = 'https://www.medinformer.co.za/conference-contacts/';
 /*if($xmlarr['to'] == '39291'){
                    $qrlanding = 'https://www.medinformer.co.za/dischem-qrlanding/';
                }*/
                $bitlyobj = json_decode(
                    file_get_contents(
                        "http://api.bit.ly/v3/shorten?login=o_59ur33ucle&apiKey=R_e64642d5e5bd459dad58b1bfe1e38e1a&longUrl=".urlencode($url)."&format=json"
                    )
                )->data->url;
                $body_msg .= $bitlyobj."\n"."\n";
            break;
        endswitch;

    }
    $body = '
    <XML>
                <SENDBATCH delivery_report="1" status_report="1">
                        <SMSLIST>
                                <SMS_SEND uid="'.$timestamp.'" user="43587887" password="jNXqa6" to="'.$xmlarr['from'].'">'.$body_msg.'</SMS_SEND>
                        </SMSLIST>
                </SENDBATCH>
        </XML>';
    //Log::debug(print_r($body, true));

        $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://sg1.channelmobile.co.za');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
    // execute curl setup.
    $return = curl_exec($ch);

    // close curl connection.
    curl_close($ch);

        return '';

})->name('home.sms.responder');


/*
 * Vehicles Routes
 */

/*
 * Users Routes
 */
Route::resource('users', App\Http\Controllers\UsersController::class);

Route::resource('allreports', App\Http\Controllers\ReportsController::class);


Route::get('export_users', [App\Http\Controllers\ExportController::class, 'export_users'])->name('export_users');


/*
 * Users Routes
 */


Route::get('export-csv', [App\Http\Controllers\ExportController::class, 'exportCSV'])->name('export-csv');

Route::get('admin/verifications', [VerificationsController::class, 'index']);

Route::get('admin/verifications/list', [VerificationsController::class, 'getVerifications'])->name('admin.verifications.list');


Route::get('admin/accounts', [AccountsController::class, 'index']);

Route::get('admin/accounts/list', [AccountsController::class, 'getAccounts'])->name('admin.accounts.list');

// Route::get('admin/users/{id}/brochures', [AdminController::class, 'userbrochures'])->middleware('is_admin')->name('admin.user.brochures');

Route::get('/user/brochures/{id}', [App\Http\Controllers\UsersController::class, 'userbrochures'])->name('user.brochures');

Route::patch('users/{id}/brochures/update', [App\Http\Controllers\UsersController::class, 'userupdatebrochures'])->name('user.update.brochures');


// Route::patch('users/{id}/brochures/update', [UsersController::class, 'userupdatebrochures'])->name('admin.user.update.brochures');


Route::resource('admin/iframe', App\Http\Controllers\IframeController::class);
Route::resource('admin/posts', App\Http\Controllers\PostsController::class);

Route::get('/admin/update-companies', [App\Http\Controllers\UsersController::class, 'updatecompanies'])->name('admin.update-companies');


Route::post('/generate-hash',[UrlController::class, 'generateHash']);
Route::get('/get-click-report/{hash}',[UrlController::class, 'getStatsForHash']);
Route::get('/{hash}',[UrlController::class, 'redirect']);
Route::get('/whatsapp/{hash}',[UrlController::class, 'redirect_whatsapp']);

Route::get('/sms/{hash}',[UrlController::class, 'redirect_sms']);

// Route::get('update-companies', function () {

// //$users = Users::all();
// $dischem_users = DB::table("users")->where("email", "like", "%mailinator.com%")->get(); 

// print_r($dischem_users);
// foreach ($dischem_users as $user) {
//          $user->company = 'company';
//          $user->update();
//          dd("Users Update");

// }
   



// });
