  @extends('layouts.master')

  @section('title')

  Show Stock Book- {{ $currentUser->healthFacility->name }}

  @endsection

  @section('content')

          <div class="card bg-primary">
              <div class="card-header bg-light">
                <strong>Stock Book - {{ $stockBook['name'] }}</strong>
               <div class="card-actions">
                 <a href="{{ route('stock-books.edit', $stockBook['id']) }}" class="btn"><i class="fa fa-pencil-alt"></i> Edit</a>
                 <a href="#" class="btn"><i class="fa fa-cog"></i> Settings</a>
               </div>
             </div>
           </div>

           <div class="clearfix">

           </div>
           <div class="row">
               <div class="col-md-3">
                   <div class="card p-4">
                       <div class="card-body d-flex justify-content-between align-items-center">
                           <div>
                               <span class="h4 d-block font-weight-normal mb-2">54</span>
                               <span class="font-weight-light">Received Drugs</span>
                           </div>

                           <div class="h2 text-muted">
                               <i class="icon icon-people"></i>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="col-md-3">
                   <div class="card p-4">
                       <div class="card-body d-flex justify-content-between align-items-center">
                           <div>
                               <span class="h4 d-block font-weight-normal mb-2">$32,400</span>
                               <span class="font-weight-light">Issued Drugs</span>
                           </div>

                           <div class="h2 text-muted">
                               <i class="icon icon-wallet"></i>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="col-md-3">
                   <div class="card p-4">
                       <div class="card-body d-flex justify-content-between align-items-center">
                           <div>
                               <span class="h4 d-block font-weight-normal mb-2">{{ $stockBook['start_date'] }}</span>
                               <span class="font-weight-light">Start Date</span>
                           </div>

                           <div class="h2 text-muted">
                               <i class="icon icon-clock"></i>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="col-md-3">
                   <div class="card p-4">
                       <div class="card-body d-flex justify-content-between align-items-center">
                           <div>
                               <span class="h4 d-block font-weight-normal mb-2">{{ $stockBook['end_date'] }}</span>
                               <span class="font-weight-strong">End Date</span>
                           </div>

                           <div class="h2 text-muted">
                               <i class="icon icon-clock"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <div class="card">
             <div class="card-body">
               <div class="row">
                 <div class="col-md-6">
                   <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#receiveDrug"><i class="fa fa-download"></i> Receive Drug</button>
                 </div>
                 <div class="col-md-6">
                   <button class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#issueDrug"><i class="fa fa-upload"></i> Issue Drugs</button>
                 </div>
               </div>
             </div>
           </div>

           <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        Received Drugs
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Quantity</th>
                                    <th>Organization</th>
                                    <th>Manufacture Date</th>
                                    <th>Expiry Date</th>
                                    <th>Batch No.</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach( $stockBook->receivedDrugs as $key => $receievedDrug)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td class="text-nowrap">{{ $receievedDrug['quantity'] }}</td>
                                        <td>{{ $receievedDrug['organization'] }}</td>
                                        <td>{{ $receievedDrug['manufacture_date'] }}</td>
                                        <td>{{ $receievedDrug['expiry_date'] }}</td>
                                        <td>{{ $receievedDrug['batch_number'] }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>


    <!-- MODALS BELOW -->
    <!-- model for receiving drugs -->
    <div class="modal fade" id="receiveDrug" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary border-0">
            <h5 class="modal-title text-white"> Add Drugs to {{ $stockBook['name'] }}  Stock Book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form id="receiveDrugForm">
            {{ csrf_field() }}
            <div class="modal-body">
              <span class="alert alert-danger error-message"></span>

              <div class="form-group">
                {{ Form::label('drug', 'Transaction Date') }}
                {{ Form::select('drug', $drugs, null, ['class' => 'form-control']) }}
                <strong class="text-danger drug-error"></strong>
              </div>
              <div class="form-group">
                {{ Form::label('date', 'Reception Date') }}
                {{ Form::date('receive_date', '',['class' => 'form-control']) }}
                <strong class="text-danger receive_date-error"></strong>
              </div>
              <div class="form-group">
                {{ Form::label('organization', 'Supplied By (Organizations)') }}
                {{ Form::text('organization','', ['class' => 'form-control'] ) }}
                <strong class="text-danger organization-error"></strong>
              </div>
              <div class="row">
                <div class="form-group col-md-6">
                  {{ Form::label('voucher_no', 'Voucher Number') }}
                  {{ Form::text('voucher_no','', ['class' => 'form-control'] ) }}
                  <strong class="text-danger voucher-error"></strong>
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('batch_number', 'Batch No.') }}
                  {{ Form::text('batch_number','', ['class' => 'form-control'] ) }}
                  <strong class="text-danger batch-error"></strong>
                </div>
              </div>
              <div class="form-group">
                {{ Form::label('quantity', 'Quantity-In') }}
                {{ Form::number('quantity','', ['class' => 'form-control'] ) }}
                <strong class="text-danger quantity-error"></strong>
              </div>
              {{ Form::hidden('stock_book', $stockBook['id']) }}
              {{ Form::hidden('user', Auth::user()->id ) }}
              <div class="row">
                <div class="form-group col-md-6">
                  {{ Form::label('manufacture_date', 'Manufacture Date') }}
                  {{ Form::date('manufacture_date','', ['class' => 'form-control'] ) }}
                  <strong class="text-danger manufacture-error"></strong>
                </div>
                <div class="form-group col-md-6">
                  {{ Form::label('expiry_date', 'Expiry Date') }}
                  {{ Form::date('expiry_date','', ['class' => 'form-control'] ) }}
                  <strong class="text-danger expiry-error"></strong>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button class="btn btn-success btn-submit" id="submitReceiveDrug">Submit</button>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>

  <!-- Issue Drug Modal -->
  <!-- model for issuing drugs -->
  <div class="modal fade" id="issueDrug" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary border-0">
          <h5 class="modal-title text-white">Issue Drugs from {{ $stockBook['name'] }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form  id="issueDrugForm">
          {{ csrf_field() }}
          <div class="modal-body">
            <span class="alert alert-danger print-error-msg"> </span>
            <div class="alert alert-success print-success-msg" > </div>
            <div class="row">
              <div class="col-md-12">
                {{ Form::label('date', 'Transaction Date') }}
                {{ Form::date('issued_date', '',['class' => 'form-control']) }}
                <strong class="text-danger issued_date-error"></strong>
              </div>
              <div class="col-md-12">
                {{ Form::label('recipient', 'Recipient') }}
                {{ Form::select('recipient', $drugs, null, ['class' => 'form-control'] ) }}
                <strong class="text-danger recepient-error"></strong>
              </div>
              <div class="col-md-12">
                {{ Form::label('quantity_out', 'Quantity-Out') }}
                {{ Form::number('quantity_out','', ['class' => 'form-control'] ) }}
                <strong class="text-danger quantity_out-error"></strong>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id ="submitIssueDrug">Issue Drug</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">

    $('#receiveDrug').on('show.bs.modal', function (event) {
      $(".error-message").hide();
    })
    $('#issueDrug').on('show.bs.modal', function (event) {
      $(".print-error-msg").hide();
      $(".print-success-msg").hide();
    })

    $("#submitReceiveDrug").click( function(event){
      event.preventDefault();
      const stockBook = $("input[name=stock_book]").val()

      $(".drug-error").empty()
      $(".receive_date-error").empty()
      $(".quantity-error").empty()
      $(".organization-error").empty()
      $(".manufacture-error").empty()
      $(".expiry-error").empty()
      $(".batch-error").empty()
      $(".voucher-error").empty()

      $.ajax({
          url: "/api/recieive-drug/" + stockBook,
          type:'POST',
          data: $('#receiveDrugForm').serialize(),
          success: function(data) {
            // console.log(data);

              if(!$.isEmptyObject(data.errors)){

                if ('drugs' in data.errors) {
                  $(".drug-error").text(data.errors['drugs'])
                }
                if ('receive_date' in data.errors) {
                  $(".receive_date-error").text(data.errors['receive_date'])
                }
                if ('quantity' in data.errors) {
                  $(".quantity-error").text(data.errors['quantity'])
                }
                if ('organization' in data.errors) {
                  $(".organization-error").text(data.errors['organization'])
                }
                if ('manufacture_date' in data.errors) {
                  $(".manufacture-error").text(data.errors['manufacture_date'])
                }
                if ('expiry_date' in data.errors) {
                  $(".expiry-error").text(data.errors['expiry_date'])
                }
                if ('batch_number' in data.errors) {
                  $(".batch-error").text(data.errors['batch_number'])
                }
                if ('voucher_no' in data.errors) {
                  $(".voucher-error").text(data.errors['voucher_no'])
                }
              }

              if (!$.isEmptyObject(data.error)) {
                $(".error-message").text(data.error.message);
              }

              if (data.success == 1) {
                $("input[name=stock_book]").val('')
                $("input[name=receive_date]").val('')
                $("input[name=quantity]").val('')
                $("input[name=organization]").val('')
                $("input[name=manufacture_date]").val('')
                $("input[name=batch_number]").val('')
                $("input[name=voucher_no]").val('')
              }
          },
          error: function (xhr, thrown, unkmown){
              console.log(unkmown);
          }
      });
    });

    $("#submitIssueDrug").click( function(event){
      event.preventDefault();
      const stockBook = $("input[name=stock_book]").val()

      $(".issued_date-error").empty()
      $(".recepient-error").empty()
      $(".quantity_out-error").empty()

      $.ajax({
          url: "/api/issue-drug/" + stockBook,
          type:'POST',
          data: $('#issueDrugForm').serialize(),
          success: function(data) {
            // console.log(data);

              if(!$.isEmptyObject(data.errors)){
                if ('issued_date' in data.errors) {
                  $(".issued_date-error").text(data.errors['issued_date'])
                }
                if ('recepient' in data.errors) {
                  $(".recepient-error").text(data.errors['recepient'])
                }
                if ('quantity_out' in data.errors) {
                  $(".quantity_out-error").text(data.errors['quantity_out'])
                }
              }

              if (!$.isEmptyObject(data.error)) {
                $(".error-message").text(data.error.message);
              }

              if (data.success == 1) {
                $("input[name=quantity_out]").val('')
                $("input[name=recepient]").val('')
                $("input[name=issued_date]").val('')
              }
          },
          error: function (xhr, thrown, unkmown){
              console.log(unkmown);
          }
      });
    });
  </script>
@endsection
