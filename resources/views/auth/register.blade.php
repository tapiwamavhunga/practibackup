<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>Medinformer Practitioner Portal</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logoi.png" />
    <!-- Custom Stylesheet -->
     
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet"> 
<script src="https://kit.fontawesome.com/be0233d1e2.js" crossorigin="anonymous"></script>

<style type="text/css">
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap");
    .formfields .formfield input[type="text"], .formfields .formfield input[type="file"], .formfields .formfield input[type="password"], .formfields .formfield textarea, .formfields .formfield select{
        font-family: Poppins !important;
    }

    body {
  margin: 0;
  font-family: "Archivo", sans-serif !important;
  font-size: 13px !important;
  font-weight: 400;
  line-height: 1.5;
  color: #7184ad;
  background-color: #fff;
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
#main-wrapper {
  opacity: 1 !important;
  -webkit-transition: all 0.25s ease-in;
  transition: all 0.25s ease-in;
  overflow: hidden;
  position: relative;
  z-index: 1;
  margin-top: 80px;
}

</style>
  </head>

  <body class="@@dashboard">


<div id="main-wrapper">
  <div class="authincation section-padding">
    <div class="container h-100">
      <div class="row justify-content-center h-100 align-items-center">
        <div class="col-xl-10">
          <div class="mini-logo text-center my-4">
            <a href="/"><img src="images/small.png" alt="" /></a>
            <h4 class="card-title"  style="color: #0179c1;">Welcome to Medinformer Patient Information Sharing portal</h4>
          </div>
          <div class="auth-form card">
            <div class="card-body">
              <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            
                        
                        <div class="col-md-6 mt-3">
                            <label for="name" class="col-form-label text-md-start">{{ __('Name') }}</label>

                            
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6 mt-3">
                            <label for="email" class="col-form-label text-md-start">{{ __('Email Address') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                             <div class="col-md-6 mt-3">
                                <label for="phone_number" class="col-form-label text-md-start">{{ __('Phone Number') }}</label>

                           
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                    

                            <div class="col-md-6 mt-3">
                             <label for="practice_number" class="col-form-label text-md-start">{{ __('HCP Professional number') }}</label>

                            
                                <input id="practice_number" type="text" class="form-control @error('practice_number') is-invalid @enderror" name="practice_number" value="{{ old('practice_number') }}" required autocomplete="practice_number" autofocus>

                                @error('practice_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                             


                            <div class="col-md-6 mt-3">
                            <label for="password" class="col-form-label text-md-start">{{ __('Password') }}</label>

                            
                                <div class="form-group pass_show"> 
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                           


                         <div class="col-md-6 mt-3">
                            <label for="password-confirm" class="col-form-label text-md-start">{{ __('Confirm Password') }}</label>

                            
                                <div class="form-group pass_show"> 
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                            <div class="col-md-12  mt-3">

                                <button type="submit" class="btn btn-primary  btn-block text-md-middle mt-3" style="width: 100%;">
                                                                       {{ __('Register') }}

                                </button>

                                
                            </div>

                            </div>
                    </form>
             
            </div>
          </div>
          <div class="privacy-link">
             <p class="mt-3 mb-0 text-center">
                Already have an account?
                <a class="text-primary" href="/login">Sign in</a>
              </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="js/scripts.js"></script>

<style>
        form i {
            margin-left: -30px;
            cursor: pointer;
        }

        .pass_show{position: relative} 

.pass_show .ptxt { 

position: absolute; 

top: 50%; 

right: 10px; 

z-index: 1; 

color: #f36c01; 

margin-top: -10px; 

cursor: pointer; 

transition: .3s ease all; 

} 

.pass_show .ptxt:hover{color: #333333;} 

    </style>
<script>
    
$(document).ready(function(){
$('.pass_show').append('<span class="ptxt">Show</span>');  
});
  

$(document).on('click','.pass_show .ptxt', function(){ 

$(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

$(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

});  
    </script>
</body>


</html>
