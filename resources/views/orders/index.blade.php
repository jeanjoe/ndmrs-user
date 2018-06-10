@extends('layouts.master')

@section('title', 'NDRMS -Orders')


@section('content')
      <div class="card">
        <div class="card-header bg-light">
          <strong>{{ strtoupper($currentUser->healthFacility->name) ." ". strtoupper($currentUser->healthFacility->level) }} - COMMITED ORDERS</strong>
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
                    <th>Order Code</th>
                    <th>Financial Year</th>
                    <th>Cycle</th>
                    <th>Committed By</th>
                    <th>Order Items</th>
                    <th>Date</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse( $orders as $key => $order)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td class="text-nowrap">{{ $order['order_code'] }}</td>
                      <td>{{ $order->orderLists[0]->cycle->name }}</td>
                      <td>{{ $order->orderLists[0]->cycle-finanancialYear['financial_year'] }}</td>
                      <td>{{ $order->healthWorker->name or 'Not Found' }}</td>
                      <td>{{ number_format($order->orderLists()->count()) }}</td>
                      <td>{{ $order['created_at'] }}</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-{{ $order['status'] == 1 ? 'success' : 'warning'}}" name="button">{{ $order['status'] == 1 ? 'Approved' : 'Pending..'}}</button>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="8">You have not committed any orders</td>
                    </tr>
                  @endforelse
                  </tbody>
              </table>
            </div>
        </div>

@endsection

@section('script')

@endsection
