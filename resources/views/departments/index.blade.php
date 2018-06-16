@extends('layouts.master')

@section('title')

{{ $currentUser->healthFacility->name }} - Departments

@endsection

@section('content')
      <div class="card">
        <div class="card-header bg-light">

            <strong>{{ $currentUser->healthFacility->name }} - Departments</strong>

            <div class="card-actions">
                <a href="{{ route('departments.create') }}" class="btn">
                    <i class="fa fa-plus-circle"></i> Create New
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i> Reload
                </a>
            </div>
        </div>
      </div>

      <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home"><b>Departments</b></a>
      </li>

      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"><b>Charts</b></a>
      </li>

      </ul>

      <div class="tab-content">
      <div class="tab-pane active" id="home" role="tabpanel">
      <div class="table-responsive">

        <table class="table table-striped table-bordered table-sm" id="dataTable">
          <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Drugs Received</th>
            <th>Date Created</th>
            <th>Actions</th>
          </thead>
          <tbody>
            @forelse($departments as $key =>  $department)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $department['name'] }}</td>
                <td>{{ $department->issueDrugs()->count() }}</td>
                <td>{{ \Carbon\Carbon::parse($department['created_at'])->toDayDateTimeString() }}</td>
                <td>
                  <a href="{{ route('departments.edit', $department['id']) }}" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"></i> &nbsp;
                  </a>
                  {{ Form::open(['route' => ['departments.destroy', $department->id], 'method' => 'DELETE', 'style' => 'display:inline-block !important;']) }}
                    <button type="submit" name="delete" class="btn btn-danger btn-sm">
                      <i class="fa fa-trash"></i> &nbsp;
                    </button>
                  {{ Form::close() }}
                  <a href="{{ route('department.report') }}" class="btn btn-sm btn-primary">Submit Report</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">No Department exist</td>
              </tr>
            @endforelse
          </tbody>
        </table>
        <div class="col-md-12">
          {{ $departments->links() }}
        </div>
      </div>


    </div>

    <div class="tab-pane active" id="profile" role="tabpanel">
     <div class="row mt-4">
      <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-light">
                    Department Consumption Of Drugs
                </div>

                <div class="card-body">
                    <canvas id="bar-chart" width="100%" height="50"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-light">
                  Department Consumption Of Drugs
              </div>

              <div class="card-body">
                  <canvas id="pie-chart" width="100%" height="50"></canvas>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')

<script type="text/javascript">

$(document).ready(function () {

var barChart = $('#bar-chart');

if (barChart.length > 0) {
    new Chart(barChart, {
        type: 'bar',
        data: {
            labels: [

              @foreach($departments as $key =>  $department)
                  {!! "'".$department['name']. "'," !!}
              @endforeach

            ],
            datasets: [{
                label: 'Received Drugs',
                data: [

                    @foreach($departments as $key =>  $department)
                        {!! "'".$department->issueDrugs()->count(). "'," !!}
                    @endforeach

                ],
                backgroundColor: [
                    'rgba(244, 88, 70, 0.5)',
                    'rgba(33, 150, 243, 0.5)',
                    'rgba(0, 188, 212, 0.5)',
                    'rgba(42, 185, 127, 0.5)',
                    'rgba(156, 39, 176, 0.5)',
                    'rgba(253, 178, 68, 0.5)'
                ],
                borderColor: [
                    '#F45846',
                    '#2196F3',
                    '#00BCD4',
                    '#2ab97f',
                    '#9C27B0',
                    '#fdb244'
                ],
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}
var pieChart = $('#pie-chart');

if (pieChart.length > 0) {
    new Chart(pieChart, {
        type: 'pie',
        data: {
            labels: [
              @foreach($departments as $key =>  $department)
                  {!! "'".$department['name']. "'," !!}
              @endforeach
            ],
            datasets: [{
                label: 'Users',
                data: [
                  @foreach($departments as $key =>  $department)
                      {!! "'".$department->issueDrugs()->count(). "'," !!}
                  @endforeach

                ],
                backgroundColor: [
                    'rgba(244, 88, 70, 0.5)',
                    'rgba(33, 150, 243, 0.5)',
                    'rgba(0, 188, 212, 0.5)',
                    'rgba(42, 185, 127, 0.5)',
                    'rgba(156, 39, 176, 0.5)',
                    'rgba(253, 178, 68, 0.5)'
                ],
                borderColor: [
                    'rgba(244, 88, 70, 0.5)',
                    'rgba(33, 150, 243, 0.5)',
                    'rgba(0, 188, 212, 0.5)',
                    'rgba(42, 185, 127, 0.5)',
                    'rgba(156, 39, 176, 0.5)',
                    'rgba(253, 178, 68, 0.5)'
                ],
                borderWidth: 1
            }]
        }
    });
}
});

</script>
@endsection
