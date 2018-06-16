@extends('layouts.master')

@section('title')

{{ $currentUser->healthFacility->name }} - Received Drugs

@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-light">

            <strong>{{ $currentUser->healthFacility->name }} - Received Drugs</strong>

            <div class="float-right">
                <a href="{{ URL::current() }}" class="btn btn-sm btn-warning">
                    <i class="icon icon-refresh"></i> Refresh Pages
                </a>
            </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
              <table class="table table-sm table-striped table-bordered">
                  <thead>
                    <tr>
                      <th colspan="10" class="text-center text-primary">Received Drugs</th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Drug</th>
                        <th>Quantity</th>
                        <th>Qnty Left</th>
                        <th>Organization</th>
                        <th>Manufacture Date</th>
                        <th>Expiry Date</th>
                        <th>Batch No.</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse( $stockBooks as $key => $stockBook)
                    <tr>
                      <td colspan="8" class="text-center"><strong>{{ $stockBook['name'] . " - " . $stockBook->cycle['name'] . " - ". $stockBook->cycle->financialYear['financial_year'] }}</strong> </td>
                    </tr>

                      @forelse( $stockBook->receivedDrugs as $key => $receievedDrug)
                      @if( $receievedDrug['expiry_date']  <= $current_date)
                        <tr >
                            <td>{{ ++$key }}</td>
                            <td class="text-nowrap" bgcolor="red">{{ $receievedDrug->drug['name'] }}</td>
                            <td bgcolor="red">{{ $receievedDrug['quantity'] }}</td>
                            <td bgcolor="red">{{ $receievedDrug['quantity_remaining'] }}</td>
                            <td bgcolor="red">{{ $receievedDrug['organization'] }}</td>
                            <td bgcolor="red">{{ $receievedDrug['manufacture_date'] }}</td>
                            <td bgcolor="red">{{ $receievedDrug['expiry_date'] }}</td>
                            <td bgcolor="red">{{ $receievedDrug['batch_number'] }}</td>
                        </tr>
                        @else
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td class="text-nowrap">{{ $receievedDrug->drug['name'] }}</td>
                            <td>{{ $receievedDrug['quantity'] }}</td>
                            <td>{{ $receievedDrug['quantity_remaining'] }}</td>
                            <td>{{ $receievedDrug['organization'] }}</td>
                            <td>{{ $receievedDrug['manufacture_date'] }}</td>
                            <td>{{ $receievedDrug['expiry_date'] }}</td>
                            <td>{{ $receievedDrug['batch_number'] }}</td>
                        </tr>
                        @endif
                      @empty
                        <tr>
                          <td colspan="8" class="text-center text-danger">No Drugs Recieved</td>
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
        <div class="p-4">
            <canvas id="bar-chart" width="100%" height="50"></canvas>
        </div>
    </div>
@endsection

@section('script')

@endsection
