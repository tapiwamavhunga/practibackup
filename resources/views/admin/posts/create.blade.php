@extends('layouts.app')

   
<style type="text/css">
  .allowed-brochure-items {
    padding: 20px 0;
}

.allowed-brochure-item {
    display: flex;
    justify-content: flex-start;
    padding: 0 15px;
    border-top: 1px solid rgba(0, 0, 0, 0.125);
    background-color: #f7f7f7;
    line-height: 80px;
}

.allowed-brochure-item-checkbox {
    width: 30px;
}

.allowed-brochure-item-image {
    width: 40px;
    height: 40px;
}

.allowed-brochure-item-title {
    padding-left: 15px;
}

.allowed-brochure-items-submit {
    text-align: right
}

.allowed-brochure-item-image {
  width: 40px;
  height: 40px;
  top: 22px;
  position: relative;
}

.allowed-brochure-item-checkbox {
  width: 30px;
  margin-top: 32px;
}


</style>
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
                        <h4 class="card-title mt-5 mb-5">Create Post</h4>
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

                        <form method="POST" action="{{ url('/admin/posts') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('admin.posts.form', ['formMode' => 'create'])

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