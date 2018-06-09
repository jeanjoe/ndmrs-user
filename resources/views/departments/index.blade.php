@extends('layouts.master')

@section('title')

Stock Book- {{ $currentUser->healthFacility->name }}

@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-light">

            {{ $currentUser->healthFacility->name }} - Departments

            <div class="card-actions">
                <a href="{{ route('departments.create') }}" class="btn">
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
              <th>No.</th>
              <th>Name</th>
              <th>Drugs Received</th>
              <th>Date Created</th>
              <th>Actions</th>
            </thead>
            <tbody>
              @forelse($departments as $key =>  $department)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $department['name'] }}</td>
                  <td>{{ $department->drugs()->count() }}</td>
                  <td>{{ $department['created_at'] }}</td>
                  <td class="text-wrap">
                    <a href="" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i> &nbsp;
                    </a>
                    <a href="" class="btn btn-success btn-sm">
                      <i class="fa fa-edit"></i> &nbsp;
                    </a>
                    {{ Form::open(['route' => ['departments.destroy', $department->id], 'method' => 'DELETE', 'style' => 'display:inline-block !important;']) }}
                      <button type="submit" name="delete" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> &nbsp;
                      </button>
                    {{ Form::close() }}
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5">No Department exist</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
    </div>
@endsection

@section('script')

@endsection
