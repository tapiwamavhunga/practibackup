<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use DB;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Corcel\Acf\Field\BasicField;
use Corcel\Acf\FieldFactory;
use Corcel\Acf\Field\PostObject;
use App\Models\User;
use App\Models\SMS;
use App\Models\Whatsapp;

use App\Models\Emails;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


class ReportsController extends Controller

{




    public function create(){}

       public function store(){}

        public function update(){}

          public function show(){}
 public function edit(){}

 public function destroy(){}

    function index(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                 $user_id = \Auth::user()->id;
                $data = Whatsapp::where('user_id', '=', $user_id)->whereBetween('created_at', array($request->from_date, $request->to_date))->get();


            } else {


                $user_id = \Auth::user()->id;
                $data = Whatsapp::where('user_id', '=', $user_id)->get();


            }


            return datatables()->of($data)->make(true);

        }


        return view('allreports');

    }

}