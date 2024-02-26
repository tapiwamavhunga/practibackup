

   

<?php $__env->startSection('content'); ?>


   <div class="content-body">
          <div class="container">
            <div class="row">
              <div class="col-xl-12">
                <div class="page-title-content  mt-5">
                  <p>
                     
                    <strong class="text-primary">Profile verification for <?php echo e(Auth::user()->name); ?></strong>
                  </p>
                </div>
              </div>
            </div>
            
          </div>



   


<div class="container-fluid-max">    
  <div class="col-xxl-12">
                    <div class="cards">
                        
                        <div class="card-body">
                            <div class="container">
            <div class="row">
                  
                       
                        <div class="card-body">
                            <div class="row">

                                <div class="col-xxl-12">
                                    <?php if(Session::has('success')): ?>

                        <div class="alert alert-success">

                            <?php echo e(Session::get('success')); ?>


                            <?php

                                Session::forget('success');

                            ?>

                        </div>

                        <?php endif; ?>
                                </div>
                                <div class="col-xxl-12">
                                    <div class="cardhh">
                                        <div class="card-header px-0">
                                            <h4 class="card-title">Verify your practice number. <strong>For instant verification phone 07618833034</strong></h4>
                                        </div>
                                        <div class="card-body px-0">
                                            <form action="<?php echo e(route('contact-form.store')); ?>" method="POST" class="personal_validate" enctype="multipart/form-data">
                                              <?php echo csrf_field(); ?>
    
                                                <div class="row g-3">
                                                    <div class="col-xl-12">
                                                        <label class="form-label">Practice Number</label>
                                                        <input type="text" name="practice_number" class="form-control mb-3" placeholder="Practice Number" value="<?php echo e(Auth::user()->practice_number); ?>">

                                                        <?php if($errors->has('practice_number')): ?>

                                            <span class="text-danger "><?php echo e($errors->first('practice_number')); ?></span>

                                        <?php endif; ?>
                                                    </div>


                             <input type="text" name="user_id" class="form-control mb-3" hidden value="<?php echo e(Auth::user()->id); ?>">

                             <input type="text" name="name" class="form-control mb-3" hidden value="<?php echo e(Auth::user()->name); ?>">

                             <input type="text" name="email" class="form-control mb-3" hidden value="<?php echo e(Auth::user()->email); ?>">

                                     <div class="col-md-12">

                                    <div class="form-group">


                                        <textarea name="message" rows="3" class="form-control" hidden>
                                            Hi Admin

                                            Please verify my details, as follows Name : <?php echo e(Auth::user()->name); ?>, Email : <?php echo e(Auth::user()->email); ?>, Practice Number : <?php echo e(Auth::user()->practice_number); ?>


                                        </textarea>

                                        

                                    </div>  

                                </div>



                            </div>

                                                    
                                                    <div class="col-auto mt-3">
                                                        <button class="btn btn-primary">Confirm</button>
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
        </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/user/verify_practice.blade.php ENDPATH**/ ?>