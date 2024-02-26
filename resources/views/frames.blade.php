@extends('layouts.app')
<style type="text/css">

</style>
@section('content')

@include('templates.complete_profile')
<div id='brochure-search-page' class='container-fluid mt-5 pt-5'>



                <form action='' method="post" id='searchbrochuresform'>
                    <div id='medclient-portfolios-search' class='medclient-search'>
                        <input type='hidden' name='page_author_id' value='Tapiwa Mavhunga'>
                        <input type='text' name='brochure_search' placeholder='Search by Keyword, ICD-10 code or health area.' value='<?php if(isset($_POST['brochure_search'])): echo $_POST['brochure_search']; endif; ?>' required>
                        <button type='submit' name='brochure_search_button' class='brochure_search_button' value='Search'>
                            <span class='button-text mc-animate'>Search</span>
                            <span class='button-loading mc-animate'>
                                <div class="ld ld-hourglass ld-spin"></div>
                            </span>
                        </button>

                        <div class='medclient-search-filters' style='display:none;'>
                            <div><input type='radio' name='search-filter' value='search' checked> Brochure Search</div>
                            <div><input type='radio' name='search-filter' value='icd10'> ICD10 Search</div>
                        </div>
                    </div>
                </form>



                
                <div class='brochure-collection'>
                    <div class='brochure-collection-label'>Selected Brochures:</div>
                    <div class='brochure-collection-items'>
                        <div class='no-results'><i>Select the brochures you would like to email.</i></div>
                    </div>
                </div>

                <div class='brochure-collection-button'>
                    <button type="submit" name="brochure_email_button" class="brochure_email_button">
                        <span class="button-text mc-animate">Email Collection</span>
                    </button>
                    <button type="submit" name="brochure_whatsapp_button" class="brochure_whatsapp_button">
                        <span class="button-text mc-animate">Whatsapp Collection</span>
                    </button>
                    <button type="submit" name="brochure_sms_button" class="brochure_sms_button">
                        <span class="button-text mc-animate">SMS Collection</span>
                    </button>
                </div>
      
                 <div class='email-collection'>
                    <form action='' method="post" id='emailbrochuresform'>
                        <input type='hidden' class='brochure_ids' name='hids' value=''>
                        <input type='hidden' class='data_post' name='data_post' value=''>
                        <input type='hidden' class='data_content' name='data_content' value=''>
                        <input type='hidden' class='data_href' name='data_href' value=''>
                        <input type='hidden' name='page_author_id' value='Tapiwa Mavhunga'>
                        
                        <div class='formfields'>

                            <?php

                            $test = 1;
                            $author_fname = 'Tapiwa';
                            $author_lname = 'Mavhunga';
                            $doctor_name = 'Tapiwa Mavhunga';
                            $branch_name = 'Axxess Health';
                            ?>
                            
                            <div class='formfield mt-4'>
                                <label class='formfield-label mc-animate <?= ($doctor_name != ' ')? 'mcshrink':''; ?>'>Your name (senders/users name):</label>
                                <input type="text" name="doctor_name" value="<?= $doctor_name; ?>" required>
                            </div>
                            <div class='formfield'>
                                <label class='formfield-label mc-animate'>Email To:</label>
                                <input type="text" name="patient_email" required>
                            </div>
                            
                              <?php
             
                            if(isset($email_message) && $email_message != ''){
                                $placeholder = $email_message;
                            } else {
                                $placeholder = 'Thank you for visiting {doctor_name}, click on the below link to view an online brochure that we thought you may find helpful.'."\n"."\n";
                                $placeholder .= 'Regards'."\n";
                                $placeholder .= '{doctor_name}'."\n";


                            }
                            $placeholder = str_replace('{doctor_name}', $doctor_name, $placeholder);
                            $placeholder = str_replace('{branch_name}', $branch_name, $placeholder);
            
                            ?>

                            
                            <div class='formfield'>
                                <textarea name='doctor_diagnosis' id="emailwTextarea" ><?= $placeholder;  ?>
                                </textarea>
                            </div>


                            <div class='formfield' style='text-align: right;'>
                                <span>I have permission to send information to this email address.</span> <input type='checkbox' name='patient_concent' required> 
                            </div>
                            <div class='formfield nopadding'>
                                <button type="submit" class='et_pb_button view_Brochure' name="email_patient_submit" value="Email now" style="background: #1E78A9;
color: #fff !important;">Email now</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class='sms-collection'>
                    <form action='' method="post" id='smsbrochuresform'>
                        <input type='hidden' class='brochure_ids' name='hids' value=''>
                        <input type='hidden' class='postscript_passcode' name='postscript_passcode' value=''>
                        <input type='hidden' class='postscript' name='postscript' value=''>
                        <input type='hidden' class='data_href' name='data_href' value=''>
                        <input type='hidden' name='page_author_id' value='Tapiwa'>

                        <div class='formfields'>
                            <?php
                           

                              $author_fname = 'Tapiwa';
                            $author_lname = 'Mavhunga';
                            $doctor_name = 'Tapiwa Mavhunga';
                            ?>
                            <div class='formfield'>
                                <label class='formfield-label mc-animate <?= ($doctor_name != ' ')? 'mcshrink':''; ?>'>Your name (senders/users name):</label>
                                <input type="text" name="doctor_name" value="{{$doctor_name}}" required disabled>
                            </div>
                            <div class='formfield'>
                                <label class='formfield-label mc-animate'>Mobile Number:</label>
                                <input type="text" name="msidn" value="" required>
                            </div>
                         
                            <input type='hidden' name='doctor_diagnosis' value=''>
                          

                             <div class='formfield' style='text-align: right;'>
                                <span>I have permission to send information to this mobile number.</span> <input type='checkbox' name='patient_concent' required> 
                            </div>

                            
                            <div class='formfield nopadding'>
                                <button type="submit" class='et_pb_button view_Brochure' name="sms_submit">SMS Now</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class='whatsapp-collection'>
                    <form action='' method="post" id='whatsappbrochuresform'>
                        <input type='hidden' class='brochure_ids' name='hids' value=''>
                        <input type='hidden' class='postscript_passcode' name='postscript_passcode' value=''>
                        <input type='hidden' class='postscript' name='postscript' value=''>
                        <input type='hidden' class='data_href' name='data_href' value=''>
                        <input type='hidden' name='page_author_id' value='Tapiwa'>

                        <div class='formfields'>
                            <?php
                              $author_fname = 'Tapiwa';
                            $author_lname = 'Mavhunga';
                            $doctor_name = 'Tapiwa Mavhunga';
                            ?>
                            <div class='formfield'>
                                <label class='formfield-label mc-animate <?= ($doctor_name != ' ')? 'mcshrink':''; ?>'>Your name (senders/users name):</label>
                                <input type="text" name="doctor_name" value="{{$doctor_name}}" required disabled>
                            </div>


                            <!-- <div class='formfield'>
                                
                                <input type="text" name="msidn" value="" required >
                            </div> -->

                            <style type="text/css">
                                .form-group {
  border: 1px solid #ced4da;
  padding: 5px;
  border-radius: 6px;
  width: auto;
}
.form-group:focus {
  color: #212529;
    background-color: #fff;
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
}
.form-group input {
  display: inline-block;
  width: auto;
  border: none;
}
.form-group input:focus {
  box-shadow: none;
}
#ec-mobile-number {
  width: 92%;
}

.form-group {
  border: 1px solid #eee;
  padding: 5px;
  border-radius: 0px;
  width: auto;
  background: #eee;
}
                            </style>
                                                        <label class='formfield-label mc-animate'>Mobile Number:</label>

                         <div class="formfieldss form-group mt-2">
        <span class="border-end country-code px-2">+27</span>
        <input type="text" class="form-control" id="ec-mobile-number" aria-describedby="emailHelp" placeholder="785122210" style="background: #eee; height: 36px;" name="msidn" />
    </div>
                         
                            <input type='hidden' name='doctor_diagnosis' value=''>
                          

                             <div class='formfield' style='text-align: right;'>
                                <span>I have permission to send information to this mobile number.</span> <input type='checkbox' name='patient_concent' required> 
                            </div>

                            
                            <div class='formfield nopadding'>
                                <button type="submit" class='et_pb_button view_Brochure' name="sms_submit">WhatsApp Now</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class='brochure-searchpage-results'>
                    <div class='no-results'> - <i style="color: #0179c1; font-style: normal;">Search for Medinformer medical brochures in field provided above or select a brochure below.</i></div>
                </div>


                <div class='listing-group'>

                    <div class='listing-group-filter'>
                        <div class='listing-group-filter-label'>TYPE OF BROCHURE: </div>
                        <div class='listing-group-filter-select'>
 
                        <select class='form-group' name="work_days" id="id_work_days" >
                          <option  value="0" id="tap">View Pre-script E-brochure</option>
                          <!-- <option  value="2" id="">View Post-script E-brochures</option> -->
                           <option  value="1" id="">View by Category</option> 

                          
                        </select>


                      
      


                        </div>
                    </div>

                    <style>
                      #s_525, #s_240, #s_485, #s_516{
                        display:  none;
                      }
                    </style>

    <div class='brochure-groups'>
            <?php 



            if( $result ) { 


              

                ?>    
                <div id="alphabetical-posts">
                  <?php $letters = array_keys($result); ?>
                  <?php if( $letters ) { ?>
                    <div class="letters-wrap mt-5 mb-5">
                      <ul class="letters">          
                        <?php foreach( $letters as $key => $letter ) { ?>
                          <li><a href="#goto-letter-<?php echo $letter; ?>"><?php echo $letter; ?></a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  <?php } ?>

                  <div class="brochure-groups">
                  <div class="posts row row-cols-lg-4 row-cols-md-2 row-cols-1 max-mb-n30">
                    <?php foreach( $result as $letter => $posts ) { ?>
                      <div id="goto-letter-<?php echo $letter; ?>" class="item">
                        <h3><?php echo $letter; ?></h3>
                        <div class="list brochure-items">
                          <?php foreach( $posts as $key => $post ) {  


                           
                            $display = "none";
                            $type = $post['meta'];
                            
                            if ($type == "postscript") {
                                $display = "none";
                            }else{
                                $display = "block"; 
                            }

                            ?>

                                <div id="<?php echo $post['ID']; ?>" 
                                    class='col brochure-item mc-animate <?php echo $post['meta']; ?>' data-bid='<?php echo $post['ID']; ?>' style="display: <?php echo $display; ?>"><a>
                                        <?php echo $post['title']; ?> </a></div>
                          
                          <?php } ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                </div>
              <?php } ?>
            <!-- End -->
</div>

@include('templates.categories')

<div class='brochure-postscripts'>

</div>

</div>




<!-- End  -->

   <div class='brochure-email-loading'>
                    <div id='brochure-email-loading-text'>Sending email...</div>
                    <div id='brochure-email-loading-icon' class='ld ld-slide-ltr'>
                        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="paper-plane" class="svg-inline--fa fa-paper-plane fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M245.53 410.5l-75 92.83c-14 17.1-42.5 7.8-42.5-15.8V358l280.26-252.77c5.5-4.9 13.3 2.6 8.6 8.3L191.72 387.87z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M511.59 28l-72 432a24.07 24.07 0 0 1-33 18.2l-214.87-90.33 225.17-274.34c4.7-5.7-3.1-13.2-8.6-8.3L128 358 14.69 313.83a24 24 0 0 1-2.2-43.2L476 3.23c17.29-10 39 4.6 35.59 24.77z"></path></g></svg>
                    </div>
                </div>

                <div class='brochure-sms-loading'>
                    <div id='brochure-sms-loading-text'>Sending SMS...</div>
                    <div id='brochure-sms-loading-icon' class='ld ld-slide-ltr'>
                        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="mobile" class="svg-inline--fa fa-mobile fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M0 384v80a48 48 0 0 0 48 48h224a48 48 0 0 0 48-48v-80zm160 96a32 32 0 1 1 32-32 32 32 0 0 1-32 32z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M0 384V48A48 48 0 0 1 48 0h224a48 48 0 0 1 48 48v336z"></path></g></svg>
                    </div>
                </div>


                   <div class='brochure-whatsapp-loading'>
                    <div id='brochure-whatsapp-loading-text'>Sending WhatsApp...</div>
                    <div id='brochure-whatsapp-loading-icon' class='ld ld-slide-ltr'>
                       
                    </div>
                </div> 

  

        <div id='brochure-categories-page'>
            <div class='brochure-categories-loading'>
                <span class='ajax-loading mc-animate'>
                    <div class="ld ld-hourglass ld-spin"></div>
                </span>
                <span class='ajax-loading-text'><i>- Loading category brochures, please wait.....</i></span>
            </div>
            <div class='brochure-categories-results'></div>
        </div>

</div>
</div>
@endsection




