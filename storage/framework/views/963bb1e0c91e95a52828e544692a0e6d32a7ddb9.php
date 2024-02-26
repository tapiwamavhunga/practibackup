

<style type="text/css">
  .card {
  border: 0px;
  margin-bottom: 30px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 1.25rem 1.5625rem #fff;
  box-shadow: 0px 1.25rem 1.5625rem #fff;
  background: #fff;
}

.allowed-brochure-item {
  display: flex;
  justify-content: flex-start;
  padding: 0 15px;
  border-top: 1px solid rgba(0, 0, 0, 0.125);
  background-color: #f7f7f7;
  line-height: 80px;
}

.allowed-brochure-item-checkbox {
  width: 30px;
}

.allowed-brochure-item-image {
  width: 80px;
  height: 80px;
}

.allowed-brochure-item-title {
  padding-left: 15px;
}

.allowed-brochure-item-checkbox {
  width: 30px;
  padding-top: 32px;
}


</style>


<?php $__env->startSection('content'); ?>
<div class="container-fluid">
 
<div class="row mt-5">
        <div class="col-xxl-12 col-xl-12">
          <!-- <div class="page-title mt-5">
            <h4>Profile</h4>
          </div> -->
<div class="col-xxl-12 mt-3 mb-3">
                                    <?php if(Session::has('success')): ?>

                        <div class="alert alert-success">

                            <?php echo e(Session::get('success')); ?>


                            <?php

                                Session::forget('success');

                            ?>

                        </div>

                        <?php endif; ?>
                                </div>




  


          <div class="cardd">
            <div class="card-header">
              <div class="settings-menu active">
                <a href="#" class="active">Personal Information</a>
                
            </div>
             <div class="pull-right">
                <a class="btn btn-primary btn-block" href="<?php echo e(route('home')); ?>"> View Brochures </a>
            </div>
            </div>
              <div class="row mt-5">
               <div class="col-xxl-3">
                <div class="card welcome-profile">
                  <div class="card-body">
                     <?php if(auth::user()->image): ?>
                  <img class="me-3 rounded-circle me-0 me-sm-3" src="<?php echo e(asset('/folder/images/'.Auth::user()->image)); ?>" width="60" height="60"
                />
              <?php endif; ?>
                    <h4>Welcome, <?php echo e($user->name); ?>!</h4>
                    <p>
                       Completing your profile with accurate information will enhance your experience and help us tailor our services to better meet your needs. 
                    </p>

                  
                  </div>
                </div>

           


<?php if(Auth::user()->is_admin == 1): ?>

<div class="carddd mt-5" style="background: #fff; padding: 10px;">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Verify User  </h4>
                                        </div>
                                        <div class="card-body px-0">
         



        <form action="<?php echo e(route('user.updateProfileStatus',$user->id)); ?>" method="POST" class="personal_validate" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?> 

                                            <div class="row">
                                              
                                            
                                           
                              <div class="col-12 mb-3 form-group <?php echo e($errors->has('is_verified') ? 'has-error' : ''); ?>">
    <label for="is_verified" class="form-label mb-3">Make <?php echo e($user->name); ?> an approved Practioner</label>
    <select name="is_verified" class="form-control" id="is_verified"  >
    <?php $__currentLoopData = json_decode('{"2": "Select", "1": "Yes", "0": "No"}', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKey); ?>" <?php echo e((isset($user->is_verified) && $user->is_verified == $optionKey) ? 'selected' : ''); ?>><?php echo e($optionValue); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
    <?php echo $errors->first('is_verified', '<p class="help-block">:message</p>'); ?>

</div>

<div class="mb-3 col-xxl-12 col-xl-12 col-lg-12 form-group <?php echo e($errors->has('company') ? 'has-error' : ''); ?>">
    <label for="company" class="form-label"><?php echo e('Company'); ?></label>
    <select name="company" class="form-control" id="company" >
    <?php $__currentLoopData = json_decode('{"none": "None","jnj": "JNJ","dischem": "Dis-Chem", "medinformer": "Medinformer", "external": "External"}', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKeyt => $optionValuet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($optionKeyt); ?>" <?php echo e((isset($user->company) && $user->company == $optionKeyt) ? 'selected' : ''); ?>><?php echo e($optionValuet); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
    <?php echo $errors->first('company', '<p class="help-block">:message</p>'); ?>

</div>

 
                          <div class="mb-3 col-xxl-12 col-xl-12 col-lg-12">
                            <label class="form-label">Region</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->region); ?>" name="region" value="<?php echo e($user->region); ?>">
                          </div> 

                          <div class="mb-3 col-xxl-12 col-xl-12 col-lg-12">
                            <label class="form-label">Sub Region</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->sub_region); ?>" name="sub_region" value="<?php echo e($user->sub_region); ?>">
                          </div> 







                                                <div class="col-12">
                                                    <button class="btn btn-success">Save</button>
                                                </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>

<?php endif; ?>

               </div>
                <div class="col-xxl-9">
                  <div class="cardd">
                 
                    <div class="card-body">

<div class="row">
               
                
                <div class="col-xxl-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Personal Information</h4>
                    </div>
                    <div class="card-body">
 <form action="<?php echo e(route('user.updateProfile',$user->id)); ?>" method="POST" class="personal_validate" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>                        <div class="row g-4">

                          <div class="col-xxl-12">
                            <div class="d-flex align-items-center">

                                <?php if($user->image): ?>
                              <img class="me-3 rounded-circle me-0 me-sm-3" src="<?php echo e(asset('/folder/images/'.Auth::user()->image)); ?>" alt="" width="55" height="55">
                              <?php endif; ?>
                              <div class="media-body">
                                <h4 class="mb-0"><?php echo e($user->surname); ?></h4>
                                <p class="mb-0">Max file size is 20mb</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-12">
                            <div class="form-file">
                        <input type="file" name="image" value="<?php echo e(isset($user->image) ? $user->image : ''); ?>">
                             
                            </div>


                             


                          </div>


                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Name and Surname eg DR John Jones</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->name); ?>" name="name" value="<?php echo e($user->name); ?>">
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6 d-none">
                            <label class="form-label">Surname</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->surname); ?>" name="surname" value="<?php echo e($user->surname); ?>">
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Email</label>
                            <div class="fx-relay-email-input-wrapper"><input type="email" class="form-control" placeholder="<?php echo e($user->email); ?>" name="email" value="" disabled style="padding-right: 52px;"><div class="fx-relay-icon" style="top: 0px; bottom: 0px;"></div></div>
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->phone_number); ?>" name="phone_number" value="<?php echo e($user->phone_number); ?>">
                          </div>

                          <!-- <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Whatsapp Number</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->whatsapp_number); ?>" name="whatsapp_number" value="<?php echo e($user->whatsapp_number); ?>">
                          </div> -->


                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">HCP Type (DR, Nurse)</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->type); ?>" name="type" value="<?php echo e($user->type); ?>">
                          </div>
                           <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Professional Number</label>
                            <input type="text" class="form-control" placeholder="<?php echo e($user->practice_number); ?>" name="practice_number" value="<?php echo e($user->practice_number); ?>" >
                          </div>
                         


 
  
                        </div>

                         <div class="col-12 mt-3">
                            <button class="btn btn-success pl-5 pr-5 waves-effect">
                              Save Changes
                            </button>
                          </div>


                    </div>

                
                   
                      </form>



                    </div>





                        <div class="row g-4">
                          
                               <div class="card">
                    
                     <div class="card-header">
                      <h4 class="card-title">Company Logo</h4>
                    </div>



                                        <div class="card-body">
              <form action="<?php echo e(route('user.updateProfileEmailSettingsLogo',$user->id)); ?>" method="POST" class="personal_validate" enctype="multipart/form-data">
                   <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?> 

                          <div class="col-xxl-12">
                            <div class="d-flex align-items-center">
                              <?php if($user->image_logo): ?>
                              <img class="me-3  me-0 me-sm-3 img-fluid" src="<?php echo e(asset('/folder/images/signatures/'.$user->image_logo)); ?>" style="width: 300px;" >
                              <?php endif; ?>
                              <div class="media-body">
                                <h4 class="mb-0"><?php echo e($user->surname); ?></h4>
                                <p class="mb-3">Upload you email logo here - max file size 20 mb | Max width should be 300px by 100px</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-12 mb-5">
                            <div class="form-file">
                        <input type="file" name="image_logo" value="<?php echo e(isset($user->image_logo) ? $user->image_logo : ''); ?>">
                             
                            </div>

                          </div>


                        
                          

                          <div class="col-12 mt-3">
                            <button class="btn btn-success pl-5 pr-5 waves-effect">
                              Save Changes
                            </button>
                          </div>

                        </form>
                        </div>


                  </div>


                              <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Company Signature</h4>
                    </div>
                    <div class="card-body">
              <form action="<?php echo e(route('user.updateProfileEmailSettings',$user->id)); ?>" method="POST" class="personal_validate" enctype="multipart/form-data">
                   <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?> 

                          <div class="col-xxl-12">
                            <div class="d-flex align-items-center">
                              <?php if($user->image_signature): ?>
                              <img class="me-3  me-0 me-sm-3 img-fluid" src="<?php echo e(asset('/folder/images/signatures/'.$user->image_signature)); ?>" style="width: 300px;" >

                              <?php endif; ?>
                              <div class="media-body">
                                <h4 class="mb-0"><?php echo e($user->surname); ?></h4>
                                <p class="mb-3">Upload you email signature here - max file size 20 mb</p>
                              </div>
                            </div>
                          </div>
                          <div class="col-xxl-12 mb-5">
                            <div class="form-file">
                        <input type="file" name="image_signature" value="<?php echo e(isset($user->image_signature) ? $user->image_signature : ''); ?>">
                             
                            </div>

                          </div>


                          <div class="col-lg-12 d-none">
                          <label class="form-label" class="mb-5">Email Message</label>

                              <textarea class="form-control" id="exampleFormControlTextarea1" name="email_message" rows="3" placeholder="Thank you for visiting <?php echo e($user->name); ?> , click on the below link to view an online brochure that we thought you may find helpful." value="<?php echo e($user->email_message); ?>"></textarea>
                          </div>
                         
                          

                          <div class="col-12 mt-3">
                            <button class="btn btn-success pl-5 pr-5 waves-effect">
                              Save Changes
                            </button>
                          </div>
                        </div>


                      </form>

                  </div>


             

                  </div>


                  


                </div>
              </div>

   
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
     





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/user/edit.blade.php ENDPATH**/ ?>