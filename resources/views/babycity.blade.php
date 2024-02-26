@extends('layouts.external')
<style type="text/css">
  .border-bottom{
    border-bottom: 3px solid #3092F8;
  }

  .relative.z-0.inline-flex.shadow-sm.rounded-md {
  display: none;
}

.border-bottom {
  border-bottom: 1px solid #009CA6 !important;
}

.pb-0.mb-1, p {
  font-family: 'Archivo', sans-serif !important;
  font-size: 14.4px;
}

.bottom{
    background: #008b94 !important;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
    color: #fff !important;
}

.alt_top{
    background: #008b94 !important;
    border-radius: 10px;
    padding: 10px;
    margin-top: 10px;
    color: #fff !important;
}
</style>
@section('content')

    <div class="container py-50" style="background: #fff;">

      <div class="row align-items-center justify-content-between">
          <h1 class="page-title border-bottom" style="color: #009CA6; font-size: 25px; text-transform: uppercase;">Today's Featured Article</h1>
      </div>
      <div class="row mb-5 mt-3">
        <div class="col-md-9">
             @foreach($current_campaign as $campaign)
          <div class="row">
               <div class="col-md-5 col-sm-12 aos-init aos-animate" data-aos="fade-up">
          <div class="mt-30 mt-md-0">
            <img src="public/product/{{$campaign->image}}" class="img-fluid" style="border-radius: 10px;">
          </div>
        </div>



        <div class="col-md-5 col-sm-12 aos-init aos-animate mb-4" data-aos="fade-up">
          <div class="cpt-tx">

            <h3 >
              <a href="{{$campaign->link}}" style="color: #009CA6; font-size: 25px; text-transform: uppercase;">{{$campaign->title}}</a>
            </h3>


            <p>{{$campaign->content}}</p>
            <div class="mb-3 me-4 ms-lg-0 me-lg-4">
              <div class="d-flex align-items-center">
                <div class="rounded-circle bg-primary-light p-2 small d-flex align-items-center justify-content-center">
                <a href="{{$campaign->link}}" style="color: #009CA6; font-size: 15px; text-transform: uppercase;"> Read More</a>
                </div>
              </div>
            </div>
            
            
          </div>
        </div>
</div>
        @endforeach

          <div class="row">
              
           <div class=" ">
          <h1 class="page-title border-bottom"></h1>
      </div>

          @foreach($main_landing_brochures as $bro)



          <div class="col-lg-6 col-md-6 mt-3" >
                        <div class="single-blog" style="background: #fff;">
                            <div class="blog-image" style="">
                                <a href="{{$bro->link}}"><img src="public/product/{{$bro->image}}" alt="image" style="width: 100%; height: auto; border-radius: 10px;"></a>
                            </div>

                            <div class="blog-content">
                                
                                <h3>
                                   <a href="{{$bro->link}}<" style="color: #009CA6; font-size: 20px;">{{$bro->title}}</a>
                                </h3>
                                <p>{{$bro->content}}</p>
                                <a href="{{$bro->link}}" style="color: #009CA6; font-size: 15px; text-transform: uppercase;"> Read More</a>
                            </div>
                        </div>
                    </div>

          @endforeach

          
        </div>

        </div>
        <div class="col-md-3 text-center" style="background: #D4EEF0; height: 100%; border-radius: 10px;">
            
            <div class="alt_top">
               <a href="#brochure-search-page" style="text-align: center; text-transform: uppercase; color: #fff;">
                A-Z Conditions
            </a> 
            </div>
            
            <img src="/images/mannequin.png" style="width: 250px; margin-top: 10px; margin-bottom: 10px;">


            <div class="bottom">
                <a href="#brochure-search-page" type="button" style="text-align: center; text-transform: uppercase; color: #fff !important;">
                    Free Trusted Healthcare Information
                </a>

             </div>
        </div>

      </div>


   
      
      
    </div>




<div class="container">

   <div class="row ">
          <h1 class="page-title border-bottom"></h1>
      </div>

  <div class="row mt-3">

    @foreach($featured as $feature)
    <div class="col-lg-3 col-md-6" >
                        <div class="single-blog" style="background: #fff;">
                            <div class="blog-image">
                                <a href="{{$feature->link}}"><img src="public/product/{{$feature->image}}" alt="image" style="width: 100%; height: auto; border-radius: 10px;"></a>
                            </div>

                            <div class="blog-content">
                                
                                <h3>
                                   <a href="facebook.com" style="color: #009CA6; font-size: 20px;">{{$feature->title}}</a>
                                </h3>
                                <p>{{$feature->content}}</p>
                                <a href="{{$feature->link}}" style="color: #009CA6; font-size: 15px; text-transform: uppercase;"> Read More</a>
                            </div>
                        </div>
                    </div>
    @endforeach()

          


  </div>

  <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">
                                         {!! $featured->links() !!}

                        </div>
                    </div>

                    
</div>

<div id='brochure-search-page' class='container'>



                <div class='listing-group'>

                   

                    <style>
                      #s_525, #s_240, #s_485, #s_516{
                        display:  none;
                      }
                    </style>

    <div class='brochure-groups'>
            <?php 



            if( $result ) { 


              

                ?>    
                <div id="alphabetical-posts">
                  <?php $letters = array_keys($result); ?>
                  <?php if( $letters ) { ?>
                    <div class="letters-wrap mt-5 mb-5">
                      <ul class="letters">          
                        <?php foreach( $letters as $key => $letter ) { ?>
                          <li><a href="#goto-letter-<?php echo $letter; ?>"><?php echo $letter; ?></a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  <?php } ?>

                  <div class="brochure-groups">
                  <div class="posts row row-cols-lg-4 row-cols-md-2 row-cols-1 max-mb-n30">
                    <?php foreach( $result as $letter => $posts ) { ?>
                      <div id="goto-letter-<?php echo $letter; ?>" class="item">
                        <h3><?php echo $letter; ?></h3>
                        <div class="list brochure-items">
                          <?php foreach( $posts as $key => $post ) {  


                           
                            $display = "none";
                            $type = $post['meta'];
                            
                            if ($type == "postscript") {
                                $display = "none";
                            }else{
                                $display = "block"; 
                            }

                            ?>
                                
                                <div id="<?php echo $post['ID']; ?>" 
                                    class='col brochure-itemddd' style="display: <?php echo $display; ?>"><a href="https://www.babycity.co.za/health_subjects/<?php echo $post['slug']; ?> ">
                                        <?php echo $post['title']; ?> </a></div>
                          
                          <?php } ?>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                </div>
              <?php } ?>
            <!-- End -->
</div>






@endsection




