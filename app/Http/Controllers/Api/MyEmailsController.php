<?php 

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;


class MyEmailsController extends Controller

{

    function index(Request $request)

    {

        if(request()->ajax()) {


            if(!empty($request->from_date)) {


                $data = DB::table('users')

                    ->whereBetween('created_at', array($request->from_date, $request->to_date))

                    ->get();

                    print_r($data);
                die();


            } else {


                $data = DB::table('users')->get();




            }


            return datatables()->of($data)->make(true);

        }


        return view('daterange.index');

    }

}