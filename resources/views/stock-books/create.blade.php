@extends('layouts.master')

@section('title')

Stock Book- {{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }}

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">

            <h3> <b>{{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }} - Add Stock Book</b> </h3>

            <div class="card-actions">
                <a href="{{ route('stock-books.index') }}" class="btn">
                    <i class="fa fa-eye"></i>
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i>
                </a>
            </div>
        </div>

        <div class="card-body">
          @include ('components.notifications')
            {{ Form::open(['route' => 'stock-books.store']) }}
              <div class="form-group">
                {{ Form::label('health_facility_name') }}
                {{ Form::text('health_facility', $currentUser->healthFacility['name'], ['class' => 'form-control', 'readonly']) }}
                @if( $errors->has('health_facility') )
                  <strong class="text-danger">{{ $errors->first('health_facility') }}</strong>
                @endif
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  {{ Form::label('stock_book_name') }}
                  {{ Form::text('name', '', ['class' => 'form-control']) }}
                  @if( $errors->has('name') )
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('financial_year_cycle') }}
                  <select class="form-control" name="cycle">
                    @forelse( $financialYears as $key => $financialYear)
                      <optgroup label="{{ $financialYear['financial_year'] }}">
                        @forelse( $financialYear->cycles as $key => $cycle)
                          <option value="{{ $cycle['id'] }}" {{ old('cycle') == $cycle['id'] ? 'selected' : '' }}>{{ $cycle['name'] . ' - Start Date: ' . $cycle['start_date'] }}</option>
                        @empty
                          <option value="">No Cycles Exists</option>
                        @endforelse
                      </optgroup>
                    @empty
                      <option value="">No Financial Years Exists</option>
                    @endforelse
                  </select>
                  @if( $errors->has('cycle') )
                    <strong class="text-danger">{{ $errors->first('cycle') }}</strong>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('start_date') }}
                  {{ Form::date('start_date', '', ['class' => 'form-control']) }}
                  @if( $errors->has('start_date') )
                    <strong class="text-danger">{{ $errors->first('start_date') }}</strong>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('end_date') }}
                  {{ Form::date('end_date', '', ['class' => 'form-control']) }}
                  @if( $errors->has('end_date') )
                    <strong class="text-danger">{{ $errors->first('end_date') }}</strong>
                  @endif
                </div>
              </div>
              <div class="form-group">
                {{ Form::submit('Save Data', ['class' => 'btn btn-sm btn-primary']) }}
              </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready( function() {

      
    });
  </script>
@endsection
