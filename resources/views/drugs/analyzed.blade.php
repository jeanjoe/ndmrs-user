@extends('layouts.master')

@section('title')

{{ $currentUser->healthFacility->name }} - Analyze {{ $drug->name or 'Not Found'}}

@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-light">

            <strong>{{ strtoupper($currentUser->healthFacility->name) }} - ANALYZING {{ $drug ? strtoupper($drug->name) : 'No Drug ' }} FOR <span class="text-danger">{{ $financialYear['financial_year'] or 'No Financial Year' }} Financial Year</span> </strong>

            <div class="float-right">
                <a href="{{ url()->full() }}" class="btn btn-sm btn-warning">
                    <i class="icon icon-refresh"></i> Refresh Pages
                </a>
                <a href="{{ route('drugs.issued') }}" class="btn btn-sm btn-primary">
                    <i class="icon icon-refresh"></i> Back
                </a>
          </div>
        </div>
      </div>


          <div class="card">
            <div class="card-body">
              {{ Form::open(['route' => 'drugs.analyzed', 'method' => 'GET']) }}
                <div class="row">
                  <div class="form-group col-md-4">
                    {{ Form::label('select_drug')}}
                    <select class="form-control" name="drug">
                      <option value="">Select Drug to analyze</option>
                      @forelse($receivedDrugs as $receivedDrug)
                      <option value="{{ $receivedDrug->drug['id'] }}" {{ isset($_GET['drug']) && $_GET['drug'] == $receivedDrug->drug['id'] ? 'selected' : '' }}>{{ $receivedDrug->drug->name }}</option>
                      @empty
                      <option value="">No Drug</option>
                      @endforelse
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    {{ Form::label('financial_year') }}
                    {{ Form::select('financialYear', $financialYears, '', ['class' => 'form-control']) }}
                  </div>
                  <div class="form-group col-md-4">
                    {{ Form::label('Click to analyze') }}
                    {{ Form::submit('Analyse', ['class' => 'btn btn-block btn-md btn-primary']) }}
                  </div>
                </div>
              {{ Form::close() }}
            </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-light">
                <center><strong>Received Quantities</strong></center>
              </div>
              <div class="card-body">
                @if( $distinctDrugMonths)
                <canvas id="bar-chart" width="100%" height="50"></canvas>
                @else
                  <h4 class="text-center">No Drugs received</h4>
                @endif
              </div>
              <div class="card-footer border-info text-center">
                <a href="{{ route('drugs.received') }}" class="btn btn-sm btn-primary">View Received Drugs</a>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-light">
                <center><strong>Issued Quantities</strong></center>
              </div>

              <div class="card-body">
                @if( $distinctDrugMonths)
                <canvas id="pie-chart" width="100%" height="50"></canvas>
                @else
                  <h4 class="text-center">No Drugs Issued </h4>
                @endif
              </div>
              <div class="card-footer border-info text-center">
                <a href="{{ route('drugs.issued') }}" class="btn btn-sm btn-primary">View Issued Drugs</a>
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
                @foreach($distinctDrugMonths as $key => $distinctDrugMonth)
                  '{{ date("F", mktime(0, 0, 0, $distinctDrugMonth->month, 1)) }}',
                @endforeach

              ],
              datasets: [{
                  label: 'Received Drugs',
                  data: [

                    @foreach($distinctDrugMonths as $key => $distinctDrugMonth)
                      @php
                        $drugs = \App\ReceivedDrug::where(['drug_id' => $healthFacility_drug_ID])->whereMonth('receive_date', $distinctDrugMonth->month)->whereIn('stock_book_id', $stockBookIDs)->get();
                      @endphp
                      "{{ $drugs->sum('quantity') }}",
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
          type: 'bar',
          data: {
              labels: [
                @foreach($distinctDrugMonths as $key => $distinctDrugMonth)
                  '{{ date("F", mktime(0, 0, 0, $distinctDrugMonth->month, 1)) }}',
                @endforeach
              ],
              datasets: [{
                  label: 'Quantity',
                  data: [
                    @foreach($distinctDrugMonths as $key => $distinctDrugMonth)
                      @php
                        $drugs = \App\IssuedDrug::where(['drug_id' => $healthFacility_drug_ID])->whereMonth('transaction_date', $distinctDrugMonth->month)->whereIn('stock_book_id', $stockBookIDs)->get();
                      @endphp
                      "{{ $drugs->sum('quantity') }}",
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


//////////////////////////////////////////////////

}
});
</script>
@endsection
