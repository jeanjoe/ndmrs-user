@extends('layouts.master')

@section('title')

Stock Book- {{ $currentUser->healthFacility->name }}

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">

            {{ $currentUser->healthFacility->name }} - View Stock Books

            <div class="card-actions">
                <a href="{{ route('stock_books.create') }}" class="btn">
                    <i class="fa fa-plus-circle"></i>
                </a>

                <a href="{{ URL::current() }}" class="btn">
                    <i class="icon icon-refresh"></i>
                </a>
            </div>
        </div>

        <div class="card-body">

          <table class="table table-striped table-sm" id="dataTable">
            <thead>
              <th>#</th>
              <th>Name</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Date Created</th>
              <th>Actions</th>
            </thead>
            <tbody>
              @forelse($stockBooks as $key =>  $stockBook)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $stockBook['name'] }}</td>
                  <td>{{ $stockBook['start_date'] }}</td>
                  <td>{{ $stockBook['end_date'] }}</td>
                  <td>{{ $stockBook['created_at'] }}</td>
                  <td>Actions</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5">No Stock Books exist</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
    </div>
@endsection

@section('script')

@endsection
