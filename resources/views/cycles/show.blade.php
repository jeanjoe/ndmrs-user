@extends('layouts.master')

@section('title')

  Financial Year - {{ $currentUser->healthFacility->name }}

@endsection

@section('content')

    <div class="card">
      <div class="card-body">
        <h4>{{ $cycle['name'] }} - {{ $cycle->financialYear['financial_year'] }} <span class="float-right">Budget {{ number_format($cycle->financialYear['budget']/4) }} UGX</span> </h4>
      </div>
    </div>
    @include('components.notifications')
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header bg-light">
              Cycle Order Lists
             <div class="card-actions">
               <a href="#" class="btn btn-sm btn-primary">
                   <i class="fa fa-check"></i>
                   COMMIT ORDER
               </a>
             </div>
             <div class="clearfix">

             </div>
            <div class="card-body">
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
              <div class="card-body bg-light">
                <h4><strong>Total Amount Used:</strong> {{ number_format( $cycle->orderLists()->sum('total_cost')) }} UGX</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
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
