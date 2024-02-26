<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use DB;

use Auth;

use App\Exports\SMSExport;
use Maatwebsite\Excel\Facades\Excel;
class AdminDateRangeController extends Controller

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


    function index(Request $request)

    {



        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('urls')

                    ->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();




            } else {


                $data = DB::table('urls')

                    ->get();

                     $data_emails = $data->count(); 



            }


          



            return datatables()->of($data)->make(true);

        }


        return view('dateranger');

    }


    function whatsapp(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('whatsapp')

                    ->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();


            } else {


                $data = DB::table('whatsapp')

                    ->get();


            }


            return datatables()->of($data)->make(true);

        }


        return view('dateranger');

    }


        function sms(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('sms')

                    ->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();


                

            } else {


                $data = DB::table('sms')

                    ->get();


            }


            return datatables()->of($data)->make(true);

        }


        return view('dateranger');

    }

}