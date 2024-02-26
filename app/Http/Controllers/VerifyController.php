<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verify;
class VerifyController extends Controller
{
        public function contactForm()

    {

        return view('user.verify_practice');

    }


    public function storeContactForm(Request $request)

    {

        $request->validate([

            'practice_number' => 'required',

            

        ]);


        $input = $request->all();


        Verify::create($input);


        //  Send mail to admin


        \Mail::send('contactMail', array(

            'name' => \Auth::user()->name,

            'email' => \Auth::user()->email,

            'practice_number' => $input['practice_number'],

            'user_id' => \Auth::user()->id ,
            'subject' => "Please verify",
            'message' => $input['message'],


        ), function($message) use ($request){

            $message->from($request->email);

            $message->to('mavhungatapiwa@gmail.com', 'Admin')->subject($request->get('subject'));

        });


        return redirect()->back()->with(['success' => 'Request for verification submitted successfully - for instant verification please phone Jo-Anne on 076 1833034']);

    }
}
