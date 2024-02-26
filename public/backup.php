<?php

@ini_set( 'upload_max_size' , '256M' );
@ini_set( 'post_max_size', '256M');
@ini_set( 'max_execution_time', '300' );
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
    
add_shortcode( 'supporters', 'supporters_func' );
    function supporters_func( $atts ) {
    ob_start(); ?>
<style>
        /*****************************************************************
	A-Z Filter
******************************************************************/

#title-status {
	float: left;
	width: 100%;
}
	#title-status p {
		float: left;
		width: 50%;
		margin-bottom: 15px;
		font-size: 16px;
	}
		#title-status span {
			font-weight: bold;
			text-transform: uppercase;
		}
	#title-status p:last-child {
		text-align: right;
		text-decoration: underline;
		color: #de466c;
		cursor: pointer;
	}

#a-z {
	float: left;
    width: 100%;
	margin-bottom: 25px;
	display: flex;
	flex-direction: row;
}
ul#a-z li {
  flex-grow: 1;
  padding: 7px;
  text-align: center;
  background: aliceblue;
  color: #00314D;
  text-transform: uppercase;
  border-left: 0px solid #fff;
  font-size: 15px;
  list-style: none;
  font-family: Archivo;
}

ul#a-z li.active {
  background: transparent;
  cursor: pointer;
}

ul#a-z li.current {
  background: #00314D;
  color: #fff;
}
#posts-results {
}
	#posts-results li {
		display: none;
	}
	#posts-results li.show {
		display: block;
	}
	#posts-results a {
		border-bottom: 1px solid #ccc;
		display: block;
		padding: 10px 0;
	}
  
#title-status p {
  float: left;
  width: 50%;
  margin-bottom: 15px;
  font-size: 16px;
  padding-left: 41px;
  font-family: Archivo;
}
#posts-results a {
  border-bottom: none;
  display: block;
  padding: 10px 0;
}

#posts-results a {
  border-bottom: none;
  display: block;
  padding: 10px 0;
  font-family: Archivo;
  font-size: 14px;
  color: #00314D;
}
        </style>
            
            
<script>
jQuery(document).ready(function()
{	
	"use strict";
	
	let initial_first_letter = jQuery('#a-z li.active:eq(0)').data('letter');
	let click_first_char;
	let title_showing = jQuery('#title-status span');
	let az_li = jQuery('#a-z li');
	let title_show_all = jQuery('p#show-all');
	let posts_results_li = jQuery("#posts-results li");
	
	// Initial load
	jQuery("#posts-results li[data-letter="+initial_first_letter+"]").addClass('show');
	jQuery('az_li:eq(0)').addClass('current');
	title_showing.text(initial_first_letter);
	
	// Click A-Z menu item
	jQuery('#a-z li.active').click(function()
	{
		jQuery("#posts-results li").removeClass('show');
		click_first_char = jQuery(this).data('letter');
		jQuery('#a-z li.active').removeClass('current');
		title_showing.text(click_first_char);
		title_show_all.show();
		jQuery(this).addClass('current');
		jQuery("#posts-results li[data-letter="+click_first_char+"]").addClass('show');
	});
	
	// Show all posts
	title_show_all.click(function()
	{
		posts_results_li.addClass('show');
		title_showing.text('all');
		az_li.removeClass('current');
		jQuery(this).hide(); 
	}); 

});

            
          </script>
   <div id="main-area">
		<div class="wrapper">
			<div <?php post_class(); ?>>
			
			<?php 
			$filter_args = array
			(
				'post_type' => 'supporters',
				'posts_per_page' => -1,
				'category_name' => 'all-suporters',
			);
			$tutorial_posts = new WP_Query($filter_args);
			$posts_array = array();

			// Get all posts
			while ( $tutorial_posts->have_posts() ) : $tutorial_posts->the_post(); 
				$posts_array[] = strtolower(get_the_title()[0]);
			endwhile; ?>
				
				
			<?php // ?>
			<ul id="a-z">
				<?php 
				$alphabet_array = range('a', 'z');
				$number_array = range(0, 9); 
				//$build_li = '';
				
				// Check if number
				if(count(array_intersect($posts_array, $number_array)) > 0){
					echo "<li class=\"active\" data-letter=\"#\">#</li>";
				}
				else 
				{
					echo "<li data-letter=\"#\">#</li>";
				}
				//echo "<li $build_li>" . '#' . '</li>';
				
				foreach ($alphabet_array as $letter)
				{
					if (in_array($letter, $posts_array)) 
					{	
						echo "<li class=\"active\" data-letter=".$letter.">$letter</li>";
					}
					else 
					{
						echo "<li data-letter=".$letter.">$letter</li>";
					}
				} 
				?>
			</ul>
				
			<div id="title-status">
				<p class="current_show">Showing: <span></span></p>
				<p id="show-all" class="show_all">Show all posts</p>
			</div>
				
			<?php 
			$i = -1;
			?>
				
			<ul id="posts-results">
			<?php while ( $tutorial_posts->have_posts() ) : $tutorial_posts->the_post(); 
				$i++;
				
				if(is_numeric($posts_array[$i])) 
				{
					echo "<li data-letter=\"#\">";
						echo "<a href=".get_the_permalink().">";
							echo get_the_title();
						echo "</a>";
					echo "</li>";
				}
				else 
				{
					echo "<li data-letter=".$posts_array[$i].">";
						echo "<a href=".get_the_permalink().">";
							echo get_the_title();
						echo "</a>";
					echo "</li>";
				} ?>
				
			<?php endwhile; ?>
			</ul>
			 
			</div>
			
		</div>
	</div>



<?php 
  return ob_get_clean();
}
add_shortcode( 'supporters', 'supporters_func' );

add_shortcode( 'timeline', 'timeline_func' );
    function timeline_func( $atts ) {
    ob_start(); ?>
<style>
    h4 {
  font-family: noto-sans-display-condensed,sans-serif;
  font-weight: 600;
  font-style: normal;
  font-size: 24px;
  line-height: 2rem;
}
 p {
  font-family: noto-serif,serif;
  font-weight: 400;
  font-size: 16px;
  line-height: 1.625em;
} 
  
.year::after {

    width: 24px;
    height: 24px;
    z-index: 1;
    top: 28px;
    background: url('https://www.globaldairyplatform.com/images/circle-slider.svg') no-repeat 50%/contain;

}
    .year {
 font-family:noto-sans-display-condensed,sans-serif;
 font-weight:600;
 font-style:normal;
 font-size:20px;
 position:absolute;
 left:85px;
 top:0;
 -webkit-transform:translateX(-50%);
 -moz-transform:translateX(-50%);
 -ms-transform:translateX(-50%);
 -o-transform:translateX(-50%);
 transform:translateX(-50%)
}
.year:before {
 width:2px;
 background:#fff;
 height:23px;
 top:47px
}
.year:after,
.year:before {
 content:"";
 position:absolute;
 left:50%;
 -webkit-transform:translateX(-50%);
 -moz-transform:translateX(-50%);
 -ms-transform:translateX(-50%);
 -o-transform:translateX(-50%);
 transform:translateX(-50%)
}
.year:after {
 width:24px;
 height:24px;
 z-index:1;
 top:28px;
background: url('https://www.globaldairyplatform.com/images/circle-slider.svg') no-repeat 50%/contain;
}  
        
        .swiper-container-cube .swiper-slide .swiper-slide {
 pointer-events:none
}
.swiper-container-cube.swiper-container-rtl .swiper-slide {
 -webkit-transform-origin:100% 0;
 -moz-transform-origin:100% 0;
 -ms-transform-origin:100% 0;
 -o-transform-origin:100% 0;
 transform-origin:100% 0
}
.swiper-container-cube .swiper-slide-active,
.swiper-container-cube .swiper-slide-active .swiper-slide-active {
 pointer-events:auto
}
.swiper-container-cube .swiper-slide-active,
.swiper-container-cube .swiper-slide-next,
.swiper-container-cube .swiper-slide-next+.swiper-slide,
.swiper-container-cube .swiper-slide-prev {
 pointer-events:auto;
 visibility:visible
}
.swiper-container-cube .swiper-slide-shadow-bottom,
.swiper-container-cube .swiper-slide-shadow-left,
.swiper-container-cube .swiper-slide-shadow-right,
.swiper-container-cube .swiper-slide-shadow-top {
 z-index:0;
 -webkit-backface-visibility:hidden;
 -moz-backface-visibility:hidden;
 backface-visibility:hidden
}
.swiper-container-cube .swiper-cube-shadow {
 position:absolute;
 left:0;
 bottom:0;
 width:100%;
 height:100%;
 opacity:.6;
 z-index:0
}
.swiper-container-cube .swiper-cube-shadow:before {
 content:"";
 background:#000;
 position:absolute;
 left:0;
 top:0;
 bottom:0;
 right:0;
 -webkit-filter:blur(50px);
 filter:blur(50px)
}
.swiper-container-flip {
 overflow:visible
}
.swiper-container-flip .swiper-slide {
 pointer-events:none;
 -webkit-backface-visibility:hidden;
 -moz-backface-visibility:hidden;
 backface-visibility:hidden;
 z-index:1
}
.swiper-container-flip .swiper-slide .swiper-slide {
 pointer-events:none
}
.swiper-container-flip .swiper-slide-active,
.swiper-container-flip .swiper-slide-active .swiper-slide-active {
 pointer-events:auto
}
.swiper-container-flip .swiper-slide-shadow-bottom,
.swiper-container-flip .swiper-slide-shadow-left,
.swiper-container-flip .swiper-slide-shadow-right,
.swiper-container-flip .swiper-slide-shadow-top {
 z-index:0;
 -webkit-backface-visibility:hidden;
 -moz-backface-visibility:hidden;
 backface-visibility:hidden
}
.swiper-container {
 width:100%;
 height:100%;
 position:relative;
 padding-bottom:50px;
 z-index:0
}
@media only screen and (min-width:1025px) {
 .swiper-container {
  cursor:url(../images/slider-icon.svg),auto;
 }
}
.timeline {
 position:relative
}
.timeline .swiper-button-next {
 color:#00314d;
 top:90%;
 z-index:0
}
@media only screen and (min-width:768px) {
 .timeline .swiper-button-next {
  top:95%
 }
}
@media only screen and (min-width:1317px) {
 .timeline .swiper-button-next {
  right:-50px;
  top:50%
 }
}
.timeline .swiper-button-prev {
 color:#00314d;
 top:90%;
 z-index:0
}
@media only screen and (min-width:768px) {
 .timeline .swiper-button-prev {
  top:95%
 }
}
@media only screen and (min-width:1317px) {
 .timeline .swiper-button-prev {
  left:-50px;
  top:50%
 }
}
.swiper-slide {
 position:relative
}
.swiper-slide:before {
 content:"";
 width:-webkit-calc(100% + 50px);
 width:-moz-calc(100% + 50px);
 width:calc(100% + 50px);
 height:1px;
 border:1px dashed #fff;
 position:absolute;
 top:40px;
 left:85px
}
.swiper-slide:last-of-type:before {
 content:none
}
.swiper-slide>div {
 display:-webkit-box;
 display:-webkit-flex;
 display:-moz-box;
 display:-ms-flexbox;
 display:flex;
 -webkit-box-pack:justify;
 -webkit-justify-content:space-between;
 -moz-box-pack:justify;
 -ms-flex-pack:justify;
 justify-content:space-between;
 -webkit-box-align:start;
 -webkit-align-items:flex-start;
 -moz-box-align:start;
 -ms-flex-align:start;
 align-items:flex-start;
 position:relative;
 padding-top:70px
}
@media only screen and (max-width:767px) {
 .swiper-slide>div {
  -webkit-flex-wrap:wrap;
  -ms-flex-wrap:wrap;
  flex-wrap:wrap
 }
 .swiper-slide>div h4 {
  margin-top:60px
 }
}
.swiper-slide img {
 width:170px;
 margin-right:24px
}
.swiper-pagination-progressbar {
 height:6px!important;
 background:#fff;
 -webkit-border-radius:8px;
 -moz-border-radius:8px;
 border-radius:8px;
 top:auto!important;
 bottom:0
}
.swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
 background:#00314d;
 -webkit-border-radius:8px!important;
 -moz-border-radius:8px!important;
 border-radius:8px!important
}
</style>
   <section class="slider phase2" id="sect-2">

     
        <div class="row timeline">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-container mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div>
                            <span class="year">2014</span>
                            <img src="https://www.globaldairyplatform.com/images/slide-1.jpg" alt="Dairy Sustainability Framework established"/>
                            <div>
                                <h4>Dairy Sustainability Framework established</h4>
                                <p>
                                    Creating global, overarching goals to align the sector’s actions towards
                                    sustainability, and enabling annual reporting of progress, which began in 2018.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <span class="year">2016</span>
                            <img src="https://www.globaldairyplatform.com/images/slide-2.jpg" alt="Dairy Declaration signed in Rotterdam"/>
                            <div>
                                <h4>
                                    Dairy Declaration signed in Rotterdam
                                </h4>
                                <p>
                                    A commitment to the sustainable development of the dairy sector across six key
                                    areas, formalized at the World Dairy Summit.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <span class="year">2019</span>
                            <img src="https://www.globaldairyplatform.com/images/slide-2019.jpg"
                                 alt="FAO Global Climate Change and Global Dairy Cattle Sector Study"/>
                            <div>
                                <h4>
                                    FAO Global Climate Change and Global Dairy Cattle Sector Study
                                </h4>
                                <p>
                                    Analysis from 2005-2015 showed a reduction in greenhouse gas emission intensity
                                    based on efficiency improvements made by the sector.<sup>1</sup>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <span class="year">July 2021</span>
                            <img src="https://www.globaldairyplatform.com/images/july-2021.jpg"
                                 alt="Announcement  at the United Nations Food Systems Pre-Summit "/>
                            <div>
                                <h4>
                                    Announcement at the United Nations Food Systems Pre-Summit
                                </h4>
                                <p>
                                    New Pathways to Dairy Net Zero initiative announced on July 26, 2021.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <span class="year">September 2021</span>
                            <img src="https://www.globaldairyplatform.com/images/sept-2021-new.png"
                                 alt="Launch at United Nations Food Systems Summit launched on September 22, 2021"/>
                            <div>
                                <h4>
                                    Launch of Pathways to Dairy Net Zero at United Nations Food Systems Summit and
                                    Climate Week
                                </h4>
                                <p>
                                    Initiative launched on September 22, 2021.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div>
                            <span class="year">November 2021</span>
                            <img src="https://www.globaldairyplatform.com/images/nov-2021.jpg" alt="Sharing progress and driving change at COP26"/>
                            <div>
                                <h4>
                                    Sharing progress and driving change at COP26
                                </h4>
                                <p>
                                    During the United Nations Climate Change Conference, the global dairy sector
                                    encouraged climate commitments and demonstrated progress already being made.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
        
    </section> 
<?php 
  return ob_get_clean();
}
add_shortcode( 'timeline', 'timeline_func' );


add_shortcode( 'download', 'download_func' );
    function download_func( $atts ) {
    ob_start(); ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

        
        <style>
        .cta,
form input[type=submit] {
 font-family:noto-sans-display-extraconde,sans-serif;
 font-weight:900;
 font-style:normal;
 display:table;
 font-size:16px;
 line-height:1em;
 -webkit-border-radius:25px;
 -moz-border-radius:25px;
 border-radius:25px;
 padding:10px 60px;
 text-transform:uppercase;
 cursor:pointer;
 background:#24e7d4;
 color:#00314d;
 -webkit-transition:.3s;
 -o-transition:.3s;
 -moz-transition:.3s;
 transition:.3s
}
.cta:hover,
form input:hover[type=submit] {
 background:#28d0bf;
 color:#00314d;
 text-decoration:none
}
.cta:active,
form input:active[type=submit] {
 background:#1fb2a3;
 color:#00314d
}
.cta.dark,
form input[type=submit] {
 background:#08314d;
 color:#24e7d4
}
.cta.dark:hover,
form input:hover[type=submit] {
 background:#011d2e;
 color:#24e7d4
}
.cta.dark:active,
form input:active[type=submit] {
 background:#01090d;
 color:#24e7d4
}
        .be-part-of {
 background-color:#00314d;
 padding:8vw 0
}
.be-part-of h4 {
 color:#fff
}
.be-part-of h4 {
  color: #fff;
  margin-top: 20%;
}
.be-part-of .cta,
.be-part-of form input[type=submit],
form .be-part-of input[type=submit] {
 margin-top:25px
}
.be-part-of img {
 position:relative;
 width:auto;
 z-index:9;
 margin-top:-10vw;
 padding-right:50px
}
@media only screen and (max-width:767px) {
 .be-part-of img {
  padding-right:0;
  padding-bottom:50px;
  display:-webkit-box;
  display:-webkit-flex;
  display:-moz-box;
  display:-ms-flexbox;
  display:flex;
  margin:auto
 }
}
        
        .shape {
 position:absolute;
 bottom:-1px;
 left:0;
 width:100%
}
.shape.reverse {
 bottom:auto;
 top:-1px;
 -webkit-transform:rotate(180deg);
 -moz-transform:rotate(180deg);
 -ms-transform:rotate(180deg);
 -o-transform:rotate(180deg);
 transform:rotate(180deg)
}
        
.be-part-of h4 {
  color: #fff;
  margin-top: 20%;
  font-size: 32px !important;
  line-height: 41px;
}
        </style>
    <div class="be-part-of">
    <div class="container-fluid-small">
        <div class="row">
            <svg class="shape reverse" viewBox="0 0 1280.773 237.223">
                <path d="M0 145.106s253.288 62.788 619.516-47.46S1280.774.481 1280.774.481v236.741H0Z" fill="#ffffff"></path>
            </svg>
            <div class="col-6">
                <img class="animated-book" src="https://www.globaldairyplatform.com/images/Supporter-Pack-A4-Mockup_V2.png" alt="Discover more about Pathways to Dairy Net Zero and how you can be a part of it" style="transform: translate3d(0px, 5.64px, 0px);">
            </div>
            <div class="col-6">
                <h4 style="24px !important;">
                    Discover more about Pathways to Dairy Net</br> Zero and how you can be a part of it.
                </h4>
                <a href="/pdfs/Pathways_to_Dairy Net Zero_Guide_to_the_initiative.pdf" class="cta" target="_blank">
                    Download the guide
                </a>
            </div>

            <svg class="shape" viewBox="0 0 1280.773 237.223">
                <path d="M0 145.106s253.288 62.788 619.516-47.46S1280.774.481 1280.774.481v236.741H0Z" fill="#24E7D4"></path>
            </svg>
        </div>
    </div>
        </div>
        <?php 
  return ob_get_clean();
}
add_shortcode( 'download', 'download_func' );

add_shortcode( 'the_form', 'the_form_func' );
    function the_form_func( $atts ) {
    ob_start(); ?>
    <div id="message">
                    <form action="/mail-script.php" method="post" id="joinform">
                        <div class="form-group">
                            <label for="support">Our organization supports Pathways to Dairy Net Zero by: *</label>
                            <input type="checkbox" name="support[]"
                                   value="Taking direct action on GHG mitigation as an implementer">Taking direct action
                            on GHG mitigation as an implementer<br/>
                            <input type="checkbox" name="support[]" value="Promoting its principles as a supporter">Promoting
                            its principles as a supporter<br/>
                        </div>
                        <div class="form-group">
                            <label for="name">Name: *</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="job-ttle">Job title: *</label>
                            <input type="text" class="form-control" id="job-title" placeholder="Job Title"
                                   name="job-title">
                        </div>
                        <div class="form-group">
                            <label for="email">Email address: *</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your email"
                                   name="email">
                        </div>
                        <div class="form-group">
                            <label for="organisation">Organization: *</label>
                            <input type="text" class="form-control" id="organisation" placeholder="Enter organization"
                                   name="organisation">
                        </div>
                        <div class="form-group">
                            <label for="contry">Country/Region: *</label>
                            <input type="text" class="form-control" id="contry" placeholder="Enter country"
                                   name="contry">
                        </div>
                        <div class="form-group">
                            <label for="iam">Organization type: *</label>
                            <input type="radio" name="iam" value="Dairy Farmer">Dairy farmer<br/>
                            <input type="radio" name="iam"
                                   value="Part of an organisation representing the dairy community">Part of an
                            organization representing the dairy community<br/>
                            <input type="radio" name="iam" value="Dairy Company/ Processor">Dairy company/processor<br/>
                            <input type="radio" name="iam" value="Other (please specify)">Other (please specify)<br/>
                        </div>
                        <div class="form-group">
                            <label for="other" class="hide">Other:</label>
                            <input type="text" class="form-control" id="other" placeholder="Enter other" name="other">
                        </div>
                        <div class="form-group gdpr">
                            <input type="checkbox" name="gdpr"
                                   value="I agree to be contacted by Pathways to Dairy Net Zero via email"><span>I agree to be contacted by Pathways to Dairy Net Zero via email *</span>
                            <br/>
                            <p>
                                We take all reasonable precautions to prevent loss, misuse, alteration or disclosure of
                                your personally identifiable information and maintain full compliance with the law
                                according to our privacy policy available at www.globaldairyplatform.com. You can
                                unsubscribe from the mailing list at any time with just one click in the email footer.
                            </p>
                            <p>
                                <strong>As a supporter of Pathways to Dairy Net Zero, you’ll receive a guide and
                                    materials to help mark your commitment, spread the word, and ﬁnd out how you can get
                                    involved.</strong>
                            </p>
                        </div>
                        <div id="alert_message"></div>
                        <input type="hidden" name="recaptcha_response" value="" id="recaptchaResponse">
                        <input type="submit" name="submit" value="Submit" class="btn btn-success btn-lg">
                    </form>
                </div>
                <?php 
  return ob_get_clean();
}
add_shortcode( 'the_form', 'the_form_func' );


function wp_get_menu_array($current_menu) {

    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['children'] = array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID'] = $m->ID;
            $submenu[$m->ID]['title'] = $m->title;
            $submenu[$m->ID]['url'] = $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
}

add_shortcode( 'header', 'header_func' );
    function header_func( $atts ) {
    ob_start(); 

?>
<?php
 $a = wp_get_menu_array('main-menu'); ?>


<header>
        
  
    <nav class="desktopmenu">
      	
      <?php
      foreach ( $a as $location ) { ?>
        <a href="<?php  echo $location['url'];?>"><?php echo $location['title'];?></a>
	<?php } ?>
  
    </nav>
</header>
<div class="menu__mobile_button">
    <span></span>
</div>
<nav class="mobilemenu">
      <?php
      foreach ( $a as $location ) { ?>
        <a href="<?php  echo $location['url'];?>"><?php echo $location['title'];?></a>
	<?php } ?>
</nav>
    
    <?php 
  return ob_get_clean();
}
add_shortcode( 'header', 'header_func' );


add_shortcode( 'news', 'news_func' );
    function news_func( $atts ) {
    ob_start(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
	.card-link{
		position:relative;
		}
		.image-grid-cover {
    width: 100%;
    background-size: cover;
    min-height: 180px;
    position: relative;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    border-radius: 4px;
}
.image-grid-clickbox {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    z-index: 20;
    background: rgba(0,0,0,.45);
}
.cover-wrapper {
    font-size: 18px;
    text-align: center;
    display: block;
    color: #fff;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    z-index: 21;
    position: relative;
    top: 80px;
}
	#topline {
      font-size: 12px;
color: #001826;
padding: 4px;
width: 85px;
text-align: center;
text-transform: uppercase;
font-family: noto-sans-display-condensed,sans-serif;
font-weight: 500;
font-style: normal;
}
.cover-wrapper {
  color: #fff;
  font-family: "noto-sans-display-extraconde", Sans-serif;
  font-size: 40px;
  font-weight: 900;
  text-transform: uppercase;
  font-style: normal;
  line-height: 43px;
  text-shadow: none;
z-index: 21;
position: relative;
top: 63px;
}
.card-title{
	font-family: noto-sans-display-condensed,sans-serif;
  font-size: 18px; 
  text-transform: uppercase;
font-family: noto-sans-display-condensed,sans-serif;
font-weight: 500;
font-style: normal;
  }
  
  .card-text{
    font-family: noto-serif,serif;
font-weight: 400;
font-size: 16px;
line-height: 1.625em;
color: #00314d;
  }
  .cover-wrapper:hover {
  color: #fff !important;
}
	</style>
      <div class="container-fluidd">
		
		<div class="row">
    <?php $query = new WP_Query( array(
        'post_type' => 'news',
        'posts_per_page' => 3
    ) );
    while ($query->have_posts()) : $query->the_post(); ?>
        <?php /* grab the url for the full size featured image */
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
     
	global $post;
	$post = $post->ID;
?>
       <div class="col-12 col-sm-6 col-md-4">
         <div class="card" style="border: 1px solid #707070;">
       		<div class="image-grid-item">
							<div style="background-image: url('<?php echo $featured_img_url; ?>');" class="image-grid-cover" style="border-radius: 0px;">
								<a href="<?php the_permalink(); ?>" class="image-grid-clickbox"></a>
								<a href="<?php the_permalink(); ?>" class="cover-wrapper"><?php the_field( 'post_sub_title' ); ?></a>
							</div>
						</div>
           
           <?php foreach( (get_the_category($post)) as $category) { ?>
           <?php  
                  $cat_name = $category->cat_name;
                  if($cat_name = "Event"){
                    	$category_color = "#00B8FF"; 
                  }else{
                    $category_color = "#24E7D4";
                  }; ?>
			<a href="<?php echo get_category_link($category);?>" class="card-text" id="topline" style="background: <?php echo $category_color; ?> !important;"><?php echo $category->cat_name; ?></a>
		<?php } ?>
           
           

         <div class="card-body">

               <h5 class="card-title"><?php the_title(); ?></h5>
               <p class="card-text"><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>
            </div>
         
          </div>
         </div>
    <?php endwhile; ?>
       

             
         
     

		

			
          </div>
	</div>
    <?php 
  return ob_get_clean();
}
add_shortcode( 'news', 'news_func' );

add_shortcode( 'search', 'search_func' );
    function search_func( $atts ) {
    ob_start(); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
	.card-link{
		position:relative;
		}
		.image-grid-cover {
    width: 100%;
    background-size: cover;
    min-height: 180px;
    position: relative;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    border-radius: 4px;
}
.image-grid-clickbox {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    z-index: 20;
    background: rgba(0,0,0,.45);
}
.cover-wrapper {
    font-size: 18px;
    text-align: center;
    display: block;
    color: #fff;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    z-index: 21;
    position: relative;
    top: 80px;
}
	#topline {
      font-size: 12px;
color: #001826;
padding: 4px;
width: 85px;
text-align: center;
text-transform: uppercase;
font-family: noto-sans-display-condensed,sans-serif;
font-weight: 500;
font-style: normal;
}
.cover-wrapper {
  color: #fff;
  font-family: "noto-sans-display-extraconde", Sans-serif;
  font-size: 40px;
  font-weight: 900;
  text-transform: uppercase;
  font-style: normal;
  line-height: 43px;
  text-shadow: none;
z-index: 21;
position: relative;
top: 63px;
}
.card-title{
	font-family: noto-sans-display-condensed,sans-serif;
  font-size: 18px; 
  text-transform: uppercase;
font-family: noto-sans-display-condensed,sans-serif;
font-weight: 500;
font-style: normal;
  }
  
  .card-text{
    font-family: noto-serif,serif;
font-weight: 400;
font-size: 16px;
line-height: 1.625em;
color: #00314d;
  }
  .cover-wrapper:hover {
  color: #fff !important;
}
	</style>
      <div class="container-fluidd">
		
		<div class="row">
    <?php $query = new WP_Query( array(
        'post_type' => 'news',
        'posts_per_page' => -1
    ) );
    while ($query->have_posts()) : $query->the_post(); ?>
        <?php /* grab the url for the full size featured image */
    $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
     
	global $post;
	$post = $post->ID;
?>
       <div class="col-12 col-sm-6 col-md-4">
         <div class="card" style="border: 1px solid #707070;">
       		<div class="image-grid-item">
							<div style="background-image: url('<?php echo $featured_img_url; ?>');" class="image-grid-cover" style="border-radius: 0px;">
								<a href="<?php the_permalink(); ?>" class="image-grid-clickbox"></a>
								<a href="<?php the_permalink(); ?>" class="cover-wrapper"><?php the_field( 'post_sub_title' ); ?></a>
							</div>
						</div>
           
           <?php foreach( (get_the_category($post)) as $category) { ?>
           <?php  
                  $cat_name = $category->cat_name;
                  if($cat_name = "Event"){
                    	$category_color = "#00B8FF"; 
                  }else{
                    $category_color = "#24E7D4";
                  }; ?>
			<a href="<?php echo get_category_link($category);?>" class="card-text" id="topline" style="background: <?php echo $category_color; ?> !important;"><?php echo $category->cat_name; ?></a>
		<?php } ?>
           
           

         <div class="card-body">

               <h5 class="card-title"><?php the_title(); ?></h5>
               <p class="card-text"><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>
            </div>
         
          </div>
         </div>
    <?php endwhile; ?>
       

             
         
     

		

			
          </div>
	</div>
<?php 
  return ob_get_clean();
}
add_shortcode( 'search', 'search_func' );
add_shortcode( 'search_results', 'search_results_func' );
    function search_results_func( $atts ) {
    ob_start(); ?>
<section id="primary" class="content-area">
 <div id="content" class="site-content" role="main">
 <?php
 global $query_string;

 $query_args = explode("&", $query_string);
 $search_query = array('category_name=portfolio-item');

 if( strlen($query_string) > 0 ) {
 foreach($query_args as $key => $string) {
 $query_split = explode("=", $string);
 $search_query[$query_split[0]] = urldecode($query_split[1]); 
 } // foreach
 } //if

 $search = new WP_Query($search_query);
 ?> 
 <?php global $wp_query; $total_results = $wp_query->found_posts;?>
 
 <?php if ( $search->have_posts() ) : ?>

 
 <div id='mw_search_results' class="">
 <div class='col-xs-3'>
 <h3> Total Results: <?php echo $total_results ?> </h3>
 </div>
 <div class="">
 <form method="get" id="mw_searchform_results" action="<?php bloginfo('url'); ?>/">
 <div id="mw_searchform_wrapper">
 <input id="mw_searchform_text" type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
 <input id="mw_searchform_submit" type="submit" id="searchsubmit" value="Search" />
 </div>
 </form> 
 </div>
 </div>
  
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<style>
	.card-link{
		position:relative;
		}
		.image-grid-cover {
    width: 100%;
    background-size: cover;
    min-height: 180px;
    position: relative;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    border-radius: 4px;
}
.image-grid-clickbox {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    z-index: 20;
    background: rgba(0,0,0,.45);
}
.cover-wrapper {
    font-size: 18px;
    text-align: center;
    display: block;
    color: #fff;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    z-index: 21;
    position: relative;
    top: 80px;
}
	#topline {
      font-size: 12px;
color: #001826;
padding: 4px;
width: 85px;
text-align: center;
text-transform: uppercase;
font-family: noto-sans-display-condensed,sans-serif;
font-weight: 500;
font-style: normal;
}
.cover-wrapper {
  color: #fff;
  font-family: "noto-sans-display-extraconde", Sans-serif;
  font-size: 40px;
  font-weight: 900;
  text-transform: uppercase;
  font-style: normal;
  line-height: 43px;
  text-shadow: none;
z-index: 21;
position: relative;
top: 63px;
}
.card-title{
	font-family: noto-sans-display-condensed,sans-serif;
  font-size: 18px; 
  text-transform: uppercase;
font-family: noto-sans-display-condensed,sans-serif;
font-weight: 500;
font-style: normal;
  }
  
  .card-text{
    font-family: noto-serif,serif;
font-weight: 400;
font-size: 16px;
line-height: 1.625em;
color: #00314d;
  }
  .cover-wrapper:hover {
  color: #fff !important;
}
	</style>
      <div class="container-fluidd">
		
		<div class="row">
 <!-- the loop -->
 <?php while ( $search->have_posts() ) : $search->the_post(); 
 $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
     
	global $post;
	$post = $post->ID;
?>
       <div class="col-12 col-sm-6 col-md-4">
         <div class="card" style="border: 1px solid #707070;">
       		<div class="image-grid-item">
							<div style="background-image: url('<?php echo $featured_img_url; ?>');" class="image-grid-cover" style="border-radius: 0px;">
								<a href="<?php the_permalink(); ?>" class="image-grid-clickbox"></a>
								<a href="<?php the_permalink(); ?>" class="cover-wrapper"><?php the_field( 'post_sub_title' ); ?></a>
							</div>
						</div>
           
           <?php foreach( (get_the_category($post)) as $category) { ?>
           <?php  
                  $cat_name = $category->cat_name;
                  if($cat_name = "Event"){
                    	$category_color = "#00B8FF"; 
                  }else{
                    $category_color = "#24E7D4";
                  }; ?>
			<a href="<?php echo get_category_link($category);?>" class="card-text" id="topline" style="background: <?php echo $category_color; ?> !important;"><?php echo $category->cat_name; ?></a>
		<?php } ?>
           
           

         <div class="card-body">

               <h5 class="card-title"><?php the_title(); ?></h5>
               <p class="card-text"><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>
            </div>
         
          </div>
         </div>
 <?php endwhile; ?>
 <!-- end of the loop --> 
  </div>
	</div>
 
 <?php else : ?>
 <h2><?php _e( 'Sorry, no posts matched your criteria. Please try a different search.' ); ?></h2>
 
 <form method="get" id="mw_searchform" action="<?php bloginfo('url'); ?>/">
 <div id="mw_searchform_wrapper">
 <input id="mw_searchform_text" type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
 <input id="mw_searchform_submit" type="submit" id="searchsubmit" value="Search" />
 </div>
 </form>
 <?php endif; ?>
 
 </div><!-- #content .site-content -->
 </section><!-- #primary .content-area -->

<?php 
  return ob_get_clean();
}
add_shortcode( 'search_results', 'search_results_func' );