@extends('layouts.master')

@section('title')

{{ $currentUser->healthFacility->name }} - Issued Drugs

@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-light">

            <strong>{{ $currentUser->healthFacility->name }} - Issued Drugs</strong>

            <div class="float-right">
                <a href="{{ URL::current() }}" class="btn btn-sm btn-warning">
                    <i class="icon icon-refresh"></i> Refresh Pages
                </a>
                <a href="{{ route('drugs.analyzed') }}" class="btn btn-sm btn-success">
                    <i class="icon icon-refresh"></i> Analyze
                </a>
            </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover">
              <thead>
                <tr>
                  <th colspan="6" class="text-center text-danger">Issued Drugs</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Drug</th>
                    <th>Quantity</th>
                    <th>Quantity Left</th>
                    <th>Department</th>
                    <th>Date</th>
                </tr>
              </thead>
              <tbody>
                @forelse( $stockBooks as $key => $stockBook)
                  <tr>
                    <td colspan="8" class="text-center"><strong>{{ $stockBook['name'] . " - " . $stockBook->cycle['name'] . " - ". $stockBook->cycle->financialYear['financial_year'] }}</strong> </td>
                  </tr>

                  @forelse( $stockBook->issuedDrugs as $key => $issuedDrug)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $issuedDrug->drug->name }}</td>
                      <td>{{ $issuedDrug->quantity }}</td>
                      <td>{{ $issuedDrug->quantity_remaining }}</td>
                      <td>{{ $issuedDrug->department->name }}</td>
                      <td>{{ $issuedDrug->created_at }}</td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="8" class="text-center text-danger">No Drugs Issued</td>
                      </tr>
                    @endforelse
                  @empty
                    <tr>
                      <td colspan="8" class="text-center text-danger">No Stock Books are Available</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
          </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
