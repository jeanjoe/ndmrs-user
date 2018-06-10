@extends('layouts.master')

@section('title')

Stock Book- {{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }}

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">

            <h5> <b>{{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }} - Departments</b> </h5>

            <div class="card-actions">
                <a href="{{ route('departments.index') }}" class="btn">
                    <i class="fa fa-eye"></i>
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
          @include ('components.notifications')
            {{ Form::open(['route' => ['departments.update', $department['id']], 'method' => 'PATCH']) }}
              <div class="form-group">
                {{ Form::label('health_facility') }}
                {{ Form::text('health_facility', $currentUser->healthFacility['name'], ['class' => 'form-control', 'readonly']) }}
                @if( $errors->has('health_facility') )
                  <strong class="text-danger">{{ $errors->first('health_facility') }}</strong>
                @endif
              </div>
              <div class="form-group">
                {{ Form::label('name') }}
                {{ Form::text('name', $department['name'], ['class' => 'form-control']) }}
                @if( $errors->has('name') )
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                @endif
              </div>
              <div class="form-group">
                {{ Form::submit('Update Department', ['class' => 'btn btn-sm btn-primary']) }}
              </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection
