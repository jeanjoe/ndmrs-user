@extends('layouts.master')

@section('title', 'NDRMS - All Orders')

@section('content')

        <div class="card">
            <div class="card-header bg-light">
                <strong>Create New Stock </strong>
                <div class="float-right">
                  <a href="{{ route('stocks.index') }}" class="btn btn-primary btn-sm"> <i class="icon icon-eye"></i> View All </a>
                  <a href="{{ URL::current() }}" class="btn btn-info btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
                </div>
            </div>

            <div class="card-body">

              @if( session('success') )
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif


              @if( session('error') )
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              @endif

              {{ Form::open([ 'route' => 'stocks.store', 'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="col-md-6">
                        {{ Form::label('name', 'Drug Name') }}
                        <select class="form-control" name="name">
                          <option value="">Select Drug</option>
                          @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                          @endforeach
                        </select>
                        @if( $errors->has('name'))
                          <div class="text-danger">
                            {{ $errors->first('name') }}
                          </div>
                        @endif
                    </div>
                      {{ Form::hidden('health_facility', $currentUser->healthFacility->id , ['class' => 'form-control'] ) }}

                    <div class="col-md-6">
                        {{ Form::label('status', 'Status') }}
                        {{ Form::select('status', ['A'=>'Active', 'D'=> 'Deactive'], 'A', ['class' => 'form-control'] ) }}

                        @if( $errors->has('status'))
                          <div class="text-danger">
                            {{ $errors->first('status') }}
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
