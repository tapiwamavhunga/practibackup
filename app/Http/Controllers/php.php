$brochure_id = (isset($request->brochure_id))? $request->brochure_id: false;
        if($brochure_id):
            
            
                
                $brochure = array();
                $result = Post::find($brochure_id);

            


                if($result === null):
                    //$this->trackRequest('brochure-html/error');
                    $return = array( 'Error' => "Brochure not found. Please try a different brochure id.");
                else:

                    $slug = ApiTracking::sanitize($result->title);
                    
                    $dataarr = array(
                        'id' => $result->ID,
                        'title' => $result->post_title,
                        'slug' => $slug,
                        'desc' => strip_tags($result->content),
                        'image' => $result->image,
                    );
                    // $bfvs = array();
                    // $bfields = BrochureField::all();
                    // foreach($bfields as $bf){
                    //     $bfvs[$bf->slug] = $bf->id;
                    // }

                    // $bfieldsvalue_items = BrochureFieldValues::where('brochure_id', $brochure_id)->get();
                    // foreach($bfvs as $key => $bfv){
                    //     foreach($bfieldsvalue_items as $bfieldsvalue_item){
                    //         if($bfieldsvalue_item->field_id == $bfv){
                    //             $value = $bfieldsvalue_item->value;
                    //             $bfvs[$key] = $value;
                    //         }
                    //     }
                    // }

                    //$dataarr['brochure_fieldvalues'] = $bfvs;

                    // $bfvs = DB::table('brochure_field_values')
                    //     ->leftjoin('brochure_fields', 'brochure_field_values.field_id', '=', 'brochure_fields.id')
                    //     ->select("brochure_fields.title","brochure_field_values.value")
                    //     ->where('brochure_field_values.brochure_id', 'like', '%'.$result->id.'%')
                    //     ->get();
                    // $dataarr['brochure_fields'] = $bfvs;

                    // $segs = DB::table('brochure_segments')
                    //     ->select("*")
                    //     ->where('brochure_id', '=', $result->id)
                    //     ->orderBy('order_id', 'asc')
                    //     ->get();
                    // $dataarr['brochure_segments'] = $segs;
                    $brochure = $dataarr;

                    print_r($brochure["title"]); 

                    print_r($brochure["desc"]); 

                    //print_r($dataarr['html']);
                    // BROCHURE HTML
                    $bimg = $brochure['image'];
                    $dataarr['html'] = '
                    <div class="brochures preview">

                        <div class="brochure">
                            <div class="brochure-title"><h1>'.$brochure["title"].'</h1></div>
                            <div class="brochure-details">
                                <div class="brochure-head">
                                    <div class="brochure-media">';

            //                     if( isset($brochure["brochure_fieldvalues"]["video-link"]) && trim($brochure["brochure_fieldvalues"]["video-link"]) != '' ):
            //         $dataarr['html'] .= '<div class="brochure-image video"><a id="play-video" href="'.$brochure['brochure_fieldvalues']['video-link'].'"><svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="play-circle" class="svg-inline--fa fa-play-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><g class="fa-group"><path class="fa-secondary" fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm115.7 272l-176 101c-15.8 8.8-35.7-2.5-35.7-21V152c0-18.4 19.8-29.8 35.7-21l176 107c16.4 9.2 16.4 32.9 0 42z" opacity="0.4"></path><path class="fa-primary" fill="currentColor" d="M371.7 280l-176 101c-15.8 8.8-35.7-2.5-35.7-21V152c0-18.4 19.8-29.8 35.7-21l176 107c16.4 9.2 16.4 32.9 0 42z"></path></g></svg></a><div class="main-image-holder" style="background-image:url('.$brochure['image'].')"></div></div>
            //                         <div class="brochure-main-video">
            //                             <iframe 
            //                                 id="bst_youtube_video" 
            //                                 width="560" 
            //                                 height="315" 
            //                                 src="'.$brochure['brochure_fieldvalues']['video-link'].'" 
            //                                 frameborder="0" 
            //                                 allow="accelerometer; autoplay;"
            //                                 allowfullscreen="">
            //                             </iframe>
            //                         </div>';
            //                     else:
            // $dataarr['html'] .= "<div class='brochure-image'><img src='".$brochure['image']."'></div>";
            //                     endif;
                                
            // $dataarr['html'] .= '</div>';


                                    //die();
            //                         $mlogo = $this->getfieldvaluebyname($result->id, "Manufacturer Logo");
            //                         if($mlogo != ""):
            // $dataarr['html'] .= '<div class="brochure-manufacturer-logo">
            //                         Brought to you by
            //                         <img src="'.$mlogo.'">
            //                     </div>';
            //                         endif;
        
            // $dataarr['html'] .= '</div>';                    
            //$dataarr['html'] .= '<div class="brochure-desc">'.$this->minifyhtml($brochure["desc"]).'</div>';


            // BROCHURE SEGMENTS

            //                     if(count($brochure["brochure_segments"]) > 0):
            // $dataarr['html'] .= '<div id="brochure-segments" class="brochure-segments">';
            //                         foreach($brochure["brochure_segments"] as $brochure_segment):

            //                             $segmentclasses = "brochure-segment";
            //                             if(strtolower($brochure_segment->bgcolor) != '#ffffff'){
            //                                 $segmentclasses = "brochure-segment hasbgcolor";
            //                             }

            //                             if($brochure_segment->anchor_id != null){
            //         $dataarr['html'] .= '<div id="'.$brochure_segment->anchor_id.'" class="'.$segmentclasses.'" style="background-color:'.$brochure_segment->bgcolor.'">';
            //                             } else {
            //         $dataarr['html'] .= '<div class="'.$segmentclasses.'" style="background-color:'.$brochure_segment->bgcolor.'">';
            //                             }

            //                                 if($brochure_segment->title != "" && $brochure_segment->content != ""):
            //                 $dataarr['html'] .= '<div class="brochure-segment-title">';
            //                 $dataarr['html'] .= '    <a href="#brochure-segments">Back to top</a> <h2>'.$brochure_segment->title.'</h2>';
            //                 $dataarr['html'] .= '</div>';
            //                 $dataarr['html'] .= '<div class="brochure-segment-content">';
            //                 $dataarr['html'] .= '    <div>'.$this->minifyhtml($brochure_segment->content).'</div>';
            //                 $dataarr['html'] .= '</div>';
            //                                 else:
            //                                     if($brochure_segment->image != ""):
            //                 $dataarr['html'] .= '<div class="brochure-segment-image full"><img src="'.$brochure_segment->image.'"></div>';
            //                                     endif;
            //                                     if($brochure_segment->title != ""):
            //                 $dataarr['html'] .= '<div class="brochure-segment-title"><a href="#brochure-segments">Back to top</a><h4>'.$brochure_segment->title.'</h4></div>';
            //                                     endif;
            //                                     if($brochure_segment->content != ""):
            //                 $dataarr['html'] .= '<div class="brochure-segment-content">'.$this->minifyhtml($brochure_segment->content).'</div>';
            //                                     endif;
            //                                 endif;
            //         $dataarr['html'] .= '</div>';
            //                         endforeach;
            // $dataarr['html'] .= '</div>';
            //                     else:
            // $dataarr['html'] .= '<br><div class="alert alert-warning" role="alert">No content segments created for this brochure.</div>';
            //                     endif;


            // $dataarr['html'] .= '</div>';
        

/* START related brochures with same Health Bucket */

//             $related_bf = BrochureField::where('title', 'Health Basket')->first();
//             $related_bfv = BrochureFieldValues::where([
//                 ['field_id', $related_bf->id],
//                 ['brochure_id', $result->id]
//             ])->first();
//             $healthbasket = $related_bfv->value;

//             //Log::debug($result->id);
//             $isbrochurePostscript = $this->isBrochure_Postscript($result->id);
//             //Log::debug($isbrochurePostscript);
            
//             $related = false;
//             if(trim($healthbasket) != ''){

//                 $related_bids = BrochureFieldValues::select('brochure_id')->where([
//                     ['value', $healthbasket],
//                     ['field_id', $related_bf->id],
//                     ['brochure_id', '!=', $result->id]
//                 ])->get()->toArray();

//                 $new_rbids = array();
//                 foreach($related_bids as $rel){
//                     if($rel['brochure_id'] != $result->id){

//                         //Log::debug($rel['brochure_id']);
//                         $isrelated_ps = $this->isBrochure_Postscript( $rel['brochure_id'] );
//                         //Log::debug($isrelated_ps);

//                         if( $isbrochurePostscript == 0 ){
                            
//                             if( $isrelated_ps == 0 ){
//                                 $new_rbids[] = $rel['brochure_id'];
//                             }

//                         } else {

//                             if( $isrelated_ps == 1 ){
//                                 $new_rbids[] = $rel['brochure_id'];
//                             }

//                         }

//                     }
//                 }

//                 //Log::debug(print_r($new_rbids, true));
                
//                 if(!empty($new_rbids)){
//                     $related = Brochure::whereIn('id', $new_rbids)->take(3)->get();
//                 }

//             }

//                                 if($related != false):
//             $dataarr['html'] .= '<div class="related-brochures">';
//             $dataarr['html'] .= '   <h2>Related Brochures</h2>';
//             $dataarr['html'] .= '   <div class="related-brochures-container">';
//                                         foreach($related as $rbrochure):
//                                         $rblink = $this->getUserCompanyRedirectUrl()."/".ApiTracking::sanitize($rbrochure->title);
//             $dataarr['html'] .= '       <a href="'.$rblink.'" class="related-brochure">';
//             $dataarr['html'] .= '           <div class="related-image" style="background-image: url( '.$rbrochure->image.' )"></div>';
//             $dataarr['html'] .= '           <div class="related-details">';
//             $dataarr['html'] .= '               <h3 class="related-title">'.$rbrochure->title.'</h3>';
//             $dataarr['html'] .= '               <div class="related-desc">'.strip_tags($rbrochure->desc).'</div>';
//             $dataarr['html'] .= '           </div>';
//             $dataarr['html'] .= '       </a>';
//                                        endforeach;
//             $dataarr['html'] .= '   </div>';
//             $dataarr['html'] .= '</div>';
//                                 endif;


// /* END related brochures with same Health Bucket */



//             $dataarr['html'] .= '<div class="brochure-buttons">';
//                                         $moreinformation = $this->getfieldvaluebyname($result->id, "More Information Link");
//                                         if(trim($moreinformation) != ""):
//                     $dataarr['html'] .= '<a href="'.$moreinformation.'" class="brochure-button moreinfo">
//                                             <span class="brochure-button-icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="info-circle" class="svg-inline--fa fa-info-circle fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"></path></svg></span>
//                                             <span class="brochure-button-text">More Information</span>
//                                         </a>';
//                                         endif;
//                                         $pdfdownload = $this->getfieldvaluebyname($result->id, "PDF");
//                                         if(trim($pdfdownload) != ""):
//                     $dataarr['html'] .= '<a href="'.$pdfdownload.'" class="brochure-button pdfdownload">
//                                             <span class="brochure-button-icon"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="cloud-download-alt" class="svg-inline--fa fa-cloud-download-alt fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M537.6 226.6c4.1-10.7 6.4-22.4 6.4-34.6 0-53-43-96-96-96-19.7 0-38.1 6-53.3 16.2C367 64.2 315.3 32 256 32c-88.4 0-160 71.6-160 160 0 2.7.1 5.4.2 8.1C40.2 219.8 0 273.2 0 336c0 79.5 64.5 144 144 144h368c70.7 0 128-57.3 128-128 0-61.9-44-113.6-102.4-125.4zm-132.9 88.7L299.3 420.7c-6.2 6.2-16.4 6.2-22.6 0L171.3 315.3c-10.1-10.1-2.9-27.3 11.3-27.3H248V176c0-8.8 7.2-16 16-16h48c8.8 0 16 7.2 16 16v112h65.4c14.2 0 21.4 17.2 11.3 27.3z"></path></svg></span>
//                                             <span class="brochure-button-text">Download PDF</span>
//                                         </a>';
//                                         endif;
//                                         $medicalrefs = $this->getfieldvaluebyname($result->id, "Medical References");
//                                         if(trim($medicalrefs) != ""):
//                     $dataarr['html'] .= '<a href="#" class="brochure-button mreferences" data-toggle="collapse" data-target="#medical-references">
//                                             <span class="brochure-button-icon"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="plus" class="svg-inline--fa fa-plus fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M368 224H224V80c0-8.84-7.16-16-16-16h-32c-8.84 0-16 7.16-16 16v144H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h144v144c0 8.84 7.16 16 16 16h32c8.84 0 16-7.16 16-16V288h144c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16z"></path></svg></span>
//                                             <span class="brochure-button-text">Medical References</span>
//                                         </a>';
//                                         endif;
//                     $dataarr['html'] .= '
//                                     </div>';
        
//                                 if(trim($medicalrefs) != ""):
//             $dataarr['html'] .= '<div id="medical-references" class="brochure-medical-references collapse">
//                                     <h2>Medical References <div class="brochure-medical-references-close"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" class="svg-inline--fa fa-times fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path></svg></div></h2>
//                                     '.$this->minifyhtml( $medicalrefs ).'
//                                 </div>';
//                                 endif;
        
        
//             $dataarr['html'] .= '</div>';
                    


//             $dataarr['html'] .= '<div class="brochure-sidebar">';

//                     /* Manikin Data */
//                     $manikin_data = array();
//                     $bodypart_id = false;
//                     $bfields = BrochureField::all();
//                     foreach($bfields as $bf){
//                         if($bf->slug == 'body_part'){
//                             $bodypart_id = $bf->id;
//                         }
//                     }
                        
//                     $manikin_data['Head'] = $this->getBrochuresByBodyPart($bodypart_id, 'Head');
//                     $manikin_data['Chest'] = $this->getBrochuresByBodyPart($bodypart_id, 'Chest');
//                     $manikin_data['Abdomen'] = $this->getBrochuresByBodyPart($bodypart_id, 'Abdomen');
//                     $manikin_data['Pelvis'] = $this->getBrochuresByBodyPart($bodypart_id, 'Pelvis');
//                     $manikin_data['Legs'] = $this->getBrochuresByBodyPart($bodypart_id, 'Legs');
//                     $manikin_data['Feet'] = $this->getBrochuresByBodyPart($bodypart_id, 'Feet');
//                     $manikin_data['Skin'] = $this->getBrochuresByBodyPart($bodypart_id, 'Skin');
//                     $manikin_data['General'] = $this->getBrochuresByBodyPart($bodypart_id, 'General');
//                     $manikin_data['mentalhealth'] = $this->getBrochuresByBodyPart($bodypart_id, 'mental health');
//                     $manikin_data['infant'] = $this->getBrochuresByBodyPart($bodypart_id, 'infant');

//                     $html = '
//                     <div class="manikin-menu">
//                         <div class="manikin-menu-box manikin-animate">
//                             <div class="manikin-menu-figure">
//                                 <img class="manikin-jpg" src="'.asset('/images/manikin.jpg').'" width="217" height="413">
//                             </div>
//                             <div class="manikin-menu-buttons">
//                                 <div class="manikin-menu-button head manikin-animate" data-show="#manikin-head">Head</div>
//                                 <div class="manikin-menu-button chest manikin-animate" data-show="#manikin-chest">Chest</div>
//                                 <div class="manikin-menu-button abdomen manikin-animate" data-show="#manikin-abdomen">Abdomen</div>
//                                 <div class="manikin-menu-button pelvis manikin-animate" data-show="#manikin-pelvis">Pelvis</div>
//                                 <div class="manikin-menu-button legs manikin-animate" data-show="#manikin-legs">Legs</div>
//                                 <div class="manikin-menu-button feet manikin-animate" data-show="#manikin-feet">Feet</div>
//                                 <div class="manikin-menu-button mentalhealth manikin-animate" data-show="#manikin-mentalhealth">Mental Health</div>
//                                 <div class="manikin-menu-button skin manikin-animate" data-show="#manikin-skin">Skin</div>
//                                 <div class="manikin-menu-button general manikin-animate" data-show="#manikin-general">General</div>
//                                 <div class="manikin-menu-button infanthealth manikin-animate" data-show="#manikin-infanthealth">Infant Health</div>
//                             </div>
//                         </div>
//                         <div class="manikin-menu-list">

//                             <div class="manikin-menu-items backitem manikin-animate">
//                                 <div class="manikin-menu-item">
//                                     <a href="#">
//                                         <span class="close-icon"><svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" class="svg-inline--fa fa-times fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"></path></svg></span>
//                                         <span class="close-text">Close Menu</span>
//                                     </a>
//                                 </div>
//                             </div>';

//                             $html .= '<ul id="manikin-head" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['Head'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-chest" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['Chest'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-abdomen" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['Abdomen'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-pelvis" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['Pelvis'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-legs" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['Legs'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-feet" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['Feet'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-skin" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['Skin'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-general" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['General'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-mentalhealth" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['mentalhealth'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';

//                             $html .= '<ul id="manikin-infanthealth" class="manikin-menu-items manikin-animate">';
//                                 foreach($manikin_data['infant'] as $data):
//                                 $html .= '<li class="manikin-menu-item"><a href="'.$data["linkurl"].'">'.$data["title"].'</a></li>';
//                                 endforeach;
//                             $html .= '</ul>';


//                     $html .= '
//                         </div>
//                     </div>
//                     <div class="manikin-intro">
//                         <h2 class="manikin-intro-heading">For more health information</h2>
//                         <p class="manikin-intro-text">Click on the body area you want to know more about. Select a related health topic from the menu</p>
//                         <div class="manikin-intro-title"><strong>Select a body area</strong></div>
//                     </div>';

                

//                     $dataarr['html'] .= $html;

//                     // get trending brochure
//                     $trending_bf = BrochureField::where('title', 'Trending')->first();
//                     $trending_bfv = BrochureFieldValues::where('field_id', $trending_bf->id)->first();
//                     $trending = Brochure::find($trending_bfv->brochure_id);
//                     $tblink = $this->getUserCompanyRedirectUrl()."/".ApiTracking::sanitize($trending->title);
                    

//                     //get most recently brochure
//                     $bf = BrochureField::where('title', 'Postscript')->first();
//                     $postscript_field_id = $bf->id;
//                     $postscript_bids = BrochureFieldValues::select('brochure_id')->where([
//                         ['value', 'Yes'],
//                         ['field_id', $postscript_field_id]
//                     ])->get()->toArray();
//                     $recent = Brochure::whereNotIn('id', $postscript_bids)->orderBy('created_at', 'desc')->take(5)->get();
                    



//                     $dataarr['html'] .= "<a href='".$tblink."' class='trending-brochure'>
//                                 <div class='trending-image'><img src='".$trending->image."' width='100%'></div>
//                                 <div class='trending-details'>
//                                     <h2>TRENDING BROCHURE</h2>
//                                     <h3 class='trending-title'>".$trending->title."</h3>
//                                     <div class='trending-desc'>".strip_tags($trending->desc)."</div>
//                                 </div>
//                             </a>";

//                             foreach($recent as $rbrochure):
//                             $rblink = $this->getUserCompanyRedirectUrl()."/".ApiTracking::sanitize($rbrochure->title);
//                     $dataarr['html'] .= "<a href='".$rblink."' class='recent-brochure'>
//                                 <div class='recent-image'><img src='".$rbrochure->image."' width='100%'></div>
//                                 <div class='recent-details'>
//                                     <h2>RECENT BROCHURE</h2>
//                                     <h3 class='recent-title'>".$rbrochure->title."</h3>
//                                     <div class='recent-desc'>".strip_tags($rbrochure->desc)."</div>
//                                 </div>
//                             </a>";
//                             endforeach;

//                     $dataarr['html'] .= '<div class="medinformer-logo"><img src="'.asset('images/medinformer-logo.jpg').'" width="100%" /></div>';

//                     $dataarr['html'] .= '</div></div>';

                //     $dataarr['html'] = str_replace("\n", "", $dataarr['html']);
                //     //$dataarr['html'] = preg_replace('/\s+/', ' ', $dataarr['html']);
                //     unset($dataarr['brochure_fields']);
                //     unset($dataarr['brochure_segments']);
                //     $return = $dataarr;

                //     $this->trackRequest('brochure-htmlwithmanikin');
                // endif;

            // else:
            //     $return = array( 'Error' => "This brocure hasn't been assigned to your profile. Contact Medinformer Administrator to get this brochure assigned to your profile.");
            // endif;

       /// else:
            $this->trackRequest('brochure-htmlwithmanikin/error');
            $return = array( 'Error' => "No 'brochure_id' field value found. Your request requires MultiForm POST data with field 'brochure_id' and its value.");
        endif;
        return $return;
    }
