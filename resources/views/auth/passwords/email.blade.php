@extends('layouts.app')

@section('title', 'NDRMS - Reset Password')

@section('content')
          <div class="col-md-4">
              <div class="card">
                <div class="card-header  border border-top-0 border-right-0 border-left-0">
                  RESET PASSWORD
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Address</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>

                    </form>
                </div>
                <div class="card-footer bg-light">
                  <div class="card-action">
                    <a class="btn btn-link" href="{{ route('login') }}">
                        Remember Password?
                    </a>
                  </div>
                </div>
            </div>
        </div>

@endsection
