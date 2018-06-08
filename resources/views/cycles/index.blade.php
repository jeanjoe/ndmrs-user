@extends('layouts.master')

@section('title')

Stock Book- {{ $currentUser->healthFacility->name }}

@endsection

@section('content')
    @forelse( $financialYears as $key => $financialYear)
      <div class="card">
        <div class="card-body">
          <h4>Financial Year - {{ $financialYear['financial_year'] }} <span class="float-right">Budget {{ number_format($financialYear['budget']) }} UGX</span> </h4>
        </div>
      </div>

      <div class="row">
        @forelse( $financialYear->cycles as $key => $cycle)
          <div class="col-md-3">
            <div class="card p-2 text-center">
              <div class="card-header">
                <strong>{{ strtoupper($cycle['name']) }} BUDGET</strong>
              </div>
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <span class="h6 d-block font-weight-normal mb-2">{{ number_format($financialYear['budget'] / 4) }} UGX</span>
                  <p class="font-weight-light">{{ $cycle['start_date'] }} - {{ $cycle['end_date'] }}</p>
                  <a href="{{ route('cycles.order.show', $cycle['id']) }}" class="btn btn-sm btn-block btn-primary"><i class="fa fa-external-link-alt"></i> Make Order</a>
                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h5 class="text-danger">No Cycles Exists</h5>
              </div>
            </div>
          </div>
        @endforelse
      </div>
    @empty
      <div class="card">
        <div class="card-body">
          <h5 class="text-danger">No Cycles Exists</h5>
        </div>
      </div>
    @endforelse
@endsection

@section('script')

@endsection
