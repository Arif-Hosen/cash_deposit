@extends('layout.auth')
@section('content')
  <div class="card ">
    <div class="card-body">
      <div class="row">
        <div style="background-color:#54359D;" class="col-12 text-center rounded"><a href="{{ route('home') }}" class="logo logo-admin">
{{--            <img src="{{ asset('assets/text-logo.png') }}" height="80" alt="logo">--}}
            <h4 style="color:white;">Cash Deposit</h4>
          </a></div>
      </div>
      <div class="pl-3 pr-3 pb-3">
        <div class="row">
          <div  class="col-12 text-center">
            <h3 class="m-2" style="color:#54359D;">Login</h3>
          </div>
        </div>
        @if(session()->has('status'))
          {!! session()->get('status') !!}
        @endif
        <form class="form-horizontal" action="{{ route('login')}}" method="post">
          @csrf
          <div class="form-group">
            <label class="form-label" for="text">Login ID</label>
            <div class="d-flex">
              <input type="username" name="username" id="username" placeholder="Enter Your username"
                     class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
              <span class="mt-1 "><i class="fa fa-duotone fa-envelope icon login-icon"></i></span>
            </div>

            <span class="spin"></span>
            @error('username')
            <strong class="text-danger">{{ $errors->first('username') }}</strong>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="d-flex">
              <input type="password" name="password" id="password" placeholder="Enter Your Password" autocomplete="off"
                     class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
              <span class="mt-1 "><i class="fa fa-regular fa-key icon login-icon"></i></span>
            </div>

            <span class="spin"></span>
            @error('password')
            <strong class="text-danger">{{ $errors->first('password') }}</strong>
            @enderror
          </div>

          <div class="form-group row m-t-20">
            <div class="col-sm-12 text-right">
{{--              <a href="{{ route('register') }}" class="btn btn-primary mr-1 w-md waves-effect waves-light">Register</a>--}}
              <button style="background-color:#54359D;" class="btn text-light w-md waves-effect waves-light" type="submit">Log In</button>

            </div>
            <a href="{{ route('password.request') }}" class=" mt-3 mx-auto">Forget Password?</a>
          </div>
        </form>
      </div>

    </div>
  </div>
@endsection
