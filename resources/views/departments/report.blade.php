@extends('layouts.master')

@section('title')

Department Report - {{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }}

@endsection

@section('content')
    <div class="card">
        <div class="card-body bg-light">

            <h5> <b>{{ strtoupper($currentUser->healthFacility->name) . " " .strtoupper($currentUser->healthFacility->level) }} - Submit Department Report</b> </h5>

            <div class="card-actions">
                <a href="{{ route('department.report.all') }}" class="btn">
                    <i class="fa fa-eye"></i> All Reports
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i>
                </a>
            </div>
        </div>
      </div>
      @include ('components.notifications')
        <div class="card">
        <div class="card-body">
            {{ Form::open(['route' => 'department.report.store']) }}
              <div class="row">
                <div class="form-group col-md-6">
                  {{ Form::label('health_facility') }}
                  {{ Form::text('health_facility', $currentUser->healthFacility['name'], ['class' => 'form-control', 'readonly']) }}
                  @if( $errors->has('health_facility') )
                    <strong class="text-danger">{{ $errors->first('health_facility') }}</strong>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('department') }}
                  <select class="form-control" id="issued_drug" name="issued_drug" onchange="getIssuedDrug(this);">
                    <option value="">Select Issued Drug</option>
                    @forelse( $departments as $department)
                      <optgroup label="{{ $department['name']}}">
                        @forelse( $department->issueDrugs as $issueDrug)
                          <option value="{{ $issueDrug['id'] }}" {{ old('issued_drug') == $issueDrug['id'] ? 'selected' : '' }}> {{ $issueDrug->drug->name }}</option>
                        @empty
                          <option value="">No Drugs have been issued</option>
                        @endforelse
                      </optgroup>
                    @empty
                      <option value="">No Departments Exist</option>
                    @endforelse
                  </select>
                  @if( $errors->has('issued_drug') )
                    <strong class="text-danger">{{ $errors->first('issued_drug') }}</strong>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('quantity_available') }}
                  {{ Form::number('quantity_available', '', ['class' => 'form-control', 'readonly', 'min' => '1']) }}
                  @if( $errors->has('quantity_available') )
                    <strong class="text-danger">{{ $errors->first('quantity_available') }}</strong>
                  @endif
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('quantity_out') }}
                  {{ Form::number('quantity', '', ['class' => 'form-control']) }}
                  @if( $errors->has('quantity') )
                    <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                  @endif
                </div>
                <div class="form-group col-md-12">
                  {{ Form::label('comment') }}
                  {{ Form::textarea('comment', '', ['class' => 'form-control', 'rows' => '3']) }}
                </div>
                <div class="form-group col-md-6">
                  {{ Form::submit('Submit Report', ['class' => 'btn btn-md btn-block btn-primary']) }}
                </div>
              </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection


@section('script')
  <script type="text/javascript">

    $(document).ready( function (){
      var issuedDrug = document.getElementById("issued_drug");
      var issuedDrugID = issuedDrug.options[issuedDrug.selectedIndex].value;

      if (typeof issuedDrug !== '') {
        getData(issuedDrugID);
      }
    });

    function getIssuedDrug(selectObj) {
        var selectIndex=selectObj.selectedIndex;
        var issuedDrugID = selectObj.options[selectIndex].value;
        getData(issuedDrugID);
    }

    function getData(issuedDrugID) {
      return $.ajax({
          url:'/api/get/issued-drug/'+ issuedDrugID,
          type:'GET',
          success:function(data) {
            console.log(data);
            if(data.success == 1) {
              $("input[name=quantity_available]").val(data.drug.quantity_remaining)
            }
          }
      });
    }
  </script>
@endsection
