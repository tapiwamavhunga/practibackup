@extends('layouts.app')

  

    
@section('content')
    <div class="container-fluid mt-5 pt-5">
      <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6">
          <div class="card welcome-profile">
            <div class="card-body">
              <img src="{{URL::asset('/images/profile/2.png')}}" alt="" />
              <h4>Welcome, {{ $user->name }}!</h4>
              <p>
                Looks like you are not verified yet. Verify yourself to use the
                full potential of Medinformer.
              </p>

              <ul>
                <li>
                  <a href="#">
                    
                   Practice Number - {{$user->practice_number}} 
                  </a>
                </li>
                <li>
                  <a href="/verify-practice">
                    
                   Verify Practice
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Download all your reports</h4>
            </div>
            <div class="card-body">
              <div class="app-link">
                
                <a href="#" class="btn btn-primary">
                  Email Reports 
                </a>
                <br />
                <div class="mt-3"></div>
                <a href="#" class="btn btn-primary">
                 SMS Reports
                </a>
                <br/>
                <div class="mt-3"></div>
                <a href="#" class="btn btn-primary">
                 WhatsApp Reports
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="wallet-widget card">
                        <h5>Emails Sent </h5>
                        <h2><span class="text-primary">23</span><sub>sent</sub></h2>
                         <p>20 Recieved</p>

                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="wallet-widget card">
                        <h5>SMSs</h5>
                        <h2><span class="text-success">41</span> <sub>sent</sub></h2>
                        <p>20 Recieved</p>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="wallet-widget card">
                        <h5>Whatsapp</h5>
                        <h2><span class="text-warning">16</span> <sub>sent</sub></h2>
                        <p>10 read</p>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <div class="wallet-widget card">
                        <h5>Global Traffic </h5>
                        <h2><span class="text-danger">16 000 </span> <sub>impressions</sub></h2>
                        <p>900 returning</p>
                    </div>
                </div>
            </div>
        <div class="col-xxl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Information</h4>
              <a href="/user/edit" class="btn btn-primary">Edit</a>
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
                    <h4> {{$user->company}} </h4>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>JOINED SINCE</span>
                    <h4>20/10/2020</h4>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>TYPE</span>
                    <h4>  </h4>
                  </div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                  <div class="user-info">
                    <span>Region</span>
                    <h4>  </h4>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>


        <div class="col-xxl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Api Token</h4>
            </div>
            <div class="card-body">
             
            </div>
          </div>
        </div>
      
      </div>
    </div>
@endsection