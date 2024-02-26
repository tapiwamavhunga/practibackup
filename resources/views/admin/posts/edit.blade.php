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
                        <h4 class="card-title mt-5 mb-5">Posts</h4>
                      </div>

                 


                      <div class="card-body">
                        <div class="table-responsive transaction-table">
                          


                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                         <form method="POST" action="{{ url('/admin/posts/' . $post->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.posts.form', ['formMode' => 'edit'])

                        </form>
                           

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