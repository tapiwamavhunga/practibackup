<style type="text/css">
  .profile_log .user .thumb img {
  max-width: 35px !important;
  border-radius: 50% !important;
}

.profile_log .user .thumb img {
  max-width: 45px !important;
  border-radius: 50% !important;
  height: 45px !important;
}


.nav-item {
  display: inline-flex;
}
.container-fluid-max {
  margin-left: 100px;
  margin-right: 100px;
}


</style>
<div class="header bg-light" style="background: #fff !important;">
  <div class="container-fluid-max">
    <div class="row">
      <div class="col-xxl-12">
        <div class="header-content">
          <div class="header-left">
            <div class="brand-logo">
                <a href="/">

                <?php if(Auth::user()): ?>
                  <?php if(Auth::user()->company == "medinformer"): ?>
                <img src="<?php echo e(URL::asset('/images/Cipla_logo.svg_-.png')); ?>" style="width: 150px; float: left;">
                <?php elseif(Auth::user()->company == "dischem"): ?>
                <img src="<?php echo e(URL::asset('/images/DCP.JO_BIG-7415fb8e.png')); ?>" style="width: 150px; float: left;">
                <?php elseif(Auth::user()->company == "jnj"): ?>
                 <img src="<?php echo e(URL::asset('/images/2560px-Johnson_and_Johnson_Logo.svg.png')); ?>" style="width: 150px; float: left;">

                <?php elseif(Auth::user()->company == "babycity"): ?>

                <img src="<?php echo e(URL::asset('/images/Baby_city_Logo.webp')); ?>" style="width: 150px; float: left; height: 48px;">


                <?php elseif(Auth::user()->company == "tlc"): ?>
                <img src="<?php echo e(URL::asset('/images/tlc.png')); ?>" style="width: 150px; float: left; height: 48px;">
                <?php else: ?>
                 <img src="<?php echo e(URL::asset('/images/Cipla_logo.svg_-.png')); ?>" style="width: 150px; float: left;">

                <?php endif; ?>

                <?php else: ?>

                 <img src="<?php echo e(URL::asset('/images/Cipla_logo.svg_-.png')); ?>" style="width: 150px; float: left;">

                <?php endif; ?>
                </a>
            </div>
            <div class="search d-none">
              <form action="#">
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Search Here"
                  />
                  <span class="input-group-text"
                    ><i class="icofont-search"></i
                  ></span>
                </div>
              </form>
            </div>
          </div>

          <?php if(Auth::check()): ?>
          <?php if(Auth::user()->is_admin == 0): ?>

          



          <div class="header-right">
            <div class="dark-light-toggle" onclick="themeToggle()">
              <span class="dark"><i class="bi bi-moon"></i></span>
              <span class="light"><i class="bi bi-brightness-high"></i></span>
            </div>
            <div class="notification dropdown">
              <div class="notify-bell" data-toggle="dropdown">
                <span><i class="bi bi-bell"></i></span>
              </div>
              <div class="dropdown-menu dropdown-menu-right notification-list">
                <h4>Notifications</h4>
                <div class="lists">
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon success"
                        ><i class="bi bi-check"></i
                      ></span>
                      <div>
                        <p>Account created successfully</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon fail"
                        ><i class="bi bi-x"></i
                      ></span>
                      <div>
                        <p>2FA verification failed</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon success"
                        ><i class="bi bi-check"></i
                      ></span>
                      <div>
                        <p>Device confirmation completed</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>
                  <a href="#" class="">
                    <div class="d-flex align-items-center">
                      <span class="me-3 icon pending"
                        ><i class="bi bi-exclamation-triangle"></i
                      ></span>
                      <div>
                        <p>Phone verification pending</p>
                        <span>2020-11-04 12:00:23</span>
                      </div>
                    </div>
                  </a>

                  <a href="settings-activity.html"
                    >View All Recquests <i class="icofont-simple-right"></i
                  ></a>
                </div>
              </div>
            </div>

            <?php endif; ?>
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>

            <ul>
                 <?php if(Route::has('login')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
            </ul>

            <?php else: ?>
            <div class="profile_log dropdown">

              <div class="user" data-toggle="dropdown">
                <strong style="margin-right: 20px;" class="d-sm-none"><?php echo e(Auth::user()->salutation); ?> <?php echo e(Auth::user()->name); ?> <?php echo e(Auth::user()->surname); ?></strong>

                <span class="thumb"
                  >
                  <?php if(auth::user()->image): ?>
                  <img src="<?php echo e(asset('/folder/images/'.Auth::user()->image)); ?>" alt=""
                />

              <?php else: ?>
              <img src="<?php echo e(asset('/folder/images/2.png')); ?>" alt=""
                />
              <?php endif; ?>
            </span>
                <span class="arrow"><i class="icofont-angle-down"></i></span>
              </div>


              <div class="dropdown-menu dropdown-menu-right">
                <div class="user-email">
                  <div class="user">
                    

              

                    <div class="user-info">
                      <h5><?php echo e(Auth::user()->name); ?></h5>
                      <span><?php echo e(Auth::user()->email); ?></span>
                    </div>
                  </div>
                </div>

                
                <a href="/user/profile/<?php echo e(Auth::user()->id); ?>" class="dropdown-item">
                  <i class="bi bi-person"></i>Profile
                </a>
                
            <!--     <a href="/reports" class="dropdown-item">
                  <i class="bi bi-gear"></i> Setting
                </a> -->
               
               <a href="/user_reports" class="dropdown-item">
                  <i class="bi bi-gear"></i> Reports
                </a>
               
                

                <a class="dropdown-item logout" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-power"></i> <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>


              </div>
            </div>

            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/templates/header.blade.php ENDPATH**/ ?>