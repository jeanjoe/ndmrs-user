@extends('layouts.master')

@section('title')

{{ $currentUser->healthFacility->name }} - Departments Reports

@endsection

@section('content')
      <div class="card">
        <div class="card-header bg-light">

            <strong>{{ $currentUser->healthFacility->name }} - Departments Reports</strong>

            <div class="card-actions">
                <a href="{{ route('department.report') }}" class="btn">
                    <i class="fa fa-plus-circle"></i>
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i>
                </a>
            </div>
        </div>
      </div>

      <div class="table-responsive">

        <table class="table table-striped table-bordered table-sm" id="dataTable">
          <thead>
            <th>No.</th>
            <th>Drug</th>
            <th>Quantity Received</th>
            <th>Quantity Used</th>
            <th>Drugs Left</th>
            <th>Department</th>
            <th>Date Created</th>
          </thead>
          <tbody>
            @forelse($reports as $key =>  $report)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $report->issuedDrug->drug->name or 'Not Found' }}</td>
                <td>{{ $report->issuedDrug['quantity'] }}</td>
                <td>{{ $report['quantity'] }}</td>
                <td>{{ $report->issuedDrug['quantity_remaining'] }}</td>
                <td>{{ $report->issuedDrug->department->name or 'Not Found' }}</td>
                <td>{{ $report['created_at'] }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5">No Department exist</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="col-md-12">
          {{ $reports->links() }}
        </div>
      </div>
@endsection

@section('script')

@endsection
