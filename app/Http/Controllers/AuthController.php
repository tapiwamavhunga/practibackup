<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Corcel\Model\Post;
use Corcel\Model\Taxonomy;
use Corcel\Model\Category;

use Corcel\Acf\Field\BasicField;
use Corcel\Acf\FieldFactory;
use Corcel\Acf\Field\File;
use Corcel\Acf\Field\PostObject;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\ApiTracking;
use App\Models\SMS;
use App\Models\Posts;
use App\Models\UserSettings;
use Corcel\Models\Attachment;
use Tbruckmaier\Corcelacf\Models\Text;
use Tbruckmaier\Corcelacf\Models\Image;
use URL;
 use Illuminate\Support\Facades\Auth; 
use App\Models\Nhs;
use App\Models\Medicines;
class AuthController extends Controller
{

    public function manikinJPG(){
        
    }
    public function sendResponse($data, $message, $status = 200) 
    {
        $response = [
          'data' => $data,
          'message' => $message
        ];

        return response()->json($response, $status);
    }

    public function sendError($errorData, $message, $status = 500)
    {
        $response = [];
        $response['message'] = $message;
        if (!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $status);
    }

    public function register(Request $request) 
    {
        $input = $request->only('name','email','password','c_password','is_verified');

        $validator = Validator::make($input, [
          'name' =>'required',
          'email' =>'required|email|unique:users',
          'password' =>'required|min:8',
          'c_password' =>'required|same:password',

        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(),'Validation Error', 422);
        }

        $input['password'] = bcrypt($input['password']); // use bcrypt to hash the passwords
        $user = User::create($input); // eloquent creation of data

        $success['user'] = $user;

        return $this->sendResponse($success,'user registered successfully', 201);

    }

    public function login(Request $request)
    {
        $input = $request->only('email','password');

        $validator = Validator::make($input, [
          'email' =>'required',
          'password' =>'required',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors(),'Validation Error', 422);
        }

        try {
            // this authenticates the user details with the database and generates a token
            if (! $token = JWTAuth::attempt($input)) {
                return $this->sendError([], "invalid login credentials", 400);
            }
        } catch (JWTException $e) {
            return $this->sendError([], $e->getMessage(), 500);
        }

        $success = [
          'token' => $token,
        ];
        return $this->sendResponse($success,'successful login', 200);
    }

    public function getUser() 
   { 
        $user = Auth::user(); 
        return response()->json(['success' => $user]); 
    }



public function brochurepreview(){
  echo "Hello";
}

// public function framehtml(){
//         //$this->trackRequest('manikin-scripts');
//         $data = file_get_contents('https://datacenter.medinformer.co.za/js/manikin.js');
//         $data = preg_replace("/\n/", " ", $data);
//         $data = preg_replace("/\r/", " ", $data);
//         $data = preg_replace("/\s+/", " ", $data);
//         // $data = preg_replace("/\s+/", " ", $data);
//         //$data = $data;
//         return array(
//           'link' =>'https://datacenter.medinformer.co.za/js/manikin.js',
//           'source' => $data
//         );
//     }



 public function framehtml(){
       $result = array(); 

       $appurl = \URL::to('/');
        
        // $brochures = Post::orderBy('title','asc')->get();
        $brochures = Post::type('medicalbrochure')->status('publish')->get();


        $current_campaign =  Posts::where('current_campaign', 1)->get(); 
        $featured =  Posts::where('featured_brochures', 1)->paginate(3); 
        $main_landing_brochures =  Posts::where('main_landing_brochures', 1)->paginate(4); 

      
      //print_r($brochures);
      
       $posts = Post::type('medicalbrochure')->status('publish')->get();

         if ( $posts ) {
                foreach ( $posts as $key => $post ) {
                

                    
                        // code...
                    
                    $first_letter = substr($post->post_title,0,1);
                    if( ! empty( $first_letter ) ) {
                        $result[$first_letter][] = array(
                          'ID' => $post->ID,
                          'title' => $post->post_title,
                          'excerpt'=>$post->excerpt,
                          'meta'=> $post->meta->brochure_type,
                          'link'=> $post->meta->link,
                          'password'=> $post->meta->password,
                           'slug'=> $post->slug,
                          'featured'=> $post->meta->featured,

                        );
                    }
                
                }
            }



        if( ! empty( $result ) ) {
            ksort( $result );
        }

        $categories = Taxonomy::where('taxonomy','medicalbrochure_category','featured')->get();

        
        // $cat->each(function($category) {
        //     echo $category->name;
        // });

        // foreach ($categories as $cat) {

        // }

        
        

        $viewShareVars = ['result','categories','current_campaign','featured','main_landing_brochures'];

        //return view('babycity',compact($viewShareVars));

        $view = view('dischem',compact($viewShareVars));
        $style = 
        $html['html'] = "


         <link href='https://share.medinformer.co.za/css/b/c/d/e/f/styleb.css?1189482039' rel='stylesheet' type='text/css'/>


         <style>

         .d-large{
  display: block;
}

.d-small {
  display: none ;
}

.page-title.text-center {
  margin-top: 50px;
}



@media only screen and (max-width:768px) {
.d-large{
  display: none;
}

.d-small {
  width: 100%;
  float: left;
  display: block;
  margin-bottom: 10px;
}

.page-main {
  margin: 13px;
}

.mpblog-search {
  margin: 20px;
}


}


.card-img-top > img{
  width: 100% !important;
}
@media only screen and (max-width: 768px) {
  .d-small {
    width: 100%;
    float: left;
    display: block;
    margin-bottom: 38px;
  }
}


.mainwrapper {
  padding: 10px;
  max-width: 1300px;
  margin: 5px auto;
  font-family: 'Montserrat','Helvetica Neue',Helvetica,Arial,sans-serif;
}


         </style>
 <div class='mainwrapper' style=''>

 <div class='d-small' style=''>
<div class='card' style='border: none; border-radius: 0px !important; background: #d4eef0; box-shadow: 6px 6px 0px 0px #00a049 !important;'>
  <a href='https://www.dischem.co.za/articles/post/male-infertility' style='color: #000 !important;'>
    <picture class='card-img-top' style='border-radius: 0px !important; '>
      <img src='http://dbank.medinformer.co.za/wp-content/uploads/2021/10/malefertility-1.jpg' style='height: 174px; width: 100%;'>
    </picture>
  </a>


  <div class='card-block'>
    <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
      <a href='https://www.dischem.co.za/articles/post/male-infertility' style='color: #000 !important;'>Male Infertility</a>
    </h5>
    <div class='content_blockR' style='padding: 10px; font-size: 14px;'>Male infertility can be due to multiple reasons including varicocele (enlargement of spermatic veins), testicular failure, hormone dysfunction, genital tract infection or exposure to toxins.... </div>
  </div>
</div>
 </div>
  <aside>
    <div class='manikin-intro'>
  <div class='text-center' style='background: #D4EEF0; height: 100%; border-radius: 10px; padding: 10px;'>
    <a href='#brochure-search-page'></a>
    <div class='alt_top'>
      <a href='#brochure-search-page'></a>
      <a href='#brochure-search-page' style='text-align: center; text-transform: uppercase; color: #fff; font-weight: 600;'> A-Z Conditions </a>
    </div>
    <a href='#brochure-search-page' style='text-align: center; text-transform: uppercase; color: #fff;'>
      <img src='https://medinformer.co.za/wp-content/uploads/2023/03/family-1024x1024.png.webp' style='height: 222px; margin-left: 28px;'>
    </a>
    <div class='bottom'>
      <a href='#brochure-search-page' type='button' style='text-align: center; text-transform: uppercase; color: #fff !important; font-weight: 600;'> Free Trusted Healthcare Information </a>
    </div>
  </div>
</div>
  </aside>
  <div class='d-large'>
  <div class='feature-block'>
  
  <div class='img_left'>
    <a href='https://www.dischem.co.za/articles/post/contraception-services'>
    <img src='http://dbank.medinformer.co.za/wp-content/uploads/2021/10/contraceptive-choices.jpg' style='height: 356px;
  object-fit: cover;' />
  </a>
  </div>
  <div class='body-text'>
    <h2 class='blog-teaser--hero__content-title'>Contraception Services</h2>
    <p>
Providing women with access to effective contraception is a critical element of women’s health. Enabling women to make choices about their fertility is empowering and offers women better economic and social opportunities.  </p>
  <br>
  <a class='read_more_btn' style='color: #000 !important;' href='https://www.dischem.co.za/articles/post/contraception-services'>Read More</a>
  </div>
</div>
     
  </div>
</div>

<div class='medwrapper'>
    <header>
    <h2 class='section-title'>FEBRUARY IS REPRODUCTIVE HEALTH MONTH!
</h2>
  </header> 
<section class='columns'>
    
    <div class='column'>
    <div class='card' style='border: none; border-radius: 0px !important; background: #d4eef0; box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;'>
          <a href='https://www.dischem.co.za/articles/post/cancer-sexuality-and-intimacy' style='color: #000 !important;'>
            <picture class='card-img-top' style='border-radius: 0px !important; '>
              
              <img src='http://dbank.medinformer.co.za/wp-content/uploads/2022/09/cancer-sexuality-and-intimacy1.jpg' style='height: auto; width: 100%;'>
            </picture>
          </a>
          <div class='card-block'>
            <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
              <a href='https://www.dischem.co.za/articles/post/cancer-sexuality-and-intimacy' style='color: #000 !important;'>Cancer - Sexuality and Intimacy</a>
            </h5>
            <div class='content_blockR' style='padding: 10px; font-size: 14px;'> While it will naturally take some time for the shock of your diagnosis to set in..   </div>

          </div>
        </div>
    </div>
    
    <div class='column'>
    <div class='card' style='border: none; border-radius: 0px !important; background: #d4eef0; box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;'>
          <a href='https://www.dischem.co.za/articles/post/pre-and-postnatal-supplementation' style='color: #000 !important;'>
            <picture class='card-img-top' style='border-radius: 0px !important; '>
              
              <img src='http://medinformer.co.za/wp-content/uploads/2024/02/image001.png' style='height: auto; width: 100%;'>
            </picture>
          </a>
          <div class='card-block'>
            <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
              <a href='https://www.dischem.co.za/articles/post/pre-and-postnatal-supplementation' style='color: #000 !important;'>Pre-and Postnatal Supplementation</a>
            </h5>
            <div class='content_blockR' style='padding: 10px; font-size: 14px;'>  A woman’s nutritional status during pregnancy and breastfeeding is not only critical for her health but also for her baby.  </div>

          </div>
        </div>
    </div>
    

    <div class='column'>
    <div class='card' style='border: none; border-radius: 0px !important; background: #d4eef0; box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;'>
          <a href='https://www.dischem.co.za/articles/post/pediatric-diarrhoea' style='color: #000 !important;'>
            <picture class='card-img-top' style='border-radius: 0px !important; '>
              
              <img src='http://medinformer.co.za/wp-content/uploads/2024/02/Untitled-design.png' style='height: auto; width: 100%;'>
            </picture>
          </a>
          <div class='card-block'>
            <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
              <a href='https://www.dischem.co.za/articles/post/pediatric-diarrhoea' style='color: #000 !important;'>Pediatric Diarrhoea</a>
            </h5>
            <div class='content_blockR' style='padding: 10px; font-size: 14px;'>Defined as a sudden onset of stools which are looser than normal and increased in frequency compared to normal, with or without vomiting. </div>

          </div>
        </div>
    </div>
  
    
</section>  
    


</div>



<div id='app'>
  <header>
    <h2 class='section-title'>Trending Articles</h2>
  </header>
  <section class='grid'>

    <div class='grid-group'>
      <div class='card' style='border: none; border-radius: 0px !important; background: #fff; box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;'>
          <a href='https://www.dischem.co.za/articles/post/epilepsy' style='color: #000 !important;'>
            <picture class='card-img-top' style='border-radius: 0px !important; '>
              
              <img src='http://dbank.medinformer.co.za/wp-content/uploads/2021/10/epilepsy.jpg' style='height: 174px;'>
            </picture>
          </a>
          <div class='card-block'>
            <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
              <a href='https://www.dischem.co.za/articles/post/epilepsy' style='color: #000 !important;'>Epilepsy</a>
            </h5>
            <div class='content_blockR' style='padding: 10px; font-size: 14px;'> 
 Epilepsy, the most common of the serious neurological conditions, is marked by repeated seizures that start in the brain.
  </div>

          </div>
        </div>
    </div>

       <div class='grid-group'>
      <div class='card' style='border: none; border-radius: 0px !important; background: #fff; box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;'>
          <a href='https://www.dischem.co.za/articles/post/diarrhoea' style='color: #000 !important;'>
            <picture class='card-img-top' style='border-radius: 0px !important; '>
              
              <img src='http://dbank.medinformer.co.za/wp-content/uploads/2022/05/diahorrea-main.jpg' style='height: 174px;'>
            </picture>
          </a>
          <div class='card-block'>
            <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
              <a href='https://www.dischem.co.za/articles/post/diarrhoea' style='color: #000 !important;'>Diarrhoea </a>
            </h5>
            <div class='content_blockR' style='padding: 10px; font-size: 14px;'> Has someone ever told you to just “let diarrhoea work itself out” and not stop it? Some people prefer not to suppress the condition with an antidiarrhoeal....</div>

          </div>
        </div>
    </div>

   <div class='grid-group'>
      <div class='card' style='border: none; border-radius: 0px !important; background: #fff; box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;'>
          <a href='https://www.dischem.co.za/articles/post/cancer-palliative-care' style='color: #000 !important;'>
            <picture class='card-img-top' style='border-radius: 0px !important; '>
              
              <img src='http://dbank.medinformer.co.za/wp-content/uploads/2022/10/heart-shaped-hands-sunset.jpg' style='height: 174px;'>
            </picture>
          </a>
          <div class='card-block'>
            <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
              <a href='https://www.dischem.co.za/articles/post/cancer-palliative-care' style='color: #000 !important;'>Cancer Palliative Care</a>
            </h5>
            <div class='content_blockR' style='padding: 10px; font-size: 14px;'>  Simply defined, palliative care is care that is responsive to the needs of patients  </div>

          </div>
        </div>
    </div>

       <div class='grid-group'>
      <div class='card' style='border: none; border-radius: 0px !important; background: #fff; box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;'>
          <a href='https://www.dischem.co.za/articles/post/antibiotic-related-diarrhoea' style='color: #000 !important;'>
            <picture class='card-img-top' style='border-radius: 0px !important; '>
              
              <img src='http://dbank.medinformer.co.za/wp-content/uploads/2022/10/cancer-diagnosisnew.jpg' style='height: 174px;'>
            </picture>
          </a>
          <div class='card-block'>
            <h5 class='text-bold' style='padding: 10px; margin-bottom: 1px;'>
              <a href='https://www.dischem.co.za/articles/post/antibiotic-related-diarrhoea' style='color: #000 !important;'>Antibiotic Related Diarrhoea</a>
            </h5>
            <div class='content_blockR' style='padding: 10px; font-size: 14px;'>   A number of antibiotics can cause diarrhoea in both children and adults </div>

          </div>
        </div>
    </div>
    
  </section>



<div class='listing-group' id='brochure-search-page'>
  <div class='row align-items-center'>
    <h1 class='page-title text-center' style='color: #00A049; font-size: 25px; text-transform: uppercase; text-align: center;  font-weight: 600 !important;'>Medical Conditions A-Z</h1>
  </div>
  <style>
    #s_525,
    #s_240,
    #s_485,
    #s_516 {
      display: none;
    }
  </style>
  <div class='brochure-groups'>
    <div id='alphabetical-posts'>
      <div class='letters-wrap mt-5 mb-5'>
        <ul class='letters'>
          <li>
            <a href='#goto-letter-A'>A</a>
          </li>
          <li>
            <a href='#goto-letter-B'>B</a>
          </li>
          <li>
            <a href='#goto-letter-C'>C</a>
          </li>
          <li>
            <a href='#goto-letter-D'>D</a>
          </li>
          <li>
            <a href='#goto-letter-E'>E</a>
          </li>
          <li>
            <a href='#goto-letter-F'>F</a>
          </li>
          <li>
            <a href='#goto-letter-G'>G</a>
          </li>
          <li>
            <a href='#goto-letter-H'>H</a>
          </li>
          <li>
            <a href='#goto-letter-I'>I</a>
          </li>
          <li>
            <a href='#goto-letter-J'>J</a>
          </li>
          <li>
            <a href='#goto-letter-K'>K</a>
          </li>
          <li>
            <a href='#goto-letter-L'>L</a>
          </li>
          <li>
            <a href='#goto-letter-M'>M</a>
          </li>
          <li>
            <a href='#goto-letter-N'>N</a>
          </li>
          <li>
            <a href='#goto-letter-O'>O</a>
          </li>
          <li>
            <a href='#goto-letter-P'>P</a>
          </li>
          <li>
            <a href='#goto-letter-Q'>Q</a>
          </li>
          <li>
            <a href='#goto-letter-R'>R</a>
          </li>
          <li>
            <a href='#goto-letter-S'>S</a>
          </li>
          <li>
            <a href='#goto-letter-T'>T</a>
          </li>
          <li>
            <a href='#goto-letter-U'>U</a>
          </li>
          <li>
            <a href='#goto-letter-V'>V</a>
          </li>
          <li>
            <a href='#goto-letter-W'>W</a>
          </li>
        </ul>
      </div>
      <div class='brochure-groups'>
        <div class='posts row row-cols-lg-4 row-cols-md-2 row-cols-1 max-mb-n30'>
          <div id='goto-letter-A' class='item'>
            <h3>A</h3>
            <div class='list brochure-items'>
              <div id='258806' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/acne-pimples' target='_blank'> Acne (Pimples) </a>
              </div>
              <div id='259594' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/adhd' target='_blank'> ADHD </a>
              </div>
              <div id='259661' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/allergic-rhinitis' target='_blank'> Allergic Rhinitis </a>
              </div>
              <div id='259666' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/allergy' target='_blank'> Allergy </a>
              </div>
              <div id='259669' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/alzheimers-disease' target='_blank'> Alzheimer’s Disease </a>
              </div>
              <div id='259971' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/anxiety-disorder' target='_blank'> Anxiety Disorder </a>
              </div>
              <div id='259975' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/arthritis-joint-pain' target='_blank'> Arthritis </a>
              </div>
              <div id='259979' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/asthma-symptoms' target='_blank'> Asthma </a>
              </div>
              <div id='259984' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/asthma-myths-and-facts' target='_blank'> Asthma – Myths and Facts </a>
              </div>
              <div id='259986' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/asthma-and-exercise' target='_blank'> Asthma and Exercise </a>
              </div>
              <div id='259988' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/asthma-and-pregnancy' target='_blank'> Asthma and Pregnancy </a>
              </div>
              <div id='259992' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/athletes-foot' target='_blank'> Athlete’s Foot </a>
              </div>
              <div id='259995' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/attention-deficit-disorder-add' target='_blank'> Attention Deficit Disorder – ADD </a>
              </div>
              <div id='259999' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/autoimmune-diseases' target='_blank'> Autoimmune Diseases </a>
              </div>
              <div id='260877' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/actinic-keratosis-scripted-patients-only' target='_blank'> Actinic Keratosis – scripted patients only </a>
              </div>
              <div id='261010' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/asthma-in-children' target='_blank'> Asthma in Children </a>
              </div>
              <div id='263901' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/actinic-keratosis-skin-condition' target='_blank'> Actinic keratosis </a>
              </div>
              <div id='263987' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/abnormal-uterine-bleeding' target='_blank'> Abnormal Uterine Bleeding </a>
              </div>
              <div id='264261' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/adult-allergies' target='_blank'> Adult Allergies </a>
              </div>
              <div id='267219' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/antibiotic-related-diarrhoea' target='_blank'> Antibiotic Related Diarrhoea </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-B' class='item'>
            <h3>B</h3>
            <div class='list brochure-items'>
              <div id='260007' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/bacterial-skin-infections' target='_blank'> Bacterial Skin Infections </a>
              </div>
              <div id='260010' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/bacterial-vaginosis' target='_blank'> Bacterial Vaginosis </a>
              </div>
              <div id='260014' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/bedwetting-enuresis' target='_blank'> Bedwetting in Children </a>
              </div>
              <div id='260017' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/bipolar' target='_blank'> Bipolar </a>
              </div>
              <div id='260020' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/blocked-nose' target='_blank'> Blocked Nose </a>
              </div>
              <div id='260022' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/blood-clots' target='_blank'> Blood Clots </a>
              </div>
              <div id='260024' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/blood-pressure' target='_blank'> Blood Pressure </a>
              </div>
              <div id='260026' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/bone-health' target='_blank'> Bone Health </a>
              </div>
              <div id='260031' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/breast-cancer' target='_blank'> Breast Cancer </a>
              </div>
              <div id='260033' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/breast-milk' target='_blank'> Breast Milk </a>
              </div>
              <div id='260036' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/breast-pumps' target='_blank'> Breast Pumps </a>
              </div>
              <div id='260854' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/baby-sun-care' target='_blank'> Baby Sun Care </a>
              </div>
              <div id='263905' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/basal-cell-carcinoma' target='_blank'> Basal Cell Carcinoma </a>
              </div>
              <div id='266352' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/bone-metastases' target='_blank'> Bone Metastases </a>
              </div>
              <div id='266732' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/breastfeeding' target='_blank'> Breastfeeding </a>
              </div>
              <div id='266784' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/body-stress-release' target='_blank'> Body Stress Release </a>
              </div>
              <div id='267209' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/baby-skin-health' target='_blank'> Baby skin health </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-C' class='item'>
            <h3>C</h3>
            <div class='list brochure-items'>
              <div id='260052' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cardiovascular-disease' target='_blank'> Cardiovascular Disease </a>
              </div>
              <div id='260056' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cervical-cancer-screening' target='_blank'> Cervical Cancer – Screening </a>
              </div>
              <div id='260063' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/childhood-constipation' target='_blank'> Childhood Constipation </a>
              </div>
              <div id='260068' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cholesterol' target='_blank'> Cholesterol </a>
              </div>
              <div id='260072' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/chronic-pain' target='_blank'> Chronic Pain </a>
              </div>
              <div id='260075' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cobiotics-and-gut-health' target='_blank'> Cobiotics and Gut Health </a>
              </div>
              <div id='260081' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/colds-and-flu' target='_blank'> Cold or Flu </a>
              </div>
              <div id='260084' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cold-sores' target='_blank'> Cold Sores </a>
              </div>
              <div id='260087' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/conjunctivitis' target='_blank'> Conjunctivitis </a>
              </div>
              <div id='260092' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/concentration-and-memory' target='_blank'> Concentration and Memory </a>
              </div>
              <div id='260127' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/contraception-services' target='_blank'> Contraception Services </a>
              </div>
              <div id='260131' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/covid-19' target='_blank'> COVID-19 </a>
              </div>
              <div id='260882' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/capeloda-therapy-scripted-patients-only' target='_blank'> Capeloda Therapy – scripted patients only </a>
              </div>
              <div id='261528' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/chronic-gout' target='_blank'> Chronic Gout </a>
              </div>
              <div id='263975' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/childhood-vaccines-kiddivaxi' target='_blank'> Childhood Vaccines - Kiddivax </a>
              </div>
              <div id='263995' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/chickenpox' target='_blank'> Chickenpox </a>
              </div>
              <div id='264059' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/corns-and-calluses' target='_blank'> Corns and Calluses </a>
              </div>
              <div id='264563' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cough-colds-flu' target='_blank'> Cough, Colds &amp; Flu </a>
              </div>
              <div id='267715' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/constipation-2' target='_blank'> Constipation </a>
              </div>
              <div id='265263' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/constipation' target='_blank'> Constipation </a>
              </div>
              <div id='265790' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/coughs-colds-and-flu' target='_blank'> Coughs, Colds and Flu </a>
              </div>
              <div id='266174' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/colic-4' target='_blank'> Colic </a>
              </div>
              <div id='266203' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-sexuality-and-intimacy' target='_blank'> Cancer - Sexuality and Intimacy </a>
              </div>
              <div id='266210' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-life-after-the-new-normal' target='_blank'> Cancer Life After - The New Normal </a>
              </div>
              <div id='266213' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-and-your-immune-system' target='_blank'> Cancer and your immune system </a>
              </div>
              <div id='266246' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/nutrition-and-cancer' target='_blank'> Cancer and Nutrition </a>
              </div>
              <div id='266252' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-tumor-markers' target='_blank'> Cancer Tumor Markers </a>
              </div>
              <div id='266264' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-palliative-care' target='_blank'> Cancer Palliative Care </a>
              </div>
              <div id='266300' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-diagnosis' target='_blank'> Cancer Diagnosis </a>
              </div>
              <div id='266305' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-managing-pain-and-discomfort' target='_blank'> Cancer - Managing Pain and Discomfort </a>
              </div>
              <div id='266309' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-stages-and-grading' target='_blank'> Cancer Stages and Grading </a>
              </div>
              <div id='266342' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/colorectal-cancer' target='_blank'> Colorectal Cancer </a>
              </div>
              <div id='266397' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/crohns-disease' target='_blank'> Crohn's Disease </a>
              </div>
              <div id='266528' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/cancer-coping-with-a-diagnosis' target='_blank'> Cancer - Coping with a Diagnosis </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-D' class='item'>
            <h3>D</h3>
            <div class='list brochure-items'>
              <div id='260224' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/dementia' target='_blank'> Dementia </a>
              </div>
              <div id='260231' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/depression' target='_blank'> Depression </a>
              </div>
              <div id='260235' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/dry-skin' target='_blank'> Dry Skin </a>
              </div>
              <div id='260238' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/dry-eye' target='_blank'> Dry Eye </a>
              </div>
              <div id='260978' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/deworming-intestinal-worms-vermox' target='_blank'> Deworming </a>
              </div>
              <div id='260981' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/depression-treatment-resistant' target='_blank'> Depression - Treatment Resistant </a>
              </div>
              <div id='260991' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/diabetes-easy-lifestyle-changes-for-healthier-living' target='_blank'> Diabetes – easy lifestyle changes for healthier living </a>
              </div>
              <div id='264579' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/diarrhoea-2-2' target='_blank'> Diarrhoea &amp; Dehydration </a>
              </div>
              <div id='264450' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/diarrhoea' target='_blank'> Diarrhoea </a>
              </div>
              <div id='265363' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/dehydration' target='_blank'> Dehydration </a>
              </div>
              <div id='267198' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/diabetes-mellitus-type-2' target='_blank'> Diabetes Mellitus Type 2 </a>
              </div>
              <div id='267403' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/diabetes-sticking-to-your-treatment-plan-helpful-tips' target='_blank'> Diabetes - Sticking to your treatment plan helpful tips </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-E' class='item'>
            <h3>E</h3>
            <div class='list brochure-items'>
              <div id='260037' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/ebola' target='_blank'> Ebola </a>
              </div>
              <div id='260047' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/eczema' target='_blank'> Eczema </a>
              </div>
              <div id='260080' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/endometriosis' target='_blank'> Endometriosis </a>
              </div>
              <div id='260123' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/enlarged-prostate-gland' target='_blank'> Enlarged Prostate Gland </a>
              </div>
              <div id='260124' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/epilepsy' target='_blank'> Epilepsy </a>
              </div>
              <div id='260126' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/exam-stress' target='_blank'> Exam Stress </a>
              </div>
              <div id='260130' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/excessive-sweating' target='_blank'> Excessive Sweating </a>
              </div>
              <div id='266102' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/exercise-and-cancer' target='_blank'> Exercise and Cancer </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-F' class='item'>
            <h3>F</h3>
            <div class='list brochure-items'>
              <div id='260140' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/female-infertility' target='_blank'> Female Infertility </a>
              </div>
              <div id='260142' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/feminine-hygiene-3' target='_blank'> Feminine Hygiene </a>
              </div>
              <div id='260886' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/filgrastim-teva-scripted-patients-only' target='_blank'> Filgrastim Teva – scripted patients only </a>
              </div>
              <div id='261019' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/flu-vaccination' target='_blank'> Flu Vaccination </a>
              </div>
              <div id='264266' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/flu-in-high-risk-individuals' target='_blank'> Flu in high risk individuals </a>
              </div>
              <div id='264323' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/flu' target='_blank'> Flu </a>
              </div>
              <div id='264330' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/flu-in-young-children' target='_blank'> Flu in young children </a>
              </div>
              <div id='264926' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/female-hormones-teen' target='_blank'> Female Hormones - Teen </a>
              </div>
              <div id='264936' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/female-hormones-adult' target='_blank'> Female Hormones - Adult </a>
              </div>
              <div id='264940' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/female-hormones-mature' target='_blank'> Female Hormones - Mature </a>
              </div>
              <div id='265102' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/female-hormones-mature-plus' target='_blank'> Female Hormones - Mature Plus </a>
              </div>
              <div id='265117' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/female-hormones-senior' target='_blank'> Female Hormones - Senior </a>
              </div>
              <div id='266163' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/functional-abdominal-pain' target='_blank'> Functional Abdominal Pain </a>
              </div>
              <div id='266499' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/first-1000-days-from-conception-to-birth' target='_blank'> First 1000 days from conception to birth </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-G' class='item'>
            <h3>G</h3>
            <div class='list brochure-items'>
              <div id='260144' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/gastrointestinal-tract-conditions-gut' target='_blank'> Gastrointestinal Tract Conditions (gut) </a>
              </div>
              <div id='260147' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/gouty-arthritis' target='_blank'> Gouty Arthritis </a>
              </div>
              <div id='263908' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/treat-genital-warts' target='_blank'> Genital Warts </a>
              </div>
              <div id='265620' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/generic-vs-originator-medicines' target='_blank'> Generic vs originator medicines </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-H' class='item'>
            <h3>H</h3>
            <div class='list brochure-items'>
              <div id='259012' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-11-hiv-and-opportunistic-infections' target='_blank'> HIV 11 – HIV and Opportunistic infections </a>
              </div>
              <div id='260151' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hay-fever-2' target='_blank'> Hay Fever </a>
              </div>
              <div id='260153' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hair-loss' target='_blank'> Hair Loss </a>
              </div>
              <div id='260154' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hba1c' target='_blank'> HbA1c </a>
              </div>
              <div id='260706' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/headaches' target='_blank'> Headaches </a>
              </div>
              <div id='260712' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/heart-attack-and-stroke' target='_blank'> Heart Attack and Stroke </a>
              </div>
              <div id='260903' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/heart-health' target='_blank'> Heart Health </a>
              </div>
              <div id='260911' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/heartburn-and-ulcers' target='_blank'> Heartburn and Ulcers </a>
              </div>
              <div id='260912' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/high-blood-pressure-hypertension' target='_blank'> High Blood Pressure – Hypertension </a>
              </div>
              <div id='260957' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hormone-replacement-therapy-hrt' target='_blank'> Hormone Replacement Therapy (HRT) </a>
              </div>
              <div id='260958' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hypertension' target='_blank'> Hypertension </a>
              </div>
              <div id='260959' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hypothyroidism' target='_blank'> Hypothyroidism </a>
              </div>
              <div id='260953' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-10-stis' target='_blank'> HIV 10 – STIs </a>
              </div>
              <div id='260951' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-9-hiv-and-hepatitis-b' target='_blank'> HIV 9 – HIV and Hepatitis B </a>
              </div>
              <div id='260926' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-5-all-about-arvs' target='_blank'> HIV 5 – All about ARVs </a>
              </div>
              <div id='260949' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-7-contraception' target='_blank'> HIV 7 – Contraception </a>
              </div>
              <div id='260928' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-6-preventing-hiv' target='_blank'> HIV 6 – Preventing HIV </a>
              </div>
              <div id='260920' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-3-treatment-in-children' target='_blank'> HIV 3 – Treatment in Children </a>
              </div>
              <div id='260915' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-1-what-is-hiv' target='_blank'> HIV 1 – What is HIV? </a>
              </div>
              <div id='260917' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-2-treatment' target='_blank'> HIV 2 – Treatment </a>
              </div>
              <div id='260922' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-4-administering-hiv-medicines-in-children' target='_blank'> HIV 4 – Administering HIV medicines in children </a>
              </div>
              <div id='261022' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-8-tuberculosis-tb-3' target='_blank'> HIV 8 – Tuberculosis (TB) </a>
              </div>
              <div id='262006' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-12-life-cycle-2' target='_blank'> HIV 12 – Life Cycle </a>
              </div>
              <div id='267716' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/baby-bath' target='_blank'> How to Bath your Baby </a>
              </div>
              <div id='267717' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/baby-massage' target='_blank'> How to Massage your Baby </a>
              </div>
              <div id='264409' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/human-papillomavirus-hpv' target='_blank'> Human Papillomavirus (HPV) </a>
              </div>
              <div id='265610' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/hiv-prevention-of-mother-to-child-transmission-pmtct' target='_blank'> HIV 13 - Prevention of mother-to-child transmission (PMTCT) </a>
              </div>
              <div id='266022' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/healthy-brain-development-in-children' target='_blank'> Healthy Brain Development in Children </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-I' class='item'>
            <h3>I</h3>
            <div class='list brochure-items'>
              <div id='260098' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/immune-booster' target='_blank'> Immune Booster </a>
              </div>
              <div id='260112' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/importance-of-vaccination' target='_blank'> Importance of Vaccination </a>
              </div>
              <div id='260117' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/incontinence' target='_blank'> Incontinence </a>
              </div>
              <div id='260149' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/infant-colic' target='_blank'> Infant Colic </a>
              </div>
              <div id='260160' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/insomnia' target='_blank'> Insomnia </a>
              </div>
              <div id='260175' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/irregular-heartbeat' target='_blank'> Irregular Heartbeat </a>
              </div>
              <div id='260180' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/irritable-bowel-syndrome-ibs' target='_blank'> Irritable Bowel Syndrome – IBS </a>
              </div>
              <div id='260182' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/itchy-scalp' target='_blank'> Itchy Scalp </a>
              </div>
              <div id='261024' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/iron-deficiency-anaemia' target='_blank'> Iron Deficiency Anaemia </a>
              </div>
              <div id='267234' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/infant-eczema-and-cradle-cap' target='_blank'> Infant eczema and cradle cap </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-J' class='item'>
            <h3>J</h3>
            <div class='list brochure-items'>
              <div id='260662' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/joints' target='_blank'> Joint Health </a>
              </div>
              <div id='266063' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/juvenile-idiopathic-arthritis' target='_blank'> Juvenile Idiopathic Arthritis </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-K' class='item'>
            <h3>K</h3>
            <div class='list brochure-items'>
              <div id='260665' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/kidney-stones' target='_blank'> Kidney Stones </a>
              </div>
              <div id='260899' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/kyleena-scripted-patients-only' target='_blank'> Kyleena® – scripted patients only </a>
              </div>
              <div id='264394' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/knee-replacement' target='_blank'> Knee Replacement </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-L' class='item'>
            <h3>L</h3>
            <div class='list brochure-items'>
              <div id='260668' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/learning-difficulties' target='_blank'> Learning Difficulties </a>
              </div>
              <div id='260672' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/liver-toxicity' target='_blank'> Liver Toxicity </a>
              </div>
              <div id='260675' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/living-with-erectile-dysfunction-ed' target='_blank'> Living with Erectile Dysfunction (ED) </a>
              </div>
              <div id='260678' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/loss-of-appetite' target='_blank'> Loss of Appetite </a>
              </div>
              <div id='260680' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/low-immune-system' target='_blank'> Low immune system </a>
              </div>
              <div id='260929' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/lopimune-40-10-oral-pellets-scripted-patients-only' target='_blank'> LOPIMUNE 40/10 ORAL PELLETS - scripted patients only </a>
              </div>
              <div id='260994' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/living-with-type-2-diabetes' target='_blank'> Living with Type 2 Diabetes </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-M' class='item'>
            <h3>M</h3>
            <div class='list brochure-items'>
              <div id='260245' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/male-infertility' target='_blank'> Male Infertility </a>
              </div>
              <div id='260639' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/meningococcal-meningitis' target='_blank'> Meningococcal Meningitis </a>
              </div>
              <div id='260643' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/menopause' target='_blank'> Menopause </a>
              </div>
              <div id='260646' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/menopause-changes-in-women' target='_blank'> Menopause – Changes in women </a>
              </div>
              <div id='260650' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/mental-fatigue' target='_blank'> Mental Fatigue </a>
              </div>
              <div id='260683' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/metabolic-syndrome' target='_blank'> Metabolic Syndrome </a>
              </div>
              <div id='260686' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/migraines' target='_blank'> Migraines </a>
              </div>
              <div id='260688' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/multiple-sclerosis' target='_blank'> Multiple Sclerosis </a>
              </div>
              <div id='260690' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/multivitamin-support' target='_blank'> Multivitamin Support </a>
              </div>
              <div id='260932' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/mirena-scripted-patients-only' target='_blank'> Mirena® - scripted patients only </a>
              </div>
              <div id='263960' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/maternal-immunisation-pertussis-whooping-cough' target='_blank'> Maternal Immunisation - Pertussis (Whooping Cough) </a>
              </div>
              <div id='264257' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/minor-cuts-and-scratches' target='_blank'> Minor Cuts and Scratches </a>
              </div>
              <div id='264285' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/measles-mumps-and-rubella' target='_blank'> Measles, Mumps and Rubella - MMR </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-N' class='item'>
            <h3>N</h3>
            <div class='list brochure-items'>
              <div id='260692' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/natural-alternative' target='_blank'> Natural Alternative </a>
              </div>
              <div id='260704' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/nutrition-and-baby-brain-development' target='_blank'> Nutrition and Baby Brain Development </a>
              </div>
              <div id='260708' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/nutrition-and-foetal-brain-development' target='_blank'> Nutrition and Foetal Brain Development </a>
              </div>
              <div id='260715' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/nutritional-support' target='_blank'> Nutritional Support </a>
              </div>
              <div id='266012' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/natural-healing-for-mom-and-baby' target='_blank'> Natural Healing for mom and baby </a>
              </div>
              <div id='266801' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/nappy-rash' target='_blank'> Nappy Rash </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-O' class='item'>
            <h3>O</h3>
            <div class='list brochure-items'>
              <div id='260718' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/obesity' target='_blank'> Obesity </a>
              </div>
              <div id='260726' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/obsessive-compulsive-disorder-ocd' target='_blank'> Obsessive Compulsive Disorder – OCD </a>
              </div>
              <div id='260730' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/open-wounds' target='_blank'> Open Wounds </a>
              </div>
              <div id='260732' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/osteoarthritis' target='_blank'> Osteoarthritis </a>
              </div>
              <div id='260734' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/otitis-externa-ear-infection' target='_blank'> Otitis Externa – Ear Infection </a>
              </div>
              <div id='260737' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/overactive-bladder-oab' target='_blank'> Overactive Bladder (OAB) </a>
              </div>
              <div id='260940' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/oxaliplatin-therapy-scripted-patients-only' target='_blank'> Oxaliplatin Therapy - scripted patients only </a>
              </div>
              <div id='261017' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/osteoporosis' target='_blank'> Osteoporosis </a>
              </div>
              <div id='262027' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/oral-pain-discomfort-10' target='_blank'> Oral Pain &amp; Discomfort </a>
              </div>
              <div id='266217' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/ocular-allergies' target='_blank'> Ocular Allergies </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-P' class='item'>
            <h3>P</h3>
            <div class='list brochure-items'>
              <div id='260741' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/paediatric-pain-and-fever' target='_blank'> Paediatric Pain and Fever </a>
              </div>
              <div id='260747' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pain-management' target='_blank'> Pain Management </a>
              </div>
              <div id='260754' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pancreatic-disorder' target='_blank'> Pancreatic Disorder </a>
              </div>
              <div id='260759' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/panic-attack' target='_blank'> Panic Attack </a>
              </div>
              <div id='260765' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/parkinsons-disease' target='_blank'> Parkinson’s Disease </a>
              </div>
              <div id='260775' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/piles-and-varicose-veins' target='_blank'> Piles And Varicose Veins </a>
              </div>
              <div id='260779' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/post-traumatic-stress-disorder-ptsd' target='_blank'> Post-Traumatic Stress Disorder (PTSD) </a>
              </div>
              <div id='260786' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/postnatal-depression' target='_blank'> Postnatal Depression </a>
              </div>
              <div id='260798' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/premenstrual-syndrome-pms' target='_blank'> Premenstrual Syndrome PMS </a>
              </div>
              <div id='260800' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/probiotics' target='_blank'> Probiotics </a>
              </div>
              <div id='260805' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/prostate-cancer' target='_blank'> Prostate Cancer </a>
              </div>
              <div id='260817' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pcos-polycystic-ovarian-syndrome' target='_blank'> PCOS – Polycystic Ovarian Syndrome </a>
              </div>
              <div id='260822' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/psoriasis' target='_blank'> Psoriasis </a>
              </div>
              <div id='260825' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pulmonary-hypertension' target='_blank'> Pulmonary Hypertension </a>
              </div>
              <div id='260944' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/paclitaxel-therapy-scripted-patients-only' target='_blank'> Paclitaxel Therapy - scripted patients only </a>
              </div>
              <div id='264316' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pneumococcal-disease' target='_blank'> Pneumococcal disease </a>
              </div>
              <div id='266005' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pre-and-postnatal-supplementation' target='_blank'> Pre-and Postnatal Supplementation </a>
              </div>
              <div id='266357' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pediatric-cold-and-flu' target='_blank'> Pediatric Cold and Flu </a>
              </div>
              <div id='266765' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/paediatric-inflammatory-bowel-disease' target='_blank'> Paediatric Inflammatory Bowel Disease </a>
              </div>
              <div id='266976' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pediatric-reflux' target='_blank'> Pediatric Reflux </a>
              </div>
              <div id='266988' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/picky-eating' target='_blank'> Picky Eating </a>
              </div>
              <div id='267226' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/pediatric-diarrhoea' target='_blank'> Pediatric Diarrhoea </a>
              </div>
              <div id='267245' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/post-cancer-skin-care' target='_blank'> Post Cancer Skin Care </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-Q' class='item'>
            <h3>Q</h3>
            <div class='list brochure-items'>
              <div id='260968' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/qlaira-scripted-patients-only' target='_blank'> Qlaira® - scripted patients only </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-R' class='item'>
            <h3>R</h3>
            <div class='list brochure-items'>
              <div id='260748' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/respiratory-tract-conditions' target='_blank'> Respiratory Tract Conditions </a>
              </div>
              <div id='260752' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/ringworm' target='_blank'> Ringworm </a>
              </div>
              <div id='263999' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/rotavirus-2' target='_blank'> Rotavirus </a>
              </div>
              <div id='265682' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/restlessness-teething-in-babies' target='_blank'> Restlessness and Teething in Babies </a>
              </div>
              <div id='266038' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/rheumatoid-arthritis' target='_blank'> Rheumatoid Arthritis </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-S' class='item'>
            <h3>S</h3>
            <div class='list brochure-items'>
              <div id='260780' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/schizophrenia' target='_blank'> Schizophrenia </a>
              </div>
              <div id='260787' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/sexual-health-7' target='_blank'> Sexual Health </a>
              </div>
              <div id='260803' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/sinusitis' target='_blank'> Sinusitis </a>
              </div>
              <div id='260836' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/sore-throat' target='_blank'> Sore Throat </a>
              </div>
              <div id='260841' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/stomach-ailments' target='_blank'> Stomach Ailments </a>
              </div>
              <div id='260845' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/stress' target='_blank'> Stress </a>
              </div>
              <div id='260848' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/stress-and-anxiety' target='_blank'> Stress and Anxiety </a>
              </div>
              <div id='260851' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/stress-and-irritable-bowel-syndrome-ibs' target='_blank'> Stress and Irritable Bowel Syndrome (IBS) </a>
              </div>
              <div id='260965' class='col brochure-itemddd' style='display: none'>
                <a href='https://www.dischem.co.za/articles/post/synchrobreathe-scripted-patients-only' target='_blank'> Synchrobreathe - scripted patients only </a>
              </div>
              <div id='264298' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/shingles' target='_blank'> Shingles </a>
              </div>
              <div id='267714' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/sinusitis-2-2' target='_blank'> Sinusitis </a>
              </div>
              <div id='267718' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/staying-healthy-and-well-how-to-prevent-disease-when-to-seek-medical-advice' target='_blank'> Staying Healthy &amp; Well Test </a>
              </div>
              <div id='264594' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/smoking_cessation' target='_blank'> Smoking Cessation </a>
              </div>
              <div id='265804' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/sinus' target='_blank'> Sinus </a>
              </div>
              <div id='266122' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/self-care-during-cancer' target='_blank'> Self-care during cancer </a>
              </div>
              <div id='266367' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/sterilising-your-babys-bottles' target='_blank'> Sterilising your baby's bottles </a>
              </div>
              <div id='267012' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/scars-and-stretchmarks' target='_blank'> Scars and Stretchmarks </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-T' class='item'>
            <h3>T</h3>
            <div class='list brochure-items'>
              <div id='260857' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/testicular-cancer' target='_blank'> Testicular Cancer </a>
              </div>
              <div id='260859' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/thrush' target='_blank'> Thrush </a>
              </div>
              <div id='260864' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/thyroid-conditions' target='_blank'> Thyroid Conditions </a>
              </div>
              <div id='260866' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/tuberculosis-tb' target='_blank'> Tuberculosis (TB) </a>
              </div>
              <div id='263889' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/the-immune-system' target='_blank'> The Immune System </a>
              </div>
              <div id='266335' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/the-big-c-a-cancer-diagnosis' target='_blank'> The Big C: A Cancer Diagnosis </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-U' class='item'>
            <h3>U</h3>
            <div class='list brochure-items'>
              <div id='260868' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/utis-urinary-tract-infection' target='_blank'> UTIs – Urinary Tract Infection </a>
              </div>
              <div id='262245' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/ukudakumba' target='_blank'> Ukudakumba </a>
              </div>
              <div id='266386' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/ulcerative-colitis' target='_blank'> Ulcerative Colitis </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-V' class='item'>
            <h3>V</h3>
            <div class='list brochure-items'>
              <div id='260872' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/vaginal-dryness' target='_blank'> Vaginal Dryness </a>
              </div>
              <div id='260997' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/vaginal-thrush' target='_blank'> Vaginal Thrush </a>
              </div>
              <div id='263971' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/vaccine-confidence' target='_blank'> Vaccine Confidence </a>
              </div>
              <div id='264384' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/vaccines-back-to-school' target='_blank'> Vaccines - Back to school </a>
              </div>
              <div id='266182' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/vaginal-yeast-infection' target='_blank'> Vaginal Yeast Infection </a>
              </div>
            </div>
          </div>
          <div id='goto-letter-W' class='item'>
            <h3>W</h3>
            <div class='list brochure-items'>
              <div id='264065' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/warts' target='_blank'> Warts </a>
              </div>
              <div id='264574' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/worms-2' target='_blank'> Worms </a>
              </div>
              <div id='264424' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/world-immunization' target='_blank'> World Immunization </a>
              </div>
              <div id='265348' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/worms' target='_blank'> Worms </a>
              </div>
              <div id='266293' class='col brochure-itemddd' style='display: block'>
                <a href='https://www.dischem.co.za/articles/post/what-is-cancer' target='_blank'> What is cancer? </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End -->
  </div>
</div>
  
</div>







        ";

       


        $return = preg_replace('/\s+/S', " ", $html);

        $retun_cleaned = preg_replace('/\n/', " ", $return);
        $retun_cleaned_again = preg_replace('/\r/', " ", $retun_cleaned);

        $return_cleaned_again_again =  preg_replace('/\s+/S', " ", $retun_cleaned_again);

        $replaced = str_replace("\'", "'", $return_cleaned_again_again);
        return $replaced;

        //return response($replaced, 200)->header('Content-Type','text/html');

    }


    public function getBrochuresByBodyPart($bodypartid, $bodypart){

        $redirect_url = "";


        $bdata = array();

        // print_r($bdata);
        // die();
        // $brochure_ids = DB::table('brochure_field_values')->select('brochure_id')->where([
        //     ['field_id', $bodypartid],
        //     ['value','LIKE','%'.$bodypart.'%'],
        // ])->get();

        $brochure_ids = Post::hasMeta($bodypartid, $bodypart)->get();

        $bids = array();
        foreach($brochure_ids as $bid){
            $bids[] = $bid->brochure_id;
        }
        $brochures = Post::whereIn('ID', $bids)->orderBy('post_title')->get();
        foreach($brochures as $brochure){
            $slug = ApiTracking::sanitize($brochure->post_title);
            $bdata[] = array(
              'title' => $brochure->post_title,
                //'linkurl' => $slug
              'linkurl' => $redirect_url.'/'.$slug,
            );

        //print_r($bdata);
        }
        return $bdata;
    }


public function minifyhtml($content){
        return preg_replace('/\s+/S', " ", $content);
    }

    
public function showbrochurehtml(Request $request) {


        $brochure_id = (isset($request->brochure_id))? $request->brochure_id: false;
        if($brochure_id):
            
            //if($this->can_access_brochure($article_id)):
                
                $article = array();
                $result = Post::find($brochure_id);

                $data = $result->acf->sponsor_logo->url; 
                $downloadable_pdfdocuments = $result->acf->downloadable_pdfdocuments->url; 
                $slug = $result->slug;
                

                $related_article = Post::published()->hasMeta('featured_article')->first();
               // print_r($result);
                
                //$result = Post::type('medicalbrochure')->status('publish')->get();

                if($result === null):
                    //$this->trackRequest('article-html/error');
                    $return = array('Error' => "Article not found. Please try a different article id.");
                else:

                    $slug = ApiTracking::sanitize($result->title);
                    
                    $dataarr = array(
                      'id' => $result->ID,
                      'title' => $result->title,
                      'slug' => $slug,
                      'description' => $this->minifyhtml($result->description),
                      'excerpt' => $this->minifyhtml($result->excerpt),
                      'reference' => $result->reference,
                      'reference_link' => $result->reference_link,
                      'fimage' => $result->fimage,
                      'published' => $result->status,
                      'sponsor'=>$result->acf->sponsor_logo->url,
                      'sponsor_logo'=>$result->acf->sponsor_logo->url,
                      'medicalbrochure_category'=>$result->taxonomies,
                      'downloadable_pdfdocuments'=>$result->acf->downloadable_pdfdocuments,
                    );


                    
                    $article = $dataarr;



                    // ARTICLE HTML

                    $viewShareVars = ['result','related_article', 'data', 'slug', 'downloadable_pdfdocuments'];

        //return view('babycity',compact($viewShareVars));

                    $view = view('view',compact($viewShareVars));


                    
                    $dataarr['html'] = $view;

                    



                    

                    $dataarr['html'] = str_replace("\n", "", $dataarr['html']);
                    //$dataarr['html'] = preg_replace('/\s+/','', $dataarr['html']);
                    //unset($dataarr['article_segments']);
                    $return = $dataarr;

                   // $this->trackRequest('article-html');
                endif;

            /*else:
                $return = array('Error' => "This article hasn't been assigned to your profile. Contact Medinformer Administrator to get this brochure assigned to your profile.");
            endif;*/

        else:
            //$this->trackRequest('article-html/error');
            $return = array('Error' => "No'article_id' field value found. Your request requires MultiForm POST data with field'article_id' and its value.");
        endif;
        return $return;
    }


    public function manikin(){

        $return = array();

        /* Manikin Data */
        $manikin_data = array();
        $bodypart_id = false;
        $bfields = Post::type('medicalbrochure')->hasMeta('miapi_brochure_body_part')->status('publish')->get();
        //$bfields = Post::hasMeta('miapi_brochure_body_part')->type('medicalbrochure')->get();

        foreach($bfields as $bf){

           
           if($bf->slug =='body_part'){
                $bodypart_id = $bf->id;

                
            }
        }
            
        $manikin_data['Head'] = $this->getBrochuresByBodyPart($bodypart_id,'Head');
        $manikin_data['Chest'] = $this->getBrochuresByBodyPart($bodypart_id,'Chest');
        $manikin_data['Abdomen'] = $this->getBrochuresByBodyPart($bodypart_id,'Abdomen');
        $manikin_data['Pelvis'] = $this->getBrochuresByBodyPart($bodypart_id,'Pelvis');
        $manikin_data['Legs'] = $this->getBrochuresByBodyPart($bodypart_id,'Legs');
        $manikin_data['Feet'] = $this->getBrochuresByBodyPart($bodypart_id,'Feet');
        $manikin_data['Skin'] = $this->getBrochuresByBodyPart($bodypart_id,'Skin');
        $manikin_data['General'] = $this->getBrochuresByBodyPart($bodypart_id,'General');
        $manikin_data['mentalhealth'] = $this->getBrochuresByBodyPart($bodypart_id,'mental health');
        $manikin_data['infant'] = $this->getBrochuresByBodyPart($bodypart_id,'infant');

        $html ='
        <div class="manikin-intro">
            <h2 class="manikin-intro-heading">For more health information</h2>
            <p class="manikin-intro-text">Click on the body area you want to know more about. Select a related health topic from the menu</p>
            <div class="manikin-intro-title"><strong>Select a body area</strong></div>
        </div>
        <div class="manikin-menu">
            <div class="manikin-menu-box manikin-animate">
                <div class="manikin-menu-figure">
                    <svg width="217" height="413" viewBox="0 0 217 413" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M76.8298 346.956C76.8298 346.956 81.5611 361.414 82.913 367.803C84.2648 374.192 84.4338 385.288 84.4338 385.288L96.4311 382.598L102.176 375.705L98.9658 363.096C98.9658 363.096 98.9658 354.017 102.852 347.124C106.739 340.231 104.711 332.329 104.711 332.329L75.8159 334.514L76.8298 346.956Z" fill="#1D5073"/>
                    <path d="M83.9264 376.714C83.9264 376.714 91.6993 376.041 93.5581 375.537C95.4168 374.865 97.2756 374.024 97.2756 374.024C97.2756 374.024 93.3891 365.618 94.403 364.609C95.4168 363.768 99.6413 360.91 99.6413 360.91C99.6413 360.91 105.386 369.316 111.132 373.52C116.877 377.723 121.608 381.085 120.088 383.103C118.567 385.288 115.187 388.819 111.132 388.819C107.245 388.819 99.1343 383.943 99.1343 383.943C99.1343 383.943 103.021 396.385 103.359 401.429C103.697 406.64 101.5 410.171 96.0928 410.507C90.6855 410.844 83.0815 406.809 82.7436 397.898C82.4056 388.819 83.0815 385.12 83.5884 381.59C83.5884 380.749 83.9264 376.714 83.9264 376.714Z" fill="#1D5073"/>
                    <path d="M82.237 364.945C82.237 364.945 79.7023 368.812 81.0542 370.998C82.406 373.183 83.9268 374.864 83.9268 374.864C83.9268 374.864 83.7578 371.166 83.2509 369.148C82.575 367.131 82.237 364.945 82.237 364.945Z" fill="#1D5073"/>
                    <path d="M67.1978 332.16C67.1978 332.16 66.3529 340.399 67.7048 344.266C69.0566 348.132 69.5635 356.371 80.716 353.008C91.8685 349.646 94.7411 348.132 94.7411 348.132C94.7411 348.132 105.218 354.185 108.597 351.831C111.977 349.477 113.329 344.266 114.849 337.036C116.37 329.807 115.187 315.348 117.891 300.553C120.426 285.757 124.819 268.272 126.002 253.141C127.354 238.01 128.537 214.808 128.874 203.88C129.212 192.952 122.115 184.545 122.115 184.545L62.9734 176.475C62.9734 176.475 64.3252 185.89 61.4526 199.509C58.58 213.127 58.242 234.311 61.9595 250.787C65.677 267.432 70.9153 291.642 70.2394 306.605C69.7325 321.737 67.1978 332.16 67.1978 332.16Z" fill="#63B3EA"/>
                    <path d="M93.2201 85.6869C93.2201 85.6869 94.7409 100.818 106.738 107.375C118.736 113.932 130.057 108.216 130.057 108.216L128.705 98.4645C128.705 98.4645 135.802 105.021 137.83 105.19C140.027 105.358 138.337 103.676 138.337 103.676C138.337 103.676 144.42 108.384 142.561 106.871C140.872 105.358 147.631 106.703 147.631 106.703C147.631 106.703 149.659 104.685 151.855 104.517C153.207 104.349 152.362 98.1283 152.362 98.1283C152.362 98.1283 140.365 101.827 139.689 95.9426C139.013 91.2351 143.237 91.235 143.237 91.235C143.237 91.235 140.027 96.6151 140.872 100.314C141.21 101.827 140.703 103.676 140.703 103.676C140.703 103.676 156.756 84.1738 137.323 75.7674C130.057 72.573 133.944 59.6273 131.578 50.3803C129.043 40.2927 120.594 27.347 115.018 24.8251C110.794 22.9757 103.866 24.1526 97.6135 30.2051C91.3614 36.2577 86.799 47.1859 88.1508 57.4416C89.5026 67.6974 92.8822 74.5905 93.896 77.1124C94.9099 79.6343 92.8822 79.8025 91.3614 78.9618C89.8406 78.1212 88.6578 76.2718 88.6578 76.2718C88.6578 76.2718 90.5165 80.9793 93.2201 82.3244C96.2617 83.8375 97.6135 82.4925 97.6135 82.4925C97.6135 82.4925 97.7825 84.6781 95.4168 84.51C93.0512 84.3419 89.1647 80.6431 89.1647 80.6431L93.2201 85.6869Z" fill="#1D5073"/>
                    <path d="M63.3112 192.784C63.3112 192.784 73.1119 197.323 83.5884 195.81C94.065 194.297 107.076 197.659 115.356 200.349C123.636 203.039 128.198 204.889 128.198 204.889L147.293 132.762L140.534 105.358L131.916 91.4032C131.916 91.4032 131.071 102.836 127.016 104.685C122.791 106.535 107.245 107.375 100.655 96.7832C94.065 86.1913 93.896 83.5013 93.896 83.5013L88.6578 81.6519L81.3917 93.7569L65.1699 154.787C65.1699 154.787 64.663 183.2 62.8043 187.403C60.9455 191.607 63.3112 192.784 63.3112 192.784Z" fill="#1299F5"/>
                    <path d="M74.9707 208.083C74.9707 208.083 78.8572 215.313 79.871 219.348C80.8849 223.383 79.871 228.426 80.378 230.948C80.8849 233.47 81.5608 235.32 80.8849 235.992C80.378 236.665 80.7159 240.027 79.871 241.036C79.0261 241.877 77.6743 243.222 76.6605 238.514C75.6466 233.638 75.8156 230.78 75.8156 230.78C75.8156 230.78 75.4776 239.187 74.9707 241.204C74.6327 243.222 72.436 243.222 71.7601 240.532C71.2532 237.841 71.4222 238.682 71.4222 238.682C71.4222 238.682 72.2671 240.532 69.2255 239.355C68.0426 238.85 67.0288 234.983 67.0288 234.983C67.0288 234.983 64.3251 238.178 63.3113 233.638C62.2974 229.099 62.9733 218.171 62.8043 215.481C62.6354 212.791 62.8043 205.561 61.1146 196.65C59.4248 187.74 56.5522 173.785 57.0591 162.521C57.3971 151.256 60.4387 135.284 60.7766 130.745C61.1146 126.205 59.7628 121.834 59.4248 116.622C59.0868 111.41 57.904 101.659 61.1146 98.2964C64.4941 94.9339 66.1839 95.2701 70.2393 93.757C74.2948 92.2439 74.9707 90.3945 76.4915 88.377C78.0123 86.3595 81.8987 82.3244 85.4473 81.9881C88.9958 81.82 90.1786 82.8288 91.3615 86.6957C92.5443 90.5626 91.8684 95.6064 89.8407 100.314C87.644 105.022 84.0955 115.445 83.5885 117.463C83.0816 119.48 83.4195 118.303 83.4195 118.303C83.4195 118.303 84.6024 119.144 84.2644 120.825C83.9265 122.339 82.5747 122.339 82.5747 122.339L82.2367 123.684C82.2367 123.684 84.6024 125.533 83.9265 126.71C83.4195 127.887 81.3918 127.887 81.3918 127.887C81.3918 127.887 79.871 129.4 78.0123 137.134C76.3225 144.868 72.0981 153.274 72.0981 156.804C72.0981 160.503 73.2809 173.113 72.943 185.722C72.605 198.332 74.2948 202.871 74.4638 204.721C74.9707 206.906 74.9707 208.083 74.9707 208.083Z" fill="#1D5073"/>
                    <path d="M134.619 368.14C134.619 368.14 130.564 375.537 126.677 378.732C122.791 381.926 114.342 386.97 117.215 392.182C120.087 397.394 125.495 401.26 130.057 397.562C134.788 393.863 142.392 384.616 147.462 383.439C152.531 382.262 156.08 379.572 154.897 370.998C153.883 362.591 134.619 368.14 134.619 368.14Z" fill="#3593D3"/>
                    <path d="M175.343 384.112C175.343 384.112 177.371 390.837 176.526 397.057C175.681 403.11 175.343 412.021 180.244 412.525C185.144 413.029 196.465 414.542 197.31 407.145C198.155 399.747 195.621 398.066 194.945 386.465C194.438 374.865 187.341 372.175 187.341 372.175L175.343 384.112Z" fill="#3593D3"/>
                    <path d="M129.55 373.856C129.55 373.856 133.606 371.67 136.985 375.201C140.365 378.9 145.941 383.103 145.941 383.103C145.941 383.103 155.573 376.041 156.925 374.528C158.277 373.015 156.418 362.928 155.911 350.486C155.573 338.045 156.756 319.047 157.094 306.941C157.432 295.005 158.784 273.821 158.615 267.6C158.446 261.211 158.108 253.477 158.108 253.477C158.108 253.477 161.825 274.997 164.191 286.934C166.556 298.871 162.501 318.206 164.529 328.63C166.725 339.054 174.836 363.936 173.316 370.493C171.795 377.05 172.471 388.315 174.329 388.651C176.019 388.819 176.357 390.669 176.357 390.669C176.357 390.669 181.595 384.952 188.355 386.297C194.945 387.642 195.958 389.324 195.958 389.324C195.958 389.324 200.183 383.439 199.507 376.378C198.662 369.316 198.493 360.742 198.493 351.159C198.493 341.576 198.831 315.18 196.634 301.393C194.438 287.607 194.438 266.087 195.79 258.857C197.141 251.628 197.648 221.029 196.296 203.376C194.945 185.722 191.565 168.741 191.565 168.741L130.564 181.183C130.564 181.183 126.509 200.013 126.002 208.083C125.664 216.321 123.298 233.302 124.819 245.239C126.171 257.176 125.157 274.661 125.664 288.784C126.171 302.906 126.171 323.922 127.523 340.399C128.706 357.043 129.55 373.856 129.55 373.856Z" fill="#18659A"/>
                    <path d="M125.495 201.694C125.495 201.694 137.154 205.729 150.334 204.889C163.514 204.048 184.13 199.677 189.537 199.509C194.775 199.34 201.703 199.34 201.703 199.34C201.703 199.34 196.296 173.281 196.465 166.051C196.634 158.822 191.565 140.16 193.592 133.267C195.62 126.205 207.955 116.958 207.955 116.958L214.884 111.747C214.884 111.747 210.321 90.3945 207.449 83.5013C204.576 76.44 204.576 65.848 197.479 61.1404C190.382 56.4329 183.454 57.2736 179.06 56.4329C174.836 55.5923 171.794 53.2385 171.794 53.2385C171.794 53.2385 165.711 55.4241 160.98 57.7779C156.248 59.9636 151.179 66.3524 146.279 67.5293C141.378 68.7062 138.675 65.5117 138.675 65.5117L133.268 66.5205C133.268 66.5205 132.761 71.3962 135.295 76.1037C136.647 78.7937 138.506 77.9531 138.506 77.9531C138.506 77.9531 135.971 80.8113 133.099 77.9531C132.254 77.2806 131.747 74.9268 131.747 74.9268C131.747 74.9268 132.254 80.8113 135.126 83.165C136.816 84.51 138.506 83.3332 138.506 83.3332C138.506 83.3332 134.45 86.3594 131.409 82.9969C131.071 82.6606 131.071 82.3244 131.071 82.3244C131.071 82.3244 132.254 86.6957 130.902 89.5538C129.55 92.5801 127.522 92.9164 127.522 92.9164C127.522 92.9164 129.719 90.0582 129.212 86.5276C128.874 83.165 128.367 82.6607 128.367 82.6607C128.367 82.6607 125.664 90.0582 127.015 94.5976C128.367 99.137 131.24 108.384 131.578 112.083C131.747 115.782 136.309 125.029 137.661 133.099C139.013 141.337 135.971 149.239 133.775 155.291C131.578 161.344 128.367 175.635 127.522 183.368C126.34 190.598 125.495 201.694 125.495 201.694Z" fill="#1A78B8"/>
                    <path d="M195.282 123.011C195.282 123.011 196.803 109.225 203.731 107.88C210.659 106.535 213.701 110.401 213.701 110.401C213.701 110.401 214.039 126.037 215.898 131.417C217.587 136.797 217.08 146.549 216.067 153.106C215.053 159.663 210.659 180.342 209.139 189.757C207.787 199.34 206.435 201.526 206.435 204.889C206.435 208.251 207.449 217.498 207.956 219.348C208.463 221.197 207.956 223.719 207.787 225.736C207.618 227.754 206.266 230.276 204.407 231.621C202.717 232.966 200.69 233.47 200.69 233.47C200.69 233.47 199.169 235.488 197.817 235.488C196.465 235.488 195.789 234.983 195.789 234.983C195.789 234.983 194.438 236.16 193.086 236.496C191.734 237.001 190.889 236.496 190.889 236.496C190.889 236.496 188.861 239.018 188.016 237.337C187.003 235.824 188.016 233.302 188.016 233.302C188.016 233.302 186.665 226.913 186.665 223.046C186.665 219.179 186.834 216.994 189.368 210.773C191.903 204.72 196.296 199.004 196.296 194.297C196.296 189.589 198.324 168.741 198.662 163.866C199 159.158 198.324 161.008 198.324 161.008C198.324 161.008 197.648 161.848 195.451 164.034C193.762 165.547 191.227 164.202 192.579 162.689C194.1 160.839 196.296 159.663 195.62 159.494C194.775 159.158 193.255 158.99 191.396 159.158C189.537 159.326 186.327 159.831 187.171 157.309C187.678 155.628 191.058 155.796 192.917 155.459C194.606 155.291 195.282 154.787 195.282 154.787C195.282 154.787 191.734 154.114 189.199 154.787C186.665 155.459 184.806 155.628 184.468 154.114C184.13 152.601 187.847 151.592 189.875 151.256C192.072 151.088 194.606 149.575 194.606 149.575C194.606 149.575 190.213 149.071 188.861 149.407C187.171 149.743 184.975 150.92 184.637 148.902C184.13 146.717 187.171 146.381 189.537 145.708C191.903 145.036 193.424 145.036 193.424 145.036C193.424 145.036 191.903 141.337 192.41 139.656C192.917 137.974 194.606 137.47 194.775 138.479C194.944 139.655 195.958 143.018 196.803 143.859C197.648 144.699 200.521 149.239 200.521 148.062C200.521 147.389 200.521 148.062 200.521 148.062C200.521 148.062 201.028 142.346 200.859 139.151C200.69 135.957 198.493 130.577 196.972 127.382C195.451 124.188 195.282 123.011 195.282 123.011Z" fill="#3593D3"/>
                    <path d="M168.753 54.2472C168.753 54.2472 160.135 54.2472 158.614 45.6728C157.093 37.0983 159.966 32.727 158.107 26.0019C156.08 19.2769 153.883 6.33115 149.321 3.64113C144.758 0.951104 136.478 -1.06645 131.916 0.614821C127.354 2.46421 124.819 1.1192 120.425 5.65862C115.863 10.198 112.99 18.1 114.004 23.1438C115.018 28.1876 117.722 33.3995 120.087 36.5939C122.453 39.7883 124.312 50.8847 127.354 53.7428C130.226 56.7691 134.788 60.2998 135.971 62.3173C137.154 64.3348 140.872 63.9985 140.027 66.016C139.182 67.8654 142.561 67.8654 142.561 67.8654C142.561 67.8654 147.969 67.8655 153.714 64.1667C159.459 60.4679 166.218 56.2647 167.232 55.9285C167.908 55.5922 168.753 54.2472 168.753 54.2472Z" fill="#3593D3"/>
                    <path d="M61.8612 412.584C61.1727 412.3 60.8517 411.369 60.1758 411.205C58.2588 411.094 56.2768 411.206 54.4878 410.375C53.0531 409.915 51.5633 409.298 50.7457 407.943C49.8155 407.288 49.7351 404.811 48.4175 405.421C46.6989 406.309 44.709 406.905 42.7884 406.346C40.2249 405.719 37.7432 404.708 35.4454 403.411C33.1206 401.944 31.0428 400.11 28.6952 398.682C27.1853 398.418 27.6646 400.716 27.1932 401.635C26.737 402.996 25.5619 403.978 25.2764 405.422C24.4995 406.289 23.1818 406.697 22.025 406.588C20.745 406.245 19.8047 407.679 18.5663 407.95C16.7716 408.863 14.6792 408.885 12.7337 408.584C11.258 408.114 10.199 406.896 8.78455 406.305C7.27591 404.854 6.51535 402.867 5.65441 401.002C5.08627 401.525 4.36998 402.384 3.54732 401.795C2.50357 401.152 3.50555 399.676 2.4684 399.073C1.86161 398.118 1.03807 397.305 0.531161 396.223C-0.286596 395.377 0.10922 394.116 0.0166413 393.051C0.0476135 392.442 -0.0439775 391.794 0.0599066 391.208C0.934116 389.789 2.11749 388.608 3.19653 387.354C3.88642 386.148 4.41603 384.862 4.98039 383.604C5.7777 382.287 6.31196 380.473 7.92086 379.942C9.80685 379.588 11.2171 381.5 11.6687 383.117C11.9168 383.847 12.3545 384.483 12.7806 385.116C13.6364 381.808 14.6593 378.531 16.1626 375.456C16.7297 374.067 17.016 372.552 17.9326 371.322C18.9452 369.582 20.5424 368.355 22.0429 367.072C24.8882 364.447 28.7183 363.459 32.2558 362.148C33.6887 361.685 35.1034 361.116 36.5886 360.848C37.2379 360.863 37.7043 361.647 38.3277 361.133C43.3214 359.197 48.3521 357.33 53.1922 355.03C55.578 353.681 57.7532 351.961 60.2123 350.748C61.3354 350.016 63.5674 350.493 63.5381 348.664C63.9074 347.446 63.4395 346.229 62.5932 345.431C61.6705 343.52 60.6995 341.579 60.4849 339.432C60.1067 336.118 60.4623 332.692 61.5394 329.536C62.1381 328.311 61.6785 326.859 62.5984 325.777C63.5572 323.979 64.8507 322.136 66.7816 321.313C69.2111 320.572 71.0172 318.489 73.5417 317.961C76.3138 316.925 79.323 316.959 82.2372 317.031C83.6903 317.43 85.2843 317.319 86.6477 318.003C88.174 318.712 89.6837 319.529 91.3408 319.883C92.4501 320.281 93.8641 320.613 94.8067 321.536C96.1826 322.685 97.7292 323.65 99.0195 324.886C100.385 326.265 101.256 328.015 102.329 329.616C103.109 330.721 103.691 331.936 103.877 333.266C104.023 334.911 103.88 336.562 103.376 338.138C103.098 339.5 102.483 340.825 102.494 342.224C102.982 342.996 101.151 344.135 102.634 344.6C103.36 345.46 101.02 345.163 101.516 346.378C100.645 347.646 101.898 348.753 102.548 349.761C103.641 351.033 102.461 352.078 101.291 352.515C100.653 353.66 100.317 355.268 98.6236 355.366C97.3932 355.653 95.4816 355.863 96.2838 357.628C96.9134 358.302 97.5935 360.036 96.2146 360.207C95.3753 360.047 94.2776 360.068 94.0132 361.102C93.1911 362.478 94.5077 363.57 95.0922 364.704C96.3079 366.824 96.4054 369.356 97.5498 371.502C99.2818 374.897 100.807 378.447 103.107 381.508C104.315 382.95 106.019 383.974 106.808 385.755C108.224 388.485 109.057 391.452 109.983 394.369C110.854 396.58 111.539 398.961 113.073 400.821C114.022 402.015 115.697 401.87 117.005 402.4C118.278 402.857 120.808 405.035 119.745 405.62C119.262 405.886 118.861 405.308 118.575 405.575C117.953 406.154 118.912 406.053 118.396 406.479C117.838 406.939 115.507 406.508 114.034 406.738C112.122 406.696 110.352 405.817 108.434 405.779C107.481 405.678 106.53 405.554 105.58 405.43C104.839 406.344 104.136 407.496 102.834 407.575C102.015 408.049 100.429 407.185 101.627 406.438C102.77 405.217 101.223 404.004 101.337 402.694C101.156 402.097 102.06 401.359 101.43 400.959C99.5581 399.331 98.2222 397.208 96.4728 395.46C95.0504 393.983 94.09 392.16 93.2663 390.302C92.6157 389.292 91.3403 388.855 90.7411 387.774C88.677 384.396 88.7121 380.185 86.7232 376.765C86.2755 376.027 85.9005 374.439 84.9619 375.65C81.9273 377.695 79.8254 380.92 76.5026 382.562C74.6034 383.554 72.6083 384.425 71.0173 385.903C68.8176 387.64 66.789 389.637 64.3418 391.029C62.6819 392.001 60.839 392.56 59.0183 393.129C59.1629 395.23 59.6209 397.297 59.9385 399.378L62.0833 403.689C65.1759 403.634 68.2499 404.171 71.2671 404.798C72.5252 405.246 73.9896 405.968 74.4793 407.287C74.9708 408.345 75.895 410.198 74.0741 410.332C73.0652 411.835 71.7325 409.828 70.8755 409.172C69.7764 409.045 71.7139 411.169 70.1833 411.385C68.748 411.713 67.9618 410.011 66.6385 410.143C65.603 410.239 64.612 410.567 63.6142 410.842C63.5869 411.581 64.0128 412.796 63.0134 412.998C62.5915 413.025 62.2011 412.808 61.8601 412.583L61.8612 412.584Z" fill="#1A689D"/>
                    </svg>
                </div>
                <div class="manikin-menu-buttons">
                    <div class="manikin-menu-button head manikin-animate" data-show="#manikin-head">Head</div>
                    <div class="manikin-menu-button chest manikin-animate" data-show="#manikin-chest">Chest</div>
                    <div class="manikin-menu-button abdomen manikin-animate" data-show="#manikin-abdomen">Abdomen</div>
                    <div class="manikin-menu-button pelvis manikin-animate" data-show="#manikin-pelvis">Pelvis</div>
                    <div class="manikin-menu-button legs manikin-animate" data-show="#manikin-legs">Legs</div>
                    <div class="manikin-menu-button feet manikin-animate" data-show="#manikin-feet">Feet</div>
                    <div class="manikin-menu-button mentalhealth manikin-animate" data-show="#manikin-mentalhealth">Mental Health</div>
                    <div class="manikin-menu-button skin manikin-animate" data-show="#manikin-skin">Skin</div>
                    <div class="manikin-menu-button general manikin-animate" data-show="#manikin-general">General</div>
                    <div class="manikin-menu-button infanthealth manikin-animate" data-show="#manikin-infanthealth">Infant Health</div>
                </div>
            </div>
            <div class="manikin-menu-list">

                <div class="manikin-menu-items backitem manikin-animate">
                    <div class="manikin-menu-item">
                        <a href="#">
                            <span class="close-icon"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" class="svg-inline--fa fa-times fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path></svg></span>
                            <span class="close-text">Close Menu</span>
                        </a>
                    </div>
                </div>';

                $html .='<ul id="manikin-head" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['Head'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-chest" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['Chest'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-abdomen" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['Abdomen'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-pelvis" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['Pelvis'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-legs" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['Legs'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-feet" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['Feet'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-skin" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['Skin'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-general" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['General'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-mentalhealth" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['mentalhealth'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';

                $html .='<ul id="manikin-infanthealth" class="manikin-menu-items manikin-animate">';
                    foreach($manikin_data['infant'] as $data):
                    $html .='<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
                    endforeach;
                $html .='</ul>';


        $html .='
            </div>
        </div>';

        $return['html'] = $html;

        return $return;
    }


    public function get_brochures_by_title($search){
        $redirect_url = "http://client.local/";
        $private_url = "http://client.local/";
        $return = array();
        $brochures = Post::where('post_title','like','%'.$search.'%')->get();
        //->orWhere('desc','like','%'.$search.'%')
        
       // print_r($brochures);
        if($brochures !== null):

            foreach($brochures as $b):
        // print_r($b);

            if($b->ID):

                    $brochuresarr = array();
                    $brochuresarr['ID'] = $b->ID;
                    $brochuresarr['post_title'] = $b->title;
                    $brochuresarr['desc'] = $b->desc;
                    $brochuresarr['categories'] = $b->categories;
                    $brochuresarr['image'] = $b->image;
                    $brochuresarr['created_at'] = $b->created_at;
                    $brochuresarr['updated_at'] = $b->updated_at;
                    $brochure_id = $b->ID;
                    //dd($brochuresarr['updated_at']);
                    $brochuresarr['redirect_url'] = $redirect_url;
                    $brochuresarr['private_url'] = $private_url;

                    //get all brochure field values
                    // $brochuresarr['brochure_fields'] = array();
                    // $bfvs = BrochureFieldValues::where('brochure_id','=', $brochure_id)->get();
                    // if($bfvs !== null):
                    //     $dataarr = array();
                    //     foreach($bfvs as $fvalue):
                    //         $field = BrochureField::find($fvalue->field_id);
                    //         if($field !== null):
                    //             $dataarr[str_slug($field->title)] = $fvalue->value;
                    //         endif;
                    //     endforeach;
                    //     $brochurefields = $dataarr;
                    //     $brochuresarr['brochure_fields'] = $dataarr;
                    // endif;

                    //get all segments
                    // $bs = BrochureSegments::where('brochure_id','=', $brochure_id)->get();
                    // if($bs !== null):
                    //     $brochuresegments = $bs;
                    //     $brochuresarr['brochure_segments'] = $bs;
                    // endif;

                    // build html brochure
                    //$brochuresarr['html'] = $this->getBrochureHTML($b, $brochurefields, $brochuresegments);

                    $return[] = $brochuresarr;

                endif;

            endforeach;


        //else:
            //$return = array('Error' => "No Brochures found.");
        endif;

        return $return;
    }


    public function get_brochures_by_icd10($icd10){
        $redirect_url = $this->getUserCompanyRedirectUrl();
        $return = array();

        //get brochure id by icd10 code.
        //$bfvs = Post::where('icd10','like','%'.$icd10.'%')->get();
        $bfvs = Post::published()->hasMeta('icd10', $icd10)->get();

       
        foreach($bfvs as $bfv){

            if($this->can_access_brochure($bfv->brochure_id)):

                $barray = array();
                $brochure_id = $bfv->brochure_id;

                //get brochure details
                $b = Brochure::find($brochure_id);
                if($b !== null):

                    $barray['id'] = $brochure_id;
                    $barray['title'] = $b->title;
                    $barray['desc'] = $b->desc;
                    $barray['categories'] = $b->categories;
                    $barray['image'] = $b->image;
                    $barray['created_at'] = $b->created_at;
                    $barray['updated_at'] = $b->updated_at;
                    $barray['redirect_url'] = $redirect_url;

                    //get all brochure field values
                    $barray['brochure_fields'] = array();
                    $bfvs = BrochureFieldValues::where('brochure_id','=', $brochure_id)->get();
                    if($bfvs !== null):
                        $dataarr = array();
                        foreach($bfvs as $fvalue):
                            $field = BrochureField::find($fvalue->field_id);
                            $dataarr[str_slug($field->title)] = $fvalue->value;
                        endforeach;
                        $barray['brochure_fields'] = $dataarr;
                    endif;

                    //get all segments
                    $bs = BrochureSegments::where('brochure_id','=', $brochure_id)->get();
                    if($bs !== null):
                        $brochuresegments = $bs;
                        $barray['brochure_segments'] = $bs;
                    endif;


                    $return[] = $barray;

                    //$this->trackRequest('brochure-search/'.$icd10.'/'.$brochure_id);

                    //$searchcheck = true;

                //else:
                    //$this->trackRequest('brochure-search/error');
                    //$barray = array('Error' => "No Brochure found for ID'".$brochure_id."' ");
                endif;

            endif;    
            
        }

        return $return;
    }




        


    

    
    public function getUserCompanyRedirectUrl(){
        $return = false;
        if(isset(\auth::user()->id)):
            $user_id = \auth::user()->id;
            $usersettings = UserSettings::where('user_id', $user_id)->first();
            $company_name = $usersettings->company;
            if($company_name ==''){
                $company = Company::find(2);
                $return = $company->redirect;
            } else {
                $company = Company::where('name', $company_name)->first();
                $return = $company->redirect;
            }
        endif;
        return $return;
    }

    public function getUserCompanyPrivateUrl(){
        $return = false;
        if(isset(\auth::user()->id)):
            $user_id = \auth::user()->id;
            $usersettings = UserSettings::where('user_id', $user_id)->first();
            $company_name = $usersettings->company;
            if($company_name ==''){
                $company = Company::find(2);
                $return = $company->private;
            } else {
                $company = Company::where('name', $company_name)->first();
                $return = $company->private;
            }
        endif;
        return $return;
    }



        // search brochures
    public function brochuresearch(Request $request){

        $searchcheck = false;

        $return = array();

        //$icd10 = (isset($request->icd10))? $request->icd10: false;
        $search = (isset($request->search))? $request->search: false;
        //$brochure_id = (isset($request->brochure_id))? $request->brochure_id: false;
        $category_id = (isset($request->category_id))? $request->category_id: false;



        //$redirect_url = $this->getUserCompanyRedirectUrl();
        $redirect_url = "https://client.local/home";
        if($search):


               


            $brochures = $this->get_brochures_by_title($search);
            if(!empty($brochures)){
                $return = array_merge($return, $brochures);
            } 
          else {

            //     $icd10brochures = $this->get_brochures_by_icd10($search);
            //     if(!empty($icd10brochures)){
            //         $return = array_merge($return, $icd10brochures);
            //     }
                
                $categorybrochures = $this->get_brochures_by_category($search);

             
                if(!empty($categorybrochures)){
                    $return = array_merge($return, $categorybrochures);
                }

         }

            //$this->trackRequest('brochure-search/'.$search);

            if(empty($return)){
                $searchcheck = false;
            } else {
                $searchcheck = true;
            }

        endif;


        

        if($searchcheck == false){
            //$this->trackRequest('brochure-search/error');
            $return = array('Error' => "No search results found.");
        }

        return $return;
    
    }

    










     public function brochures() {


        $bcs = Taxonomy::where('taxonomy','category')->get();


        $barr = array();
               $brochures = Post::type('medicalbrochure')->status('publish')->get()->toArray();

         //$brochures = Brochure::whereNotIn('id', $postscript_bids)->get()->toArray();
        //determine prescript field id
        // $bf = BrochureField::where('title','Postscript')->first();
        // $postscript_field_id = $bf->id;

        // $postscript_bids = BrochureFieldValues::select('brochure_id')->where([
        //     ['value','Yes'],
        //     ['field_id', $postscript_field_id]
        // ])->get();

        // $userSettings = UserSettings::where('user_id', Auth::user()->id)->first();
        // if( $userSettings->brochures_allowed === NULL ):
        //     $brochures = Brochure::whereNotIn('id', $postscript_bids)->get()->toArray();
        // else:
        //     $bids = explode(',', $userSettings->brochures_allowed);
        //     $brochures = Brochure::whereIn('id', $bids)->get()->toArray();
        // endif;

        //get brochure link url
        // $redirect_url ='';
        // if($userSettings->company !=''):
        //     $company = Company::where('name', $userSettings->company)->first();
        //     $redirect_url = $company->redirect;
        // endif;

         //search for brochures that have yes postscript
        foreach($brochures as $brochure){


            //set brochure categories
            // $bcatsarr = array();
            // $catids = array_map('intval', explode(',', substr($brochure->category,0,-1)));
            // $bcats = Taxonomy::find($catids);
            // foreach($bcats as $bcats){
            //     $bcatsarr[] = $bcats->title;
            // }
           // $brochure['categories'] = $bcatsarr;


            //save brochure to collection of postscript only brochures
            // $brochure['desc'] = strip_tags($brochure['desc']);
            // $brochure['type'] ='prescript';

            // $brochure['link'] = ($redirect_url !='')? $redirect_url.'/'.ApiTracking::sanitize($brochure['title']): false;

            $barr[] = $brochure;


        }

        return $barr;
    }

public function findnhsmeds(Request $request) {


        $return = false;
        $brochure_id = (isset($request->brochure_id))? $request->brochure_id: false;



         
        if($brochure_id):
            //if($this->can_access_brochure($brochure_id)):
                $brochure = Medicines::find($brochure_id);
                
                // print_r($brochure); 

                //     die(); 

                // if($brochure === null):

                    //$this->trackRequest('brochure/'.$brochure_id.'/error');
                    $return = array('Error' => "Brochure not found. Please try a different brochure id.");

                // else:
                    //$this->trackRequest('brochure/'.$brochure_id);

                    $return = array();
                    $return['id'] = $brochure->ID;


                    
                    $return['title'] = $brochure->post_title;


                    $return['desc'] = strip_tags($brochure->desc);
                    $return['excerpt'] = $brochure->excerpt; 
                    $return['categories'] = $brochure->categories;
                    $return['image'] = $brochure->image;

                    $return['type'] = $brochure->brochure_type;
                    $return['password'] = $brochure->password;
                    $return['icd10'] = $brochure->icd10;
                    $return['slug'] = $brochure->url;
                    $return['created_at'] = $brochure->created_at;
                    $return['updated_at'] = $brochure->updated_at;
         
        endif;
        return $return;
    }

public function findnhsbrochure(Request $request) {


        $return = false;
        $brochure_id = (isset($request->brochure_id))? $request->brochure_id: false;



         
        if($brochure_id):
            //if($this->can_access_brochure($brochure_id)):
                $brochure = Nhs::find($brochure_id);
                
                // print_r($brochure); 

                //     die(); 

                // if($brochure === null):

                    //$this->trackRequest('brochure/'.$brochure_id.'/error');
                    $return = array('Error' => "Brochure not found. Please try a different brochure id.");

                // else:
                    //$this->trackRequest('brochure/'.$brochure_id);

                    $return = array();
                    $return['id'] = $brochure->ID;


                    
                    $return['title'] = $brochure->post_title;


                    $return['desc'] = strip_tags($brochure->desc);
                    $return['excerpt'] = $brochure->excerpt; 
                    $return['categories'] = $brochure->categories;
                    $return['image'] = $brochure->image;

                    $return['type'] = $brochure->brochure_type;
                    $return['password'] = $brochure->password;
                    $return['icd10'] = $brochure->icd10;
                    $return['slug'] = $brochure->url;
                    $return['created_at'] = $brochure->created_at;
                    $return['updated_at'] = $brochure->updated_at;
         
        endif;
        return $return;
    }


    // get specific brochure
    public function findbrochure(Request $request) {


        $return = false;
        $brochure_id = (isset($request->brochure_id))? $request->brochure_id: false;

        // print_r($brochure_id);
        // die();
        if($brochure_id):
            //if($this->can_access_brochure($brochure_id)):
                $brochure = Post::find($brochure_id);
                
                
                // if($brochure === null):

                    //$this->trackRequest('brochure/'.$brochure_id.'/error');
                    $return = array('Error' => "Brochure not found. Please try a different brochure id.");

                // else:
                    //$this->trackRequest('brochure/'.$brochure_id);

                    $return = array();
                    $return['id'] = $brochure->ID;

                    $return['title'] = $brochure->title;
                    $return['desc'] = strip_tags($brochure->desc);
                    $return['excerpt'] = $brochure->excerpt; 
                    $return['categories'] = $brochure->categories;
                    $return['image'] = $brochure->image;

                    $return['type'] = $brochure->acf->brochure_type;
                    $return['password'] = $brochure->acf->password;
                    $return['icd10'] = $brochure->acf->icd10;
                    $return['slug'] = $brochure->slug;
                    $return['created_at'] = $brochure->created_at;
                    $return['updated_at'] = $brochure->updated_at;
         
        endif;
        return $return;
    }



    // SMS brochures to recipient.
    public function smsbrochures(Request $request){

        


        $timestamp = time();


        $statuses = array(
            "ireq" => "success",
            "ires" => "pending",
            "ipod" => "pending",
            "hids" => "No hids were specified.",
        );

        


        $doctor_name = (isset($request->doctor_name))? $request->doctor_name: false;
        $doctor_diagnosis = (isset($request->doctor_diagnosis))? $request->doctor_diagnosis:'Medinformer Medical Information';
        //$doctor_email = (isset($request->doctor_email))? $request->doctor_email: false;
        $patient_number = (isset($request->msidn))? $request->msidn: false;

        //$pids = (isset($request->pids))? $request->pids: false;
        $hids = (isset($request->hids))? $request->hids: false;
        $statuses['hids'] = $hids;
        //$service_date = (isset($request->service_date))? $request->service_date: false;
        //$doctor_contact = (isset($request->doctor_contact))? $request->doctor_contact: false;
        //$text_signature = (isset($request->text_signature))? $request->text_signature: false;
        //$image_signature = (isset($request->image_signature))? $request->image_signature: false;

        $doctor_message = (isset($request->doctor_diagnosis))? $request->doctor_diagnosis:'';
        //$updated_msg = str_replace("{doctor_name}", $doctor_name, $doctor_message);

        //$updated_msg  ='Your doctor has selected the following medical health information to share with you on your medical condition.'."<BR><BR>";
        //$updated_msg .='Yours in good health'."<BR>";

        $subject = $doctor_diagnosis;



        // SMS body
        $bids ='';

        $body_msg  = $subject."\n";
        //$body_msg .= $updated_msg."\n";

        if($hids):
            $hids = str_replace(',',',', $hids);
            $hidsarr = explode(',', $hids);
            foreach($hidsarr as $hid):

                $brochure_id = false;

                $hid = Post::where('id','hid')->first();

                

                $bfv_hids = Post::where('id','hid')->get();
                foreach($bfv_hids as $bfv_hid){
                    $b = Brochure::find($bfv_hid->brochure_id);

                    if($b){
                        $brochure_id = $bfv_hid->brochure_id;
                    }
                }
                
                //print_r($bfv_hids);
                
                $postscript = "no";
                $bf_postscript = BrochureField::where('slug','postscript')->first();
                $bfv_postscript = BrochureFieldValues::where([
                    ['field_id', $bf_postscript->id],
                    ['brochure_id', $brochure_id]
                ])->first();
                if($bfv_postscript):   
                    $postscript = $bfv_postscript->value;
                endif;
 
                $b = Brochure::find($brochure_id);
                if(isset($b) && $b !== NULL):
                    $trackurl  = route('track.sms.brochure', ['timestamp' => $timestamp,'brochureid' => $b->id ] );
                    $bitlyobj = json_decode(
                        file_get_contents(
                            "http://api.bit.ly/v3/shorten?login=o_59ur33ucle&apiKey=R_e64642d5e5bd459dad58b1bfe1e38e1a&longUrl=".urlencode($trackurl)."&format=json"
                        )
                    )->data->url;
                    $body_msg .= $b->title.": "; //'<div>- <a href="'.$trackurl.'" target="_blank">'.$b->title.'</a></div>';
                    $body_msg .= $bitlyobj."\n"."\n"; //'<div>- <a href="'.$trackurl.'" target="_blank">'.$b->title.'</a></div>';
                    $bids .= $b->id.',';
                endif;


                /*$bfvs = BrochureFieldValues::where('value', $hid)->get();
                foreach($bfvs as $bfv):
                    $b = Brochure::find($bfv->brochure_id);
                    if(isset($b) && $b !== NULL):
                        $redirect_url = $this->getUserCompanyRedirectUrl();
                        $brochure_url = $redirect_url.'/'.str_slug($b->title);
                        $trackurl  = route('track.sms.brochure', ['timestamp' => $timestamp,'brochureid' => $bfv->brochure_id] );
                        $bitlyobj = json_decode(
                            file_get_contents(
                                "http://api.bit.ly/v3/shorten?login=o_59ur33ucle&apiKey=R_e64642d5e5bd459dad58b1bfe1e38e1a&longUrl=".urlencode($trackurl)."&format=json"
                            )
                        )->data->url;

                        $body_msg .= $b->title.": "; //'<div>- <a href="'.$trackurl.'" target="_blank">'.$b->title.'</a></div>';
                        $body_msg .= $bitlyobj."\n"."\n"; //'<div>- <a href="'.$trackurl.'" target="_blank">'.$b->title.'</a></div>';
                        $bids .= $b->id.',';
                    endif;
                endforeach;*/
            endforeach;
        else:
            $statuses['hids'] ='No hids were specified.';
        endif;
        $bids = substr($bids, 0, -1);
        
        $patient_number_firstchar = substr($patient_number,0, 1);
        if($patient_number_firstchar =='0'){
            $patient_number ='+27'.substr($patient_number, 1, strlen($patient_number));
        }
         \Log::info("SENDING SMS");
        \Log::info($request->all());
        $postscriptValue = (isset($request->postscript))? $request->postscript :'No';
        $postscriptPasscode = "Yes";
        if($postscriptValue === "Yes"){
            $body_msg .= "Password is : ".$postscriptPasscode."\n"."\n";
        }

        $body ='';
        $body ='<XML>
                <SENDBATCH delivery_report="1" status_report="1">
                    <SMSLIST> 
                        <SMS_SEND uid="'.$timestamp.'" user="43587887" password="jNXqa6" to="'.$patient_number.'">'.$body_msg.'</SMS_SEND>
                    </SMSLIST>
                </SENDBATCH>
                </XML>';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'http://sg1.channelmobile.co.za');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        // execute curl setup.
        $return = curl_exec($ch);

        // close curl connection.
        curl_close($ch);


        //$result = $this->sendSMS('http://sg1.channelmobile.co.za', $post);
        $statuses["ires"] = $return;
        $statuses["ipod"] = "success";

        $sms = SMS::create($request->all());

        dd($sms);

        $this->trackRequest('brochure-sms/'.$patient_number.'/'.$bids.'/'.$timestamp);

        return array(
          'xmlsent' => $body,
          'statuses' => $statuses
        );

    }

     public function trackRequest($endpoint_requested){
        //Log::debug(Auth::user()->name);

        $apitracking = new ApiTracking;
        $apitracking->user_id = \auth::user()->id;
        $apitracking->user_name = \auth::user()->name;
        $apitracking->endpoint_requested = $endpoint_requested;
        $apitracking->save();
    }

       // brochures email to recipient.
    public function emailbrochures(Request $request) {

        $emailstamp = time();

        $statuses = array(
            "ireq" => "success",
            "ires" => "pending",
            "ipre" => "pending",
            "ipod" => "pending",
            "emailsig" => "null",
            "doctor_email" => "null",
            "doctor_contact" => "null",
            "ican" => "null",
        );
        \Log::info("sending email");
        \Log::info($request->all());
        $email_title = (isset($request->email_title))? $request->email_title: false;
        $doctor_name = (isset($request->doctor_name))? $request->doctor_name: false;
        $doctor_email = (isset($request->doctor_email))? $request->doctor_email: false;
        $patient_email = (isset($request->patient_email))? $request->patient_email: false;
        $doctor_message = (isset($request->doctor_diagnosis))? str_replace("\n ","</br> </br>",$request->doctor_diagnosis): false;
        $type = (isset($request->type))? $request->type:'Dr.';
        $newMessage =explode(".",$doctor_message);
        \Log::info($doctor_message);
         \Log::info($newMessage);
        $pids = (isset($request->pids))? $request->pids: false;
        $hids = (isset($request->hids))? $request->hids: false;
        $service_date = (isset($request->service_date))? $request->service_date: false;
        $doctor_contact = (isset($request->doctor_contact))? $request->doctor_contact: false;
        $text_signature = (isset($request->text_signature))? $request->text_signature: false;
        $image_signature = (isset($request->image_signature))? $request->image_signature: false;

        $updated_msg = str_replace("{doctor_name}", $doctor_name, $doctor_message);

        //$updated_msg  ='Your doctor has selected the following medical health information to share with you on your medical condition.'."<BR><BR>";
        //$updated_msg .='Yours in good health'."<BR>";
        $doctor_name_arr = explode(" ", $doctor_name);
        $from_name = $doctor_name; //$type.''.( isset($doctor_name_arr[0]) )? $doctor_name_arr[0]: $doctor_name;
        $from_email = $doctor_email;
        $subject = "Important health info from ".$from_name;  /*"Dr. Jone / Sister Mary.";*/


        $statuses['ires'] ='success';

        //dd($statuses);
        // Email body
        $body ='';
        /*if($email_title && $email_title !='' && $email_title != null):
        $body .='<h1>Hi'.$email_title.'</h1>';
        endif;*/
        foreach($newMessage as $key=>$msg){
            $size = (sizeof($newMessage)-1);
            if($key < $size){
                $body .='<p>'.$msg.'.</p>';
            }elseif($size === $key){
                $endingsms= explode("health",$msg);
                $body .='<p>'.$endingsms[0].',</p>';
//                $body .='<p>'.$endingsms[1].'.</p>';
            }
            
        }
        



        $bids ='';
        if($hids):
            
            $hids = str_replace(',',',', $hids);
            if( substr($hids, strlen($hids)-1, strlen($hids)) ==','){
                $hids = substr($hids, 0, -1);
            }
            //Log::debug(print_r($hids, true));
            $hidsarr = explode(',', $hids);
            

            foreach($hidsarr as $hid):

                //Log::debug(print_r($hid, true));

                $brochure_id = false;

                $bf_hid = BrochureField::where('slug','hid')->first();
                $bfv_hids = BrochureFieldValues::where([
                    ['field_id', $bf_hid->id],
                    ['value', $hid]
                ])->get();
                foreach($bfv_hids as $bfv_hid){
                    $b = Brochure::find($bfv_hid->brochure_id);
                    if($b){
                        $brochure_id = $bfv_hid->brochure_id;
                    }
                }
                
                $postscript = "no";
                $bf_postscript = BrochureField::where('slug','postscript')->first();
                $bfv_postscript = BrochureFieldValues::where([
                    ['field_id', $bf_postscript->id],
                    ['brochure_id', $brochure_id]
                ])->first();
                if($bfv_postscript):   
                    $postscript = $bfv_postscript->value;
                endif;
 
                $b = Brochure::find($brochure_id);
                if(isset($b->title)):
                    //$brochure_url = $redirect_url.'/'.str_slug($b->title);
                    $trackurl = route('track.email.brochure', ['emailstamp' => $emailstamp,'brochureid' => $brochure_id] );
                    $body .='<div>- <a href="'.$trackurl.'" target="_blank">'.$b->title.'</a></div>';
                    $bids .= $b->id.',';
                endif;


                /*foreach($bfvs as $bfv):
                    $b = Brochure::find($bfv->brochure_id);
                    if(isset($b->title)):
                        if($bfv)
                        $redirect_url = $this->getUserCompanyRedirectUrl();
                        $brochure_url = $redirect_url.'/'.str_slug($b->title);
                        $trackurl = route('track.email.brochure', ['emailstamp' => $emailstamp,'brochureid' => $bfv->brochure_id] );
                        $body .='<div>- <a href="'.$trackurl.'" target="_blank">'.$b->title.'</a></div>';
                        $bids .= $b->id.',';
                        endif;
                endforeach;*/

            endforeach;
        else:
            $statuses['hids'] ='No hids were specified.';
        endif;
        $bids = substr($bids, 0, -1);

        if($pids):

        else:
            $statuses['pids'] ='No pids were specified.';
        endif;

        $body .= "&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>";

        $body .= "<table width='100%' style='max-width:600px;' border='0'>";
        if( $text_signature && !in_array( strtolower($text_signature), array('','null')) ):
            $body .= "<tr>";
            $body .= "  <td text-align='left'>".$text_signature."</td>";
            $body .= "</tr>";
        elseif( $image_signature && !in_array(strtolower($image_signature), array('','null')) ):
            $body .= "<tr>";
            $body .= "  <td text-align='left'><img src='".$image_signature."'>'</td>";
            $body .= "</tr>";
            $statuses['emailsig'] ='success';
        else:
            $body .= "<tr>";
            $body .= "  <td text-align='left'>";
            $body .= "  <table style='font-size:12px;'>";

            if($doctor_name && !in_array( strtolower($doctor_name), array('','null')) ):
                $body .= "<tr><td style='color:rgb(77,184,71)!important; width:50px;'>Name:</td> <td>".$doctor_name."</td></tr>";
            endif;

            if($doctor_contact && !in_array( strtolower($doctor_contact), array('','null')) ):
                $body .= "<tr><td style='color:rgb(77,184,71)!important; width:50px;'>Contact:</td> <td>".$doctor_contact."</td></tr>";
                $statuses['doctor_contact'] = $doctor_contact;
            endif;

            if($doctor_email && !in_array( strtolower($doctor_email), array('','null')) ):
                $body .= "<tr><td style='color:rgb(77,184,71)!important; width:50px;'>Email:</td> <td>".$doctor_email."</td></tr>";
                $statuses['doctor_email'] = $doctor_email;
            endif;

            $body .= "  </table>";
            $body .= "  </td>";
            $body .= "</tr>";

        endif;
        $body .= "</table>";


        Mail::to($patient_email)->send(new FeedbackMail('production@medinformer.co.za', "Dehlia Dalrymple", $subject, $body));
        $statuses["ipod"] = "success";

        $this->trackRequest('brochure-email/'.$patient_email.'/'.$bids.'/'.$emailstamp);

        return array(
            //'request' => $request->all(),
          'statuses' => $statuses
        );


        /*Mail::to('hannesbrink@gmail.com')->send(
            new FeedbackMail(
              'production@medinformer.co.za', 
                "Dehlia Dalrymple", 
              'test emails', 
              'this is a test email. check check.'
            )
        );*/


    }


    public function sendSMS($endpoint, $post=false){

        $return = false;

        $authorization ='';

        // start curl setup
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if($post):
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

            //send brochure_id as array
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            //set content type as multipart/form-data for posting data to api.
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        else:
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        endif;

        // execute curl setup.
        $return = curl_exec($ch);

        // close curl connection.
        curl_close($ch);


        return $return;
    }


    public function sendSMSNhs($endpoint, $post=false){

        $return = false;

        $authorization ='';

        // start curl setup
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if($post):
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

            //send brochure_id as array
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

            //set content type as multipart/form-data for posting data to api.
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        else:
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        endif;

        // execute curl setup.
        $return = curl_exec($ch);

        // close curl connection.
        curl_close($ch);


        return $return;
    }

//}





}
