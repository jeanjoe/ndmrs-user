@extends('layouts.master')

@section('title', 'NDRMS -Orders')


@section('content')
    <div class="card">
        <div class="card-header bg-success">

            {{ strtoupper($currentUser->healthFacility->name) ." ". strtoupper($currentUser->healthFacility->level) }} - HEALTH WORKERS

            <div class="card-actions">
                <a href="{{ route('orders.create') }}" class="btn">
                    <i class="fa fa-plus-circle"></i>
                </a>

                <a href="{{ URL::current() }}" class="btn btn-warning btn-sm">
                    <i class="icon icon-refresh"></i> Refresh
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
          			<thead>
        			    <tr>
            				<th>#</th>
            				<th>Name</th>
            				<th>Email</th>
            				<th>Phone</th>
            				<th>Health Facility</th>
            				<th>Level</th>
        			    </tr>
          			</thead>
          			<tbody>
                  @foreach( $healthWorkers as $key => $healthWorker)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $healthWorker->name }}</td>
                    <td>{{ $healthWorker->email }}</td>
                    <td>{{ $healthWorker->phone }}</td>
                    <td>{{ $healthWorker->healthFacility->name }}</td>
                    <td>{{ $healthWorker->healthFacility->level }}</td>
                  </tr>
                  @endforeach
          			</tbody>
          		</table>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
