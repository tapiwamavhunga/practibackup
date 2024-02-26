
<style type="text/css">

</style>


<?php $__env->startSection('content'); ?>









<div class="container-fluid">
    <div class="pt-5 mt-5">
             <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="wallet-widget card">
                        <h5>Emails Sent </h5>
                        <h2><span class="text-primary"><?php echo e($reports->count()); ?></span> <sub>sent</sub></h2>
                         <p><?php echo e($reports->count()); ?> Recieved</p>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="wallet-widget card">
                        <h5>SMSs</h5>
                        <h2><span class="text-success"><?php echo e($sms_reports_count); ?></span> <sub>sent</sub></h2>
                        <p><?php echo e($sms_reports_count); ?> Recieved</p>
                    </div>
                </div>
                
              
            </div>

            
    </div>

</div>




<div class="container-fluid mt-5">

<div class="col-xxl-12">
          <div class="cardeff">
            <div class="card-header">
              <h4 class="card-title">Email Reports</h4>
              <span data-href="/export-csv" id="export" class="btn btn-success btn-sm" onclick ="exportTasks (event.target);">Export</span>
            </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped responsive-table" id="table" style="width: 100%;">
                   <thead>
                      <tr>
                           <th>Transaction ID</th>
                           <th>Sent To</th>
                           <th>Sent By</th>
                           <th>Brochure Sent</th>
                           <th>Date Sent</th>
                      </tr>
                   </thead>


                    <tbody>

                                      <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reports): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td data-th="ID"><span class="bt-content"><?php echo e($reports->id); ?></span></td>
                                     
                                       
                                            <td data-th="ID"><span class="bt-content"><?php echo e($reports->patient_email); ?></span></td>

                                             <td data-th="ID"><span class="bt-content"><?php echo e($reports->doctor_name); ?></span></td>


                                             <?php $post = \Corcel\Model\Post::find($reports->hids);  ?>
                                             <td data-th="ID"><span class="bt-content"><?php echo e($post->post_title); ?></span></td>


                                              <td data-th="ID"><span class="bt-content"><?php echo e($reports->created_at); ?></span></td>


                                     
                                        </tr>


                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      
                                        
                                    </tbody>


                </table>
             </div>
           </div>
          </div>
        </div>


<div class="col-xxl-12">
          <div class="cardeff">
            <div class="card-header">
              <h4 class="card-title">SMS Reports</h4>
              <span data-href="/export-csv" id="export" class="btn btn-success btn-sm" onclick ="exportTasks (event.target);">Export</span>
            </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped responsive-table" id="tableemail" style="width: 100%;">

                  <thead>
                      <tr>
                           <th>Transaction ID</th>
                           <th>Sent To</th>
                           <th>Sent By</th>
                           <th>Brochure Sent</th>
                           <th>Date Sent</th>
                      </tr>
                   </thead>


                   <tbody>

                                      <?php $__currentLoopData = $sms_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td data-th="ID"><span class="bt-content"><?php echo e($report->id); ?></span></td>
                                     
                                       
                                            <td data-th="ID"><span class="bt-content"><?php echo e($report->msidn); ?></span></td>

                                             <td data-th="ID"><span class="bt-content"><?php echo e($report->doctor_name); ?></span></td>


                                             <?php $post = \Corcel\Model\Post::find($report->hids);  ?>
                                             <td data-th="ID"><span class="bt-content"><?php echo e($post->post_title); ?></span></td>


                                              <td data-th="ID"><span class="bt-content"><?php echo e($report->created_at); ?></span></td>


                                     
                                        </tr>


                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      
                                        
                                    </tbody>
                </table>
             </div>
           </div>
          </div>
        </div>

</div>


<div style="height: 100px;"></div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/reports.blade.php ENDPATH**/ ?>