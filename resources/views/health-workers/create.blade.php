@extends('layouts.master')

@section('title')

{{ strtoupper($currentUser->healthFacility->name) }} - Create New Health Workers

@endsection

@section('content')

        <div class="card">
            <div class="card-header bg-light">
                <strong>Create New Health Worker</strong>
                <div class="float-right">
                  <a href="{{ route('health-workers.index') }}" class="btn btn-primary btn-sm"> <i class="icon icon-eye"></i> View All </a>
                  <a href="{{ URL::current() }}" class="btn btn-info btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
                </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">

              @include('components.notifications')

              {{ Form::open([ 'route' => 'health-workers.store', 'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', '', ['class' => 'form-control'] ) }}
                        @if( $errors->has('name'))
                          <div class="text-danger">
                            {{ $errors->first('name') }}
                          </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        {{ Form::label('gender', 'Gender') }}
                        {{ Form::select('gender', [
                                                  'M' => 'Male',
                                                  'F' => 'Female',
                                                  ], 'M', ['class' => 'form-control']) }}

                        @if( $errors->has('gender'))
                          <div class="text-danger">
                            {{ $errors->first('gender') }}
                          </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                      {{ Form::label('health_facility', 'Health Facility') }}
                      {{ Form::text('health_facility', strtoupper($currentUser->healthFacility->name), ['class' => 'form-control', 'readonly']) }}
                      @if( $errors->has('health_facility'))
                        <div class="text-danger">
                          {{ $errors->first('health_facility') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-md-6">
                      {{ Form::label('phone', 'Phone') }}
                      {{ Form::text('phone', '', ['class' => 'form-control']) }}
                      @if( $errors->has('phone'))
                        <div class="text-danger">
                          {{ $errors->first('phone') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-md-6">
                      {{ Form::label('email', 'Email') }}
                      {{ Form::email('email', '', ['class' => 'form-control']) }}
                      @if( $errors->has('email'))
                        <div class="text-danger">
                          {{ $errors->first('email') }}
                        </div>
                      @endif
                    </div>

                    <div class="col-md-6">
                      {{ Form::label('address', 'Address') }}
                      {{ Form::text('address', '', ['class' => 'form-control']) }}
                      @if( $errors->has('address'))
                        <div class="text-danger">
                          {{ $errors->first('address') }}
                        </div>
                      @endif
                    </div>

                </div>
                <div class="my-4">
                  {{ Form::submit('Create New', ['class' => 'btn btn-primary btn-sm']) }}
                </div>
              {{ Form::close() }}
            </div>
        </div>


@endsection
