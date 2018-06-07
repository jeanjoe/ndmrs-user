@extends('layouts.master')

@section('title')

Stock Book- {{ $currentUser->healthFacility->name }}

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">

            <h3><b>{{ $currentUser->healthFacility->name }} - Stock Books</b> </h3>

            <div class="card-actions">
                <a href="{{ route('stock-books.create') }}" class="btn">
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
              <th>Stock Items</th>
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
                  <td>0</td>
                  <td>{{ $stockBook['created_at'] }}</td>
                  <td>
                    <a href="{{ route('stock-books.edit', $stockBook['id']) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> </a>
                    <a href="{{ route('stock-books.show', $stockBook['id']) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>
                    {{ Form::open(['route' => ['stock-books.destroy', $stockBook['id']], 'method' => 'DELETE', 'style' => 'display:inline-block']) }}
                        <button type="submit" class="btn btn-danger btn-sm" name="button" onclick="return confirm('Are you sure you want to delete this stock Book?');"><i class=" fa fa-trash"></i> </button>
                    {{ Form::close() }}

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7">No Stock Books exist</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
    </div>
@endsection

@section('script')

@endsection
