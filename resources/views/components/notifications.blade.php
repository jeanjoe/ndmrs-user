@if (session('success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
        {{ session('success') }}
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
        {{ session('status') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
        {{ session('error') }}
    </div>
@endif

{{-- @if( $errors->any())
  <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
     </button>
    <h4><strong>Whoops! You have Errors, Fix to continue</strong></h4>
    <ol>
      @foreach( $errors->all() as $key => $error)
        <li style="display:inline-block;"> {{ ++$key }} - {{ $error }}</li>
      @endforeach
    </ol>
  </div>
@endif--}}
