@extends('layouts.master')

@section('title', 'NDRMS - Expired Drugs')


@section('content')
      <div class="card">
        <div class="card-header bg-light">
          <strong>{{ strtoupper($currentUser->healthFacility->name) ." ". strtoupper($currentUser->healthFacility->level) }} - Expired Drugs</strong>
          <div class="card-actions">
            <a href="{{ URL::current() }}" class="btn">
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
              <th>Expiry Date</th>
              <th>Manufacture Date</th>
            </tr>
            </thead>
            <tbody>
            @forelse( $expiredDrugs as $key => $expiredDrug)
              <tr>
                <td>{{ ++$key }}</td>
                <td class="text-nowrap">{{ $expiredDrug->drug['name'] }}</td>
                <td>{{ $expiredDrug['manufacture_date'] or 'Not Found' }}</td>
                <td>{{ $expiredDrug['expiry_date'] or 'Not Found' }}</td>
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
