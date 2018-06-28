@extends('layouts.master')

@section('title')

  Financial Year Cycle Stock Book - {{ $currentUser->healthFacility->name }}

@endsection

@section('content')

    <div class="row text-center">
      @php
        $percentageAmount = ( ($cycle->financialYear[$sharedLevel] / 100) * $cycle->financialYear['budget']/4);
      @endphp
      <div class="col-md-3">
        <div class="card rounded">
          <div class="card-body">
            <strong>Financial Year {{ $cycle->financialYear['financial_year'] }} </strong> <br>
            <span>Budget</span>
            <h4>{{ number_format($cycle->financialYear['budget']) }} UGX</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card rounded">
          <div class="card-body">
            <strong>{{ strtoupper($cycle['name']) }} </strong> <br>
            <span>Cycle Budget</span>
            <h4>{{ number_format($cycle->financialYear['budget']/4) }} UGX</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card rounded">
          <div class="card-body">
            <strong>{{ $currentUser->healthFacility->name . ' - ' . $currentUser->healthFacility['level'] }} </strong> <br>
            <span>H.F Budget</span>
            <h4>{{ number_format($percentageAmount) }} UGX</h4>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card rounded">
          <div class="card-body">
            <strong>Budget Used: {{ number_format( $cycle->orderLists()->sum('total_cost')) }} UGX</strong> <br>
            <span>Balance</span>
            <h4>{{ number_format($percentageAmount - $cycle->orderLists()->sum('total_cost')) }} UGX</h4>
          </div>
        </div>
      </div>
    </div>
    @include('components.notifications')
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <strong class="float-left">Cycle Order Lists</strong>
             <div class="float-right">
               @if( $findIfOrderExists)
                  @if($findIfOrderExists['status'] == 1)
                    <button type="button" class="btn btn-success btn-sm" name="button">Order Committed {{ $findIfOrderExists['order_code'] }}</button>
                  @else
                    {{ Form::open(['route' => ['cycles.order.revoke', $findIfOrderExists['order_code']], 'method' => 'DELETE']) }}
                    {{ Form::hidden('cycle', $cycle['id']) }}
                     <button type="submit" class="btn btn-sm btn-danger btn-sm" onclick="return confirm('Are you sure you want to revoke this order?');"><i class="fa fa-reply"></i> REVOKE ORDER</button>
                    {{ Form::close() }}
                  @endif
               @else
                 {{ Form::open(['route' => 'orders.store']) }}
                 {{ Form::hidden('cycle', $cycle['id']) }}
                  <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to commmit this order? Order committed cannnot be edited');" name="commitOrder"><i class="fa fa-check"></i>COMMIT ORDER</button>
                 {{ Form::close() }}
               @endif
             </div>
           </div>
         </div>
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Drug</th>
                  <th>Quantity</th>
                  <th>Cost (UGX)</th>
                  <th>VEN</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse( $cycle->orderLists as $key => $order)
                  <tr>
                    <td>{{ ++$key }}</td>
                    <td class="text-nowrap">{{ $order->drug->name }}</td>
                    <td>{{ number_format($order['quantity']) }}</td>
                    <td>{{ number_format($order['total_cost']) }}</td>
                    <td>{{ $order['ven'] }}</td>
                    <td>
                      <button type="button" class="btn btn-sm btn-{!! $order['status'] == 1 ? 'success' : 'warning' !!}" name="button">{{ $order['status'] == 1 ? 'Approved' : 'Pending..'}}</button>
                    </td>
                    <td>
                      @if($order['committed'] == 1 && $order['commit_code'] != '')
                        <button type="button" class="btn btn-sm btn-success" name="button">Committed</button>
                      @else
                        <a href="#" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> </a>
                        {{ Form::open(['route' => ['order-lists.destroy', $order['id']], 'method' => 'delete', 'style' => 'display:inline-block']) }}
                          <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are your sure you want to remove this drug from the List?');" name="button"><i class="icon icon-trash"></i> </button>
                        {{ Form::close() }}
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7"><h6 class="text-danger">You have not Made any orders Lists</h6> </td>
                  </tr>
                @endforelse
                </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-light">
            <div class="card-body">
              <strong>Amount Used:</strong> <span class="badge badge-success">{{ number_format( $cycle->orderLists()->sum('total_cost')) }} UGX</span>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              @if( $findIfOrderExists)

                <h6>This order has been successfully committed for approval Please wait while Suppliers approve your order</h6>
                <hr>
                <button type="button" class="btn btn-md btn-success btn-block" name="button">Order Code {{ $findIfOrderExists['order_code'] }}</button>
                <hr>
                <button type="button" class="btn btn-md btn-block btn-{{ $findIfOrderExists['status'] == 1 ? 'success' : 'warning' }}" name="button">Order Status {{ $findIfOrderExists['status'] == 1 ? 'Approved' : 'Pending...' }} </button>
              @else
                {{ Form::open(['route' => 'order-lists.store']) }}
                  <div class="form-group">
                    <select class="form-control" onchange="getDrug(this);" id="drug" name="drug">
                      <option value="">Select Drug to add</option>
                      @forelse( $cycle->stocks as $stock )
                        <option value="{{ $stock['drug_id'] }}" {{ old('drug') == $stock['drug_id'] ? 'selected' : '' }}>{{ $stock->drug->name }}</option>
                      @empty
                        <option value="">No Drugs Have been added to this Cycle Stock</option>
                      @endforelse
                    </select>
                    @if($errors->has('drug'))
                      <strong class="text-danger">{{ $errors->first('drug') }}</strong>
                    @endif
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="ven"><option value="V">Vital</option><option value="E">Essential</option><option value="N">Neccessary</option></select>
                  </div>
                  <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Unit Cost</span>
                        </div>
                      {{ Form::text('unit_cost', '', ['class' => 'form-control', 'readonly']) }}
                    </div>
                  </div>
                  {{ Form::hidden('cycle', $cycle['id']) }}
                  <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Quantity</span>
                        </div>
                    {{ Form::number('quantity', '', ['class' => 'form-control', 'min'=>'1' ]) }}
                  </div>
                  @if($errors->has('quantity'))
                    <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                  @endif
                  <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Total Cost</span>
                        </div>
                      {{ Form::text('total_cost', '', ['class' => 'form-control', 'readonly']) }}
                    </div>
                    @if($errors->has('total_cost'))
                      <strong class="text-danger">{{ $errors->first('total_cost') }}</strong>
                    @endif
                  </div>
                  <div class="form-group">
                    {{ Form::submit('Add', ['class' => 'btn btn-sm btn-primary btn-block']) }}
                  </div>
                {{ Form::close() }}
              @endif
            </div>
          </div>
        </div>


      </div>

@endsection

@section('script')
  <script type="text/javascript">

    $(document).ready( function (){
      var drug = document.getElementById("drug");
      var drugID = drug.options[drug.selectedIndex].value;

      if (typeof drug !== '') {
        getData(drugID);
      }

      $("input[name='quantity']" ).change(function() {
        var unit_cost = $("input[name=unit_cost]").val();
        var quantity = $("input[name=quantity]").val();
        var totalCost =  unit_cost * quantity;
        $("input[name='total_cost']").val(totalCost);

        });

    });

    function getDrug(selectObj) {
        var selectIndex=selectObj.selectedIndex;
        var drugID = selectObj.options[selectIndex].value;
        getData(drugID);
    }

    function getData(drugID) {
      return $.ajax({
          url:'/api/drug/'+ drugID,
          type:'GET',
          success:function(data) {
            console.log(data);
            var quantity = $("input[name=quantity]").val()
            if(data.success == 1) {
              $("input[name=total_cost]").val(data.drug.cost_per_unit * quantity)
              $("input[name=unit_cost]").val(data.drug.cost_per_unit)
            }
          },
          error : function ( xhr, thrown, unknown) {
            console.log(xhr);
            console.log(thrown);
            console.log(unknown);
          },
      });
    }
  </script>
@endsection
