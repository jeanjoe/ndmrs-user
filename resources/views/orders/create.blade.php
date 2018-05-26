@extends('layouts.master')

@section('title', 'NDRMS -Orders')


@section('content')




<div class="card">
<div class="card-header bg-light">
Drugs ({{ count( $drugs ) }})
Budget ({{ count( $finacial_years ) }})
<div class="float-right">

<a href="{{ URL::current() }}" class="btn btn-warning btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
</div>
</div>


<div class="card-body">
<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home">Add to Cart</a>
</li>

<li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Order Cart</a>
</li>

<li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Order Status</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="home" role="tabpanel">
  <div class="card">
      <div class="card-header bg-light">
        @foreach($finacial_years as $finacial_year)
          Add Drugs To Cart <strong class="badge badge-danger rounded float-right"><h5> {{ (($finacial_year->budget)*100) - $grandTotal }} </h5></strong>
        @endforeach
      </div>
      <div class="card-body">
        @include('components.notifications')
        <div class="table-responsive">
          <table class="table table-striped" id="drugList">
            <thead>
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Cost(Ushs)</th>
                <th>Pkg Size</th>
                <th>Quantity</th>
                <th>Total Cost</th>
                <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  @foreach($drugs as $key => $drug)
                  <tr id="row{{ $key}}">
                  <td class="text-wrap"> {{ $drug->id }}  </td>
                  <td class="text-wrap"> {{ $drug->name }} - {{ $drug->strength }}  </td>
                  <td class="text-wrap"> {{ $drug->unit_of_issue }}  </td>
                  <td class="text-wrap"> {{ $drug->cost_per_unit }}  </td>
                  <td class="text-wrap"> {{ $drug->package_size }}  </td>
                  <!--<td class="text-wrap"> {{ $drug->category }}  </td>-->

                  {{ Form::open(['route' => 'orders.store' ]) }}
                    <td>
                      {{ Form::hidden('drug_id', $drug->id) }}
                      {{ Form::hidden('unit_cost', $drug->cost_per_unit) }}
                      {{ Form::number('quantity', !empty($drug->order->quantity) ? $drug->order->quantity : 0, ['class' => 'form-control', 'length' => '10000'] ) }}
                    </td>
                    <td>
                      {{ Form::number('totalCost', !empty($drug->order->total_cost) ? $drug->order->total_cost : 0, ['class' => 'form-control', 'readonly'] ) }}
                      {{ Form::select('ven', [ 'V' => 'Vital', 'E' => 'Essential', 'N' => 'Neccessary'], null, ['class' => 'form-control']) }}
                    </td>
                    <td><button type="submit" name="Add" class="btn btn-primary btn-sm" > <i class="fa fa-save"></i> </button></td>
                  {{ Form::close() }}
                  <form class="form-{{ $key }}" action="{{ route('orders.store') }}" method="post" style="display:inline-block !important;">
                    {{ csrf_field() }}

                  </form>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
     </div>
   </div>
</div>

   <div class="tab-pane" id="profile" role="tabpanel">

      <div class="card">
          <div class="card-header bg-light">
            @foreach($finacial_years as $finacial_year)
              Send Order <strong class="badge badge-danger rounded float-right"><h5> {{ (($finacial_year->budget)*100) - $grandTotal }} </h5></strong>
            @endforeach
          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Strength</th>
                  <th>Unit of Issue</th>
                  <th>Unit Cost(Ushs)</th>
                  <th>Pkg Size</th>
                  <th>Order Qnty</th>
                  <th>Status</th>
                  <th>Total Cost</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $GrandTotal = 0;
                @endphp
                @foreach($orders as $order)
                @php
                  $GrandTotal = $GrandTotal + $order->total_cost;
                @endphp
                  <tr>
                    <td class="text-wrap"> {{ $order->drug->id }}  </td>
                    <td class="text-wrap"> {{ $order->drug->name }}  </td>
                    <td class="text-wrap"> {{ $order->drug->strength }}  </td>
                    <td class="text-wrap"> {{ $order->drug->unit_of_issue }}  </td>
                    <td class="text-wrap"> {{ $order->drug->cost_per_unit }}  </td>
                    <td class="text-wrap"> {{ $order->drug->package_size }}  </td>
                    <td class="text-wrap"> {{ number_format($order->quantity) }}  </td>

                    <td>
                        @if($order->status == '0')
                      <button type="button" name="button" class="btn btn-danger btn-sm">Pending...</button>

                        @else
                      <button type="button" name="button" class="btn btn-success btn-sm">Approved</button>

                        @endif
                    </td>
                    <td class="text-wrap"> {{ number_format($order->total_cost) }} <b>UGX</b>  </td>
                  </tr>
                @endforeach
                <tr>
                  <td>Grand Total</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td colspan="8" class="text-wrap float-right">{{ number_format($GrandTotal) }}</td>
                </tr>
              </tbody>
          </table>
       </div>
      </div>
    </div>
 </div>
</div>
</div>


@endsection

@section('script')
<script type="text/javascript">
$(document).ready( function () {

$("#drugList > tbody > tr").each( function( index ){

$( "#row" + index +" input[name='quantity']" ).change(function() {

var unit_cost = $("#row" + index +" input[name='unit_cost']").val();
var quantity = $("#row" + index +" input[name='quantity']").val();
var totalCost =  unit_cost * quantity;

$("#row" + index +" input[name='totalCost']").val(totalCost);

});

});

});
</script>

@endsection
