@extends('layouts.app')

<style type="text/css">
  .card {
  border: 0px;
  margin-bottom: 30px;
  border-radius: 5px;
  -webkit-box-shadow: 0px 1.25rem 1.5625rem #fff;
  box-shadow: 0px 1.25rem 1.5625rem #fff;
  background: #fff;
}
</style>
@section('content')
<div class="container-fluid">
<div class="row">
        <div class="col-xxl-12 col-xl-12">
          <div class="page-title mt-4">
            <h4>Create User</h4>
          </div>

           @if ($errors->any())
        <div class="alert alert-danger">
        There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

          <div class="cardd">
            <div class="card-header">
             
             <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
            </div>
              <div class="row">
               
                <div class="col-xxl-12">
                  <div class="cardd">
                    <div class="card-header">
                      <h4 class="card-title">Personal Information</h4>
                    </div>
                    <div class="card-body">

    <form action="{{ route('users.store') }}" method="POST" class="personal_validate">
        @csrf
                                <div class="row g-4 mb-5">
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" value="">
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Surname</label>
                            <input type="text" class="form-control" placeholder="Surname" name="surname" value="">
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Email</label>
                            <div class="fx-relay-email-input-wrapper"><input type="email" class="form-control" placeholder="" name="email" value="email" style="padding-right: 52px;"><div class="fx-relay-icon" style="top: 0px; bottom: 0px;"></div></div>
                          </div>
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Type</label>
                            <input type="text" class="form-control" placeholder="Type" name="type" value="">
                          </div>
                           <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">IsAdmin</label>
                            <input type="text" class="form-control" placeholder="" name="is_admin" value="0">
                          </div>
                         <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Company</label>
                            <input type="text" class="form-control" disabled="true" placeholder="" name="company" value="">
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="password" value="">
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Repeat Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="c_password" value="">
                          </div>
                         

                          <div class="col-12">
                            <button class="btn btn-success pl-5 pr-5 waves-effect">
                              Save
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
     
@endsection