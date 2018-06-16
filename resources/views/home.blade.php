@extends('layouts.master')

@section('title', 'NDRMS - Dashboard')

@section('content')

    <div class="container-fluid">
        @include('components.notifications')
        <div class="row">
            <div class="col-md-3">
                <div class="card p-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2">{{ $financialYears ? number_format(($financialYears[0]->$level/ 100 ) * $financialYears[0]->budget) : 0 }} </span>
                            <span class="font-weight-light">BUDGET (UGX)</span>
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
                            <span class="h4 d-block font-weight-normal mb-2">{{ number_format(count($drugs) ) }}</span>
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
                            <span class="h4 d-block font-weight-normal mb-2">{{ number_format(count($orders) ) }}</span>
                            <span class="font-weight-light">Drug Orders</span>
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
                            <span class="h4 d-block font-weight-normal mb-2">{{ number_format(count($healthWorkers)) }}</span>
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
                        <div class="p-4">
                            <canvas id="bar-chart" width="100%" height="50"></canvas>
                        </div>

                        <div class="justify-content-around mt-4 p-4 bg-light d-flex border-top d-md-down-none">
                            <div class="text-center">
                                <div class="text-muted small">Referrals</div>
                                <div>{{ $financialYears ? number_format(($financialYears[0]->NRH/ 100 ) * $financialYears[0]->budget) : 0 }} UGX ({{ $financialYears ? $financialYears[0]->NRH : 0 }}%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre II</div>
                                <div>{{ $financialYears ? number_format(($financialYears[0]->HCII/ 100 ) * $financialYears[0]->budget) : 0 }} UGX({{ $financialYears ? $financialYears[0]->HCII : 0 }}%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre III</div>
                                <div>{{ $financialYears ? number_format(($financialYears[0]->HCIII/ 100 ) * $financialYears[0]->budget) : 0 }} UGX ({{ $financialYears ? $financialYears[0]->HCIII : 0 }}%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre IV</div>
                                <div>{{ $financialYears ? number_format(($financialYears[0]->HCIV/ 100 ) * $financialYears[0]->budget) : 0 }} UGX ({{ $financialYears ? $financialYears[0]->HCIV :0 }}%)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <ul class="list-group">
                  <li class="list-group-item">Financial Year <span class="float-right">Budget</span> </li>
                  @forelse($financialYears as $financialYear)
                    <li class="list-group-item">{{ $financialYear['financial_year']}} <span class="float-right">{{ number_format($financialYear['budget']) }} UGX</span> </li>
                  @empty
                    <li class="list-group-item">No FInancial Years Created</li>
                  @endforelse
                </ul>
              </div>
            </div>

          {{--  <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <ul class="list-group">
                    <li class="list-group-item">No One is here</li>
                    <li class="list-group-item">No One is here
                      <ul class="list-group">
                        <li class="list-group-item">Chile 1</li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>--}}
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
                    label: 'Order Items',
                    data: [
                      @foreach($cycles as $cycle)
                        {!! "'".$cycle->orderLists->count() . "'," !!}
                      @endforeach
                    ],
                    backgroundColor: 'rgba(66, 165, 245, 0.5)',
                    borderColor: '#2196F3',
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

    /////////////////////////////////////////////////////////////////

    var barChart = $('#bar-chart');

    if (barChart.length > 0) {
        new Chart(barChart, {
            type: 'bar',
            data: {
                labels: ["Red", "Blue", "Cyan", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
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

  });

  </script>

@endsection
