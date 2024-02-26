@extends('layouts.general')

@section('content')
  <div class="authincation section-padding">
    <div class="container h-100">
    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-8">

            <div class="mini-logo text-center my-4">
            <a href="/"><img src="/images/small.png" alt="" /></a>
            <h4 class="card-title mt-5">{{ __('Reset Password') }}</h4>
          </div>


            <div class="card" style="box-shadow: none;">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3" style="width:500px; margin: 0 auto;">
                            <label for="email" class="col-md-12 col-form-label text-md-start">{{ __('Email Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send Password Reset Link') }}
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


@endsection
