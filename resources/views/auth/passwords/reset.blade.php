@extends('layouts.app')

@section('title', 'NDRMS - STAFF RESET PASSWORD')

@section('content')

    <div class="card-header text-center text-info text-uppercase h6 font-weight-bold border-0 border-top-0 border-right-0 border-left-0">
      <i class="icon icon-lock"></i>  NDMRS - STAFF RESET PASSWORD
    </div>

    <div class="card-body py-2">
          <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
              {{ csrf_field() }}

              <input type="hidden" name="token" value="{{ $token }}">

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email" class="control-label">E-Mail Address</label>

                      <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif

              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="control-label">Password</label>

                      <input id="password" type="password" class="form-control" name="password" required>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif

              </div>

              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label for="password-confirm" class="control-label">Confirm Password</label>
                  <div class="col-md-6">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                      @if ($errors->has('password_confirmation'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                          Reset Password
                      </button>
                  </div>
              </div>
          </form>
      </div>
@endsection
