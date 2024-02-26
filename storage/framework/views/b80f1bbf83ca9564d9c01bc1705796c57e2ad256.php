<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<title>Medinformer Practitioner Portal</title>

<!-- Scripts -->

<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet"> 
<!-- Styles -->
<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
 
<?php echo $__env->make('templates.override', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<style type="text/css">

    @font-face {
font-family: 'Glyphicons Halflings';
src: url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.eot');  src: url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'), url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.woff') format('woff'), url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.ttf') format('truetype'), url('https://netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');



}

    .brochure_whatsapp_button {
  border: 0;
background-color: #54BE91;
color: #fff;
line-height: 36px;
padding: 0 15px;
font-size: 12px;
text-transform: uppercase;
font-weight: bold;
letter-spacing: 0.5px;
vertical-align: middle;
border-radius: 3px;
height: 36px;
opacity: 1;
text-shadow: 1px 1px 1px rgba(0,0,0,0.24);
}


.et_pb_button {
  padding: 10px;
  border: none;
  background: #000;
  color: #fff !important;
  border-radius: 4px;
}

.pass_show .ptxt {
  position: absolute;
  top: 50%;
  right: 10px;
  z-index: 1;
  color: #b9cdeb !important;
  margin-top: -10px;
  cursor: pointer;
  transition: .3s ease all;
}

</style>
<body class="dashboard" style="background: #fff;">
        <div id="main-wrapper">
            <div class="content-body" style="background: #fff !important;">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>



<script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts.js')); ?>"></script>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
 -->        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<!--         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 -->        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>


</body>
</html>
<?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/layouts/general.blade.php ENDPATH**/ ?>