<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="iframely:title" content="Medinformer" />
<meta property="iframely:description" content="Medinformer Free Medical Information" />
<meta property="iframely:image" content="https://medinformer.co.za/wp-content/uploads/2022/08/restlessness-teething-in-babies.jpg.webp" />
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

.blog-area {
  position: relative;
  z-index: 1;
  overflow: hidden;
}

.single-blog {
  -webkit-transition: 0.6s;
  transition: 0.6s;
  margin-bottom: 30px;
}

.single-blog .blog-content {
  margin-top: 30px;
}

.single-blog .blog-content .entry-meta {
  padding-left: 0;
  margin-bottom: 0;
}

.single-blog .blog-content .entry-meta .tag {
  display: inline-block;
  background-color: #EAF0FF;
  color: #0064FB;
  font-size: 14px;
  font-weight: 500;
  padding: 5px 15px;
  border-radius: 5px;
  -webkit-transition: 0.6s;
  transition: 0.6s;
}

.single-blog .blog-content .entry-meta .tag:hover {
  background-color: #0064FB;
  color: #ffffff;
}

.single-blog .blog-content .entry-meta li {
  list-style-type: none;
  display: inline-block;
  color: #79798D;
  font-size: 14px;
  font-weight: 400;
  margin-right: 15px;
  position: relative;
  padding-left: 18px;
}

.single-blog .blog-content .entry-meta li:last-child {
  margin-right: 0;
}

.single-blog .blog-content .entry-meta li i {
  position: absolute;
  left: 0;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  color: #36CC72;
  font-size: 14px;
}

.single-blog .blog-content h3 {
  font-size: 22px;
  margin-top: 20px;
  margin-bottom: 15px;
  line-height: 1.5;
}

.single-blog .blog-content h3 a {
  color: #2E2F46;
}

.single-blog .blog-content .blog-btn {
  font-size: 16px;
  font-weight: 500;
  position: relative;
  -webkit-transition: 0.6s;
  transition: 0.6s;
}

.single-blog .blog-content .blog-btn i {
  position: absolute;
  right: -20px;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  font-size: 15px;
}

.single-blog:hover .blog-content h3 a {
  color: #0064FB;
}

.single-blog:hover .blog-content .blog-btn {
  letter-spacing: 1px;
}

.single-blog-standard {
  margin-bottom: 30px;
}

.single-blog-standard .blog-image {
  overflow: hidden;
}

.single-blog-standard .blog-image img {
  -webkit-transition: 0.6s;
  transition: 0.6s;
}

.single-blog-standard .blog-content {
  margin-top: 30px;
}

.single-blog-standard .blog-content .entry-meta {
  padding-left: 0;
  margin-bottom: 0;
}

.single-blog-standard .blog-content .entry-meta .tag {
  display: inline-block;
  background-color: #EAF0FF;
  color: #0064FB;
  font-size: 14px;
  font-weight: 500;
  padding: 5px 15px;
  border-radius: 5px;
  -webkit-transition: 0.6s;
  transition: 0.6s;
}

.single-blog-standard .blog-content .entry-meta .tag:hover {
  background-color: #0064FB;
  color: #ffffff;
}

.single-blog-standard .blog-content .entry-meta li {
  list-style-type: none;
  display: inline-block;
  color: #79798D;
  font-size: 14px;
  font-weight: 400;
  margin-right: 15px;
  position: relative;
  padding-left: 18px;
}

.single-blog-standard .blog-content .entry-meta li:last-child {
  margin-right: 0;
}

.single-blog-standard .blog-content .entry-meta li i {
  position: absolute;
  left: 0;
  top: 50%;
  -webkit-transform: translateY(-50%);
          transform: translateY(-50%);
  color: #36CC72;
  font-size: 14px;
}

.single-blog-standard .blog-content h3 {
  font-size: 28px;
  margin-top: 20px;
  margin-bottom: 15px;
  line-height: 1.5;
}

.single-blog-standard .blog-content h3 a {
  color: #2E2F46;
}

.single-blog-standard .blog-content p {
  margin-bottom: 30px;
}

.single-blog-standard .blog-content .default-btn {
  background-color: transparent;
  border: 1px solid #0064FB;
  color: #494A60;
}

.single-blog-standard .blog-content .default-btn:hover {
  border: 1px solid #FF414B;
  color: #ffffff;
}

.single-blog-standard:hover .blog-image img {
  -webkit-transform: scale(1.1);
          transform: scale(1.1);
}

.single-blog-standard:hover .blog-content h3 a {
  color: #0064FB;
}

.blog-shape-1 {
  position: absolute;
  top: 10%;
  right: 2%;
  -webkit-transform: translateY(-10%) translateX(-2%);
          transform: translateY(-10%) translateX(-2%);
}

.blog-shape-2 {
  position: absolute;
  top: 10%;
  left: 2%;
  -webkit-transform: translateY(-10%) translateX(-2%);
          transform: translateY(-10%) translateX(-2%);
}

/*================================================
Pagination CSS
=================================================*/
.pagination-area {
  margin-top: 20px;
  text-align: center;
}

.pagination-area .page-numbers {
  width: 40px;
  height: 40px;
  background-color: #EAF0FF;
  border: 1px solid #EAF0FF;
  color: #79798D;
  text-align: center;
  display: inline-block;
  border-radius: 5px;
  line-height: 40px;
  position: relative;
  margin-left: 2px;
  margin-right: 2px;
  font-size: 16px;
  font-weight: 500;
}

.pagination-area .page-numbers:hover, .pagination-area .page-numbers.current {
  color: #0064FB;
  background-color: #ffffff;
  border: 1px solid #0064FB;
}

.pagination-area .page-numbers i {
  position: relative;
  top: 1.5px;
}



</style>
<body class="" style="background: #fff;">
        <div id="main-wrapper">
            <div  style="background: #fff !important;">
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
<?php /**PATH /srv/users/practitionernew/apps/practitionernew/resources/views/layouts/external.blade.php ENDPATH**/ ?>