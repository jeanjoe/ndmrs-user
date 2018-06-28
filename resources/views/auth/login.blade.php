@extends('layouts.app')

@section('title', 'NDRMS - STAFF LOGIN')

@section('content')

    <div class="card-header text-center text-info text-uppercase h6 font-weight-bold border-0 border-top-0 border-right-0 border-left-0">
      <i class="icon icon-lock"></i>  NDMRS - STAFF LOGIN
    </div>

    <div class="card-body py-2">
      {{ Form::open(['route' => 'login']) }}
        <div class="input-group input-group-md mb-3{{ $errors->has('email') ? ' has-error border-danger' : '' }}">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="icon icon-envelope"></i> </span>
          </div>
          {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' =>'Email Address', 'required']) }}
          @if ($errors->has('email'))
            <strong class="text-danger">{{ $errors->first('email') }}</strong>
          @endif
        </div>

        <div class="input-group input-group-md mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="icon icon-key"></i> </span>
          </div>
          {{ Form::password('password',['class' => 'form-control', 'placeholder' => 'Password', 'required']) }}
          @if ($errors->has('password'))
              <strong class="text-danger">{{ $errors->first('password') }}</strong>
          @endif
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-block btn-rounded btn-info px-5">
            <i class="icon icon-login"></i>  Sign in
          </button>
        </div>

      {{ Form::close() }}
    </div>
    <div class="card-footer">
      Forgot Password? <a href="{{ route('password.request') }}"> Reset</a>
    </div>
@endsection
