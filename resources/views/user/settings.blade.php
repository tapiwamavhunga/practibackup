@extends('layouts.app')

   

@section('content')

<style type="text/css">
    .card {
  border: 0px;
  margin-bottom: 30px;
  border-radius: 5px;
  -webkit-box-shadow: none;
  box-shadow: none;
  background: #fff;
}
</style>
   <div class="content-body">
          <div class="container-fluid-max">
            <div class="row">
              <div class="col-xl-12">
                <div class="page-title-content  mt-5">
                  <p>
                    You are loggedin as, 
                    <strong class="text-primary"> {{$user->name}}</strong>
                  </p>
                </div>
              </div>
            </div>
            
          </div>


  <div class="row">
        <div class="col-xxl-12 col-xl-12">
          <div class="page-title">
            <h4>Profile</h4>
          </div>
          <div class="carde">
            <div class="card-header">
              <div class="settings-menu active">
              <a href="settings-profile.html" class="active">Profile</a>
              <a href="settings-application.html">Application</a>
              <a href="settings-security.html">Security</a>
              <a href="settings-activity.html">Activity</a>
              <a href="settings-privacy.html">Privacy</a>
              <a href="settings-payment-method.html">Payment Method</a>
              <a href="settings-api.html">API</a>
              <a href="settings-fees.html">Fees</a>
            </div>
            </div>
            <div class="card-body  ">
              <div class="row">
              
                <div class="col-xxl-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="card-title">Personal Information</h4>
                    </div>
                    <div class="card-body">
                      <form name="myform" class="personal_validate" novalidate="novalidate">
                        <div class="row g-4">
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" value="{{$user->name}}" name="name">
                          </div>
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Surnname</label>
                            <input type="text" class="form-control" value="{{$user->surname}}" name="surname">
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Email</label>
                            <div class="fx-relay-email-input-wrapper">
                              <input type="email" class="form-control" value="{{$user->email}}" name="email" style="padding-right: 52px;"><div class="fx-relay-icon" style="top: 0px; bottom: 0px;"></div></div>
                          </div>

                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Practice Number</label>
                            <input type="text" class="form-control" value="{{$user->practice_number}}" name="practice_number">
                          </div>


                         <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Company</label>
                            <input type="text" class="form-control" value="{{$user->company}}" name="company">
                          </div>
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Present Address</label>
                            <input type="text" class="form-control" placeholder="56, Old Street, Brooklyn" name="presentaddress">
                          </div>
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Permanent Address</label>
                            <input type="text" class="form-control" placeholder="123, Central Square, Brooklyn" name="permanentaddress">
                          </div>
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" placeholder="New York" name="city">
                          </div>
                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <label class="form-label">Postal Code</label>
                            <input type="text" class="form-control" placeholder="25481" name="postal">
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
        </div>
      </div>




@endsection