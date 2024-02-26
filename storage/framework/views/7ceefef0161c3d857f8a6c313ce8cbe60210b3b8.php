<?php $__env->startComponent('mail::message'); ?>
# New Registration 

A new user has been registered. <br>

Name : <?php echo e($user->name); ?>

<br>
Email : <?php echo e($user->email); ?>


<!-- <?php $__env->startComponent('mail::button', ['url' => '']); ?>
Button Text
<?php echo $__env->renderComponent(); ?> -->

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/emails/signup-notice.blade.php ENDPATH**/ ?>