@extends('layouts.master')

@section('title', 'health centers below')

@section('content')
      <div class="card border-info">
        <div class="card-header bg-light">
            <strong>Health Facilities ({{ count($healthFacilitiesUnder) }})</strong>
            <div class="float-right">
              <a href="#" class="btn btn-primary btn-sm"> <i class="icon icon-plus"></i> Create New </a>
              <a href="{{ URL::current() }}" class="btn btn-info btn-sm"> <i class="icon icon-refresh"></i> Refresh </a>
            </div>
        </div>
        <div class="card-body">
            @include('components.notifications')
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr class="text-primary">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Phone</th>
                        <th>HSD</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($healthFacilitiesUnder as $key => $healthFacilityUnder)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td class="text-nowrap">{{ $healthFacilityUnder->name }}</td>
                            <td> <strong>{{ $healthFacilityUnder->level }}</strong> </td>
                            <td>{{ $healthFacilityUnder->phone }}</td>
                            <td>{{ $healthFacilityUnder->healthSubDistrict['name'] }}
                            <td>
                              <a href="#" class="btn btn-success btn-sm"> View </a>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
