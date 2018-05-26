    @extends('layouts.master')

    @section('title', 'NDRMS - All Stocks')

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

            </div>
        </div>

      @endsection
