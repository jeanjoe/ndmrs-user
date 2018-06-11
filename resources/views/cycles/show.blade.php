@extends('layouts.master')

@section('title')

  Financial Year - {{ $currentUser->healthFacility->name }}

@endsection

@section('content')

    <div class="card">
      <div class="card-body">
        <strong>{{ strtoupper($cycle['name']) }} - {{ $cycle->financialYear['financial_year'] }}
          <span class="float-right">Budget {{ number_format($cycle->financialYear['budget']/4) }} UGX</span> </strong>
      </div>
    </div>
    @include('components.notifications')
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header bg-light">
              <strong>Cycle Order Lists</strong>
             <div class="card-actions">
               @if( $findIfOrderExists)
                <button type="button" class="btn btn-danger btn-sm" name="button"><i class="fa fa-reply"></i> Revoke Order</button>
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
                    <td colspan="6"><h4>You have not Made any orders Lists</h4> </td>
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
                    {{ Form::select('drug', $drugs, null, ['class' => 'form-control', 'id' => 'drug', 'placeholder' => 'Select Drug', 'onChange' => 'getDrug(this);']) }}
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
            var quantity = $("input[name=quantity]").val()
            if(data.success == 1) {
              $("input[name=total_cost]").val(data.drug.cost_per_unit * quantity)
              $("input[name=unit_cost]").val(data.drug.cost_per_unit)
            }
          },
      });
    }
  </script>
@endsection
