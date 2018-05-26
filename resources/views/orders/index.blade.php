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

        <div class="card-body">
            Coming soon....

            <button type="button" onclick="loadUsers()" class="btn btn-sm btn-info" >Check Registered Users</button>

            <div class="text-danger">
              <table id="dataTable" class="table table-bordered">
          			<thead>
        			    <tr>
            				<th>Name</th>
            				<th>Email</th>
            				<th>Phone</th>
            				<th width="200px">Action</th>
        			    </tr>
          			</thead>
          			<tbody>
          			</tbody>
          		</table>
              <!-- <p id="data"></p> -->
            </div>

            <div class="input_fields_wrap">
                <form class="form" action="{{ url('/users') }}" method="post">
                  {{ csrf_field() }}
                  <button  class="add_field_button btn btn-danger btn-sm">Add More Fields</button>
                  <div><input type="text" class="form-control" name="mytext[]"></div>
                  <button type="submit" name="button">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
  <script type="text/javascript">
      $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input type="text" class="form-control" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });

    function loadUsers() {
      var xhttp;
      if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
      }else {
        xhttp = new ActiveObject("window.XMLHTTP");
      }

      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var jsonData = JSON.parse(this.responseText);
          printData(jsonData);
        }
      }
      xhttp.open('GET', "{{ url('/users') }}", true);
      xhttp.setRequestHeader('Content-type', 'application/json');
      xhttp.setRequestHeader('Accept', 'application/json');
      xhttp.send();
    }

    function printData(data) {
      var rows = "";
      data.users.forEach(function(user, index){
        // output += "<p>" + ++index + " - "+ user.name + "</p>";
        rows = rows + '<tr>';
        rows = rows + '<td>'+user.name+'</td>';
        rows = rows + '<td>'+user.email+'</td>';
        rows = rows + '<td>'+user.phone+'</td>';
        rows = rows + '<td data-id="'+user.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';
      });
      $("tbody").html(rows);
      // document.getElementById('data').innerHTML = rows;
    }
  </script>
@endsection
