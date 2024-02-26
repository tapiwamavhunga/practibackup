

<style type="text/css">
	.allowed-brochure-items {
    padding: 20px 0;
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
    width: 40px;
    height: 40px;
}

.allowed-brochure-item-title {
    padding-left: 15px;
}

.allowed-brochure-items-submit {
    text-align: right
}

.allowed-brochure-item-image {
  width: 40px;
  height: 40px;
  top: 22px;
  position: relative;
}

.allowed-brochure-item-checkbox {
  width: 30px;
  margin-top: 32px;
}


</style>
<div class="container-fluid-max py-3">
    

<?php $__env->startSection('title', __('users.list')); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid-max">
    

    <div class="row justify-content-center">

        <!-- sidebar nav -->

        <!-- main content -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                     Assign Brochures
                    <span class="float-right">
                        <a href="<?php echo e(route('admin.users')); ?>" class="btn btn-sm btn-primary">Back</a>
                    </span>
                </div>

                <div class="card-body ml-5">


                    <?php if(isset($brochures) && count($brochures) > 0): ?>

                        <p>Select the brochure checkboxes and then click 'Assign Brochures' button to assign them to this user.</p>

                        <form action="<?php echo e(route('user.update.brochures', $user->id)); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo method_field('PATCH'); ?>
                            <?php echo csrf_field(); ?>

                            <div class="allowed-brochure-items-submit">
                                <button type="button" class="btn btn-secondary btn-sm float-left selectallbrochures">Select All</button>
                                <button type="submit" class="btn btn-primary btn-sm">Assign Brochures</button>
                            </div>
                            
                            <div class='allowed-brochure-items'>
                            <?php $__currentLoopData = $brochures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brochure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class='allowed-brochure-item'>
                                    
                                    <div class='allowed-brochure-item-checkbox'>
                                        <?php if(in_array($brochure->ID, $brochures_allowed)): ?>
                                        <input type='checkbox' name='brochures_allowed[]' value='<?php echo e($brochure->ID); ?>' checked="checked">
                                        <?php else: ?>
                                        <input type='checkbox' name='brochures_allowed[]' value='<?php echo e($brochure->ID); ?>'>
                                        <?php endif; ?>
                                    </div>
                                    <div class='allowed-brochure-item-image'><img src='<?php echo e($brochure->image); ?>' style="width: 50px; height: 50px;"></div>
                                    <div class='allowed-brochure-item-title'><?php echo e($brochure->title); ?></div>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="allowed-brochure-items-submit">
                                <button type="button" class="btn btn-secondary btn-sm float-left selectallbrochures">Select All</button>
                                <button type="submit" class="btn btn-primary btn-sm">Assign Brochures</button>
                            </div>

                        </form>

                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">No Brochures Found</div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>



</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/admin/users/brochures.blade.php ENDPATH**/ ?>