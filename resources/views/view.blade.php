<style>
  
  .alt_top {
  background: #00A049 !important;
  border-radius: 10px;
  padding: 10px;
  margin-top: 10px;
  color: #fff !important;
}
.bottom {
  background: #00A049 !important;
  border-radius: 10px;
  padding: 10px;
  margin-bottom: 10px;
  color: #fff !important;
}





.brochures.preview{
  max-width: 1400px !important;
  padding: 0px !important;
}

  .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
    position: relative;
    min-height: 1px;
    padding-left: 1px !important;
    padding-right: 1px !important;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }

.brochure-segment-content, .brochure-segment-content > div {
  line-height: 23px;
}

.alignnone.size-full {
  margin-top: 20px;
  margin-bottom: 20px;
}

.brochures.preview .brochure .brochure-segments .brochure-segment {
  display: inline-block;
  vertical-align: middle;
  width: 100%;
  margin-bottom: 20px;
}


.brochure_desc {
  text-align: justify;
  background: #F6F6F6;
  padding: 20px;
  color: #000;
  margin-bottom: 20px;
  box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 0.07) !important;
}

.brochures.preview .brochure .brochure-image img {
  width: 100%;
  display: block;
  margin-bottom: 50px;
}

@media screen and (min-width: 600px) {
 #mobile-share {
 visibility: hidden;
 clear: both;
 float: left;
 margin: 10px auto 5px 20px;
 width: 28%;
 display: none;
 }
}

.columns {
  display: -webkit-flex;
  display: -ms-flexbox;
  display: block;
  -webkit-flex-wrap: wrap;
  flex-wrap: wrap;
  box-sizing: border-box;
}


</style>

  <div class="brochures preview" id="top">
    <div class="brochure">
      <div class="brochure-title" >
        <h1>{{$result["title"]}}</h1>
      </div>
      <div class="brochure-details">
        <div class="brochure-head">
          <div class="brochure-media">
            <div class="brochure-image mb-3">
            <img src='{{ $result["image"]}}'>
            </div>
          </div>
        </div>
         <div id='brochure-segments' class='brochure-segments'>
        <div class='brochure-segment' style='background-color:#FFFFFF'>


          @if($data)
          <div class='brochure-segment-image full'>
            <img src='{{ $data }}' >
          </div>
          @endif
          @if($result["post_content"])
          <div class="brochure_desc" >
          {{$result["post_content"]}}
        </div>

        @endif


        </div>

       
      @if($result->acf->segments)
      @foreach($result->acf->segments as $segments)
        <div id='overview' class='brochure-segment' style='background-color:#FFFFFF'>
          <div class='listview_1_of_2 images_1_of_2'>
            @if(!empty($segments["title"]))
             <div class='listimg listimg_2_of_1'>
              <div class='brochure-segment-icon'>
                <i class='fas fa-info-circle' style='color: #1e78a9 !important;'></i>
              </div>
            </div>

              @endif
           
            <div class='text list_2_of_1'>

              @if(!empty($segments["title"]))
              <div class='brochure-segment-title'>
                <a href='#top' class='backTOP'>Back to top</a>
                <h2>
             
                   {{ strip_tags($segments["title"]) }} 
                </h2>
              </div>
              @endif
              <div class='brochure-segment-content'>
                  {{$segments["content"]}}
              </div>
            </div>
          </div>
        </div>
       
      @endforeach
     
        @endif
      </div>
      </div>
          <div class='brochure-buttons' style="margin-top: 50px;">

            @if($downloadable_pdfdocuments)
      <a href='{{$downloadable_pdfdocuments}}' class='brochure-button pdfdownload' target='_blank'>
        <span class='brochure-button-icon'>
          <svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='cloud-download-alt' class='svg-inline--fa fa-cloud-download-alt fa-w-20' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 512'>
            <path fill='currentColor' d='M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zm-132.9 88.7L299.3 420.7c-6.2 6.2-16.4 6.2-22.6 0L171.3 315.3c-10.1-10.1-2.9-27.3 11.3-27.3H248V176c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v112h65.4c14.2 0 21.4 17.2 11.3 27.3z'></path>
          </svg>
        </span>
        <span class='brochure-button-text'>Download PDF</span>
      </a>

      @endif
      <a href='#' class='brochure-button mreferences' data-toggle='collapse' data-target='#medical-references'>
        <span class='brochure-button-icon'>
          <svg aria-hidden='true' focusable='false' data-prefix='far' data-icon='plus' class='svg-inline--fa fa-plus fa-w-12' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 512'>
            <path fill='currentColor' d='M368 224H224V80c0-8.84-7.16-16-16-16h-32c-8.84 0-16 7.16-16 16v144H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h144v144c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V288h144c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z'></path>
          </svg>
        </span>
        <span class='brochure-button-text'>Medical References</span>
      </a>
    </div>
    <div id='medical-references' class='brochure-medical-references collapse'>
      <h2>Medical References <div class='brochure-medical-references-close'>
          <svg aria-hidden='true' focusable='false' data-prefix='fal' data-icon='times' class='svg-inline--fa fa-times fa-w-10' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'>
            <path fill='currentColor' d='M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z'></path>
          </svg>
        </div>
      </h2>
     
     {{$result->acf->medical_references}}
      

    </div>
      <div class="related-brochures" style="margin-top: 50px; display: none; ">
        <h2>Related Brochures</h2>
        <div class="related-brochures-container">


          <a href="https://www.dischem.co.za/articles/post/diabetes-managing-and-preventing-long-term-complications" class="related-brochure" target="_blank">
            <div class="related-image" style="background-image: url( https://datacenter.medinformer.co.za/images/brochures/diabetes---managing-and-preventing-long-term-complications.jpg )"></div>
            <div class="related-details">
              <h3 class="related-title">Diabetes - Managing and preventing long-term complications</h3>
              <div class="related-desc">Sticking to your treatment plan is the best way to avoid the long-term health complications associated with diabetes.</div>
            </div>
          </a>
         
        </div>
      </div>
    </div>
    <div class="brochure-sidebar">
     
    <div class='manikin-intro'>
      <div class="text-center" style="background: #D4EEF0; height: 100%; border-radius: 10px; padding: 10px;">
            <a href="https://www.dischem.co.za/health-conditions-a-z">
            </a><div class="alt_top"><a href="https://www.dischem.co.za/health-conditions-a-z/#brochure-search-page">
               </a><a href="#brochure-search-page" style="text-align: center; text-transform: uppercase; color: #fff; font-weight: 600;">
                A-Z Conditions
            </a> 
            </div>
            <a href="https://www.dischem.co.za/health-conditions-a-z/#brochure-search-page" style="text-align: center; text-transform: uppercase; color: #fff;">
            <img src="https://medinformer.co.za/wp-content/uploads/2023/03/family-1024x1024.png.webp" style="width: 250px; margin-top: 10px; margin-bottom: -5px;">
        </a>
  


<style type="text/css">
  .wp
    {
        width: 100%;
        margin-top: 5px;

    }
.wpbtn
    {
       
        border: none;
        background-color:white;
    }

</style>
            <div class="bottom">
                <a href="https://www.dischem.co.za/health-conditions-a-z/#brochure-search-page" type="button" style="text-align: center; text-transform: uppercase; color: #fff !important; font-weight: 600;">
                    Free Trusted Healthcare Information
                </a>

             </div>
         
        </div>


        <style>
      

          .wp_ {
  width: 40px;
  margin-top: 16px;
}

.wha_a {
  padding-top: 10px;
  color: #fff;
  margin-bottom: 10px;
  font-size: 14px;
  text-transform: uppercase;
}

.wp_ {
  width: 100%;
  margin-top: 16px;
  max-width: 5%;
}

.share_whatsapp {
  
  margin-top: 10px;
  border-radius: 4px;
}
.wha_a {
  padding: 7px;
  color: #fff;
  margin-bottom: 18px;
  float: ;
  font-size: 14px;
  text-transform: uppercase;
  line-height: 23px;
}
.whatsapp-button {
  display: inline-flex;
  justify-content: flex-start;
  align-items: center;
  padding: 12px 20px;
  background: #00A049;
  text-align: left;
  text-decoration: none;
  font-family: sans-serif;
  font-size: 16px;
  line-height: 20px;
  border-radius: 12px;
  box-shadow: rgba(255, 255, 255, 0.25) 0 0 0 3px inset;
  transition: 0.3s ease-out;
}
.whatsapp-button, .whatsapp-button:hover, .whatsapp-button:focus, .whatsapp-button:active {
  color: #fff;
  text-decoration: none;
}
.whatsapp-button:hover, .whatsapp-button:focus {
  background: #22bf5b;
}
.whatsapp-button:focus {
  outline: none;
}
.whatsapp-button:active {
  background: #1ea951;
  transition: none;
}
.whatsapp-button p {
  margin: 0;
}
.whatsapp-button span {
  display: block;
  font-size: 14px;
  line-height: 18px;
}
.whatsapp-button strong {
  display: block;
  font-weight: 700;
}
.whatsapp-button svg {
  width: 36px;
  height: 36px;
  fill: currentcolor;
  flex-shrink: 0;
  margin-right: 8px;
}

.whatsapp-button span {
  display: block;
  font-size: 14px;
  line-height: 18px;
  text-transform: uppercase;
  font-family: 'Montserrat','Helvetica Neue',Helvetica,Arial,sans-serif;
  font-weight: 500;
}


        </style>
        <div class="share_whatsapp">

        <a class="whatsapp-button" onclick="window.open('whatsapp://send?text=Hi I thought you might find this usefull https://www.dischem.co.za/articles/post/{{$slug}}')" >
  <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
    <path d="M.057,22,1.6,16.351a10.9,10.9,0,1,1,4.233,4.133L.057,22ZM6.1,18.51A9.04,9.04,0,1,0,3.59,16.066L2.674,19.41l3.43-.9ZM16.542,13.5c-.068-.114-.249-.182-.522-.318s-1.612-.8-1.862-.886-.431-.137-.613.137-.7.886-.863,1.068-.318.2-.59.068A7.435,7.435,0,0,1,9.9,12.217,8.2,8.2,0,0,1,8.386,10.33c-.159-.272-.017-.42.119-.556s.272-.318.409-.478a1.787,1.787,0,0,0,.275-.454.5.5,0,0,0-.023-.478c-.069-.136-.613-1.477-.84-2.022s-.446-.459-.613-.468l-.523-.009a1,1,0,0,0-.726.341A3.057,3.057,0,0,0,5.511,8.48,5.3,5.3,0,0,0,6.623,11.3a12.145,12.145,0,0,0,4.653,4.113,15.762,15.762,0,0,0,1.553.574,3.744,3.744,0,0,0,1.716.108,2.806,2.806,0,0,0,1.839-1.3,2.269,2.269,0,0,0,.159-1.3Z"/>
  </svg>
  <p>
    <span>Click here to share this brochure on whatsapp.</span>
  </p>
</a>
</div>
 </div>


    @if($result->acf->related_articles)
          @foreach($result->acf->related_articles as $related_article)
    <a href='https://www.dischem.co.za/articles/post/<?php echo $related_article['slug']; ?> ' class='recent-brochure'>
      <div class='recent-image'>
        <img src='<?php echo $related_article['image']; ?>' width='100%'>
      </div>
      <div class='recent-details'>
        <h3 class='recent-title'>{{$related_article->post_title}}</h3>
       
      </div>
    </a>
            @endforeach

    @endif
    </div>

  </div>
  </div>
