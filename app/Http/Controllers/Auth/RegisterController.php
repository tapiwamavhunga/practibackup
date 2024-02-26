<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

use App\Mail\SignupNotice; 
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'practice_number' => ['required', 'string', 'max:255'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'practice_number' => $data['practice_number'],
            'phone_number' => $data['phone_number'],
            'company' => 'medinformer',
            'password' => Hash::make($data['password']),
        ]);

            $user->UserSettings()->save(new UserSettings);

//             $signup_data = $user;
//             \Mail::send('emails.signup-notice', compact('signup_data'), function ($message) {
//     $message->to('mavhungatapiwa@gmail.com')->subject('New account notice');
//     $message->from('mavhungatapiwa@gmail.com', 'Accounts');
// });


                $mail = 'jo-anne@medinformer.co.za';
                //$craig = 'medinformer10@gmail.com';
    \Mail::to($mail)->send(new SignupNotice($user));



        return $user;

        // print_r($user);
        // die();

        // $usersettings = new UserSettings;

        // $usersettings->user_id = \auth::user()->id;
    
        // $usersettings->brochures_allowed = NULL;

        // $usersettings->save();





    }

    // private function whatsappNotification(string $recipient)
    // {
    //     $sid    = getenv("TWILIO_AUTH_SID");
    //     $token  = getenv("TWILIO_AUTH_TOKEN");
    //     $wa_from= getenv("TWILIO_WHATSAPP_FROM");
    //     $twilio = new Client($sid, $token);
        
    //     $from_doc = "Medinformer Health";
    //     $body = "Important health information from $from_doc. Acne: https://medinformer.co.za/health_subjects/acne-pimples/";

    //     return $twilio->messages->create("whatsapp:$recipient",["from" => "whatsapp:$wa_from", "body" => $body]);
    // }
}
