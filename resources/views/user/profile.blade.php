@extends('layouts.app')

@section('content')


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<div class="content-bodyd ">
    <div class="container-fluid mt-5 pt-5">
      <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6">
          <div class="card welcome-profile">
            <div class="card-body">

              


              <h4>Welcome, {{ $user->name }}!</h4>
              <p>
                Completing your profile with accurate information will enhance your experience and help us tailor our services to better meet your needs.
              </p>

              <ul>
               
                <li class="mb-5">
                  <a href="{{ route('users.edit',$user->id) }}">
                    
                    Click here to complete your profile.
                  </a>
                </li>

                
              </ul>
            </div>
          </div>
        </div>



        <div class="col-xxl-6 col-xl-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Reports</h4>
            </div>
            <div class="card-body">
              <div class="app-link">
                <h5>Get Analytics in realtime.</h5>
                <p>
                  You can only view reports once you have been verified. 
                </p>
                <a href="/user_reports" class="btn btn-primary">
                 View your Reports 
                </a>
                
                
              </div>
            </div>
          </div>
        </div>

      </div>


      <div class="row">
        <div class="col-xxl-12">
          <div class="cardc">
            <div class="card-header">
              <h4 class="card-title ">Profile Summary</h4>
              <a  href="{{ route('users.edit',$user->id) }}" class="btn btn-primary">Edit</a>

            </div>
            <div class="card-body">
              <form class="row">
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>USER ID</span>
                    <h4>{{$user->id}}</h4>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>EMAIL ADDRESS</span>
                    <h4>{{$user->email}}</h4>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Company</span>
                    @if(!empty($user->company))

                          <h4>{{$user->company}}</h4>
                          @else
                            <h4>Medinformer</h4>
                          @endif
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Professional Number</span>

                     @if(!empty($user->practice_number))

                    <h4>{{$user->practice_number}}</h4>
                          @else
                            <h4>Not Provided</h4>
                          @endif


                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Phone Number</span>

                      @if(!empty($user->phone_number))

                    <h4>{{$user->phone_number}}</h4>
                          @else
                            <h4>Not Provided</h4>
                          @endif


                  </div>
                </div>

                 <!-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>WhatsApp Number</span>
                    <h4>{{$user->whatsapp_number}}</h4>
                  </div>
                </div> -->

                 

                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>User Type</span>
                          @if($user->is_admin == 1)

                    <h4>Admin User</h4>
                          @else
                            <h4>Practitioner</h4>
                          @endif
                  </div>
                </div>

                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Is Verified</span>
                    <h4>{{$user->is_verified}}</h4>

                    @if($user->is_verified == 1)

                    <h4>Yes</h4>
                          @else
                            <h4>No</h4>
                          @endif
                  </div>
                </div>

                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Last Logged In</span>
                    
                      @if(!empty($user->last_login_at))

                    <h4>{{$user->last_login_at}}</h4>
                          
                          @endif
                          
                  </div>
                </div>

                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>JOINED SINCE</span>
                    <h4>{{$user->created_at}}</h4>
                  </div>
                </div>

                <div class="col-xxl-12">
                  <div class="user-info">


                     @if(auth::user()->image_logo)
                    <h4>Practice Logo</h4>

                  <img src="{{asset('/folder/images/signatures/'.Auth::user()->image_logo)}}" style=" height: auto;" 
                />

                @else
                              <img src="{{asset('/folder/images/signatures/'.Auth::user()->image_logo)}}" alt="" />

              @endif


                  </div>
                </div>


                <div class="col-xxl-12">
                  <div class="user-info">


                     @if(auth::user()->image_signature)
                    <h4>Email Signature</h4>

                  <img src="{{asset('/folder/images/signatures/'.Auth::user()->image_signature)}}" style=" height: auto;" 
                />

                @else
                              <img src="{{asset('/folder/images/signatures/'.Auth::user()->image_signature)}}" alt="" />

              @endif


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