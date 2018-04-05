@extends('layouts.master')

@section('title', 'NDRMS - All Stocks')

@section('content')

        <div class="card">
            <div class="card-header bg-light">
                <strong>Create New Stock </strong>
                <div class="float-right">
                  <a href="{{ route('stocks.index') }}" class="btn btn-primary btn-sm"> <i class="icon icon-eye"></i> View All </a>
                  <a href="{{ URL::current() }}" class="btn btn-info btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
                </div>
            </div>

            <div class="card-body">

              @include('components.notifications')

              {{ Form::open([ 'route' => 'stocks.store', 'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="col-md-4">
                        {{ Form::label('name', 'Drug Name') }}
                        <select class="form-control" name="name">
                          <option value="">Select Drug</option>
                          @foreach($drugs as $drug)
                            <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                          @endforeach
                        </select>
                        @if( $errors->has('name'))
                          <div class="text-danger">
                            {{ $errors->first('name') }}
                          </div>
                        @endif
                    </div>
                      {{ Form::hidden('health_facility', $currentUser->healthFacility->id , ['class' => 'form-control'] ) }}

                    <div class="col-md-4">
                        {{ Form::label('status', 'Status') }}
                        {{ Form::select('status', ['Active'=>'Active', 'Deactive'=> 'Deactive'], 'A', ['class' => 'form-control'] ) }}

                        @if( $errors->has('status'))
                          <div class="text-danger">
                            {{ $errors->first('status') }}
                          </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                      {{ Form::label('submit', 'Click to Add')}}
                      {{ Form::submit('Add New', ['class' => 'btn btn-primary btn-sm btn-block']) }}
                    </div>

                </div>
              {{ Form::close() }}
            </div>
        </div>


      <div class="card border-light">
        <div class="card-header bg-light">
            <strong>STOCKS AT THE STORE ({{ count($stocks) }})</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                      <tr class="text-primary">
                          <th>No.</th>
                          <th>Name</th>
                          <th>Qty Available</th>
                          <th>Actions</th>
                          <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($stocks as $key => $stock)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td class="text-nowrap">{{ $stock->drug->name }}</td>
                            <!-- <td class="text-nowrap">{{$stock->status}}</td> -->
                            <td><strong class="badge badge-info rounded">{{$stock->stock_quantity}}</strong></td>
                            <td>
                              <!-- <a href="#" class="btn btn-success btn-sm"> View </a> -->
                              <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm">Action</button>
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                  <!-- <a class="dropdown-item" href="#">Receive stock</a> -->
                                  <button class="dropdown-item btn btn-outline-primary" data-toggle="modal" data-target="#addProduct" data-id="{{ $stock->id }}"  data-product="{{ $stock->drug->name }}">Receive Stock</button>
                                  <button class="dropdown-item btn btn-outline-primary" data-toggle="modal" data-target="#issueDrug" data-id="{{ $stock->id }}"  data-product="{{ $stock->drug->name }}">Issue Stock</button>
                                  <button class="dropdown-item btn btn-outline-primary" data-toggle="modal" data-target="#deleteDrug" data-id="{{ $stock->id }}"  data-product="{{ $stock->drug->name }}">Delete</button>
                                  <!-- <a class="dropdown-item btn btn-outline-primary" data-toggle="modal" data-target="#issue-drug">Issue Stock</a> -->
                                  <!-- <a class="dropdown-item btn btn-outline-danger" data-toggle="modal" data-target="#modal-3{{ $key }}">Delete</a> -->
                                  <button class="dropdown-item btn btn-outline-primary" data-toggle="modal" data-target="#viewDrug" data-id="{{ $stock->id }}"  data-product="{{ $stock->drug->name }}">View</button>
                                </div>
                              </div>
                              <!-- model for delete alert -->
                              <div class="modal fade" id="deleteDrug" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header bg-danger border-0">
                                            <h5 class="modal-title text-white"></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                          <div class="modal-body text-white p-5">
                                        </div>
                                        <div class="modal-footer border-0">
                                          <!-- {{ Form::submit('Continue', ['class' => 'btn btn-dange']) }} -->
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            {{ Form::open(['route' => ['stocks.destroy', $stock->id ], 'method' => 'DELETE']) }}
                                            <button type="submit" class="btn btn-danger">Continue</button>
                                            {{ Form::close() }}
                                        </div>

                                      </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                              <div class="btn-group">
                                <!-- logic to determine whether we are activating or deactivating -->
                                <?php
                                $status = 'Deactive';
                                if($stock->status == 'Deactive'){
                                  $status = 'Activate';
                                }
                                ?>
                                <button type="button" class="btn btn-success btn-sm">{{$stock->status}}</button>
                                <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">
                                  <!-- then display the appriate link -->
                                  <!-- <a class="dropdown-item" href="#">{{$status}}</a> -->
                                  <a class="dropdown-item" href="#">{{$status}}</a>
                                </div>
                              </div>
                            </td>

                        </tr>

                      @endforeach
                      @unless($stocks)
                        <tr>
                          <td colspan="5"> <h3 class="text-danger">No Stocks have been Recorded</h3> </td>
                        </tr>
                      @endunless
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- model for receiving drugs -->
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary border-0">
                  <h5 class="modal-title text-white"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <form>
                {{ csrf_field() }}

                <div class="modal-body">
                  <div class="alert alert-danger print-error-msg">
                      <ul></ul>
                  </div>
                  <div class="alert alert-success print-success-msg" style="display:none">
                      <p></p>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        {{ Form::label('date', 'Transaction Date') }}
                        {{ Form::date('date', '',['class' => 'form-control']) }}
                      </div>
                        {{ Form::hidden('product_name', '', ['class' => 'form-control'] ) }}
                        {{ Form::hidden('stock_id', '' , ['class' => 'form-control'] ) }}
                      <div class="col-md-12">
                        {{ Form::label('from', 'Given By') }}
                        {{ Form::text('from','', ['class' => 'form-control'] ) }}
                      </div>
                      <div class="col-md-12">
                        {{ Form::label('voucher_no', 'Voucher Number') }}
                        {{ Form::text('voucher_no','', ['class' => 'form-control'] ) }}
                      </div>
                      <div class="col-md-12">
                        {{ Form::label('batch_number', 'Batch No.') }}
                        {{ Form::text('batch_number','', ['class' => 'form-control'] ) }}
                      </div>
                      <div class="col-md-12">
                        {{ Form::label('quantity', 'Quantity-In') }}
                        {{ Form::number('quantity','', ['class' => 'form-control'] ) }}
                      </div>
                      <div class="col-md-12">
                        {{ Form::label('expiry_date', 'Expiry Date') }}
                        {{ Form::date('expiry_date','', ['class' => 'form-control'] ) }}
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                  <button class="btn btn-success btn-submit" id="submit-data">Submit</button>
              </div>
            {{ Form::close() }}
        </div>
    </div>
  </div>
    <!-- model for issuing drugs -->
  <div class="modal fade" id="issueDrug" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary border-0">
                  <h5 class="modal-title text-white"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

              <form>
                {{ csrf_field() }}

              <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="alert alert-success print-success-msg" style="display:none">
                    <p></p>
                </div>
                  <div class="row">
                      <div class="col-md-12">
                          {{ Form::label('date', 'Transaction Date') }}
                          {{ Form::date('issued_date', '',['class' => 'form-control']) }}
                      </div>
                        {{ Form::hidden('issued_product_name', '', ['class' => 'form-control'] ) }}
                        {{ Form::hidden('issued_stock_id', '' , ['class' => 'form-control'] ) }}

                      <div class="col-md-12">
                          {{ Form::label('issued_recipient', 'Recipient') }}
                          {{ Form::text('issued_recipient','', ['class' => 'form-control'] ) }}
                      </div>
                      <div class="col-md-12">
                          {{ Form::label('issued_voucher_no', 'Voucher Number') }}
                          {{ Form::text('issued_voucher_no','', ['class' => 'form-control'] ) }}
                      </div>
                      <div class="col-md-12">
                          {{ Form::label('quantity_out', 'Quantity-Out') }}
                          {{ Form::number('quantity_out','', ['class' => 'form-control'] ) }}
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id = "submit">Click To Remove</button>
              </div>
              {{ Form::close() }}
          </div>
      </div>
  </div>
  <!-- modal for viewing drug -->
  <div class="modal fade" id="viewDrug" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header bg-primary border-0">
                  <h5 class="modal-title text-white"></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
              <div class="card-body">
                <div class="row">
               <div class="col-md-12 mb-4">
                   <ul class="nav nav-tabs" role="tablist">
                       <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home"><i class="icon-detail"></i>Details</a>
                       </li>

                       <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"><i class="icon-calculator"></i>History</a>
                       </li>

                       <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages"><i class="icon-pie-chart"></i>Charts</a>
                       </li>
                   </ul>

                   <div class="tab-content">
                       <div class="tab-pane active" id="home" role="tabpanel">
                         <div class="card border-light">
                           <div class="card-header bg-light">
                               <strong>STOCKS AT THE STORE ({{ count($stocks) }})</strong>
                           </div>

                           <div class="card-body">
                               <div class="table-responsive">
                                   <table class="table table-bordered table-striped">
                                       <thead>
                                         <tr class="text-primary">
                                             <th>Name</th>
                                             <th>Qty Available</th>
                                             <th>Strength</th>
                                             <th>Dosage Form</th>
                                             <th>Unit of Issue</th>
                                             <th>Cost Per Unit</th>
                                             <th>Package Size</th>
                                         </tr>
                                       </thead>
                                       <tbody>
                                         {{--<tr>
                                             <!-- <td class="text-nowrap" id = '1'></td>
                                             <td id = '2'><strong class="badge badge-info rounded"></strong></td> -->
                                             <!-- <td id = '2'><strong class="badge badge-info rounded">{{$stock->stock_quantity}}</strong></td> -->
                                             <!-- <td><strong class="badge badge-info rounded">{{$stock->drug->strength}}</strong></td>
                                             <td><strong class="badge badge-info rounded">{{$stock->drug->dosage_form}}</strong></td>
                                             <td><strong class="badge badge-info rounded">{{$stock->drug->unit_of_issue}}</strong></td>
                                             <td><strong class="badge badge-info rounded">{{$stock->drug->cost_per_unit}}</strong></td>
                                             <td><strong class="badge badge-info rounded">{{$stock->drug->package_size}}</strong></td> -->

                                         </tr> --}}
                                         @unless($stocks)
                                           <tr>
                                             <td colspan="5"> <h3 class="text-danger">No Stocks have been Recorded</h3> </td>
                                           </tr>
                                         @endunless
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                       </div>

                       <div class="tab-pane" id="profile" role="tabpanel">
                           2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                           dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                       </div>

                       <div class="tab-pane" id="messages" role="tabpanel">
                           3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                           dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                       </div>
                   </div>
               </div>
             </div>
           </div>
         </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" id = "submit">Click To Remove</button>
              </div>
          </div>
      </div>
  </div>


@endsection


@section('script')

<script type="text/javascript">

      $('#addProduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var productID = button.data('id'); // Extract info from data-* attributes
        var product = button.data('product'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('Add ' + product +' to the store ' + productID);
        modal.find(".modal-body input[name='stock_id']").val(productID);
        modal.find(".modal-body input[name='product_name']").val(product);
      });
      $('#issueDrug').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var productID = button.data('id'); // Extract info from data-* attributes
        var product = button.data('product'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('Issue ' + product +' Out');
        modal.find(".modal-body input[name='issued_stock_id']").val(productID);
        modal.find(".modal-body input[name='issued_product_name']").val(product);
      });
      $('#deleteDrug').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var productID = button.data('id'); // Extract info from data-* attributes
        var product = button.data('product'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-body').text('You are about to delete ' + product +' from stock list');
        modal.find('.modal-title').text('Warning');
        modal.find(".modal-body input[name='stock_id']").val(productID);
        modal.find(".modal-body input[name='product_name']").val(product);
      });
      $('#viewDrug').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var productID = button.data('id'); // Extract info from data-* attributes
        var product = button.data('product'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('.modal-title').text('Details for '+ product);
        modal.find('#1').text(product);
        modal.find(".modal-body input[name='stock_id']").val(productID);
        modal.find(".modal-body input[name='product_name']").val(product);
      });

    $(document).ready(function() {

        $(".print-error-msg").hide();
        $(".print-success-msg").hide();

        $("#submit-data").click( function(event){

        event.preventDefault();

        var _token = $("input[name='_token']").val();
        var date = $("input[name='date']").val();
        var product_name = $("input[name='product_name']").val();
        var stock_id = $("input[name='stock_id']").val();
        var from = $("input[name='from']").val();
        var voucher_no = $("input[name='voucher_no']").val();
        var batch_number = $("input[name='batch_number']").val();
        var quantity = $("input[name='quantity']").val();
        var expiry_date = $("input[name='expiry_date']").val();

        $.ajax({
            url: "api/products",
            type:'POST',
            data: {_token:_token, date:date, product_name:product_name, stock_id:stock_id, from:from, voucher_no:voucher_no, batch_number:batch_number, quantity:quantity, expiry_date:expiry_date },
            success: function(data) {

                if (!($.isEmptyObject(data.errors))) {
                  console.log(data.errors);
                  printErrorMsg(data.errors);
                } else if ($.isEmptyObject(data.error)) {
                  $(".print-error-msg").empty();
                  $(".print-error-msg").find("ul").html();
                  $(".print-error-msg").show();
                  $(".print-error-msg").append("<li>" + data.error + "</li>");
                }
                if($.isEmptyObject(data.errors) && $.isEmptyObject(data.error) ){
                  $("input[name='_token']").val('');
                  $("input[name='date']").val('');
                  $("input[name='product_name']").val('');
                  $("input[name='stock_id']").val('');
                  $("input[name='from']").val('');
                  $("input[name='voucher_no']").val('');
                  $("input[name='batch_number']").val('');
                  $("input[name='quantity']").val('');
                  $("input[name='expiry_date']").val('');
                  // alert(data.success);
                  $(".print-success-msg").find("p").html('');
                  $(".print-error-msg").hide();
                  $(".print-success-msg").show();
                  $(".print-success-msg p").text(data.success);
                }

            }
        });
    });

    function printErrorMsg (errors) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").show();
      $.each(errors, function (index, msg) {
        $(".print-error-msg").find("ul").append("<li>"+ msg + "</li>");
      })

    }

    });
    $(document).ready(function() {
        $("#submit").click( function(event){

        event.preventDefault();

        var _token = $("input[name='_token']").val();
        var issued_date = $("input[name='issued_date']").val();
        var issued_product_name = $("input[name='issued_product_name']").val();
        var issued_stock_id = $("input[name='issued_stock_id']").val();
        var issued_recipient = $("input[name='issued_recipient']").val();
        var issued_voucher_no = $("input[name='issued_voucher_no']").val();
        var quantity_out = $("input[name='quantity_out']").val();
        $.ajax({
            url: "api/issued_stocks",
            type:'POST',
            data: {_token:_token, issued_date:issued_date, issued_product_name:issued_product_name, issued_stock_id:issued_stock_id, issued_recipient:issued_recipient, issued_voucher_no:issued_voucher_no, quantity_out:quantity_out},
            success: function(data) {
              // console.log(data);

                if (!($.isEmptyObject(data.errors))) {
                  printErrorMsg(data.errors);
                  console.log(data.errors);
                } else if ($.isEmptyObject(data.error)) {
                  console.log(data.error);
                }
                if($.isEmptyObject(data.errors) && $.isEmptyObject(data.error) ){
                  $("input[name='_token']").val('');
                  $("input[name='issued_date']").val('');
                  $("input[name='issued_product_name']").val('');
                  $("input[name='issued_stock_id']").val('');
                  $("input[name='issued_recipient']").val('');
                  $("input[name='issued_voucher_no']").val('');
                  $("input[name='quantity_out']").val('');
                  // alert(data.success);
                  $(".print-error-msg").hide();
                  $(".print-success-msg").find("p").html('');
                  $(".print-success-msg").css('display','block');
                  $(".print-success-msg").find("p").append(data.success);
                }

            }
        });
    });

    function printErrorMsg (msg) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( msg, function( key, value ) {
        $(".print-success-msg").hide();
        $(".print-error-msg").find("ul").append('<li>'+ value +'</li>');
      });
    }
    // function printSuccessMsg (msg) {
    //   $(".print-success-msg").find("ul").html('');
    //   $(".print-success-msg").css('display','block');
    //   // $.each( msg, function( key, value ) {
    //   //   $(".print-error-msg").find("ul").append('<li>'+ value +'</li>');
    //   // });
    // }

    });
  </script>
@endsection
