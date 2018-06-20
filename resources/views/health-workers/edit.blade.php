@extends('layouts.master')

@section('title', 'NDRMS - General Settings')

@section('content')

    <div class="container-fluid">
        <div class="card border-info">
            <div class="card-header bg-info">
                Account Settings

                <div class="card-actions">
                   <a href="{{ route('settings') }}" class="btn btn-sm">
                       <i class="fa fa-cog"></i> Settings
                   </a>
               </div>
            </div>

            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-4 mb-4">
                        <h4 class="text-info">Profile Information</h4>
                        <div class="text-muted small">These information are visible to the top Administration.</div>
                        <img src="{{ asset('imgs/avatar-1.png') }}" class="avatar avatar-lg img-responsive" alt="Profile photo">
                    </div>

                    <div class="col-md-8">
                        {{ Form::open(['route' => ['health-workers.update', Auth::user()->id ], 'method' => 'PATCH']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Full Name</label>
                                    {{ Form::text('name', $currentUser->name, ['class' => 'form-control']) }}
                                    @if( $errors->has('name'))
                                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Address</label>
                                    {{ Form::text('address', $currentUser->address, ['class' => 'form-control']) }}
                                    @if( $errors->has('address'))
                                      <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Tel No.</label>
                                    {{ Form::text('phone', $currentUser->phone, ['class' => 'form-control']) }}
                                    @if( $errors->has('phone'))
                                      <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    {{ Form::text('email', $currentUser->email, ['class' => 'form-control']) }}
                                    @if( $errors->has('email'))
                                      <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Gender</label>
                                    {{ Form::select('gender', [ 'M' => 'Male', 'F' => 'Female'], $currentUser->gender, ['class' => 'form-control']) }}
                                    @if( $errors->has('gender'))
                                      <strong class="text-danger">{{ $errors->first('gender') }}</strong>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Account Status</label>
                                    <input class="form-control" value="{{ $currentUser->status == 1 ? 'Active' : 'Inactive' }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                              {{ Form::submit('Update Profile', ['class' => 'btn btn-sm btn-primary']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>

        </div>
    </div>
@endsection
