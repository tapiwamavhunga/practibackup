<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserSettings;
use App\User;
use App\Company;
use App\ApiTracking;
use Auth;
use Log;
use DB;

class ApiTrackingController extends Controller
{

    public function trackEmailLinkBrochure($timestamp, $brochureid){

        ApiTracking::trackEmailBrochureLink('brochure-email-link/'.$timestamp.'/'.$brochureid);
        //return Redirect::to('http://heera.it');

    }
    public function trackSMSLinkBrochure($timestamp, $brochureid){
        //dd("hello");
        ApiTracking::trackSMSBrochureLink('brochure-sms-link/'.$timestamp.'/'.$brochureid);
        //return Redirect::to('http://heera.it');

    }
    public function trackSMSCodeLinkBrochure($timestamp, $brochureid, $smscode){

        ApiTracking::trackSMSCodeBrochureLink('brochure-sms-responder/'.$timestamp.'/'.$brochureid.'/'.$smscode);
        //return Redirect::to('http://heera.it');

    }
}
