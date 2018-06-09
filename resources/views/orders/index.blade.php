@extends('layouts.master')

@section('title', 'NDRMS -Orders')


@section('content')
      <div class="card">
        <div class="card-header bg-light">
          {{ strtoupper($currentUser->healthFacility->name) ." ". strtoupper($currentUser->healthFacility->level) }} - ORDERS
          <div class="card-actions">
            <a href="{{ route('orders.create') }}" class="btn">
                <i class="fa fa-plus-circle"></i>
            </a>

            <a href="{{ URL::current() }}" class="btn">
                <i class="icon icon-refresh"></i>
            </a>
          </div>
        </div>
      </div>


          <div class="table-responsive">
              <table class="table table-bordered table-sm">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Drug</th>
                    <th>Cycle</th>
                    <th>Quantity</th>
                    <th>Cost</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse( $orders as $key => $order)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td class="text-nowrap">{{ $order->drug->name }}</td>
                      <td class="text-nowrap">{{ $order->cycle->name or 'Not Found' }}</td>
                      <td>{{ $order['quantity'] }}</td>
                      <td>{{ number_format($order['total_cost']) }}</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-{{ $order['status'] == 1 ? 'success' : 'warning'}}" name="button">{{ $order['status'] == 1 ? 'Approved' : 'Pending..'}}</button>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5">You have not Made any orders</td>
                    </tr>
                  @endforelse
                  </tbody>
              </table>
            </div>
        </div>

@endsection

@section('script')

@endsection
