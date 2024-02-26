@extends('layouts.app')

   

@section('content')

<style type="text/css">
  .relative.z-0.inline-flex.shadow-sm.rounded-md {
  display: none;

}

.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
  margin-top: 20px;
}

</style>

   <div class="content-body" >
          <div class="container-fluid-max" >
            
            <div class="row">
              



                  <div class="col-xxl-12" >
                    <div class="carde">
                      <div class="card-headerd">
                        <h4 class="card-title mt-5">Trending Brochures</h4>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive transaction-table">
                          <table class="table table-striped responsive-table">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>ICD10 Code</th>
                                <th>Password</th>
                                <th>Sponsor</th>
                                <th>Date Published</th>

                              </tr>
                            </thead>
                            <tbody>





                            
                            @foreach ($posts as $post)

                          

                              <tr>
                                <td data-th="Ledger ID"><span class="bt-content">{{$post->ID}}</span></td>
                                <td data-th="Type"><span class="bt-content">
                                  <span class="danger-arrow"><i class="icofont-arrow-down"></i>
                                    <?php $str = str_replace(' ', '-', $post->title); 
                                                    ;
                                                    $stri = mb_strtolower($str);
                                                ?>

                                  <a href="https://medinformer.co.za/health_subjects/<?php echo $stri; ?>" target="_blank" > {{$post->title}}</a>

                                  </span>
                                </span></td>
                                <td class="coin-name" data-th="Currency"><span class="bt-content">
                                  <i class="cc BTC"></i> {{$post->acf->brochure_type}}
                                </span></td>
                                <td class="text-danger" data-th="Amount"><span class="bt-content">{{$post->acf->icd10}}</span></td>
                                <td data-th="Fee"><span class="bt-content">{{$post->acf->password}}</span></td>
                                <td data-th="Balance"><span class="bt-content"><strong>{{$post->acf->sponsor_name}}</strong></span></td>
                                <td data-th="Date"><span class="bt-content">{{$post->post_date}}</span></td>

                                
                                                

                              </tr>
                                  @endforeach
                            </tbody>
                          </table>

                           

                        </div>

                        {{ $posts->links() }}
                      </div>
                    </div>
                  </div>
  
                 

                </div>

           
              </div>
            </div>
          </div>
        </div>


@endsection