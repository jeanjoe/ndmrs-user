@extends('layouts.master')

@section('title', 'NDRMS - All Orders')

@section('content')
<div class="card">
    <div class="card-header bg-light">
        <strong>Add New ({{ $drug->name or "Not Found" }}) </strong>
        <div class="float-right">
          <a href="#" class="btn btn-primary btn-sm"> <i class="icon icon-eye"></i> View All </a>
          <a href="{{ URL::current() }}" class="btn btn-info btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
        </div>
    </div>

    <div class="card-body">

      @if( session('success') )
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif


      @if( session('error') )
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      {{ Form::open([ 'route' => 'stocks.store', 'class' => 'form-horizontal']) }}
        <div class="row">
            <div class="col-md-2">
                {{ Form::label('date', 'Date') }}
                {{ Form::date('date', '',['class' => 'form-control']) }}
                @if( $errors->has('date'))
                  <div class="text-danger">
                    {{ $errors->first('date') }}
                  </div>
                @endif
            </div>
              {{ Form::hidden('product_name', $drug->name, ['class' => 'form-control'] ) }}
              {{ Form::hidden('stock_id', '', ['class' => 'form-control'] ) }}

            <!-- <div class="col-md-2">
                {{ Form::label('name', 'Product Name') }}
                {{ Form::select('name', ['Active'=>'Active', 'Deactive'=> 'Deactive'], 'A', ['class' => 'form-control'] ) }}

                @if( $errors->has('status'))
                  <div class="text-danger">
                    {{ $errors->first('status') }}
                  </div>
                @endif
            </div> -->
            <div class="col-md-3">
                {{ Form::label('from', 'From') }}
                {{ Form::text('from','', ['class' => 'form-control'] ) }}

                @if( $errors->has('from'))
                  <div class="text-danger">
                    {{ $errors->first('from') }}
                  </div>
                @endif
            </div>
            <div class="col-md-3">
                {{ Form::label('quantity', 'Quantity') }}
                {{ Form::number('quantity','', ['class' => 'form-control'] ) }}

                @if( $errors->has('quantity'))
                  <div class="text-danger">
                    {{ $errors->first('quantity') }}
                  </div>
                @endif
            </div>
            <div class="col-md-3">
              {{ Form::label('submit', 'Click to Add')}}
              {{ Form::submit('Add New', ['class' => 'btn btn-primary btn-sm btn-block']) }}
            </div>

        </div>
      {{ Form::close() }}
    </div>
</div>
@endsection
