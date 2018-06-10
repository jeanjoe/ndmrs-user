@extends('layouts.master')

@section('title', 'NDRMS -Show Order')


@section('content')




      <div class="card">
        <div class="card-header bg-light">
          Order CODE ({{ $order->order_code  }})
          Order Date ({{ $order->created_at }})
          <div class="float-right">
            <a href="{{ URL::current() }}" class="btn btn-warning btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
          </div>
        </div>


        <div class="card-body">

        </div>
      </div>


@endsection

@section('script')
<script type="text/javascript">
$(document).ready( function () {

});
</script>

@endsection
