@extends('layouts.master')

@section('title', 'NDRMS - Dashboard')

@section('content')

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card p-4">
             <strong style="align:center;">{{$facility->name}} ({{ $facility->level }})</strong>
          </div>
        </div>
      </div>
        @include('components.notifications')
        <div class="row">
            <div class="col-md-3">
                <div class="card p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2">54,278,374</span>
                            <span class="font-weight-light">BUDGET</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="icon icon-people"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2"></span>
                            <span class="font-weight-light">Available Drugs</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="icon icon-wallet"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-default p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2"></span>
                            <span class="font-weieight-light">Drug Orders</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="icon icon-cloud-download"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-primary p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2"></span>
                            <span class="font-weight-bolder">Health Workers</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="icon icon-home"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        2018 Drug Supply
                    </div>

                    <div class="card-body p-0">
                        <div class="p-4">
                            <canvas id="line-chart" width="100%" height="20"></canvas>
                        </div>

                        <div class="justify-content-around mt-4 p-4 bg-light d-flex border-top d-md-down-none">
                            <div class="text-center">
                                <div class="text-muted small">Referrals</div>
                                <div>12,457 Users (40%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre II</div>
                                <div>95,333 Users (5%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre III</div>
                                <div>957,565 Pages (50%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre IV</div>
                                <div>957,565 Files (5%)</div>
                            </div>
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

      /**
       * Line Chart
       */
      var lineChart = $('#line-chart');

      if (lineChart.length > 0) {
          new Chart(lineChart, {
              type: 'line',
              data: {
                  labels: [
                    @foreach($cycles as $cycle)
                      {!! "'".$cycle['name'] . " " . $cycle->financialYear['financial_year'] . "'," !!}
                    @endforeach
                  ],
                  datasets: [{
                      label: '2018',
                      data: [
                        @foreach($cycles as $cycle)
                          {!! "'".$cycle->orderLists->count() . "'," !!}
                        @endforeach
                      ],
                      backgroundColor: "rgba(153,255,51,0.4)",
                      borderColor: '#2196F3',
                      borderWidth: 1
                  }
                ]
              },
              options: {
                  legend: {
                      display: true
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



    });

    </script>

  @endsection
