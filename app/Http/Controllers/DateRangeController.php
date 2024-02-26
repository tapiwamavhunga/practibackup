<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use DB;

use Auth;

use App\Exports\SMSExport;
use App\Exports\EmailExport;
use App\Exports\WhatsappExport;
use App\Exports\UsersExport;

use Maatwebsite\Excel\Facades\Excel;
class DateRangeController extends Controller

{   


    public function create(){}

      public function store(){}

        public function update(){}

          public function show(){}

            public function edit(){}

              public function destroy(){}
    public function export() 
    {
        return Excel::download(new SMSExport, 'users.xlsx');
    }


    public function email_export() 
    {
        return Excel::download(new EmailExport, 'emails.xlsx');
    }

     public function whatsapp_export() 
    {
        return Excel::download(new WhatsappExport, 'whatsapp.xlsx');
    }

     public function users_export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


      function emailadmin(Request $request)

    {



        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('urls')->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();




            } else {


                $data = DB::table('urls')->get();

                     $data_emails = $data->count(); 

            

            }


          



            return datatables()->of($data)->make(true);

        }


        return view('dateranger');

    }


    function index(Request $request)

    {



        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('urls')->where('user_id', Auth::user()->id)

                    ->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();




            } else {


                $data = DB::table('urls')->where('user_id', Auth::user()->id)

                    ->get();

                     $data_emails = $data->count(); 

            

            }


          



            return datatables()->of($data)->make(true);

        }


        return view('daterange');

    }


    function whatsapp(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('whatsapp')->where('user_id', Auth::user()->id)

                    ->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();


            } else {


                $data = DB::table('whatsapp')->where('user_id', Auth::user()->id)

                    ->get();


            }


            return datatables()->of($data)->make(true);

        }


        return view('daterange');

    }


        function sms(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('sms')->where('user_id', Auth::user()->id)

                    ->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();


            } else {


                $data = DB::table('sms')->where('user_id', Auth::user()->id)

                    ->get();


            }


            return datatables()->of($data)->make(true);

        }


        return view('daterange');

    }



    function smsadmin(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('sms')->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();


            } else {


                $data = DB::table('sms')->get();


            }


            return datatables()->of($data)->make(true);

        }


        return view('dateranger');

    }


    function whatsappadmin(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('whatsapp')->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();


            } else {


                $data = DB::table('whatsapp')->get();


            }


            return datatables()->of($data)->make(true);

        }


        return view('dateranger');

    }

}