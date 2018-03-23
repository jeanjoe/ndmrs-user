@extends('layouts.app')

@section('title', 'NDRMS - Staff Login')

@section('content')
              <div class="col-md-4">
                  <div class="card">
                    <div class="card-header text-center text-uppercase h4 font-weight-bold border border-top-0 border-right-0 border-left-0">
                        Staff Login
                    </div>

                    <div class="card-body py-2">
                      @if(session('error'))
                        <div class="alert alert-danger">
                          {{ session('error') }}
                        </div>
                      @endif
                      {{ Form::open(['route' => 'login' ]) }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{ Form::label('email', 'E-mail Address') }}
                            {{ Form::text('email', '', ['class' => 'form-control', 'required']) }}
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          {{ Form::label('password', 'Password') }}
                          {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                          @if ($errors->has('password'))
                              <span class="text-danger">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">
                              <i class="icon icon-login"></i>  Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light">
                  <div class="card-action">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>
                  </div>
                </div>
            </div>
        </div>

@endsection
