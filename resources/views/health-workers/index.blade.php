@extends('layouts.master')

@section('title')

{{ strtoupper($currentUser->healthFacility->name) }} - Health Workers

@endsection


@section('content')
      <div class="card">
        <div class="card-body bg-light">
          <strong>{{ strtoupper($currentUser->healthFacility->name) ." ". strtoupper($currentUser->healthFacility->level) }} - HEALTH WORKERS</strong>
          <div class="float-right">
              <a href="{{ route('health-workers.create') }}" class="btn btn-sm btn-primary">
                  <i class="fa fa-plus-circle"></i> Create New
              </a>

              <a href="{{ URL::current() }}" class="btn btn-warning btn-sm">
                  <i class="icon icon-refresh"></i> Refresh
              </a>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-sm table-striped table-bordered">
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
@endsection

@section('script')

@endsection
