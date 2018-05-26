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

          <!-- <div class="row">
              <div class="col-md-6">
                  <div class="card card-green">
                      <div class="card-header bg-light">
                          Processed Orders
                      </div>

                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Name</th>
                                      <th>Sales</th>
                                      <th>Price</th>
                                      <th>Discount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td class="text-nowrap">Samsung Galaxy S8</td>
                                      <td>31,589</td>
                                      <td>$800</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>2</td>
                                      <td class="text-nowrap">Google Pixel XL</td>
                                      <td>99,542</td>
                                      <td>$750</td>
                                      <td>3%</td>
                                  </tr>
                                  <tr>
                                      <td>3</td>
                                      <td class="text-nowrap">iPhone X</td>
                                      <td>62,220</td>
                                      <td>$1,200</td>
                                      <td>0%</td>
                                  </tr>
                                  <tr>
                                      <td>4</td>
                                      <td class="text-nowrap">OnePlus 5T</td>
                                      <td>50,000</td>
                                      <td>$650</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>5</td>
                                      <td class="text-nowrap">Google Nexus 6</td>
                                      <td>400</td>
                                      <td>$400</td>
                                      <td>7%</td>
                                  </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header bg-light">
                          Striped Rows
                      </div>

                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped">
                                  <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Name</th>
                                      <th>Sales</th>
                                      <th>Price</th>
                                      <th>Discount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td class="text-nowrap">Samsung Galaxy S8</td>
                                      <td>31,589</td>
                                      <td>$800</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>2</td>
                                      <td class="text-nowrap">Google Pixel XL</td>
                                      <td>99,542</td>
                                      <td>$750</td>
                                      <td>3%</td>
                                  </tr>
                                  <tr>
                                      <td>3</td>
                                      <td class="text-nowrap">iPhone X</td>
                                      <td>62,220</td>
                                      <td>$1,200</td>
                                      <td>0%</td>
                                  </tr>
                                  <tr>
                                      <td>4</td>
                                      <td class="text-nowrap">OnePlus 5T</td>
                                      <td>50,000</td>
                                      <td>$650</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>5</td>
                                      <td class="text-nowrap">Google Nexus 6</td>
                                      <td>400</td>
                                      <td>$400</td>
                                      <td>7%</td>
                                  </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header bg-light">
                          Bordered Table
                      </div>

                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-bordered">
                                  <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Name</th>
                                      <th>Sales</th>
                                      <th>Price</th>
                                      <th>Discount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td class="text-nowrap">Samsung Galaxy S8</td>
                                      <td>31,589</td>
                                      <td>$800</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>2</td>
                                      <td class="text-nowrap">Google Pixel XL</td>
                                      <td>99,542</td>
                                      <td>$750</td>
                                      <td>3%</td>
                                  </tr>
                                  <tr>
                                      <td>3</td>
                                      <td class="text-nowrap">iPhone X</td>
                                      <td>62,220</td>
                                      <td>$1,200</td>
                                      <td>0%</td>
                                  </tr>
                                  <tr>
                                      <td>4</td>
                                      <td class="text-nowrap">OnePlus 5T</td>
                                      <td>50,000</td>
                                      <td>$650</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>5</td>
                                      <td class="text-nowrap">Google Nexus 6</td>
                                      <td>400</td>
                                      <td>$400</td>
                                      <td>7%</td>
                                  </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header bg-light">
                          Hoverable Table
                      </div>

                      <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover">
                                  <thead>
                                  <tr>
                                      <th>ID</th>
                                      <th>Name</th>
                                      <th>Sales</th>
                                      <th>Price</th>
                                      <th>Discount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                      <td>1</td>
                                      <td class="text-nowrap">Samsung Galaxy S8</td>
                                      <td>31,589</td>
                                      <td>$800</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>2</td>
                                      <td class="text-nowrap">Google Pixel XL</td>
                                      <td>99,542</td>
                                      <td>$750</td>
                                      <td>3%</td>
                                  </tr>
                                  <tr>
                                      <td>3</td>
                                      <td class="text-nowrap">iPhone X</td>
                                      <td>62,220</td>
                                      <td>$1,200</td>
                                      <td>0%</td>
                                  </tr>
                                  <tr>
                                      <td>4</td>
                                      <td class="text-nowrap">OnePlus 5T</td>
                                      <td>50,000</td>
                                      <td>$650</td>
                                      <td>5%</td>
                                  </tr>
                                  <tr>
                                      <td>5</td>
                                      <td class="text-nowrap">Google Nexus 6</td>
                                      <td>400</td>
                                      <td>$400</td>
                                      <td>7%</td>
                                  </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div> -->
    </div>

@endsection
