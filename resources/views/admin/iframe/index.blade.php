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
                        <h4 class="card-title mt-5 mb-5">Iframes</h4>
                      </div>

                      <a href="{{ url('/admin/iframe/create') }}" class="btn btn-success btn-sm" title="Add New Iframe">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>


                      <div class="card-body">
                        <div class="table-responsive transaction-table">
                          <table class="table table-striped responsive-table">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Site Name</th>
                                <th>Redirect Url</th>
                                <th>Featured Brochures</th>
                                <th>Main landing brochures</th>
                                <th>Current Campaign</th>
                                <th>Date Published</th>
                                <th>Edit</th>
                              </tr>
                            </thead>
                            <tbody>





                            
                            @foreach ($iframes as $post)

                          

                              <tr>
                                <td data-th="Ledger ID"><span class="bt-content">{{$post->id}}</span></td>
                                <td data-th="Type">{{$post->sitename}}</td>
                                <td class="coin-name" data-th="Currency">{{$post->redirect_url}}</td>
                                <td class="text-danger" data-th="Amount"><span class="bt-content">{{$post->featured_brochures}}</span></td>
                                <td data-th="Fee"><span class="bt-content">{{$post->main_landing_brochures}}</span></td>
                                <td data-th="Balance"><span class="bt-content"><strong>{{$post->current_campaign}}</strong></span></td>
                                <td data-th="Date"><span class="bt-content">{{$post->created_at}}</span></td>

                                <td data-th="Date">
                                  
                                    <a href="{{ url('/admin/iframe/' . $post->id . '/edit') }}" title="Edit Brand"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/iframe' . '/' . $post->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Brand" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>


                                </td>
                                                

                              </tr>
                                  @endforeach
                            </tbody>
                          </table>

                           

                        </div>

                      </div>
                    </div>
                  </div>
  
                 

                </div>

           
              </div>
            </div>
          </div>
        </div>


@endsection