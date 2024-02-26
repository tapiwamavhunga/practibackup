<div class='brochure-categories'>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

      <div class='brochure-category' data-id='<?php echo e($category->name); ?>'>
          <div class='brochure-category-image' style='background-image:url("")' id="s_<?php echo e($category->term_id); ?>"></div>
        <div class='brochure-category-details'>
              <h2><?php echo e($category->name); ?></h2>
           <?php echo  $category->image; ?>
          </div>
        </div>  
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





</div>
<?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/templates/categories.blade.php ENDPATH**/ ?>