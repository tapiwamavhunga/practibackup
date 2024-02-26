


<style>
    .bt-content {
  font-size: 14px !important;
}
.btn.btn-info {
  padding: 9px !important;
}

.table tr td {
  font-weight: 400 !important;
}

.table tr td, .table tr th {
  border-bottom: 1px solid #eff2f7;
  vertical-align: middle;
  padding: 18px;
  font-size: 13px;
}


</style>
<?php $__env->startSection('content'); ?>


   <div class="content-bodyf43rfg">
          <div class="container-fluid-max">

          <div class="col-xxl-12">
                    <div class="cards">
                        

             


            <div class="card-header mb-5">
              <h4 class="card-title">Manage Users</h4>
              
                            <a class="btn btn-success btn-sm" href="/users/export/">Export Users</a>

            </div>


                       <div class="card-header">

                 <form action="<?php echo e(route('admin.users', [])); ?>" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control me-2" name="search" placeholder="Search Users..." value="<?php echo e(request()->search); ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> <?php echo app('translator')->get('Go!'); ?></button>
                        </span>
                    </div>
                </form>
            </div>



                        <div class="card-body">
                            <div class="table-responsivex">
                         <div class="col-xxl-12">
                    <div class="cards">
                      
                            <div class="table-responsive">
                                <table class="table table-striped responsive-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                       
                                            <th>Is Verified </th>
                                            <th>Is Admin </th>
                                            <th>Date Created </th>
                                            <th>Last Loggedin </th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <tr>
                                            <td data-th="ID">
                                                <span class="bt-content"><?php echo e($user->id); ?></span>

                                            </td>




                                            </td>
                                            <td class="coin-name" data-th="Type"><span class="bt-content">
                                                
                                                <span><?php echo e($user->name); ?></span>

                                            </span>

                                        </td>
                                            <td data-th="Amount"><span class="bt-content">
                                                <?php echo e($user->email); ?>

                                            </span></td>
                                            <td data-th="Fee"><span class="bt-content">
                                                
                                                <?php if (!empty($user->company)) {
                                                   echo $user->company;
                                                }else{
                                                    echo "Medinformer";
                                                }?>

                                            </span></td>
                                            



                                            <td data-th="Hash"><span class="bt-content">
                                                <?php if ($user->is_verified == 1) {
                                                   echo "Yes";
                                                }else{
                                                    echo "No";
                                                }?>
                                            </span></td>

                                          <td data-th="Hash"><span class="bt-content">
                                                <?php if ($user->is_admin == 1) {
                                                   echo "Yes";
                                                }else{
                                                    echo "No";
                                                }?>
                                            </span></td>



                                            <td data-th="Date"><span class="bt-content">
                                                <?php echo e($user->created_at); ?>

                                            </span></td>

                                                  <td data-th="Hash"><span class="bt-content">
                                                <?php echo e($user->last_login_at); ?>

                                            </span></td>
                                            
                                            <td>
                                          <span class="bt-content">  <a href="<?php echo e(route('user.brochures', $user->id)); ?>" class="btn btn btn-primary btn-sm">Brochures</a></span>
</td>


                                            <td data-th="Status" class="nyt-t">
                                                <br>
                <form action="<?php echo e(route('users.destroy',$user->id)); ?>" method="POST">
   
                    <!-- <a  href="<?php echo e(route('users.show',$user->id)); ?>">Show</a> -->
    
                    <a class="btn btn-primary btn btn-sm" href="<?php echo e(route('users.edit',$user->id)); ?>">Edit</a>
   
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    
                    <button class="btn btn-danger btn btn-sm" onclick="return confirm('<?php echo e(__('Are you sure you want to delete?')); ?>')">
    <?php echo e(__('Delete')); ?>

</button>


                </form>
            </td>


                                        </tr>
                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      
                                        
                                    </tbody>
                                </table>


                            </div>
                                                                                    <?php echo e($users->links()); ?>



                        </div>

                </div>


                            </div>


                        </div>

                    </div>
                </div>
        </div>


</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/adminUsers.blade.php ENDPATH**/ ?>