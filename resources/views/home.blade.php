@extends('layouts.master')

@section('title', 'NDRMS - Dashboard')

@section('content')

    <div class="container-fluid">
        @include('components.notifications')
        <div class="row">
            <div class="col-md-3">
                <div class="card rounded p-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <span class="h4 d-block font-weight-normal mb-2">{{ $currentFinancialYear ? number_format(( ($currentFinancialYear[$sharedLevel] / 100) * $currentFinancialYear['budget']) / $sharedHealthFacilities->count()) : 0 }} </span>
                            <span class="font-weight-light">Current F.Y BUDGET</span>
                        </div>

                        <div class="h2 text-muted">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card rounded p-2">
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
                <div class="card rounded p-2">
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
                <div class="card rounded p-2">
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

        <div class="card">
          <div class="card-body text-center">
            <div class="p-4">
                <canvas id="line-chart" width="100%" height="20"></canvas>
            </div>
            <strong>{{ $currentUser->healthFacility['name'] . " " . $currentUser->healthFacility['level'] }} ORDER SUMMARY</strong>
          </div>
        </div>

        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       <strong>Current FInancial Year {{ $currentFinancialYear['financial_year'] }}</strong>
                       <div class="card-actions float-right">
                         <button type="button" class="btn btn-outline-danger" name="button">{{ number_format($currentFinancialYear['budget']) }} UGX</button>
                       </div>
                    </div>
                    <hr>
                    <div class="card-body p-0">
                        @if($currentFinancialYear)
                        <div class="p-4">
                            <canvas id="bar-chart" width="100%" height="50"></canvas>
                        </div>

                        <div class="justify-content-around mt-4 p-2 bg-light d-flex border-top d-md-down-none">
                            <div class="text-center">
                                <div class="text-muted small">National Referrals</div>
                                <div>{{ $currentFinancialYear ? number_format(($currentFinancialYear->NRH/ 100 ) * $currentFinancialYear->budget) : 0 }} UGX ({{ $currentFinancialYear ? $currentFinancialYear->NRH : 0 }}%)</div>
                            </div>
                            <div class="text-center">
                                <div class="text-muted small">Regional Referrals</div>
                                <div>{{ $currentFinancialYear ? number_format(($currentFinancialYear->RRH/ 100 ) * $currentFinancialYear->budget) : 0 }} UGX ({{ $currentFinancialYear ? $currentFinancialYear->NRH : 0 }}%)</div>
                            </div>
                            <div class="text-center">
                                <div class="text-muted small">Distrct Hospitals</div>
                                <div>{{ $currentFinancialYear ? number_format(($currentFinancialYear->DH/ 100 ) * $currentFinancialYear->budget) : 0 }} UGX ({{ $currentFinancialYear ? $currentFinancialYear->NRH : 0 }}%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre II</div>
                                <div>{{ $currentFinancialYear ? number_format(($currentFinancialYear->HCII/ 100 ) * $currentFinancialYear->budget) : 0 }} UGX({{ $currentFinancialYear ? $currentFinancialYear->HCII : 0 }}%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre III</div>
                                <div>{{ $currentFinancialYear ? number_format(($currentFinancialYear->HCIII/ 100 ) * $currentFinancialYear->budget) : 0 }} UGX ({{ $currentFinancialYear ? $currentFinancialYear->HCIII : 0 }}%)</div>
                            </div>

                            <div class="text-center">
                                <div class="text-muted small">Health Centre IV</div>
                                <div>{{ $currentFinancialYear ? number_format(($currentFinancialYear->HCIV/ 100 ) * $currentFinancialYear->budget) : 0 }} UGX ({{ $currentFinancialYear ? $currentFinancialYear->HCIV :0 }}%)</div>
                            </div>
                        </div>
                        @else
                          <div class="alert alert-info">
                            <strong>Cannot Find CUrrent Financial Year</strong>
                          </div>
                        @endif
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
                labels: [
                  @foreach( $orders as $order)
                    "{{ $order['order_code'] }}",
                  @endforeach
                ],
                datasets: [{
                    label: 'Order Items',
                    data: [
                      @foreach( $orders as $order)
                        {{ $order->orderLists()->count() }},
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

  });

  </script>

@endsection
