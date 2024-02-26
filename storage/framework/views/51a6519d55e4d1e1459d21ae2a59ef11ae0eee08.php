

   

<?php $__env->startSection('content'); ?>





<style type="text/css">
  .relative.z-0.inline-flex.shadow-sm.rounded-md {
  display: none;

}

.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
  margin-top: 20px;
}


</style>

   <div class="content-bodyccc" >
          <div class="container-fluid" >
            
                <div class="content">

              <div class="row pt-5">
                <div class="col-md-3">
                    <div class="wallet-widget card" style="border-radius: 0px; background: #0179C1;">
                        <h5 style="color: #fff; ">Users</h5>
                         <h2><span  style="color: #fff; "><?php echo e($users_count); ?> </span></h2>
                         <p style="color: #fff; ">Active Users</p>

                    </div>
                </div>
                 <div class="col-md-3">
                    <div class="wallet-widget card" style="border-radius: 0px; background: #64A93C;">
                        <h5 style="color: #fff; ">Emails Sents</h5>
                         <h2><span  style="color: #fff; "><?php echo e($emails_sent); ?> </span></h2>
                         <p style="color: #fff; ">Delivered Emails</p>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="wallet-widget card" style="border-radius: 0px; background: #DE7E50;">
                        <h5 style="color: #fff; ">SMS Sents</h5>
                         <h2><span  style="color: #fff; "><?php echo e($sms_sent); ?> </span></h2>
                         <p style="color: #fff; ">Delivered SMSs</p>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="wallet-widget card" style="border-radius: 0px; background: #0179C1;">
                        <h5 style="color: #fff; ">WhatsApp </h5>
                         <h2><span  style="color: #fff; "><?php echo e($whatsapp_sent); ?> </span></h2>
                         <p style="color: #fff; ">WhatsApp Sent</p>

                    </div>
                </div>


               
            </div>


        <div class="row mb-3">
       <?php $__currentLoopData = $number_blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

         <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-6">
           <div class="chart-stat text-center" style="border-radius: 0px;">
             <p class="mb-1"><?php echo e($block['title']); ?></p>
             <h5><?php echo e($block['number']); ?></h5>
           </div>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div>



            
        

        <div class="row">
            <?php $__currentLoopData = $list_blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-12">
                <h4 class="card-title pt-5 mb-3"><?php echo e($block['title']); ?></h4>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Last login at</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $block['entries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($entry->id); ?></td>
                                <td><?php echo e($entry->name); ?></td>
                                <td><?php echo e($entry->email); ?></td>
                                <td><?php echo e($entry->company); ?></td>
                                <td><?php echo e($entry->last_login_at); ?></td>
                                 <td class="text-center">
                               <a class="btn btn-primary btn-sm" href="<?php echo e(route('users.edit',$entry->id)); ?>">Edit</a>
                        </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3"><?php echo e(__('No entries found')); ?></td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
    </div>




            <div class="row">
                      <div class="col-xxl-12 mb-5">
        <div class="card-header mb-3">
              <h4 class="card-title pt-5">User Management</h4>
              <span data-href="/export-csv" id="export" class="btn btn-success btn-sm" onclick="exportTasks (event.target);">Export</span>
            </div>
    <table class="table yajra-datatable mb-5 pt-5">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Practice Number</th>
                <th>Company</th>
                <th>User ID</th>
                <th>User Is Admin</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
            </div>

            
              </div>
            </div>
          </div>
        </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <?php echo $chart->renderJs(); ?>

<?php $__env->stopSection(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(route('admin.accounts.list')); ?>",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'practice_number', name: 'practice_number'},
            {data: 'company', name: 'company'},
            {data: 'id', name: 'id'},
            {data: 'is_admin', name: 'is_admin'},

            {
                data: 'action', 
                name: 'action', 
                searchable: true,
                sortable: true
            },
        ]
    });
    
  });
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/adminHome.blade.php ENDPATH**/ ?>