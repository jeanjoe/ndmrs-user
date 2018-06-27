@extends('layouts.app')

@section('title', 'NDRMS - STAFF RESET PASSWORD')

@section('content')

    <div class="card-header text-center text-info text-uppercase h6 font-weight-bold border-0 border-top-0 border-right-0 border-left-0">
      <i class="icon icon-lock"></i>  NDMRS - STAFF RESET PASSWORD
    </div>

    <div class="card-body py-2">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="input-group input-group-md mb-3{{ $errors->has('email') ? ' has-error border-danger' : '' }}">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="icon icon-envelope"></i> </span>
              </div>
              {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' =>'Email Address', 'required']) }}
              @if ($errors->has('email'))
                <strong class="text-danger">{{ $errors->first('email') }}</strong>
              @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
    <div class="card-footer">
      Remember Password ?<a href="{{ route('login') }}"> Sign in</a>
    </div>
@endsection
