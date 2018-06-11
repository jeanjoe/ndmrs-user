@extends('layouts.master')

@section('title', 'NDRMS -Show Order')


@section('content')

      <div class="card">
        <div class="card-body bg-light">
          <div class="row p-5">
            <div class="col-md-6">
              <h6> <strong>Order Details</strong> </h6>
              <p class="font-weight-bold mb-4">{{ $order->healthFacility['name'] ." ".  $order->healthFacility['level'] }}</p>
              <p class="mb-1">Submitted By: {{ $order->healthWorker['name'] }}</p>
              <p class="mb-1">Date: {{ \Carbon\Carbon::parse($order->created_at)->toDayDateTimeString() }} </p>
            </div>

            <div class="col-md-6 text-right">
              <p class="font-weight-bold mb-1">Order Code {{ $order->order_code  }}</p>
              <p class="text-muted">Date: {{ \Carbon\Carbon::parse($order['created_at'])->toDayDateTimeString()  }}</p>
              <p class="font-weight-bold">Status: <span class="badge badge-{{ $order['status'] ==  1 ? 'success' : 'warning' }}">{{ $order['status'] ==  1 ? 'Approved' : 'Pending' }}</span> </p>
              <div class="float-right">
                <a href="{{ URL::current() }}" class="btn btn-warning btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
          <tr>
            <th>#</th>
            <th>Drug</th>
            <th>Cycle</th>
            <th>Quantity</th>
            <th>Cost (UGX)</th>
            <th>VEN</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
          @forelse( $orderLists as $key => $order)
            <tr>
              <td>{{ ++$key }}</td>
              <td class="text-nowrap">{{ $order->drug->name or 'Not Found' }}</td>
              <td class="text-nowrap">{{ $order->cycle->name or 'Not Found' }}</td>
              <td>{{ number_format($order['quantity']) }}</td>
              <td>{{ number_format($order['total_cost']) }}</td>
              <td>{{ $order['ven'] }}</td>
              <td>
                <button type="button" class="btn btn-sm btn-{!! $order['status'] == 1 ? 'success' : 'warning' !!}" name="button">{{ $order['status'] == 1 ? 'Approved' : 'Pending..'}}</button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6"><h4>You have not Made any Orders Lists</h4> </td>
            </tr>
          @endforelse
          </tbody>
        </table>
        <div class="pagination">
          {{ $orderLists->links() }}
        </div>
      </div>
      <div class="d-flex flex-row-reverse bg-dark text-white p-4">
        <div class="py-3 px-5 text-right">
          <div class="mb-2">Grand Total</div>
          <div class="h2 font-weight-light">{{ number_format($orderLists->sum('total_cost')) }} UGX</div>
        </div>

        <div class="py-3 px-5 text-right">
          <div class="mb-2">Total Quantity</div>
          <div class="h2 font-weight-light">{{ $orderLists->sum('quantity') }}</div>
        </div>
      </div>
@endsection

@section('script')
<script type="text/javascript">
$(document).ready( function () {

});
</script>

@endsection
