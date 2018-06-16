    @extends('layouts.master')

    @section('title', 'NDRMS - Report')

    @section('content')

        <div class="card">
            <div class="card-body bg-light">
                <strong>Create New Stock </strong>
                <div class="float-right">
                  <a href="{{ route('stocks.index') }}" class="btn btn-primary btn-sm"> <i class="icon icon-eye"></i> View All </a>
                  <a href="{{ URL::current() }}" class="btn btn-info btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
                </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
              {{ Form::open(['route' => 'reports', 'method' => 'GET']) }}
                <div class="row">
                  <div class="form-group col-md-6">
                    {{ Form::select('financialYear', $financialYears, null, ['class' => 'form-control', 'placeholder' => 'Select Financial Year']) }}
                  </div>
                  <div class="form-group col-md-6">
                    {{ Form::submit('Analyse', ['class' => 'btn btn-block btn-md btn-primary']) }}
                  </div>
                </div>
              {{ Form::close() }}
            </div>
        </div>

      @endsection

      @section('script')

      @endsection
