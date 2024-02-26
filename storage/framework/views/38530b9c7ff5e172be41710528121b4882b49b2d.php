 <div class="sidebar">
  <div class="brand-logo">
    <a href="/"><img src="<?php echo e(URL::asset('/images/fav.png')); ?>" alt="" width="50" /> </a>
  </div>
  <div class="menu">
    <ul>
<?php if(Auth::check()): ?>
    <?php if(Auth::user()->is_admin == 0): ?>

      <li>
        <a
          href="/"
          data-toggle="tooltip"
          data-placement="right"
          title="Home"
        >
          <span><i class="bi bi-house"></i></span>
        </a>
      </li>

      <li>
        <a
          href="/user_reports"
          data-toggle="tooltip"
          data-placement="right"
          title="Reports"
        >
          <span><i class="bi-envelope"></i></span>
        </a>
      </li>

     

        <li>
        <a
          href="/user/profile/<?php echo e(Auth::user()->id); ?>"
          data-toggle="tooltip"
          data-placement="right"
          title="My Profile"
        >
          <span><i class="bi-person-lines-fill"></i></span>
        </a>
      </li>


      <?php endif; ?>

      <?php if(Auth::user()->is_admin == 1): ?>
       <li>
          <a
            href="/"
            data-toggle="tooltip"
            data-placement="right"
            title="Home"
          >
            <span><i class="bi bi-globe2"></i></span>
          </a>
        </li>

         <li>
        <a
          href="/admin/admin_reports"
          data-toggle="tooltip"
          data-placement="right"
          title="Reports"
        >
          <span><i class="bi-envelope"></i></span>
        </a>
      </li>



        <li>
        <a
          href="/admin/users"
          data-toggle="tooltip"
          data-placement="right"
          title="Manage Users"
        >
          <span><i class="bi bi-people"></i></span>
        </a>
      </li>

        <li>
        <a
          href="/admin/newusers"
          data-toggle="tooltip"
          data-placement="right"
          title="Manage New Users"
        >
          <span><i class="bi bi-person-plus"></i></span>
        </a>
      </li>


       <li>
        <a
          href="/admin/verifications"
          data-toggle="tooltip"
          data-placement="right"
          title="Manage Verifications"
        >
          <span><i class="bi bi-bookmarks"></i></span>
        </a>
      </li>

      <!-- <li>
        <a
          class="settings"
          href="/admin/companies"
          data-toggle="tooltip"
          data-placement="right"
          title="Clients"
        >
          <span><i class="bi bi-briefcase"></i></span>
        </a>
      </li> -->


      <?php endif; ?>
     
  
      <?php endif; ?>
      <li class="logout">
  


        <a  href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" 
          data-toggle="tooltip"
          data-placement="right"
          title="Signout">
                                        
                                                  <span><i class="bi bi-power"></i></span>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>


      </li>
    </ul>

  </div>
</div><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/templates/sidebar.blade.php ENDPATH**/ ?>