@extends('layouts.master')

@section('title', 'NDRMS - Expired Drugs')


@section('content')
      <div class="card">
        <div class="card-header bg-light">
          <strong>{{ strtoupper($currentUser->healthFacility->name) ." ". strtoupper($currentUser->healthFacility->level) }} - Expired Drugs</strong>
          <div class="float-right">
            <a href="{{ URL::current() }}" class="btn btn-warning btn-sm">
                <i class="icon icon-refresh"></i> Refersh Page
            </a>
          </div>
        </div>
      </div>

      @include('components.notifications')
      <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
              <th>#</th>
              <th>Drug</th>
              <th>Quantity</th>
              <th>Expiry Date</th>
              <th>Manufacture Date</th>
              <th>Date Time</th>
            </tr>
            </thead>
            <tbody>
            @forelse( $expiredDrugs as $key => $expiredDrug)
              <tr>
                <td>{{ ++$key }}</td>
                <td class="text-nowrap">{{ $expiredDrug->drug['name'] }}</td>
                <td class="text-nowrap">{{ $expiredDrug['quantity_remaining'] }}</td>
                <td>{{ $expiredDrug['manufacture_date'] or 'Not Found' }}</td>
                <td>{{ $expiredDrug['expiry_date'] or 'Not Found' }}</td>
                <td class="text-danger"> <strong>{{ \Carbon\Carbon::parse($expiredDrug['expiry_date'])->diffForHumans() }}</strong> </td>
              </tr>
            @empty
              <tr>
                <td colspan="8">You have not Expired Drugs any orders</td>
              </tr>
            @endforelse
            </tbody>
        </table>
      </div>

@endsection

@section('script')

@endsection
