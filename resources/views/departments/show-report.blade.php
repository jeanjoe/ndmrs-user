@extends('layouts.master')

@section('title')

{{ $currentUser->healthFacility->name }} - Departments

@endsection

@section('content')
      <div class="card">
        <div class="card-header bg-light">

            <strong>{{ $currentUser->healthFacility->name }} - {{ $report->issueDrug->drug->name }}</strong>

            <div class="card-actions">
                <a href="{{ route('departments.create') }}" class="btn">
                    <i class="fa fa-plus-circle"></i> Create New
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i> Reload
                </a>
            </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">

        </div>
      </div>


@endsection
