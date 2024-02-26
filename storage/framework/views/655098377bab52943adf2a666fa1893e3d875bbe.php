

<?php $__env->startSection('content'); ?>


    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success">
            <p><?php echo e($message); ?></p>
        </div>
    <?php endif; ?>

<div class="content-bodyd ">
    <div class="container-fluid mt-5 pt-5">
      <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6">
          <div class="card welcome-profile">
            <div class="card-body">

              


              <h4>Welcome, <?php echo e($user->name); ?>!</h4>
              <p>
                Completing your profile with accurate information will enhance your experience and help us tailor our services to better meet your needs.
              </p>

              <ul>
               
                <li class="mb-5">
                  <a href="<?php echo e(route('users.edit',$user->id)); ?>">
                    
                    Click here to complete your profile.
                  </a>
                </li>

                
              </ul>
            </div>
          </div>
        </div>



        <div class="col-xxl-6 col-xl-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Reports</h4>
            </div>
            <div class="card-body">
              <div class="app-link">
                <h5>Get Analytics in realtime.</h5>
                <p>
                  You can only view reports once you have been verified. 
                </p>
                <a href="/user_reports" class="btn btn-primary">
                 View your Reports 
                </a>
                
                
              </div>
            </div>
          </div>
        </div>

      </div>


      <div class="row">
        <div class="col-xxl-12">
          <div class="cardc">
            <div class="card-header">
              <h4 class="card-title ">Profile Summary</h4>
              <a  href="<?php echo e(route('users.edit',$user->id)); ?>" class="btn btn-primary">Edit</a>

            </div>
            <div class="card-body">
              <form class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>USER ID</span>
                    <h4><?php echo e($user->id); ?></h4>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>EMAIL ADDRESS</span>
                    <h4><?php echo e($user->email); ?></h4>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Company</span>
                    <?php if(!empty($user->company)): ?>

                          <h4><?php echo e($user->company); ?></h4>
                          <?php else: ?>
                            <h4>Medinformer</h4>
                          <?php endif; ?>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Professional Number</span>

                     <?php if(!empty($user->practice_number)): ?>

                    <h4><?php echo e($user->practice_number); ?></h4>
                          <?php else: ?>
                            <h4>Not Provided</h4>
                          <?php endif; ?>


                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Phone Number</span>

                      <?php if(!empty($user->phone_number)): ?>

                    <h4><?php echo e($user->phone_number); ?></h4>
                          <?php else: ?>
                            <h4>Not Provided</h4>
                          <?php endif; ?>


                  </div>
                </div>

                 <!-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>WhatsApp Number</span>
                    <h4><?php echo e($user->whatsapp_number); ?></h4>
                  </div>
                </div> -->

                 

                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>User Type</span>
                          <?php if($user->is_admin == 1): ?>

                    <h4>Admin User</h4>
                          <?php else: ?>
                            <h4>Practitioner</h4>
                          <?php endif; ?>
                  </div>
                </div>

                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Is Verified</span>
                    <h4><?php echo e($user->is_verified); ?></h4>

                    <?php if($user->is_verified == 1): ?>

                    <h4>Yes</h4>
                          <?php else: ?>
                            <h4>No</h4>
                          <?php endif; ?>
                  </div>
                </div>

                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Last Logged In</span>
                    
                      <?php if(!empty($user->last_login_at)): ?>

                    <h4><?php echo e($user->last_login_at); ?></h4>
                          
                          <?php endif; ?>
                          
                  </div>
                </div>

                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>JOINED SINCE</span>
                    <h4><?php echo e($user->created_at); ?></h4>
                  </div>
                </div>

                <div class="col-xxl-12">
                  <div class="user-info">


                     <?php if(auth::user()->image_logo): ?>
                    <h4>Practice Logo</h4>

                  <img src="<?php echo e(asset('/folder/images/signatures/'.Auth::user()->image_logo)); ?>" style=" height: auto;" 
                />

                <?php else: ?>
                              <img src="<?php echo e(asset('/folder/images/signatures/'.Auth::user()->image_logo)); ?>" alt="" />

              <?php endif; ?>


                  </div>
                </div>


                <div class="col-xxl-12">
                  <div class="user-info">


                     <?php if(auth::user()->image_signature): ?>
                    <h4>Email Signature</h4>

                  <img src="<?php echo e(asset('/folder/images/signatures/'.Auth::user()->image_signature)); ?>" style=" height: auto;" 
                />

                <?php else: ?>
                              <img src="<?php echo e(asset('/folder/images/signatures/'.Auth::user()->image_signature)); ?>" alt="" />

              <?php endif; ?>


                  </div>
                </div>


              </form>
            </div>
          </div>
        </div>

      
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/user/profile.blade.php ENDPATH**/ ?>